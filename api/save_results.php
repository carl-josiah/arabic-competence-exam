<?php

session_start();
require_once __DIR__ . '/../src/Database.php';

header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!is_array($data)) {
    echo json_encode(['error' => 'Invalid JSON']);
    exit();
}

$correctCount = isset($data['correct_count']) ? (int) $data['correct_count'] : null;
$totalQuestions = isset($data['total_questions']) ? (int) $data['total_questions'] : null;
$score = isset($data['score']) ? (float) $data['score'] : null;
$level = isset($data['level']) ? trim($data['level']) : '';

if ($correctCount === null || $totalQuestions === null || $score === null || $level === '') {
    echo json_encode(['error' => 'Missing data']);
    exit();
}

try {
    $db = new Database()->connect();
    $stmt = $db->prepare('
        INSERT INTO exam_results
        (student_id, student_name, score_percentage, competence_level, correct_count, total_questions)
        VALUES (?, ?, ?, ?, ?, ?)
    ');
    $stmt->execute([$_SESSION['user_id'], $_SESSION['user_name'], $score, $level, $correctCount, $totalQuestions]);

    echo json_encode(['success' => true]);
} catch (Throwable $e) {
    echo json_encode(['error' => 'DB failure']);
}
