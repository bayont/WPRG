<?php

if (!$_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Location: ../index.php');
    die();
}

$username = $_POST['username'];
$password = $_POST['password'];

try {
    require "../classes/dbh.class.php";
    require "../classes/login/login.class.php";
    require "../classes/login/login-contr.class.php";

    $loginController = new LoginController();

    //Error handlers
    $errors = [];

    if (!$loginController->isInputValid($username, $password)) {
        $errors['input_invalid'] = 'Please fill in all fields.';
    }

    if (!$loginController->isPasswordCorrect($username, $password)) {
        $errors['details_incorrect'] = 'Incorrect login details.';
    }

    require_once "./config_session.inc.php";

    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        header('Location: ../login.php?username=' . $username);
        die();
    }

    $user = $loginController->getLoggedInUser($username);

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['user_name'];

    header('Location: ../index.php?login=success');
    die();
} catch (Exception $e) {
    $errors['exception'] = $e->getMessage();
    $_SESSION['errors'] = $errors;
    header('Location: ../login.php?username=' . $username);
    die();
}
