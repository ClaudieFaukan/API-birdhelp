<?php

namespace App\Controller;

use App\Entity\GeographicCoordinate;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GeographicCoordinateRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CoordinateController extends AbstractController
{
    protected $coordinateRepository;

    public function __construct(GeographicCoordinateRepository $geographicCoordinateRepository)
    {
        $this->coordinateRepository = $geographicCoordinateRepository;
    }
    /**
     * @Route("/coordinates", name="app_coordinate")
     */
    public function getAllCoordinates()
    {
        $coordinates = $this->coordinateRepository->findAll();
        $json = [];
        foreach ($coordinates as $key => $value) {
            /** @var GeographicCoordinate */
            $value;
            $json[] = ["id" => $value->getId(), "latitude" => floatval($value->getLattitude()), "longitude" => floatval($value->getLongitude())];
        }
        return new JsonResponse($json, Response::HTTP_OK);
    }
}
