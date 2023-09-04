<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Question;
use App\Domain\Repository\QuestionRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @extends ServiceEntityRepository<Question>
 *
 * @method Question|null find($id, $lockMode = null, $lockVersion = null)
 * @method Question|null findOneBy(array $criteria, array $orderBy = null)
 * @method Question[]    findAll()
 * @method Question[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionRepository extends ServiceEntityRepository implements QuestionRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Question::class);
    }

    public function getQuestions(): array
    {
        return $this->createQueryBuilder('q')
            ->select('q', 'a')
            ->leftJoin('q.answers', 'a')
            ->getQuery()
            ->getResult();
    }

    public function findById(int $id): Question
    {
        return $this->find($id) ?? throw new NotFoundHttpException(sprintf('Resource by id="%d" not found', $id));
    }
}
