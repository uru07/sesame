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
        $startDate = new \DateTime($startDate);
        $endDate = $endDate ? new \DateTime($endDate) : null;
        if (!$this->checkDates($startDate, $endDate)) {
            throw new \Exception('End date must be grater than start date');
        }

        $workEntry = new WorkEntry();
        $workEntry->setUser($user)
            ->setCreatedAt($today)
            ->setUpdatedAt($today)
            ->setStartDate($startDate)
            ->setEndDate($endDate)
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
        $startDate = new \DateTime($startDate);
        $endDate = $endDate ? new \DateTime($endDate) : null;
        if (!$this->checkDates($startDate, $endDate)) {
            throw new \Exception('End date must be grater than start date');
        }

        $workEntry->setUpdatedAt($today)
            ->setStartDate($startDate)
            ->setEndDate($endDate)
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

    public function getAllActiveWorkEntryByUserId(int $userId): array
    {
        $workEntry = $this->workEntryRepository->getActiveWorkEntryByUserId($userId);

        return $this->workEntriesToArray($workEntry);
    }

    private function workEntriesToArray(array $workEntries): array
    {
        $workEntriesArray = [];
        foreach ($workEntries as $workEntry) {
            $workEntriesArray[] = $workEntry->toArray();
        }

        return $workEntriesArray;
    }

    private function checkDates(\DateTime $startDate, ?\DateTime $endDate): bool
    {
        if (is_null($endDate)) {
            return true;
        }

        return $startDate < $endDate;
    }
}
