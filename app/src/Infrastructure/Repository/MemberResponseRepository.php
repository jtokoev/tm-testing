<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\MemberResponse;
use App\Domain\Repository\MemberResponseRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MemberResponse>
 *
 * @method MemberResponse|null find($id, $lockMode = null, $lockVersion = null)
 * @method MemberResponse|null findOneBy(array $criteria, array $orderBy = null)
 * @method MemberResponse[]    findAll()
 * @method MemberResponse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemberResponseRepository extends ServiceEntityRepository implements MemberResponseRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MemberResponse::class);
    }

    public function getResultByMemberId(int $userId): array
    {
        return $this->findBy(['member' => $userId]);
    }
}
