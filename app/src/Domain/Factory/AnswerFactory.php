<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Entity\Answer;

class AnswerFactory
{
    public function create(string $answer, bool $isCorrect): Answer
    {
        return new Answer($answer, $isCorrect);
    }
}
