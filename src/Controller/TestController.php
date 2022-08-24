<?php

namespace App\Controller;

use Exception;
use App\Entity\Fiche;
use Doctrine\DBAL\Query;
use App\Repository\FicheRepository;
use App\Entity\GeographicCoordinate;
use Symfony\Component\HttpFoundation\Request;
use App\Services\CalculatorDistanceGeographic;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GeographicCoordinateRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="app_test")
     */
    public function index(Request $request, GeographicCoordinateRepository $repo, FicheRepository $ficheRepository)
    {

        try {

            $current_coord = new GeographicCoordinate;
            $current_coord->setLattitude(49.435134993867)->setLongitude(1.0815019892211);
            $radius_meter = 6000;
            //$convertisseur est la référence pour 1km en dist_diff
            $convertisseur = 0.00900171;

            $currentPosition = floatval($current_coord->getLattitude()) + floatval($current_coord->getLongitude());
            $indice_de_recherche = ($radius_meter / 1000) * $convertisseur;

            $indiceHigh = $currentPosition + $indice_de_recherche;
            $indiceLow = $currentPosition - $indice_de_recherche;


            $query = $repo->createQueryBuilder("a")
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

            $fiches = $ficheRepository->findBy(["id" => $idTosearch]);
            return new JsonResponse($fiches, Response::HTTP_OK);
        } catch (Exception $e) {
            return new JsonResponse(["Erreur" => $e->getMessage], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
