<?php
require_once 'src/SessionManager.php';
require_once 'src/Database.php';

SessionManager::start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$db = new Database()->connect();

$studentId = trim($_GET['student_id'] ?? '');
$studentName = trim($_GET['student_name'] ?? '');
$level = trim($_GET['level'] ?? '');
$minScore = trim($_GET['min_score'] ?? '');
$examDate = trim($_GET['exam_date'] ?? '');

$sql = 'SELECT student_id, student_name, score_percentage, competence_level, correct_count, total_questions, exam_date
        FROM exam_results
        WHERE 1 = 1';
$params = [];

if ($studentId !== '') {
    $sql .= ' AND student_id LIKE :student_id';
    $params[':student_id'] = '%' . $studentId . '%';
}

if ($studentName !== '') {
    $sql .= ' AND student_name LIKE :student_name';
    $params[':student_name'] = '%' . $studentName . '%';
}

if ($level !== '') {
    $sql .= ' AND competence_level = :level';
    $params[':level'] = $level;
}

if ($minScore !== '' && is_numeric($minScore)) {
    $sql .= ' AND score_percentage >= :min_score';
    $params[':min_score'] = (float) $minScore;
}

if ($examDate !== '') {
    $sql .= ' AND DATE(exam_date) = :exam_date';
    $params[':exam_date'] = $examDate;
}

$sql .= ' ORDER BY exam_date DESC';

$stmt = $db->prepare($sql);
$stmt->execute($params);
$results = $stmt->fetchAll();

$levels = ['Beginner', 'Intermediate', 'Advanced'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - Arabic Competence Exam</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <nav>
        <h2>Arabic Exam</h2>
        <div>
            <a href="logged_in.php">Home</a>
            <a href="exam.php">Exam</a>
            <a href="report.php">Reports</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <section class="container">
        <h2>Exam Results Report</h2>

        <form method="get" class="form-box report-form">
            <input type="text" name="student_id" placeholder="Student ID" value="<?php echo htmlspecialchars($studentId); ?>">
            <input type="text" name="student_name" placeholder="Student Name" value="<?php echo htmlspecialchars($studentName); ?>">

            <select name="level" class="report-select">
                <option value="">All Levels</option>
                <?php foreach ($levels as $item): ?>
                <option value="<?php echo htmlspecialchars($item); ?>" <?php echo $level === $item ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($item); ?>
                </option>
                <?php endforeach; ?>
            </select>

            <input type="number" name="min_score" placeholder="Minimum Score %" value="<?php echo htmlspecialchars($minScore); ?>"
                min="0" max="100">
            <input type="date" name="exam_date" value="<?php echo htmlspecialchars($examDate); ?>">

            <div class="report-actions">
                <button type="submit" class="btn">Search</button>
                <a href="report.php" class="btn report-clear-btn">Clear Filters</a>
            </div>
        </form>
    </section>

    <section class="container">
        <div class="card report-summary">
            <h3>Total Results</h3>
            <p><?php echo count($results); ?> record(s) found</p>
        </div>

        <div class="report-table-wrap">
            <table class="report-table">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Score</th>
                        <th>Correct / Total</th>
                        <th>Level</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($results): ?>
                    <?php foreach ($results as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['score_percentage']); ?>%</td>
                        <td><?php echo htmlspecialchars($row['correct_count']); ?>/<?php echo htmlspecialchars($row['total_questions']); ?></td>
                        <td><?php echo htmlspecialchars($row['competence_level']); ?></td>
                        <td><?php echo htmlspecialchars($row['exam_date']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="6" class="report-empty">No results found.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

    <footer>
        <p>&copy; 2026 Arabic Competence Exam</p>
    </footer>

</body>

</html>
