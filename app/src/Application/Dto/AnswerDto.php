<?php

declare(strict_types=1);

namespace App\Application\Dto;

use Symfony\Component\Validator\Constraints as Assert;

final class AnswerDto
{
    #[Assert\Type('integer')]
    public int $questionId;

    #[Assert\Type('array')]
    public array $answers;
}
