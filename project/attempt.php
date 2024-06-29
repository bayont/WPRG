<?php
require_once './includes/config_session.inc.php';

require "classes/dbh.class.php";
require "classes/quiz/quiz.class.php";
require "classes/quiz/quiz-view.class.php";
$quizView = new QuizView();

$quizDetails = $quizView->getQuizDetails($_GET['qid']);
$flashcards = $quizView->getQuizFlashcards($_GET['qid']);

require "classes/attempt/attempt.abstract.class.php";
require "classes/attempt/flashcards/attempt-flashcards.class.php";
require "classes/attempt/flashcards/attempt-flashcards.contr.class.php";

$attemptFlashcardsController = new AttemptFlashcardsController();
$attempt_id = $attemptFlashcardsController->createAttempt($_GET['qid'], isset($_SESSION['user_id'])  ? $_SESSION['user_id'] : null);
if (!$attempt_id) {
    header('Location: ./quiz.php?id=' . $_GET['qid']);
    exit();
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
    <script>
        const flashcards = <?php
                            $flashcardsAttributesToExpose = ['id', 'front', 'reverse'];
                            $newFlashcards = [];
                            foreach ($flashcards as $flashcard) {
                                $flashcardAttributes = [];
                                foreach ($flashcardsAttributesToExpose as $attribute) {
                                    $flashcardAttributes[$attribute] = $flashcard[$attribute];
                                }
                                $newFlashcards[] = $flashcardAttributes;
                            }

                            echo json_encode($newFlashcards);
                            ?>;
    </script>
</head>

<body>
    <div class="w-full h-svh flex flex-col overflow-hidden">
        <?php
        include_once './navbar.partial.php';
        ?>
        <div class="p-2 mx-auto w-full md:w-4/5 lg:w-3/4 max-w-[50rem] my-3 flex flex-col items-center gap-3 h-full">
            <div class="mt-4">
                <h4 class="text-2xl text-center text-primary font-specific" id="flashcard-header">
                </h4>
                <h2 class="text-2xl text-center"><a href="quiz.php?id=<?php echo $quizDetails['id'] ?>" class="link link-hover"><?php echo $quizDetails['title'] ?></a></h2>
            </div>

            <div class="reversible-card w-full flex-1 flex items-center">
                <div class="reversible-card-inner h-full md:h-3/4">
                    <div class="front">
                        <div class="card w-full bg-base-300 h-full">
                            <div class="card-caption text-base-100">
                                <h3 id="flashcard-front-caption"></h3>
                            </div>
                            <div class="card-body items-center justify-center" id="flashcard-front-body">
                                <h2 class="card-title text-center">$front</h2>
                            </div>
                        </div>
                    </div>
                    <div class="reverse">
                        <div class="card w-full bg-base-300 h-full">
                            <div class="card-caption text-base-100">
                                <h3 id="flashcard-reverse-caption"></h3>
                            </div>
                            <div class="card-body items-center justify-center" id="flashcard-reverse-body">
                                <h2 class="card-title text-center">$reverse</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="action-bar w-full flex justify-between mb-3">
                <button class="btn btn-ghost btn-circle" id="undo-flashcard-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" class="fill-current">
                        <path d="M280-200v-80h284q63 0 109.5-40T720-420q0-60-46.5-100T564-560H312l104 104-56 56-200-200 200-200 56 56-104 104h252q97 0 166.5 63T800-420q0 94-69.5 157T564-200H280Z" />
                    </svg>
                </button>
                <div class="flex gap-2">
                    <button class="btn btn-warning btn-outline w-36" id="unknown-flashcard-btn">Don't know</button>
                    <button class="btn btn-success btn-outline w-36" id="known-flashcard-btn">Know</button>
                </div>
            </div>

        </div>
    </div>

    <script>
        const reversibleCard = document.querySelector('.reversible-card');
        reversibleCard.addEventListener('click', () => {
            reversibleCard.classList.toggle('reversed');
        });

        const flashcardHeader = document.getElementById('flashcard-header');
        const flashcardFrontCaption = document.getElementById('flashcard-front-caption');
        const flashcardFrontBody = document.getElementById('flashcard-front-body');
        const flashcardReverseCaption = document.getElementById('flashcard-reverse-caption');
        const flashcardReverseBody = document.getElementById('flashcard-reverse-body');

        const undoButton = document.getElementById('undo-flashcard-btn');
        const knownTermButton = document.getElementById('known-flashcard-btn');
        const unknownTermButton = document.getElementById('unknown-flashcard-btn');

        let currentFlashcardIndex = 0;

        const actions = [];
        const knownFlashcards = [];
        const unknownFlashcards = [];

        const flashcardsCompleted = () => {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = './includes/attempt.inc.php';

            const knownFlashcardsInput = document.createElement('input');
            knownFlashcardsInput.type = 'hidden';
            knownFlashcardsInput.name = 'known_flashcards';
            knownFlashcardsInput.value = JSON.stringify(knownFlashcards);
            form.appendChild(knownFlashcardsInput);

            const unknownFlashcardsInput = document.createElement('input');
            unknownFlashcardsInput.type = 'hidden';
            unknownFlashcardsInput.name = 'unknown_flashcards';
            unknownFlashcardsInput.value = JSON.stringify(unknownFlashcards);
            form.appendChild(unknownFlashcardsInput);

            const attemptIdInput = document.createElement('input');
            attemptIdInput.type = 'hidden';
            attemptIdInput.name = 'attempt_id';
            attemptIdInput.value = '<?php echo $attempt_id; ?>';
            form.appendChild(attemptIdInput);
            document.body.appendChild(form);

            form.submit();
        }

        const previousCard = () => {
            if (currentFlashcardIndex === 0) {
                return;
            }
            currentFlashcardIndex--;
            showFlashcard(currentFlashcardIndex);
        }

        const nextCard = () => {
            if (currentFlashcardIndex === flashcards.length - 1) {
                return flashcardsCompleted();
            }
            currentFlashcardIndex++;
            showFlashcard(currentFlashcardIndex);
        }

        const knownAction = () => {
            actions.push('known');
            knownFlashcards.push(flashcards[currentFlashcardIndex]);
            nextCard();
        }

        const unknownAction = () => {
            actions.push('unknown');
            unknownFlashcards.push(flashcards[currentFlashcardIndex]);
            nextCard();
        }

        const undoAction = () => {
            if (actions.length === 0) {
                return;
            }
            const lastAction = actions.pop();
            if (lastAction === 'known') {
                knownFlashcards.pop();
            } else if (lastAction === 'unknown') {
                unknownFlashcards.pop();
            }
            previousCard();
        }

        const showFlashcard = (flashcardIndex) => {
            const flashcard = flashcards[flashcardIndex];
            flashcardHeader.textContent = `Flashcard ${flashcardIndex + 1}/${flashcards.length}`;
            flashcardFrontCaption.textContent = 'Front';
            flashcardFrontBody.querySelector('h2').textContent = flashcard.front.content;
            flashcardReverseCaption.textContent = 'Reverse';
            flashcardReverseBody.querySelector('h2').textContent = flashcard.reverse.content;
        }

        undoButton.addEventListener('click', undoAction);

        knownTermButton.addEventListener('click', knownAction);

        unknownTermButton.addEventListener('click', unknownAction);

        showFlashcard(currentFlashcardIndex);
    </script>
</body>

</html>