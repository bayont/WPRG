<?php
require_once './config_session.inc.php';

require_once '../classes/dbh.class.php';
require_once '../classes/permission/permission.class.php';
require_once '../classes/permission/permission-contr.class.php';

$permissionContr = new PermissionController();

if (!isset($_POST['uid'])) {
    header('Location: ../index.php');
    die();
}

if ($_POST['uid'] == $_SESSION['user_id']) {
    if (!$permissionContr->userHasPermission($_SESSION['user_id'], 'edit_own_profile')) {
        header('Location: ../insufficient-permissions.php');
        die();
    }
} else {
    if (!$permissionContr->userHasPermission($_SESSION['user_id'], 'edit_profile')) {
        header('Location: ../insufficient-permissions.php');
        die();
    }
}

if (isset($_FILES['avatar'])) {
    $file = $_FILES['avatar'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    $file_ext = explode('.', $file_name);
    $file_ext = strtolower(end($file_ext));
    $allowed = array('jpg', 'jpeg', 'png', 'gif', 'webp', 'svg');

    if (in_array($file_ext, $allowed)) {
        if ($file_error === 0) {
            if ($file_size <= 2097152) {
                $file_name_new = uniqid('', true) . '.' . $file_ext;
                $file_destination = '../uploads/' . $file_name_new;
                if (move_uploaded_file($file_tmp, $file_destination)) {
                    $file_uploaded = true;
                }
            }
        }
    }
}

require_once '../classes/signup/signup.class.php';
require_once '../classes/signup/signup-contr.class.php';
require_once '../classes/profile/profile.class.php';
require_once '../classes/profile/profile-contr.class.php';


$profileContr = new ProfileController();
$signupContr = new SignupController();


if (isset($file_uploaded) && $file_uploaded) {
    $profileContr->setAvatar($_POST['uid'], $file_name_new);
}

if (isset($_POST['username'])) {
    $newUsername = $_POST['username'];
    if ($signupContr->isUsernameValid($newUsername) && !$signupContr->isUsernameTaken($newUsername)) {
        $profileContr->setNewUsername($_POST['uid'], $newUsername);
    }
}

if (isset($_POST['password']) && isset($_POST['retype_password'])) {
    $newPassword = $_POST['password'];
    $retypePassword = $_POST['retype_password'];
    if ($signupContr->isPasswordValid($newPassword) && $signupContr->isPasswordRepeatValid($newPassword, $retypePassword)) {
        $profileContr->setNewPassword($_POST['uid'], $newPassword);
        header('Location ./logout.inc.php');
        die();
    }
}

header('Location: ../profile.php?id=' . $_POST['uid']);
