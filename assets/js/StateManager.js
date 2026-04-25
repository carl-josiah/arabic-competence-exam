class StateManager {
  constructor() {
    this.questions = [];
    this.currentIndex = 0;
    this.userAnswers = {};
    this.level =
      new URLSearchParams(window.location.search).get("level") ||
      sessionStorage.getItem("examLevel") ||
      "";
  }

  async fetchQuestions() {
    const params = new URLSearchParams();

    if (this.level) {
      params.set("level", this.level);
    }

    const url = params.toString()
      ? `api/get_questions.php?${params.toString()}`
      : "api/get_questions.php";

    const response = await fetch(url);

    if (!response.ok) {
      throw new Error("Failed to fetch questions");
    }

    const data = await response.json();

    this.questions = Array.isArray(data) ? data : [];
  }

  getCurrentQuestion() {
    return this.questions[this.currentIndex];
  }

  saveAnswer(choice) {
    const question = this.getCurrentQuestion();
    if (!question) return;
    this.userAnswers[question.id] = choice;
  }

  getSavedAnswer() {
    const question = this.getCurrentQuestion();
    if (!question) return null;
    return this.userAnswers[question.id] || null;
  }
}
