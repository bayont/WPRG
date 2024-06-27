<?php
class ProfileController extends Profile
{
    public function setAvatar(string $userId, string $fileName)
    {
        $this->updateAvatar($userId, $fileName);
    }

    public function setNewPassword(string $userId, string $newPassword)
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $this->updatePassword($userId, $hashedPassword);
    }

    public function setNewUsername(string $userId, string $newUsername)
    {
        $this->updateUsername($userId, $newUsername);
    }

    public function deleteUserById(string $userId)
    {
        $this->deleteUser($userId);
    }
}
