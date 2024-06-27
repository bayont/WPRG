<?php
require_once './config_session.inc.php';

if (isset($_SESSION['user_id'])) {
    $logged_in = true;
} else {
    header('Location: login.php');
    die();
}

if (!isset($_GET['id'])) {
    header('Location: ../index.php');
    die();
}

require_once '../classes/dbh.class.php';
require_once '../classes/permission/permission.class.php';
require_once '../classes/permission/permission-contr.class.php';

$permissionController = new PermissionController();


if (!$permissionController->userHasPermission($_SESSION['user_id'], 'delete_user')) {
    header('Location: ../insufficient-permissions.php');
    die();
}

require_once '../classes/profile/profile.class.php';
require_once '../classes/profile/profile-contr.class.php';

$profileController = new ProfileController();

$profileController->deleteUserById($_GET['id']);

header('Location: ' . $_SERVER['HTTP_REFERER']);
