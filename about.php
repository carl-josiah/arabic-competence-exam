<?php
require_once 'src/SessionManager.php';
SessionManager::start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Arabic Competence Exam</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <nav>
        <h2>Arabic Exam</h2>
        <div>
            <a href="index.html">Home</a>
            <a href="login.html">Login</a>
            <a href="register.html">Register</a>
            <a href="about.html">About</a>
        </div>
    </nav>

    <section class="container">
        <h2>About This Project</h2>

        <p style="max-width:800px; margin:auto; text-align:center;">
            The Arabic Competence Exam is a web-based platform designed to evaluate Arabic language proficiency
            through structured assessments covering reading and comprehension.
        </p>
    </section>

    <section class="container">
        <h2>Who developed this platform?</h2>

        <div class="cards">
            <div class="card">
                <h3>Developers</h3>
                <p>
                    Carl Castro – 202211346<br>
                    Firas Elhag – 202310264<br>
                    Omar Mohammed – 202311782<br>
                    Zohair Jamall – 202311793<br>
                    Clark Kevin Montemayor – 202320050
                </p>
            </div>

            <div class="card">
                <h3>Project Type</h3>
                <p>Academic Web Development Project</p>
            </div>

            <div class="card">
                <h3>Purpose</h3>
                <p>To assess Arabic language competence in a structured digital format</p>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2026 Arabic Competence Exam</p>
    </footer>

</body>

</html>
