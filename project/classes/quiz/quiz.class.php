<?php

declare(strict_types=1);

abstract class Quiz extends Dbh
{
    protected function getCategories(): array
    {
        $sql = "SELECT * FROM category";
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetchAll();
        return $results;
    }

    protected function setQuiz(string $title, string $description, int $category_id, int $user_id): string
    {
        $sql = "INSERT INTO quiz (title, description, category_id, user_id) VALUES (:title, :description, :category_id, :user_id)";
        $dbh = $this->connect();
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $dbh->lastInsertId();
    }

    protected function getQuizById($quiz_id): array
    {
        $sql = "SELECT * FROM quiz WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$quiz_id]);
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        return $results;
    }

    protected function setSide(string $content, ?string $imgPath = null): string
    {
        $sql = "INSERT INTO side (content, img_path) VALUES (:content, :img)";
        $dbh = $this->connect();
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':img', $imgPath);
        $stmt->execute();
        return $dbh->lastInsertId();
    }

    protected function getSideById($side_id): array
    {
        $sql = "SELECT * FROM side WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$side_id]);
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        return $results;
    }

    protected function setFlashcard(string $front_id, string $reverse_id, int $quiz_id): string
    {
        $dbh = $this->connect();
        $sql = "INSERT INTO flashcard (front_id, reverse_id, quiz_id) VALUES (:front, :reverse, :quiz_id)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':front', $front_id);
        $stmt->bindParam(':reverse', $reverse_id);
        $stmt->bindParam(':quiz_id', $quiz_id);
        $stmt->execute();
        return $dbh->lastInsertId();
    }

    protected function getFlashcardsByQuizId($quiz_id): array
    {
        $sql = "SELECT * FROM flashcard WHERE quiz_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$quiz_id]);
        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getAttempts($quiz_id): array
    {
        $sql = "SELECT * FROM attempt WHERE quiz_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$quiz_id]);
        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getCategoryById($category_id): array
    {
        $sql = "SELECT * FROM category WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$category_id]);
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        return $results;
    }

    protected function getQuizzesByUserId(string $user_id): array
    {
        $sql = "SELECT * FROM quiz WHERE user_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_id]);
        $results = $stmt->fetchAll();
        return $results;
    }
}
