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
            return $this->json(['error' => $e->getMessage()], $e->getCode());
        }

        return $this->json($workEntry->getId());
    }
}
