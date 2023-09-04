<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Dto\AnswerDto;
use App\Domain\Storage\AnswerStorageInterface;

class AnswerStorage
{
    public function __construct(private readonly AnswerStorageInterface $answerStorage)
    {
    }

    /**
     * @return AnswerDto[]
     */
    public function getResult(): array
    {
        return $this->answerStorage->getAll();
    }

    public function addAnswer(AnswerDto $answerDto): void
    {
        $this->answerStorage->add($answerDto);
    }

    public function clear(): void
    {
        $this->answerStorage->clear();
    }
}
