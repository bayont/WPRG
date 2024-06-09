<?php

if (!$_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Location: ../index.php');
    die();
}

$username = $_POST['username'];
$password = $_POST['password'];
$repeated_password = $_POST['repeated_password'];

try {
    require "../classes/dbh.class.php";
    require "../classes/signup/signup.class.php";
    require "../classes/signup/signup-contr.class.php";

    $signupController = new SignupController();
    //Error handlers
    $errors = [];

    if (!$signupController->isInputValid($username, $password, $repeated_password)) {
        $errors['input_invalid'] = 'Please fill in all fields.';
    }

    if (!$signupController->isUsernameValid($username)) {
        $errors['username_invalid'] = 'Invalid username.';
    }

    if (!$signupController->isPasswordValid($password)) {
        $errors['password_invalid'] = 'Password must be at least 5 characters long.';
    }

    if (!$signupController->isPasswordRepeatValid($password, $repeated_password)) {
        $errors['passwords_no_match'] = 'Passwords do not match.';
    }

    if ($signupController->isUsernameTaken($username)) {
        $errors['username_taken'] = 'Username is already taken.';
    }

    if ($signupController->isUsernameTooShort($username)) {
        $errors['username_too_short'] = 'Username must be at least 3 characters long.';
    }

    require_once "./config_session.inc.php";

    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        header('Location: ../signup.php?username=' . $username);
        die();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $user_id = $signupController->createUser($username, $hashed_password);

    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;

    header('Location: ../index.php?signup=success');
    die();
} catch (Exception $e) {
    die('Query failed: ' . $e->getMessage());
}
