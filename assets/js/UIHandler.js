const state = new StateManager();

async function init() {
  await state.fetchQuestions();
  render();
}

function render() {
  const question = state.getCurrentQuestion();
  const qText = document.getElementById("question-text");
  const container = document.getElementById("choices-container");
  const nextBtn = document.getElementById("next");

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
  if (state.currentIndex < state.questions.length - 1) {
    state.currentIndex++;
    render();
  }
}

function prev() {
  if (state.currentIndex > 0) {
    state.currentIndex--;
    render();
  }
}

function reset() {
  state.userAnswers[state.getCurrentQuestion().id] = null;
  render();
}

init();
