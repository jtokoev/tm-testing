<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Entity\Answer;
use App\Domain\Entity\MemberResponseAnswer;

class MemberResponseAnswerFactory
{
    public function create(Answer $answer): MemberResponseAnswer
    {
        return new MemberResponseAnswer($answer);
    }
}
