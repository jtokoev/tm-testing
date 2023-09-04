<?php

declare(strict_types=1);

namespace App\Domain\Storage;

use App\Domain\Entity\Question;

interface QuestionStorageInterface
{
    /**
     * @return Question[]
     */
    public function get(): array;

    public function getCurrentQuestion(): ?Question;

    public function set(array $questions): void;
}
