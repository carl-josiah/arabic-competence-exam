<?php

require_once __DIR__ . '/../src/ExamManager.php';

header('Content-Type: application/json; charset=utf-8');

try {
    $manager = new ExamManager();
    $level = $_GET['level'] ?? null;

    $questions = $level !== null && $level !== '' ? $manager->getQuestionsByLevel($level) : $manager->getAllQuestions();

    echo json_encode($questions, JSON_UNESCAPED_UNICODE);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to load questions']);
}
