<?php
require_once './config_session.inc.php';

$attempt_id = $_POST['attempt_id'];
$known_flashcards = json_decode($_POST['known_flashcards']);
$unknown_flashcards = json_decode($_POST['unknown_flashcards']);

require '../classes/dbh.class.php';
require '../classes/attempt/attempt.abstract.class.php';
require '../classes/attempt/flashcards/attempt-flashcards.class.php';
require '../classes/attempt/flashcards/attempt-flashcards.contr.class.php';

$attemptFlashcardsController = new AttemptFlashcardsController();

if (!$attemptFlashcardsController->isAttemptIdValid($attempt_id)) {
    header('Location: ../index.php');
    die();
}

if ($attemptFlashcardsController->isAttemptFinished($attempt_id)) {
    header('Location: ../index.php');
    die();
}

if (!$attemptFlashcardsController->isTheSameUser($attempt_id, isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null)) {
    header('Location: ../index.php');
    die();
}

$known_flashcards_ids = [];
$unknown_flashcards_ids = [];

foreach ($known_flashcards as $flashcard) {
    $known_flashcards_ids[] = strval($flashcard->id);
}

foreach ($unknown_flashcards as $flashcard) {
    $unknown_flashcards_ids[] = strval($flashcard->id);
}

if (!$attemptFlashcardsController->areFlashcardsValid($attempt_id, array_merge($known_flashcards_ids, $unknown_flashcards_ids))) {
    header('Location: ../index.php');
    die();
}



$attemptFlashcardsController->finishAttempt($attempt_id, $known_flashcards_ids, $unknown_flashcards_ids);

header('Location: ../attempt-summary.php?id=' . $attempt_id);
