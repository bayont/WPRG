<?php

class PermissionView extends Permission
{
    public function userHasPermission($userId, $permissionName)
    {
        return $this->hasPermission($userId, $permissionName);
    }
}
