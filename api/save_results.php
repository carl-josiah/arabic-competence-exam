<?php

session_start();
require_once __DIR__ . '/../src/Database.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $db = new Database()->connect();
    $stmt = $db->prepare('INSERT INTO exam_results (student_id, student_name, score_percentage, competence_level) VALUES (?, ?, ?, ?)');
    $stmt->execute([$_SESSION['user_id'], $_SESSION['user_name'], $data['score'], $data['level']]);
    echo json_encode(['success' => true]);
}
