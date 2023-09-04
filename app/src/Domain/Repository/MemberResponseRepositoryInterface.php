<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\MemberResponse;

interface MemberResponseRepositoryInterface
{
    /**
     * @return MemberResponse[]
     */
    public function getResultByMemberId(int $userId): array;
}
