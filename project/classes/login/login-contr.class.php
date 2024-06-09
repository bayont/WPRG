<?php

declare(strict_types=1);

class LoginController extends Login
{
    public function isInputValid(string $username, string $password): bool
    {
        if (empty($username) || empty($password)) {
            return false;
        }
        return true;
    }

    public function isPasswordCorrect(string $username, string $password): bool
    {
        $passwordHash = $this->getUserPasswordHash($username);
        return password_verify($password, $passwordHash);
    }

    public function getLoggedInUser(string $username): array
    {
        return $this->getUser($username);
    }
}
