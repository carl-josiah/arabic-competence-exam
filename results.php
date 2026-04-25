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
            <a href="index.php">Home</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="result-container" style="text-align: center; margin-top: 50px;">
        <h1 id="competence-text">Calculating...</h1>
        <div class="score-circle">
            <span id="final-score">0</span>%
        </div>
        <p id="feedback-message"></p>
        <a href="exam.php" class="btn">Retake Exam</a>
    </div>

    <script>
        // Pull data from sessionStorage (set by UIHandler.js)
        const score = sessionStorage.getItem('lastScore');
        const level = sessionStorage.getItem('lastLevel');

        if (score && level) {
            document.getElementById('final-score').innerText = score;
            document.getElementById('competence-text').innerText = "Your Level: " + level;

            // Visual feedback
            const msg = document.getElementById('feedback-message');
            if (score >= 80) msg.innerText = "Excellent! You have high Arabic proficiency.";
            else if (score >= 50) msg.innerText = "Good progress. You are at an Intermediate level.";
            else msg.innerText = "Keep practicing! You are currently at a Beginner level.";
        }
    </script>
</body>

</html>
