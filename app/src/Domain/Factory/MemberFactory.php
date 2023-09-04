<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Entity\Member;

class MemberFactory
{
    public function create(): Member
    {
        return new Member();
    }
}
