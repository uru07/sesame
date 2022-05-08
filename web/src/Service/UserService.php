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

    public function createNewUser(string $name, string $email): User
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
}
