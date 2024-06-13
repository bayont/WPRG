<?php

class Profile extends Dbh
{
    protected function getUserDetails($userId)
    {
        $sql = "SELECT user_name, email, created_at FROM user WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userId]);

        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        return $results;
    }

    protected function getUserCreatedQuizzes($userId)
    {
        $sql = "SELECT * FROM quiz WHERE user_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userId]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    protected function getUserAttempts($userId)
    {
        $sql = "SELECT * FROM attempt WHERE user_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userId]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    protected function getAttemptsNumber($userId)
    {
        $sql = "SELECT COUNT(*) as attemptsNumber FROM attempt WHERE user_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userId]);

        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        return $results;
    }


    protected function getRole($userId)
    {
        $sql = "SELECT role.name FROM user INNER JOIN user_role ON user_role.user_id = user.id INNER JOIN role ON role.id = user_role.role_id WHERE user.id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userId]);

        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        return $results;
    }
}
