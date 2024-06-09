<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php');
    die();
}


require "../classes/dbh.class.php";
require "../classes/quiz/quiz.class.php";
require "../classes/quiz/quiz-contr.class.php";

$quizController = new QuizController();

$errors = [];

if (!isset($_POST['title']) || !isset($_POST['description']) || !isset($_POST['category']) || !isset($_POST['front']) || !isset($_POST['reverse'])) {
    $errors['input_invalid'] = 'Please fill in all fields.';
    header('Location: ../add-quiz.php');
    die();
}

require_once "./config_session.inc.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    die();
}

if (!$quizController->isInputValid($_POST['title'], $_POST['description'], $_POST['category'], $_POST['front'], $_POST['reverse'])) {
    $errors['input_invalid'] = 'Please fill in all fields.';
    header('Location: ../add-quiz.php');
    die();
}

$title = $_POST['title'];
$description = $_POST['description'];
$category_id = $_POST['category'];
$fronts = $_POST['front'];
$reverses = $_POST['reverse'];

if (!$quizController->isCategoryValid($category_id)) {
    $errors['category_invalid'] = 'Invalid category.';
    header('Location: ../add-quiz.php');
    die();
}

if (!$quizController->areFlashcardsValid($fronts, $reverses)) {
    $errors['flashcards_invalid'] = 'Flashcards are not valid.';
    header('Location: ../add-quiz.php');
    die();
}


$quiz_id = $quizController->createQuiz($title, $description, $category_id, $_SESSION['user_id']);

$quizController->createFlashcards($fronts, $reverses, $quiz_id);

header('Location: ../quiz.php?id=' . $quiz_id);
