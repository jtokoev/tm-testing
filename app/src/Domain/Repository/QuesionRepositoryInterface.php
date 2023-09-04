<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Question;

interface QuesionRepositoryInterface
{
    /**
     * @return Question[]
     */
    public function getQuestions(): array;
}
