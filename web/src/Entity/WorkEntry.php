<?php

namespace App\Entity;

use App\Repository\WorkEntryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WorkEntryRepository::class)
 */
class WorkEntry
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     *  @ORM\ManyToOne(targetEntity="User", inversedBy="workEntry")
     */
    private User $userId;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTime $createdAt;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private \DateTime $updatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private \DateTime $deletedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTime $startDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private \DateTime $endDate;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): WorkEntry
    {
        $this->id = $id;

        return $this;
    }

    public function getUserId(): User
    {
        return $this->userId;
    }

    public function setUserId(User $userId): WorkEntry
    {
        $this->userId = $userId;

        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): WorkEntry
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): WorkEntry
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDeletedAt(): \DateTime
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(\DateTime $deletedAt): WorkEntry
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTime $startDate): WorkEntry
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTime $endDate): WorkEntry
    {
        $this->endDate = $endDate;

        return $this;
    }
}
