<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function addUser(string $name, string $email): User
    {
        $today = new \DateTime();

        $user = new User();
        $user->setCreatedAt($today)
            ->setUpdatedAt($today)
            ->setName($name)
            ->setEmail($email)
        ;
        $this->userRepository->persist($user);

        return $user;
    }

    /**
     * @throws \Exception
     */
    public function editUser(int $id, string $name, string $email): User
    {
        $user = $this->userRepository->getActiveUserById($id);
        if (is_null($user)) {
            throw new \Exception('User not found');
        }

        $today = new \DateTime();

        $user->setUpdatedAt($today)
            ->setName($name)
            ->setEmail($email)
        ;
        $this->userRepository->persist($user);

        return $user;
    }

    /**
     * @throws \Exception
     */
    public function removeUser(int $id): User
    {
        $user = $this->userRepository->getActiveUserById($id);
        if (is_null($user)) {
            throw new \Exception('User not found');
        }

        $today = new \DateTime();

        $user->setDeletedAt($today);
        $this->userRepository->persist($user);

        return $user;
    }

    /**
     * @throws \Exception
     */
    public function getUser(int $id): User
    {
        $user = $this->userRepository->getActiveUserById($id);
        if (is_null($user)) {
            throw new \Exception('User not found');
        }

        return $user;
    }
}
