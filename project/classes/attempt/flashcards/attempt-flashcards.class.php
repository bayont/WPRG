<?php

declare(strict_types=1);

abstract class AttemptFlashcards extends Attempt
{
    private string $mode = 'flashcards';

    protected function setFlashcardsAttempt(string $quiz_id, ?string $user_id): string
    {
        return parent::setAttempt($this->mode, $quiz_id, $user_id);
    }

    protected function setFlashcardsAttemptAnswer(string $attempt_id, string $flashcard_id, bool $is_known): string
    {
        $sql = "INSERT INTO attempt_flashcards_answer (attempt_id, flashcard_id, is_known) VALUES (:attempt_id, :flashcard_id, :is_known)";
        $dbh = $this->connect();
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':attempt_id', $attempt_id);
        $stmt->bindParam(':flashcard_id', $flashcard_id);
        $stmt->bindValue(':is_known', $is_known, PDO::PARAM_BOOL);
        $stmt->execute();
        return $dbh->lastInsertId();
    }

    protected function setFinishedAttempt(string $attempt_id): void
    {
        parent::setFinishedAttempt($attempt_id);
    }

    protected function getAttemptFlashcardsIds(string $attempt_id): array
    {
        $sql = "SELECT flashcard.id FROM attempt INNER JOIN flashcard ON attempt.quiz_id = flashcard.quiz_id WHERE attempt.id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$attempt_id]);
        $results = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $results;
    }

    protected function getAttemptKnownFlashcardsNumber(string $attempt_id): int
    {
        $sql = "SELECT COUNT(*) FROM attempt_flashcards_answer WHERE attempt_id = ? AND is_known = 1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$attempt_id]);
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result;
    }

    protected function getAttemptUnknownFlashcardsNumber(string $attempt_id): int
    {
        $sql = "SELECT COUNT(*) FROM attempt_flashcards_answer WHERE attempt_id = ? AND is_known = 0";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$attempt_id]);
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result;
    }

    protected function getAttemptFlashcardsNumber(string $attempt_id): int
    {
        $sql = "SELECT COUNT(*) FROM attempt_flashcards_answer WHERE attempt_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$attempt_id]);
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result;
    }
}
