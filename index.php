<?php
require_once 'src/SessionManager.php';
SessionManager::start();

$startUrl = isset($_SESSION['user_id']) ? 'exam.php' : 'login.php';
$username = $_SESSION['user_name'] ?? 'Student';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arabic Competence Exam</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <nav>
        <h2>Arabic Exam</h2>
        <div>
            <a href="index.php">Home</a>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
            <a href="about.php">About</a>
        </div>
    </nav>

    <section class="hero">
        <h1>Arabic Competence Exam</h1>
        <p>Test your Arabic language skills and discover your level</p>
        <a href="<?php echo $startUrl; ?>" class="btn">Start Now</a>
    </section>

    <section class="container">
        <h2>Exam Information</h2>
        <div class="cards">
            <div class="card">
                <h3>Duration</h3>
                <p>60 Minutes</p>
            </div>
            <div class="card">
                <h3>Levels</h3>
                <p>Beginner, Intermediate, Advanced</p>
            </div>
            <div class="card">
                <h3>Questions</h3>
                <p>46</p>
            </div>
            <div class="card">
                <h3>Type</h3>
                <p>MCQ</p>
            </div>
        </div>
    </section>

    <section class="container">
        <h2>Proficiency Levels</h2>
        <div class="cards">
            <div class="card">
                <h3>Beginner</h3>
                <p>Basic vocabulary and simple sentences</p>
            </div>
            <div class="card">
                <h3>Intermediate</h3>
                <p>Grammar and understanding texts</p>
            </div>
            <div class="card">
                <h3>Advanced</h3>
                <p>Full language proficiency</p>
            </div>
        </div>
    </section>

    <section class="container">
        <h2>Skills Tested</h2>
        <div class="cards">
            <div class="card">Reading & Understanding</div>
            <div class="card">Listening & Understanding</div>
            <div class="card">Writing (Composition)</div>
            <div class="card">Grammar</div>
            <div class="card">Speaking</div>
        </div>
    </section>

    <footer>
        <p>&copy; 2026 Arabic Competence Exam. All rights reserved.</p>
    </footer>
</body>

</html>
