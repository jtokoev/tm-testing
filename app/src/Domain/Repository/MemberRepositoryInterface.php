<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Member;

interface MemberRepositoryInterface
{
    public function save(Member $member): void;
}
