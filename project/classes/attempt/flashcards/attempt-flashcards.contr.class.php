<?php

declare(strict_types=1);

class AttemptFlashcardsController extends AttemptFlashcards
{
    public function createAttempt(string $quiz_id, ?string $user_id): string
    {
        return $this->setFlashcardsAttempt($quiz_id, $user_id);
    }

    public function isAttemptIdValid(string $attempt_id): bool
    {
        return !!$this->getAttemptById($attempt_id);
    }

    public function isAttemptFinished(string $attempt_id): bool
    {
        $attempt = $this->getAttemptById($attempt_id);
        return $attempt['finished_at'] !== null;
    }

    public function isTheSameUser(string $attempt_id, ?string $user_id): bool
    {
        $attempt = $this->getAttemptById($attempt_id);
        if ($attempt['user_id'] === null) {
            // created by guest
            //! Possible vulnerability: Users can guess the attempt_id and send a POST request to finish GUESTS' attempts,
            //! Some id should be generated when starting an attempt and should be verfied in the controller
            return true;
        }

        return strval($attempt['user_id']) === $user_id;
    }

    public function areFlashcardsValid(string $attempt_id, array $flashcards_ids): bool
    {
        $quizAllowedFlashcardsIds = $this->getAttemptFlashcardsIds($attempt_id);
        foreach ($flashcards_ids as $flashcard_id) {
            if (!in_array($flashcard_id, $quizAllowedFlashcardsIds)) {
                return false;
            }
        }
        return true;
    }

    public function finishAttempt(string $attempt_id, array $known_flashcards_ids, array $unknown_flashcards_ids): void
    {
        foreach ($known_flashcards_ids as $flashcard_id) {
            $this->setFlashcardsAttemptAnswer($attempt_id, $flashcard_id, true);
        }
        foreach ($unknown_flashcards_ids as $flashcard_id) {
            $this->setFlashcardsAttemptAnswer($attempt_id, $flashcard_id, false);
        }
        $this->setFinishedAttempt($attempt_id);
    }
}
