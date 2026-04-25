<?php
require_once 'src/Database.php';

$error = '';

$student_id = '';
$student_name = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = trim($_POST['student_id'] ?? '');
    $student_name = trim($_POST['student_name'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($student_id === '' || $student_name === '' || $password === '') {
        $error = 'Please fill in all fields.';
    } elseif (!preg_match('/^20\d{7}$/', $student_id)) {
        $error = 'Student ID must be exactly 9 digits and the format must be \'20XXXXXXX\'.';
    } elseif (!preg_match('/^[\p{L} .\'-]{2,100}$/u', $student_name)) {
        $error = 'Please enter a valid full name.';
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$/', $password)) {
        $error = 'Password must be at least 8 characters and include uppercase, lowercase, number, and special character.';
    } else {
        $db = new Database()->connect();

        if ($db) {
            $checkStmt = $db->prepare('SELECT 1 FROM users WHERE student_id = ?');
            $checkStmt->execute([$student_id]);

            if ($checkStmt->fetch()) {
                $error = 'Student ID already exists. Please use a different one.';
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $db->prepare('INSERT INTO users (student_id, student_name, password) VALUES (?, ?, ?)');

                if ($stmt->execute([$student_id, $student_name, $hashedPassword])) {
                    header('Location: login.php?success=1');
                    exit();
                } else {
                    $error = 'Registration failed. Please try again.';
                }
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

        <?php if ($error): ?>
        <p style="color: #dc2626; margin-bottom: 1rem; text-align: center;">
            <?= htmlspecialchars($error) ?>
        </p>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="student_id" placeholder="Student ID" required
                value="<?= htmlspecialchars($student_id) ?>">
            <input type="text" name="student_name" placeholder="Full Name" required
                value="<?= htmlspecialchars($student_name) ?>">
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn">Register</button>
        </form>
    </div>
</body>

</html>
