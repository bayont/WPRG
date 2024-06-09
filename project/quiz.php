<?php
require_once 'includes/config_session.inc.php';

require "classes/dbh.class.php";
require "classes/quiz/quiz.class.php";
require "classes/quiz/quiz-view.class.php";
$quizView = new QuizView();

$quizDetails = $quizView->getQuizDetails($_GET['id']);

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
    <?php
    include_once 'includes/navbar.inc.php';
    ?>
    <div class="w-full p-1">
        <div class="mx-auto w-full md:w-4/5 lg:w-3/4 max-w-[50rem] my-3 flex flex-col items-center gap-3">
            <div>
                <h2 class="text-4xl text-center"><?php echo $quizDetails['title'] ?></h2>
                <h4 class="text-xl text-center text-primary"><?php $quizView->showQuizCategory($_GET['id']) ?></h4>
            </div>


            <div class="stats stats-vertical bg-base-100 md:bg-base-200 md:stats-horizontal shadow w-full">

                <div class="stat">
                    <div class="stat-figure text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" class="fill-current">
                            <path d="M320-213.33q-27 0-46.83-19.84Q253.33-253 253.33-280v-533.33q0-27 19.84-46.84Q293-880 320-880h413.33q27 0 46.84 19.83Q800-840.33 800-813.33V-280q0 27-19.83 46.83-19.84 19.84-46.84 19.84H320Zm0-66.67h413.33v-533.33H320V-280ZM186.67-80q-27 0-46.84-19.83Q120-119.67 120-146.67v-600h66.67v600h480V-80h-480ZM320-280v-533.33V-280Z" />
                        </svg>
                    </div>
                    <div class="stat-title">Flashcards</div>
                    <div class="stat-value"><?php $quizView->showFlashcardsNumber($quizDetails['id']) ?></div>
                </div>

                <div class="stat">
                    <div class="stat-figure text-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" class="fill-current">
                            <path d="m239.33-160 40-159.33H120L136.67-386H296l47.33-188H184l16.67-66.67H360L399.33-800h66L426-640.67h188.67L654-800h66l-39.33 159.33H840L823.33-574H664l-47.33 188H776l-16.67 66.67H600L560-160h-66l40-159.33H345.33l-40 159.33h-66ZM362-386h188.67L598-574H409.33L362-386Z" />
                        </svg>
                    </div>
                    <div class="stat-title">Attempts</div>
                    <div class="stat-value"><?php $quizView->showAttemptsNumber($quizDetails['id']) ?></div>
                </div>

            </div>

            <div class="join">
                <a class="w-40 join-item btn btn-secondary btn-outline " href="./attempt.php?qid=<?php echo $_GET['id'] ?>">Flashcards</a>
                <a class="w-40 join-item btn btn-secondary btn-outline btn-disabled" href="./attempt.php?qid=<?php echo $_GET['id'] ?>">Test</a>
            </div>

            <div class="flex flex-col my-3 mt-6">
                <h3 class="text-2xl w-full text-center">Quiz Flashcards</h3>
                <div class="text-sm text-center text-secondary">(press to flip)</div>
            </div>

            <?php
            $quizView->showFlashcards($_GET['id']);
            ?>

        </div>
    </div>

    <script>
        const reversibleCards = document.querySelectorAll('.reversible-card');

        reversibleCards.forEach(card => {
            card.addEventListener('click', () => {
                card.classList.toggle('reversed');
            });
        });
    </script>
</body>

</html>