<?php

declare(strict_types=1);

abstract class Signup extends Dbh
{
    protected function setUser(string $username, string $hashed_password)
    {
        $sql = "INSERT INTO user (user_name, password_hash) VALUES (:username, :hashed_password)";
        $dbh = $this->connect();
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':hashed_password', $hashed_password);
        $stmt->execute();
        return $dbh->lastInsertId();
    }

    protected function getUserById($username)
    {
        $sql = "SELECT * FROM user WHERE user_name = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username]);
        $results = $stmt->fetchAll();
        return $results;
    }
}
