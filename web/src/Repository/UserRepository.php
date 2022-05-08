<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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

    public function getActiveUserById(int $id): ?User
    {
        $qb = $this->createQueryBuilder('user')
            ->andWhere('user.id = :id')
            ->andWhere('user.deletedAt IS NULL')
            ->setParameter('id', $id)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getActiveUser(): array
    {
        $qb = $this->createQueryBuilder('user')
            ->andWhere('user.deletedAt IS NULL')
        ;

        return $qb->getQuery()->execute();
    }
}
