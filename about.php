<?php
require_once 'src/SessionManager.php';
SessionManager::start();

$homeUrl = isset($_SESSION['user_id']) ? 'logged_in.php' : 'index.php';
$loginUrl = isset($_SESSION['user_id']) ? 'logout.php' : 'login.php';
$loginText = isset($_SESSION['user_id']) ? 'Logout' : 'Login';
$welcomeText = isset($_SESSION['user_name']) ? 'Welcome, ' . htmlspecialchars($_SESSION['user_name']) . '!' : '';
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
            <a href="<?php echo $homeUrl; ?>">Home</a>
            <a href="<?php echo $loginUrl; ?>"><?php echo $loginText; ?></a>
            <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="register.php">Register</a>
            <?php endif; ?>
            <a href="about.php">About</a>
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
