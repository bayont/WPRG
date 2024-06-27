<?php

class Permission extends Dbh
{
    protected function hasPermission($userId, $permissionName)
    {
        $sql = "SELECT COUNT(*) AS count
        FROM
            permission
            INNER JOIN role_permission ON permission.name = role_permission.permission_name
            INNER JOIN role ON role_permission.role_id = role.id
            INNER JOIN user ON user.role_id = role.id
        WHERE
        user.id = ?
        AND permission.name = ?;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userId, $permissionName]);

        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($results['count'] > 0) {
            return true;
        } else {
            return false;
        }
    }

    protected function getUserRoleName($userId)
    {
        $sql = "SELECT role.name AS name FROM role INNER JOIN user_role ON role.id = user.role_id WHERE user.id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userId]);

        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        return $results['name'];
    }
}
