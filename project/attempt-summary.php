<?php
require_once './includes/config_session.inc.php';

require 'classes/dbh.class.php';
require 'classes/attempt/attempt.abstract.class.php';
require 'classes/attempt/flashcards/attempt-flashcards.class.php';
require 'classes/attempt/flashcards/attempt-flashcards.view.class.php';

$attemptFlashcardsView = new AttemptFlashcardsView();

if (!isset($_GET['id'])) {
    header('Location: index.php');
    die();
}

$attempt_id = $_GET['id'];

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    die();
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
    <div class="flex flex-col gap-1">
        <?php
        include_once './includes/navbar.inc.php';
        include "./includes/toast.inc.php";
        ?>

        <div class="flex justify-center">
            <div class="stats shadow bg-base-200">
                <div class="stat">
                    <div class="stat-figure text-secondary">
                    </div>
                    <div class="stat-value"><?php $attemptFlashcardsView->showKnownPercentage($attempt_id) ?></div>
                    <div class="stat-title">of flashcards learned</div>
                    <div class="stat-desc text-secondary"><?php $attemptFlashcardsView->showUnknownFlashcardsNumber($attempt_id) ?> flashcards to learn remaining</div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>