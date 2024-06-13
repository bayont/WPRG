<?php

declare(strict_types=1);

class ProfileView extends Profile
{
    public function getPublicProfileDetails(string $user_id)
    {
        $user = $this->getUserDetails($user_id);

        //filter out sensitive information
        unset($user['email']);
        return $user;
    }

    public function showAttemptsNumber(string $user_id)
    {
        $attempts = $this->getAttemptsNumber($user_id);
        echo $attempts['attemptsNumber'];
    }

    public function showQuizesMade(string $user_id)
    {
        $quizes = $this->getUserCreatedQuizzes($user_id);
        echo count($quizes);
    }

    public function isUserExists(string $user_id)
    {
        $user = $this->getUserDetails($user_id);
        if ($user) {
            return true;
        } else {
            return false;
        }
    }
}