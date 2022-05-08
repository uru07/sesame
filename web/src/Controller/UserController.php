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
            $user = $this->userService->createNewUser($name, $email);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], $e->getCode());
        }

        return $this->json($user->getId());
    }

    public function editUser(Request $request): JsonResponse
    {
        $id = $request->request->get('id');
        $name = $request->request->get('name');
        $email = $request->request->get('email');

        try {
            $user = $this->userService->editUser($id, $name, $email);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], $e->getCode());
        }

        return $this->json($user->getId());
    }
}
