<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Domain\Entity\Question;
use App\Domain\Repository\QuesionRepositoryInterface;
use App\Domain\Storage\QuestionStorageInterface;

class QuestionStorage
{
    public function __construct(private readonly QuestionStorageInterface $questionStorage, private readonly QuesionRepositoryInterface $quesionRepository)
    {
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

        $questions = $this->quesionRepository->getQuestions();

        shuffle($questions);

        $this->questionStorage->set($questions);
    }

    public function shift(): void
    {
        $questions = $this->questionStorage->get();

        array_shift($questions);

        $this->questionStorage->set($questions);
    }
}
