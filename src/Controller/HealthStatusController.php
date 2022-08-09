<?php

namespace App\Controller;

use App\Repository\HealthStatusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HealthStatusController extends AbstractController
{
    protected $repository;

    public function __construct(HealthStatusRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/healthstatus", name="get_all_health_status")
     */
    public function getHealthStatus()
    {
        $status = $this->repository->findAll();
        $statusArray = [];

        foreach ($status as $statut) {
            $statusArray[] = ['id' => $statut->getId(), 'status' => $statut->getStatus()];
        }
        return new JsonResponse($statusArray);
    }
}
