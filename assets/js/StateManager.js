class StateManager {
  constructor() {
    this.questions = [];
    this.currentIndex = 0;
    this.userAnswers = {};
  }

  async fetchQuestions() {
    const response = await fetch("api/get_questions.php");
    this.questions = await response.json();
  }

  getCurrentQuestion() {
    return this.questions[this.currentIndex];
  }

  saveAnswer(choice) {
    const question = this.getCurrentQuestion();
    this.userAnswers[question.id] = choice;
  }

  getSavedAnswer() {
    const question = this.getCurrentQuestion();
    return this.userAnswers[question.id] || null;
  }
}
