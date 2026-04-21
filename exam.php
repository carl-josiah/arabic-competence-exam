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
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
        </div>
    </nav>

    <section class="container">
        <div id="exam-app" class="form-box" style="max-width: 800px;">
            <h2 id="question-text">Loading Questions...</h2>

            <div id="choices-container">
            </div>

            <div class="controls">
                <button onclick="prev()" class="btn">Previous</button>
                <button onclick="reset()" class="btn"
                    style="background-color: #721c24; border-color: #721c24; color: white;">Reset</button>
                <button onclick="next()" class="btn">Next</button>
            </div>
        </div>
    </section>

    <script src="assets/js/StateManager.js"></script>
    <script src="assets/js/UIHandler.js"></script>
</body>

</html>
