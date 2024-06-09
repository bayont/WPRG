<?php

declare(strict_types=1);
abstract class Attempt extends Dbh
{
    protected function setAttempt(string $mode, string $quiz_id, ?string $user_id): string
    {
        $sql = "INSERT INTO attempt (user_id, quiz_id, mode) VALUES (:user_id, :quiz_id, :mode)";
        $dbh = $this->connect();
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':quiz_id', $quiz_id);
        $stmt->bindParam(':mode', $mode);
        $stmt->execute();
        return $dbh->lastInsertId();
    }

    protected function setFinishedAttempt(string $attempt_id): void
    {
        $sql = "UPDATE attempt SET finished_at = NOW() WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$attempt_id]);
    }

    protected function getAttemptById(string $attempt_id): array | false
    {
        $sql = "SELECT * FROM attempt WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$attempt_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
