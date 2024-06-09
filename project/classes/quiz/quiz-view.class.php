<?php

declare(strict_types=1);

class QuizView extends Quiz
{
    public function showCategories(): void
    {
        $categories = $this->getCategories();
        foreach ($categories as $category) {
            echo "<option value='" . $category['id'] . "'>" . $category['name'] . "</option>";
        }
    }

    public function showQuizCategory(string $quiz_id): void
    {
        $quiz = $this->getQuizById($quiz_id);
        $category_id = $quiz['category_id'];
        $category = $this->getCategoryById($category_id);
        echo $category['name'];
    }

    public function getQuizDetails(string $quiz_id): array
    {
        return $this->getQuizById($quiz_id);
    }

    public function getQuizFlashcards(string $quiz_id): array
    {
        $flashcards = $this->getFlashcardsByQuizId($quiz_id);
        $newFlashcards = [];
        foreach ($flashcards as $flashcard) {
            $front_id = $flashcard['front_id'];
            $reverse_id = $flashcard['reverse_id'];
            $front = $this->getSideById($front_id);
            $reverse = $this->getSideById($reverse_id);
            $flashcard['front'] = $front;
            $flashcard['reverse'] = $reverse;
            $newFlashcards[] = $flashcard;
        }
        return $newFlashcards;
    }

    public function showAttemptsNumber(string $quiz_id): void
    {
        $attempts = $this->getAttempts($quiz_id);
        echo count($attempts);
    }


    public function showFlashcardsNumber(string $quiz_id): void
    {
        $flashcards = $this->getFlashcardsByQuizId($quiz_id);
        echo count($flashcards);
    }

    public function showFlashcards(string $quiz_id): void
    {
        $flashcards = $this->getQuizFlashcards($quiz_id);
        for ($i = 0; $i < count($flashcards); $i++) {
            $front = $flashcards[$i]['front']['content'];
            $reverse = $flashcards[$i]['reverse']['content'];
            $cardIndex = $i + 1;
            echo <<<EOD
            <div class="reversible-card w-full h-24">
            <div class="reversible-card-inner">
                <div class="front">
                    <div class="card w-full bg-base-300 h-24">
                        <div class="card-caption text-base-100">
                            <h3>#$cardIndex | Front</h3>
                        </div>
                        <div class="card-body items-center">
                            <h2 class="card-title text-center">$front</h2>
                        </div>
                    </div>
                </div>
                <div class="reverse">
                    <div class="card w-full bg-base-300">
                        <div class="card-caption text-base-100">
                            <h3>#$cardIndex | Reverse</h3>
                        </div>
                        <div class="card-body items-center">
                            <h2 class="card-title text-center">$reverse</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        EOD;
        }
    }

    public function showUserQuizzes(string $user_id): void
    {
        $quizzes = $this->getQuizzesByUserId($user_id);

        foreach ($quizzes as $quiz) {
            $category_id = $quiz['category_id'];
            $category = htmlspecialchars($this->getCategoryById($category_id)['name']);
            $quiz_id = strval($quiz['id']);
            $quiz_title = htmlspecialchars($quiz['title']);
            $quiz_description = htmlspecialchars($quiz['description']);
            $flashcards_number = count($this->getFlashcardsByQuizId($quiz_id));

            echo <<<EOD
            <div class="card bg-base-200 w-full md:w-[20rem]">
                <div class="card-body">
                    <div class="card-caption">
                        <div class="badge badge-outline text-primary">$category</div> 
                    </div>
                    <h2 class="card-title">$quiz_title
                        <div class="badge badge-primary">$flashcards_number</div>
                    </h2>

                    <p>$quiz_description</p>
                    
                    <div class="card-actions w-full my-3">
                        <div class="w-full">
                            <a href="quiz.php?id=$quiz[id]" class="btn btn-primary btn-outline w-full">View</a>
                        </div>
                    </div>
                    </div>
                
        </div>
        EOD;
        }
    }
}
