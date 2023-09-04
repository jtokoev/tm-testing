<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Question;

interface QuestionRepositoryInterface
{
    /**
     * @return Question[]
     */
    public function getQuestions(): array;

    public function findById(int $id): Question;
}
