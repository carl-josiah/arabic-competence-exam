CREATE DATABASE IF NOT EXISTS arabic_exam_db;
USE arabic_exam_db;

CREATE TABLE IF NOT EXISTS questions (
    Id INT PRIMARY KEY,
    Text TEXT NOT NULL,
    ChoiceA TEXT NOT NULL,
    ChoiceB TEXT NOT NULL,
    ChoiceC TEXT NOT NULL,
    ChoiceD TEXT NOT NULL,
    CorrectAnswer INT NOT NULL,
    CategoryId INT NOT NULL,
    PassageId INT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS exam_results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(50) NOT NULL,
    student_name VARCHAR(100) NOT NULL,
    score_percentage DECIMAL(5,2) NOT NULL,
    competence_level VARCHAR(50) NOT NULL,
    exam_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(50) UNIQUE NOT NULL,
    student_name VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL, -- Will store hashed passwords
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
