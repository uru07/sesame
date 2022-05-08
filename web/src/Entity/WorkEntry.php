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
    private \Datetime $createdAt;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private \Datetime $updatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private \Datetime $deletedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTime $startDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private \DateTime $endDate;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return WorkEntry
     */
    public function setId(int $id): WorkEntry
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return User
     */
    public function getUserId(): User
    {
        return $this->userId;
    }

    /**
     * @param User $userId
     * @return WorkEntry
     */
    public function setUserId(User $userId): WorkEntry
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return \Datetime
     */
    public function getCreatedAt(): \Datetime
    {
        return $this->createdAt;
    }

    /**
     * @param \Datetime $createdAt
     * @return WorkEntry
     */
    public function setCreatedAt(\Datetime $createdAt): WorkEntry
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \Datetime
     */
    public function getUpdatedAt(): \Datetime
    {
        return $this->updatedAt;
    }

    /**
     * @param \Datetime $updatedAt
     * @return WorkEntry
     */
    public function setUpdatedAt(\Datetime $updatedAt): WorkEntry
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return \Datetime
     */
    public function getDeletedAt(): \Datetime
    {
        return $this->deletedAt;
    }

    /**
     * @param \Datetime $deletedAt
     * @return WorkEntry
     */
    public function setDeletedAt(\Datetime $deletedAt): WorkEntry
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     * @return WorkEntry
     */
    public function setStartDate(\DateTime $startDate): WorkEntry
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     * @return WorkEntry
     */
    public function setEndDate(\DateTime $endDate): WorkEntry
    {
        $this->endDate = $endDate;
        return $this;
    }
}