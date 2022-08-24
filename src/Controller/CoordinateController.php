<?php

namespace App\Controller;

use Exception;
use App\Repository\FicheRepository;
use App\Entity\GeographicCoordinate;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GeographicCoordinateRepository;
use App\Services\FicheToJsonFormat;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CoordinateController extends AbstractController
{
    protected $coordinateRepository;
    protected $ficheRepository;
    protected $ficheToJsonFormat;

    public function __construct(GeographicCoordinateRepository $geographicCoordinateRepository, FicheRepository $ficheRepository, FicheToJsonFormat $ficheToJsonFormat)
    {
        $this->coordinateRepository = $geographicCoordinateRepository;
        $this->ficheRepository = $ficheRepository;
        $this->ficheToJsonFormat = $ficheToJsonFormat;
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

    //TODO Refacto getCoordinateFormRadius, extraire le code et le mettre en service

    /**
     * @Route("/coordinates/by_current_position/radius", name="coordiante_around_user_by_radius_meter")
     */
    public function getCoordinateFromRadiusMeter(Request $request)
    {
        $params = json_decode($request->getContent(), true);
        $coordinate = $params["coordinates"];
        $current_coord = new GeographicCoordinate;
        $current_coord->setLattitude(strval($coordinate["latitude"]))
            ->setLongitude(strval($coordinate["longitude"]))
            ->setDiffDist($coordinate["latitude"] + $coordinate["longitude"]);

        $radius_meter = $params["radius"];

        try {
            //$convertisseur est la référence pour 1km en dist_diff
            $convertisseur = 0.00900171;

            $currentPosition = floatval($current_coord->getLattitude()) + floatval($current_coord->getLongitude());
            $indice_de_recherche = ($radius_meter / 1000) * $convertisseur;

            $indiceHigh = $currentPosition + $indice_de_recherche;
            $indiceLow = $currentPosition - $indice_de_recherche;


            $query = $this->coordinateRepository->createQueryBuilder("a")
                ->where("a.diff_dist >= :low ")->andWhere("a.diff_dist <= :high")->setParameters([':low' => $indiceLow, ':high' => $indiceHigh]);

            $query = $query->getQuery()->execute();
            if (!$query) {
                return new JsonResponse($query, Response::HTTP_FORBIDDEN);
            }
            /** @var GeographicCoordinate[] */
            $listCoordinate = $query;
            $idTosearch = [];
            foreach ($listCoordinate as $key) {
                $idTosearch[] = $key->getFiche()->getId();
            }

            $fiches = $this->ficheRepository->findBy(["id" => $idTosearch]);
            $json = [];
            foreach ($fiches as $fiche) {
                $json[] = $this->ficheToJsonFormat->format($fiche);
            }
            return new JsonResponse($json, Response::HTTP_OK);
        } catch (Exception $e) {
            return new JsonResponse(["Erreur" => $e->getMessage], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
