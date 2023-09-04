<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Domain\Entity\Question;
use App\Domain\Repository\QuestionRepositoryInterface;
use App\Domain\Storage\QuestionStorageInterface;

class QuestionStorage
{
    public function __construct(private readonly QuestionStorageInterface $questionStorage, private readonly QuestionRepositoryInterface $questionRepository)
    {
    }

    public function getCurrentPosition(): int
    {
        return $this->questionStorage->getCurrentPosition();
    }

    public function getCurrent(): ?Question
    {
        return $this->questionStorage->getCurrentQuestion();
    }

    public function generate(): void
    {
        if (!empty($this->questionStorage->get())) {
            return;
        }

        $questions = $this->questionRepository->getQuestions();

        shuffle($questions);

        $this->questionStorage->set($questions);
    }

    public function shift(): void
    {
        $this->questionStorage->removeFirst();
    }
}
