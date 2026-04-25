<?php
require_once 'src/SessionManager.php';
SessionManager::start();

require_once 'src/Database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = trim($_POST['student_id'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($student_id === '' || $password === '') {
        $error = 'Please enter both Student ID and Password.';
    } else {
        $db = new Database()->connect();

        if ($db) {
            $stmt = $db->prepare('SELECT student_id, student_name, password FROM users WHERE student_id = ?');
            $stmt->execute([$student_id]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                SessionManager::login($user['student_id'], $user['student_name']);
                header('Location: logged_in.php');
                exit();
            } else {
                $error = 'Invalid Student ID or Password.';
            }
        } else {
            $error = 'Database connection failed.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - Arabic Exam</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <nav>
        <h2>Arabic Exam</h2>
        <div>
            <a href="index.php">Home</a>
            <a href="register.php">Register</a>
        </div>
    </nav>

    <div class="form-box">
        <h2>Login</h2>

        <?php if ($error): ?>
        <p style="color: #dc2626; margin-bottom: 1rem; text-align: center;">
            <?= htmlspecialchars($error) ?>
        </p>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="student_id" placeholder="Student ID" required
                value="<?= htmlspecialchars($_POST['student_id'] ?? '') ?>">
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>

</html>
