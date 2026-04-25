<?php
require_once 'src/SessionManager.php';
SessionManager::start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam - Arabic Competence Exam</title>
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

    <section class="container">
        <div id="exam-app" class="form-box" style="max-width: 800px;">
            <p id="timer"></p>
            <p id="progress"></p>
            <h2 id="question-text">Loading Questions...</h2>
            <div id="choices-container"></div>

            <div class="controls">
                <div class="controls-left">
                    <button id="prev" onclick="prev()" class="btn">Previous</button>
                </div>

                <div class="controls-center">
                    <button id="reset" onclick="reset()" class="btn">Reset</button>
                    <button id="finish" onclick="finishExam()" class="btn">Finish Exam</button>
                </div>

                <div class="controls-right">
                    <button id="next" onclick="next()" class="btn">Next</button>
                </div>
            </div>
        </div>
    </section>

    <script src="assets/js/StateManager.js"></script>
    <script src="assets/js/UIHandler.js"></script>
</body>

</html>
