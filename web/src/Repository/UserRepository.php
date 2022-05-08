<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function persist(User $user): void
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function getUserQueryBuilder(int $id): QueryBuilder
    {
        return $this->createQueryBuilder('user')
            ->andWhere('user.id = :id')
            ->setParameter('id', $id);
    }

    public function getUserToEdit(int $id): ?User
    {
        $qb = $this->getUserQueryBuilder($id);
        $qb->andWhere('user.deletedAt IS NULL');

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getUserToDelete(int $id): ?User
    {
        $qb = $this->getUserQueryBuilder($id);
        $qb->andWhere('user.deletedAt IS NOT NULL');

        return $qb->getQuery()->getOneOrNullResult();
    }
}
