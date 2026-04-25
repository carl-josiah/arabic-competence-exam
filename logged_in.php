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
            <a href="index.php">Home</a>
            <a href="results.php">Results</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <section class="hero">
        <h1>Welcome back, <?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>!</h1>
        <p>You are now signed in and ready to continue your Arabic competence journey.</p>
        <a href="<?php echo $startUrl; ?>" class="btn">Start Exam</a>
    </section>

    <section class="container">
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
                <h3>Support</h3>
                <p>Check your profile for updates</p>
            </div>
        </div>
    </section>

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
                <h3>Edit Profile</h3>
                <p>Update your account information and preferences.</p>
            </div>
        </div>
    </section>

    <section class="container">
        <h2>What to Expect</h2>
        <div class="cards">
            <div class="card">30-minute assessment</div>
            <div class="card">20 multiple-choice questions</div>
            <div class="card">Beginner, Intermediate, and Advanced levels</div>
            <div class="card">Grammar, reading, listening, writing, and speaking</div>
        </div>
    </section>

    <footer>
        <p>&copy; 2026 Arabic Competence Exam. All rights reserved.</p>
    </footer>

</body>

</html>
