<?php
require_once './includes/config_session.inc.php';

if (isset($_SESSION['user_id'])) {
    $username = $_SESSION['username'];
    $logged_in = true;
} else {
    $logged_in = false;
}

if ($logged_in) {
    require 'classes/dbh.class.php';
    require 'classes/quiz/quiz.class.php';
    require 'classes/quiz/quiz-view.class.php';

    $quizView = new QuizView();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizconst</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/tailwind.css">
</head>

<body>
    <div class="flex flex-col gap-1 min-h-screen">
        <?php
        include_once './includes/navbar.inc.php';
        ?>

        <h1>Unsufficient permissions!</h1>
    </div>

</body>

</html>