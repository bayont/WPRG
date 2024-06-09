<?php
require_once 'includes/config_session.inc.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    die();
}

require "classes/dbh.class.php";
require "classes/quiz/quiz.class.php";
require "classes/quiz/quiz-view.class.php";
$quizView = new QuizView();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add quiz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/tailwind.css">
</head>

<body>
    <?php
    include_once 'includes/navbar.inc.php';
    ?>
    <div class="w-full">
        <div class="mx-auto w-full card md:w-4/5 max-w-[70rem] bg-base-200 shadow-xl my-3">
            <div class="card-body">
                <h2 class="card-title text-3xl mb-3">Add quiz</h2>
                <form action="includes/add-quiz.php" class="flex flex-col gap-4" method="post">

                    <div class="flex flex-col md:flex-row gap-4">
                        <label class="form-control w-full">
                            <input type="text" name="title" placeholder="Enter quiz title" class="input input-bordered w-full" />
                        </label>
                        <select class="select select-bordered w-full text-base text-base-content" name="category" required>
                            <option disabled selected value="-1">Quiz category</option>
                            <?php
                            echo $quizView->showCategories();
                            ?>
                        </select>
                    </div>
                    <textarea name="description" class="textarea textarea-bordered block w-full resize-none text-base" rows="3" placeholder="Add description..."></textarea>

                    <div id="cards" class="flex flex-col gap-3"> </div>

                    <div class="card-actions mt-3 w-full flex flex-col md:flex-row justify-between">
                        <div class="w-full md:w-[12rem]">
                            <button type="button" class="btn btn-outline w-full" id="add-flashcard" role="button">
                                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
                                </svg>
                                Add flashcard
                            </button>
                        </div>
                        <input type="submit" role="button" class="btn btn-primary w-full ml-auto md:w-auto" value="Save quiz"></input>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const cardsContainer = document.querySelector("#cards");
        const addFlashcardButton = document.querySelector("#add-flashcard");
        let cardCount = 0;

        const reorderFlashcards = () => {
            const flashcards = document.querySelectorAll('.flashcard');
            flashcards.forEach((card, index) => {
                card.id = `flashcard-${index + 1}`;
                card.querySelector('h3').textContent = `Flashcard ${index + 1}`;
            });
        }

        const removeFlashcard = (id) => {
            const card = document.querySelector(`#flashcard-${id}`);
            card.remove();
            cardCount--;
            reorderFlashcards();
        }


        const addCard = () => {
            cardCount++;
            const card = document.createElement('div');
            card.id = `flashcard-${cardCount}`;
            card.innerHTML = `<div class="flashcard card w-full bg-base-100 shadow-xl">
                            <div class="card-body">
                                <div class="card-title -mt-4 flex justify-between">
                                    <h3 class="text-xl">Flashcard ${cardCount}</h3>
                                    <div class="tooltip" data-tip="Remove flashcard">
                                        <button type="button" class="btn btn-square btn-ghost btn-sm" onclick="removeFlashcard(${cardCount})">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="currentColor">
                                                <path d="M312-144q-29.7 0-50.85-21.15Q240-186.3 240-216v-480h-48v-72h192v-48h192v48h192v72h-48v479.57Q720-186 698.85-165T648-144H312Zm336-552H312v480h336v-480ZM384-288h72v-336h-72v336Zm120 0h72v-336h-72v336ZM312-696v480-480Z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="flex flex-col md:flex-row mt-2 gap-4">
                                    <input type="text" placeholder="Front" name="front[]" class="input input-primary w-full" required />
                                    <input type="text" placeholder="Reverse" name="reverse[]" class="input input-secondary w-full" required />
                                </div>
                            </div>
                        </div>
                    `;
            cardsContainer.appendChild(card);
        }


        addCard();
        addFlashcardButton.addEventListener('click', addCard);
    </script>
</body>

</html>