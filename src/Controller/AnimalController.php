<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnimalController extends AbstractController
{
    protected $repository;

    public function __construct(AnimalRepository $repository)
    {

        $this->repository = $repository;
    }

    /**
     * @Route("/animals", name="get_all_animals")
     */
    public function getAnimals()
    {

        $animals = $this->repository->findAll();
        $animalsArray = [];
        foreach ($animals as $animal) {
            $animalsArray[] = ["id" => $animal->getId(), "color" => $animal->getColor(), "healthStatus" => $animal->getHealthStatus()];
        }
        return new JsonResponse(json_encode($animalsArray));
    }
}
