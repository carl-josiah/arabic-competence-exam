const state = new StateManager();

const EXAM_DURATION_MINUTES = 60;
const EXAM_DURATION_SECONDS = EXAM_DURATION_MINUTES * 60;

let timerInterval = null;
let examSubmitted = false;
sessionStorage.removeItem("lastScoreText");
sessionStorage.removeItem("lastScorePercent");
sessionStorage.removeItem("lastLevel");
sessionStorage.removeItem("examStartTime");
let allowUnload = false;

window.addEventListener("beforeunload", (event) => {
  if (examSubmitted || allowUnload) return;

  event.preventDefault();
  event.returnValue = "";
});

async function init() {
  await state.fetchQuestions();
  startExamTimer();
  render();
}

function getLevelFromScore(percentage) {
  if (percentage >= 80) return "Advanced";
  if (percentage >= 50) return "Intermediate";
  return "Beginner";
}

function startExamTimer() {
  sessionStorage.removeItem("examStartTime");

  const startTime = Date.now();
  sessionStorage.setItem("examStartTime", String(startTime));

  const timerEl = document.getElementById("timer");

  function updateTimer() {
    if (examSubmitted) return;

    const elapsedSeconds = Math.floor((Date.now() - startTime) / 1000);
    const remainingSeconds = EXAM_DURATION_SECONDS - elapsedSeconds;

    if (remainingSeconds <= 0) {
      timerEl.innerText = "Time left: 00:00";
      clearInterval(timerInterval);
      submitExam(true);
      return;
    }

    const minutes = String(Math.floor(remainingSeconds / 60)).padStart(2, "0");
    const seconds = String(remainingSeconds % 60).padStart(2, "0");
    timerEl.innerText = `Time left: ${minutes}:${seconds}`;
  }

  updateTimer();
  timerInterval = setInterval(updateTimer, 1000);
}

function render() {
  const question = state.getCurrentQuestion();
  const qText = document.getElementById("question-text");
  const container = document.getElementById("choices-container");
  const nextBtn = document.getElementById("next");
  const progress = document.getElementById("progress");

  if (!question) {
    qText.innerHTML = "No questions available.";
    container.innerHTML = "";
    progress.innerText = "";
    nextBtn.innerText = "Next";
    nextBtn.onclick = next;
    return;
  }

  progress.innerText = `Question ${state.currentIndex + 1} of ${state.questions.length}`;

  if (state.currentIndex === 0) {
    progress.innerText += " — First question";
  } else if (state.currentIndex === state.questions.length - 1) {
    progress.innerText += " — Last question";
  }

  qText.innerHTML = question.text;
  container.innerHTML = "";

  Object.entries(question.choices).forEach(([key, value]) => {
    const btn = document.createElement("button");
    btn.className = "choice-btn";
    btn.innerText = value;

    if (state.getSavedAnswer() == key) {
      btn.classList.add("selected");
    }

    btn.onclick = () => {
      if (examSubmitted) return;
      state.saveAnswer(key);
      render();
    };

    container.appendChild(btn);
  });

  if (state.currentIndex === state.questions.length - 1) {
    nextBtn.innerText = "Submit Exam";
    nextBtn.onclick = submitExam;
    nextBtn.style.backgroundColor = "#28a745";
  } else {
    nextBtn.innerText = "Next";
    nextBtn.onclick = next;
    nextBtn.style.backgroundColor = "";
  }
}

function next() {
  if (examSubmitted) return;

  if (state.currentIndex < state.questions.length - 1) {
    state.currentIndex++;
    render();
  }
}

function prev() {
  if (examSubmitted) return;

  if (state.currentIndex > 0) {
    state.currentIndex--;
    render();
  }
}

function reset() {
  if (examSubmitted) return;

  const question = state.getCurrentQuestion();
  if (!question) return;

  state.userAnswers[question.id] = null;
  render();
}

function finishExam() {
  if (examSubmitted) return;

  const ok = confirm("Would you like to submit your exam now?");
  if (!ok) return;

  submitExam(false);
}

async function submitExam(fromTimeout = false) {
  if (examSubmitted) return;
  examSubmitted = true;
  allowUnload = true;

  if (timerInterval) {
    clearInterval(timerInterval);
  }

  const totalQuestions = state.questions.length;

  if (!totalQuestions) {
    alert("No questions available to submit.");
    return;
  }

  let correctCount = 0;

  state.questions.forEach((question) => {
    const savedAnswer = state.userAnswers[question.id];
    if (
      savedAnswer != null &&
      String(savedAnswer) === String(question.correct)
    ) {
      correctCount++;
    }
  });

  const scoreText = `${correctCount}/${totalQuestions}`;
  const percentage = Math.round((correctCount / totalQuestions) * 100);
  const level = getLevelFromScore(percentage);

  sessionStorage.setItem("lastScoreText", scoreText);
  sessionStorage.setItem("lastScorePercent", String(percentage));
  sessionStorage.setItem("lastLevel", level);

  const payload = {
    correct_count: correctCount,
    total_questions: totalQuestions,
    score: percentage,
    level: level,
    answers: state.userAnswers,
    from_timeout: fromTimeout,
  };

  try {
    await fetch("api/save_results.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(payload),
    });
  } catch (error) {
    console.error("Network error while saving results:", error);
  }

  sessionStorage.removeItem("examStartTime");
  window.location.href = "results.php";
}

init();
