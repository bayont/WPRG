<?php

class PermissionController extends Permission
{
    public function userHasPermission($userId, $permissionName)
    {
        return $this->hasPermission($userId, $permissionName);
    }
}
