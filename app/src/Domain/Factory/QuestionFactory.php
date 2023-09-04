<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Entity\Question;

class QuestionFactory
{
    public function create(string $questionText): Question
    {
        return new Question($questionText);
    }
}
