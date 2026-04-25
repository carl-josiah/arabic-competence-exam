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
            <p id="progress"></p>
            <h2 id="question-text">Loading Questions...</h2>
            <div id="choices-container">
            </div>
            <button id="prev" onclick="prev()" class="btn">Previous</button>
            <button id="reset" onclick="reset()" class="btn"
                style="background-color: #721c24; border-color: #721c24; color: white;">Reset</button>
            <button id="next" onclick="next()" class="btn">Next</button>
        </div>
    </section>

    <script src="assets/js/StateManager.js"></script>
    <script src="assets/js/UIHandler.js"></script>
</body>

</html>
