<?php

declare(strict_types=1);

namespace App\Domain\Storage;

use App\Application\Dto\AnswerDto;

interface AnswerStorageInterface
{
    /**
     * @return AnswerDto[]
     */
    public function getAll(): array;

    public function add(AnswerDto $answerDto): void;

    public function clear(): void;
}
