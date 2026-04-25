<?php

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Question.php';

class ExamManager
{
    private $db;

    public function __construct()
    {
        $this->db = new Database()->connect();
    }

    public function getAllQuestions(): array
    {
        $stmt = $this->db->query('SELECT * FROM questions');
        $rows = $stmt->fetchAll();

        $questions = [];
        foreach ($rows as $row) {
            $questions[] = new Question((int) $row['Id'], $row['Text'], [1 => $row['ChoiceA'], 2 => $row['ChoiceB'], 3 => $row['ChoiceC'], 4 => $row['ChoiceD']], (int) $row['CorrectAnswer']);
        }
        return $questions;
    }
}
