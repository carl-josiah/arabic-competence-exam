<?php
require_once 'src/SessionManager.php';
SessionManager::start();
require_once 'src/Database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database()->connect();
    $stmt = $db->prepare('SELECT * FROM users WHERE student_id = ?');
    $stmt->execute([$_POST['student_id']]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        SessionManager::login($user['student_id'], $user['student_name']);
        header('Location: logged_in.php');
        exit();
    } else {
        $error = 'Invalid Student ID or Password';
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
        <?php if (isset($error)) {
            echo "<p style='color:red; text-align:center;'>$error</p>";
        } ?>
        <form method="POST">
            <input type="text" name="student_id" placeholder="Student ID" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>

</html>
