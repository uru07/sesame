<?php

namespace App\Controller;

use App\Service\WorkEntryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class WorkEntryController extends AbstractController
{
    private WorkEntryService $workEntryService;

    public function __construct(
        WorkEntryService $workEntryService
    ) {
        $this->workEntryService = $workEntryService;
    }

    public function addWorkEntry(Request $request): JsonResponse
    {
        $userId = $request->request->get('userId');
        $startDate = $request->request->get('startDate');
        $endDate = $request->request->get('endDate', null);

        try {
            $workEntry = $this->workEntryService->addWorkEntry($userId, $startDate, $endDate);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()]);
        }

        return $this->json($workEntry->getId());
    }

    public function editWorkEntry(Request $request, int $id): JsonResponse
    {
        $startDate = $request->request->get('startDate');
        $endDate = $request->request->get('endDate', null);

        try {
            $workEntry = $this->workEntryService->editWorkEntry($id, $startDate, $endDate);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()]);
        }

        return $this->json($workEntry->getId());
    }

    public function removeWorkEntry(Request $request): JsonResponse
    {
        $id = $request->request->get('id');

        try {
            $workEntry = $this->workEntryService->removeWorkEntry($id);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()]);
        }

        return $this->json($workEntry->getId());
    }

    public function getWorkEntryById(Request $request, int $id): JsonResponse
    {
        $workEntry = $this->workEntryService->getAllActiveWorkEntryById($id);

        return $this->json($workEntry->toArray());
    }

    public function getWorkEntryByUserId(Request $request, int $userId): JsonResponse
    {
        $workEntry = $this->workEntryService->getAllActiveWorkEntryByUserId($userId);

        return $this->json($workEntry);
    }
}
