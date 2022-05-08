<?php

namespace App\Service;

use App\Entity\WorkEntry;
use App\Repository\UserRepository;
use App\Repository\WorkEntryRepository;

class WorkEntryService
{
    private UserRepository $userRepository;
    private WorkEntryRepository $workEntryRepository;

    public function __construct(
        UserRepository $userRepository,
        WorkEntryRepository $workEntryRepository
    ) {
        $this->userRepository = $userRepository;
        $this->workEntryRepository = $workEntryRepository;
    }

    public function addWorkEntry(string $userId, string $startDate, ?string $endDate): WorkEntry
    {
        $today = new \DateTime();
        $user = $this->userRepository->find($userId);

        $workEntry = new WorkEntry();
        $workEntry->setUserId($user)
            ->setCreatedAt($today)
            ->setUpdatedAt($today)
            ->setStartDate(new \DateTime($startDate))
            ->setEndDate($endDate ? new \DateTime($endDate) : $endDate)
        ;
        $this->workEntryRepository->persist($workEntry);

        return $workEntry;
    }

    public function editWorkEntry(int $id, string $startDate, ?string $endDate): WorkEntry
    {
        $workEntry = $this->workEntryRepository->getActiveWorkEntryById($id);
        if (is_null($workEntry)) {
            throw new \Exception('Work entry not found');
        }

        $today = new \DateTime();

        $workEntry->setUpdatedAt($today)
            ->setStartDate(new \DateTime($startDate))
            ->setEndDate($endDate ? new \DateTime($endDate) : $endDate)
        ;
        $this->workEntryRepository->persist($workEntry);

        return $workEntry;
    }

    public function removeWorkEntry(int $id): WorkEntry
    {
        $workEntry = $this->workEntryRepository->getActiveWorkEntryById($id);
        if (is_null($workEntry)) {
            throw new \Exception('Work entry not found');
        }

        $today = new \DateTime();

        $workEntry->setDeletedAt($today);
        $this->workEntryRepository->persist($workEntry);

        return $workEntry;
    }

    public function getAllActiveWorkEntryById(int $id): WorkEntry
    {
        $workEntry = $this->workEntryRepository->getActiveWorkEntryById($id);
        if (is_null($workEntry)) {
            throw new \Exception('Work entry not found');
        }

        return $workEntry;
    }
}
