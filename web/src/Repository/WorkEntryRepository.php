<?php

namespace App\Repository;

use App\Entity\WorkEntry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class WorkEntryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkEntry::class);
    }

    public function persist(WorkEntry $workEntry): void
    {
        $this->getEntityManager()->persist($workEntry);
        $this->getEntityManager()->flush();
    }

    public function getActiveWorkEntryById(int $id): ?WorkEntry
    {
        $qb = $this->createQueryBuilder('workEntry')
            ->andWhere('workEntry.id = :id')
            ->andWhere('workEntry.deletedAt IS NULL')
            ->setParameter('id', $id)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getActiveWorkEntryByUserId(int $userId): array
    {
        $qb = $this->createQueryBuilder('workEntry')
            ->andWhere('workEntry.user = :id')
            ->andWhere('workEntry.deletedAt IS NULL')
            ->setParameter('id', $userId)
        ;

        return $qb->getQuery()->execute();
    }

    public function getActiveWorkEntry(): array
    {
        $qb = $this->createQueryBuilder('workEntry')
            ->andWhere('workEntry.deletedAt IS NULL')
        ;

        return $qb->getQuery()->execute();
    }
}
