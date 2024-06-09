<?php

declare(strict_types=1);

class SignupController extends Signup
{
    public function isInputValid(string $username, string $password, string $passwordRepeat): bool
    {
        if (empty($username) || empty($password) || empty($passwordRepeat)) {
            return false;
        }
        return true;
    }

    public function isUsernameValid(string $username): bool
    {
        if (preg_match('/^[a-zA-Z0-9]*$/', $username)) {
            return true;
        }
        return false;
    }

    public function isPasswordValid(string $password): bool
    {
        if (strlen($password) < 5) {
            return false;
        }

        return true;
    }

    public function isPasswordRepeatValid(string $password, string $passwordRepeat): bool
    {
        if ($password !== $passwordRepeat) {
            return false;
        }
        return true;
    }

    public function isUsernameTooShort(string $username): bool
    {
        if (strlen($username) < 3) {
            return true;
        }
        return false;
    }

    public function isUsernameTaken($username)
    {
        $result = $this->getUserById($username);
        if (empty($result)) {
            return false;
        } else {
            return true;
        }
    }

    public function createUser(string $username, string $password): string
    {
        return $this->setUser($username, $password);
    }
}
