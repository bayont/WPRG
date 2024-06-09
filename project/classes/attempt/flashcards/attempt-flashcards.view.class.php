<?php

declare(strict_types=1);

class AttemptFlashcardsView extends AttemptFlashcards
{

    public function showKnownFlashcardsNumber(string $attempt_id): void
    {
        echo  $this->getAttemptKnownFlashcardsNumber($attempt_id);
    }

    public function showUnknownFlashcardsNumber(string $attempt_id): void
    {
        echo  $this->getAttemptUnknownFlashcardsNumber($attempt_id);
    }

    public function showKnownPercentage(string $attempt_id): void
    {
        echo strval(($this->getAttemptKnownFlashcardsNumber($attempt_id) / $this->getAttemptFlashcardsNumber($attempt_id)) * 100) . "%";
    }
}
