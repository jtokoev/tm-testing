<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Entity\MemberResponse;

class MemberResponseFactory
{
    public function create(): MemberResponse
    {
        return new MemberResponse();
    }
}
