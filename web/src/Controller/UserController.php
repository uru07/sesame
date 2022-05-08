<?php

namespace App\Controller;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    private UserService $userService;

    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
    }

    public function addUser(Request $request): JsonResponse
    {
        $name = $request->request->get('name');
        $email = $request->request->get('email');

        try {
            $user = $this->userService->addUser($name, $email);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], $e->getCode());
        }

        return $this->json($user->getId());
    }

    public function editUser(Request $request, int $id): JsonResponse
    {
        $name = $request->request->get('name');
        $email = $request->request->get('email');

        try {
            $user = $this->userService->editUser($id, $name, $email);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], $e->getCode());
        }

        return $this->json($user->getId());
    }

    public function removeUser(Request $request): JsonResponse
    {
        $id = $request->request->get('id');

        try {
            $user = $this->userService->removeUser($id);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], $e->getCode());
        }

        return $this->json($user->getId());
    }

    public function getAllUser(Request $request): JsonResponse
    {
        $users = $this->userService->getAllActiveUser();

        return $this->json($users);
    }

    public function getUserById(Request $request, int $id): JsonResponse
    {
        try {
            $user = $this->userService->getActiveUser($id);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], $e->getCode());
        }

        return $this->json($user->toArray());
    }
}
