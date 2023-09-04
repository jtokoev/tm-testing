<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Domain\Repository\MemberResponseRepositoryInterface;

class ResultReader
{
    public function __construct(private readonly MemberResponseRepositoryInterface $userResponseReadRepository)
    {
    }

    public function findByMember(int $memberId): array
    {
        return $this->userResponseReadRepository->getResultByMemberId($memberId);
    }
}
