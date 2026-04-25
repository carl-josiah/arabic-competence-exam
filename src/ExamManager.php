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

    private function buildQuestions(array $rows): array
    {
        $questions = [];

        foreach ($rows as $row) {
            $questions[] = new Question(
                (int) $row['Id'],
                $row['Text'],
                [
                    1 => $row['ChoiceA'],
                    2 => $row['ChoiceB'],
                    3 => $row['ChoiceC'],
                    4 => $row['ChoiceD'],
                ],
                (int) $row['CorrectAnswer'],
            );
        }

        return $questions;
    }

    public function getAllQuestions(): array
    {
        $stmt = $this->db->query('SELECT * FROM questions ORDER BY Id ASC');
        $rows = $stmt->fetchAll();

        return $this->buildQuestions($rows);
    }

    public function getQuestionsByLevel(?string $level): array
    {
        $level = strtolower(trim((string) $level));

        if ($level === '' || $level === 'all') {
            return $this->getAllQuestions();
        }

        $categoryMap = [
            'beginner' => [4],
            'intermediate' => [4],
            'advanced' => [4],
        ];

        $categoryIds = $categoryMap[$level] ?? [4];
        $placeholders = implode(',', array_fill(0, count($categoryIds), '?'));

        $stmt = $this->db->prepare("SELECT * FROM questions WHERE CategoryId IN ($placeholders) ORDER BY Id ASC");
        $stmt->execute($categoryIds);
        $rows = $stmt->fetchAll();

        if (!$rows) {
            return $this->getAllQuestions();
        }

        return $this->buildQuestions($rows);
    }
}
