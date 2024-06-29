<?php

declare(strict_types=1);

class ProfileView extends Profile
{

    public function getAllUsersProfileDetails()
    {
        $users = $this->getAllUsers();
        $usersDetails = [];
        foreach ($users as $user) {
            $userDetails = $this->getPublicProfileDetails(strval($user['id']));
            $usersDetails[] = $userDetails;
        }
        return $usersDetails;
    }

    public function getPublicProfileDetails(string $user_id)
    {
        $user = $this->getUserDetails($user_id);
        $avatarUrl = $user['avatar_url'];
        if ($avatarUrl !== null) {
            $user['avatar_url'] =  $avatarUrl;
        }

        //filter out sensitive information
        unset($user['role_id']);
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
