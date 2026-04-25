<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Your Results</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <nav>
        <h2>Arabic Exam</h2>
        <div>
            <a href="logged_in.php">Home</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="result-container" style="text-align: center; margin-top: 50px;">
        <h1 id="competence-text">Calculating...</h1>
        <div class="score-circle">
            <span id="final-score">0/0</span>
        </div>
        <p id="percent-score"></p>
        <p id="feedback-message"></p>
        <a href="exam.php" class="btn">Retake Exam</a>
    </div>

    <script>
        const scoreText = sessionStorage.getItem('lastScoreText');
        const scorePercent = sessionStorage.getItem('lastScorePercent');
        const level = sessionStorage.getItem('lastLevel');

        if (scoreText && scorePercent && level) {
            document.getElementById('final-score').innerText = scoreText;
            document.getElementById('competence-text').innerText = "Your Level: " + level;
            document.getElementById('percent-score').innerText = scorePercent + "%";

            const msg = document.getElementById('feedback-message');
            const percent = parseInt(scorePercent, 10);

            if (percent >= 80) {
                msg.innerText = "Excellent! You have high Arabic proficiency.";
            } else if (percent >= 50) {
                msg.innerText = "Good progress. You are at an Intermediate level.";
            } else {
                msg.innerText = "Keep practicing! You are currently at a Beginner level.";
            }
        }
    </script>
</body>

</html>
