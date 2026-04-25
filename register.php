<?php 'includes/header.php';
require_once 'src/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database()->connect();

    $student_id = $_POST['student_id'];
    $name = $_POST['student_name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $db->prepare('INSERT INTO users (student_id, student_name, password) VALUES (?, ?, ?)');

    if ($stmt->execute([$student_id, $name, $password])) {
        header('Location: login.php?success=1');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register - Arabic Exam</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <nav>
        <h2>Arabic Exam</h2>
        <div>
            <a href="index.php">Home</a>
            <a href="login.php">Login</a>
        </div>
    </nav>

    <div class="form-box">
        <h2>Register</h2>
        <form method="POST">
            <input type="text" name="student_id" placeholder="Student ID (e.g. 202310123)" required>
            <input type="text" name="student_name" placeholder="Full Name" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn">Register</button>
        </form>
    </div>
</body>

</html>
