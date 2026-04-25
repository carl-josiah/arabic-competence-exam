<?php

require_once __DIR__ . '/../src/ExamManager.php';
header('Content-Type: application/json; charset=utf-8');

$manager = new ExamManager();
echo json_encode($manager->getAllQuestions(), JSON_UNESCAPED_UNICODE);
