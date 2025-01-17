<?php

namespace Classes\Quiz;

use PDO;
use PDOException;

class ScoreManager
{
    private $db;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        try {
            $this->db = new PDO('sqlite:db/quiz_app.db');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error connecting to database: " . $e->getMessage());
        }
    }

    public function saveScore(int $idP, int $score): bool
    {
        try {
            $stmt = $this->db->prepare('INSERT INTO QUIZ_DATE (jour) VALUES (DATE("now"))');
            $stmt->execute();
            $idD = $this->db->lastInsertId();

            $stmt = $this->db->prepare('
                INSERT INTO REALISE (idP, idD, score) 
                VALUES (:idP, :idD, :score)
            ');
            $stmt->bindParam(':idP', $idP);
            $stmt->bindParam(':idD', $idD);
            $stmt->bindParam(':score', $score);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error saving score: " . $e->getMessage());
            return false;
        }
    }
}
