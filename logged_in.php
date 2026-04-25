<?php
require_once 'src/SessionManager.php';
SessionManager::start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$startUrl = 'exam.php';
$username = $_SESSION['user_name'] ?? ($_SESSION['username'] ?? ($_SESSION['name'] ?? 'Student'));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Arabic Competence Exam</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <nav>
        <h2>Arabic Exam</h2>
        <div>
            <a href="logged_in.php">Home</a>
            <a href="results.php">Results</a>
            <a href="report.php">Reports</a>
            <a href="logout.php">Logout</a>
            <a href="about.php">About</a>
        </div>
    </nav>

    <section class="hero">
        <h1>Welcome back, <?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>!</h1>
        <p>You are now signed in and ready to continue your Arabic competence journey.</p>
        <a href="<?php echo $startUrl; ?>" class="btn">Start Exam</a>
    </section>

    <sectionlogin class="container">
        <h2>Account Status</h2>
        <div class="cards">
            <div class="card">
                <h3>Login Status</h3>
                <p>Successfully signed in</p>
            </div>
            <div class="card">
                <h3>Session</h3>
                <p>Active</p>
            </div>
            <div class="card">
                <h3>Next Step</h3>
                <p>Begin your placement test</p>
            </div>
            <div class="card">
                <h3>Results</h3>
                <p>Check your results to view your scores</p>
            </div>
        </div>
    </sectionlogin>

    <section class="container">
        <h2>Quick Actions</h2>
        <div class="cards">
            <div class="card">
                <h3>Take the Exam</h3>
                <p>Start your Arabic competence assessment now.</p>
            </div>
            <div class="card">
                <h3>View Results</h3>
                <p>Review your latest score and performance.</p>
            </div>
            <div class="card">
                <h3>Logout</h3>
                <p>Log out of your account.</p>
            </div>
        </div>
    </section>

    <section class="container">
        <h2>What to Expect</h2>
        <div class="cards">
            <div class="card">60-minute assessment</div>
            <div class="card">46 multiple-choice questions</div>
            <div class="card">Beginner, Intermediate, and Advanced levels</div>
        </div>
    </section>

    <footer>
        <p>&copy; 2026 Arabic Competence Exam. All rights reserved.</p>
    </footer>

</body>

</html>
