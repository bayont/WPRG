<?php
abstract class Login extends Dbh
{
    protected function getUser(string $username): array
    {
        $sql = "SELECT * FROM user WHERE user_name = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    protected function getUserPasswordHash(string $username): string
    {
        $sql = "SELECT password_hash FROM user WHERE user_name = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return '';
        }
        return $result['password_hash'];
    }
}
