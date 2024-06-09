<?php
require_once 'includes/config_session.inc.php';

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
        include_once 'includes/navbar.inc.php';

        if (isset($_GET['login'])) {
            $toastMessage = 'Login successful!';
        } elseif (isset($_GET['logout'])) {
            $toastMessage = 'Logout successful!';
        } elseif (isset($_GET['signup'])) {
            $toastMessage = 'Signup successful!';
        }
        include "includes/toast.inc.php";
        ?>

        <div class="flex-1 flex justify-center">
            <div class="w-full md:w-4/5 p-2">
                <h1 class="text-5xl font-bold font-specific my-8">Welcome <span class="text-primary"><?php echo $logged_in ? $username : "Guest"  ?>!</span></h1>
                <?php if (!$logged_in)
                    echo '<p class="text-lg">Please <a href="/login.php" class="after:content-[\'_↗\'] link link-primary">login</a> or <a href="/signup.php" class="after:content-[\'_↗\'] link link-primary">sign up</a> to access your quizzes.</p>';
                else {
                ?>
                    <div class="flex my-3 items-center gap-2">
                        <h2 class="text-2xl">Your Quizzes</h2>

                        <a href="add-quiz.php" class="btn btn-ghost btn-circle">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
                            </svg>
                        </a>
                    </div>
                    <div class="flex flex-wrap gap-5">
                        <?php $quizView->showUserQuizzes($_SESSION['user_id']); ?>
                    </div>
                <?php
                } ?>

            </div>
        </div>
    </div>

</body>

</html>