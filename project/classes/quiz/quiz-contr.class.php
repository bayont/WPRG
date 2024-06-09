<?php

declare(strict_types=1);

class QuizController extends Quiz
{
    public function isInputValid(string $title, string $description, int $category_id, array $fronts, array $reverses): bool
    {
        if (empty($title) || empty($category_id) || empty($fronts) || empty($reverses)) {
            return false;
        }
        return true;
    }

    public function isCategoryValid(int $category_id): bool
    {
        $categories = $this->getCategories();
        foreach ($categories as $category) {
            if ($category['id'] === $category_id) {
                return true;
            }
        }
        return false;
    }

    public function areFlashcardsValid(array $fronts, array $reverses): bool
    {
        if (count($fronts) !== count($reverses)) {
            return false;
        }
        return true;
    }

    public function createQuiz(string $title, string $description, int $category_id, int $user_id): string
    {
        return $this->setQuiz($title, $description, $category_id, $user_id);
    }

    public function createFlashcards(array $fronts, array $reverses, int $quiz_id): bool
    {
        for ($i = 0; $i < count($fronts); $i++) {
            $front_side_id = $this->setSide($fronts[$i]);
            $reverse_side_id = $this->setSide($reverses[$i]);
            $this->setFlashcard($front_side_id, $reverse_side_id, $quiz_id);
        }
        return true;
    }
}
