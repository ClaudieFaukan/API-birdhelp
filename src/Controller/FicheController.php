<?php

namespace App\Controller;

use DateTime;
use Exception;
use App\Entity\User;
use App\Entity\Fiche;
use App\Entity\Animal;
use App\Repository\FicheRepository;
use App\Entity\GeographicCoordinate;
use App\Repository\CategoryRepository;
use App\Repository\GeographicCoordinateRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\HealthStatusRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Services\FicheToJsonFormat;


class FicheController extends AbstractController
{
    protected $ficheRepository;
    protected $categoryRepository;
    protected $healthStatusRepository;
    protected $em;
    protected $geographicCoordinateRepository;
    protected $ficheToJsonFormat;

    public function __construct(
        FicheRepository $ficheRepository,
        CategoryRepository $categoryRepository,
        HealthStatusRepository $healthStatusRepository,
        EntityManagerInterface $em,
        GeographicCoordinateRepository $geographicCoordinateRepository,
        FicheToJsonFormat $ficheToJsonFormat
    ) {
        $this->ficheRepository = $ficheRepository;
        $this->categoryRepository = $categoryRepository;
        $this->healthStatusRepository = $healthStatusRepository;
        $this->em = $em;
        $this->geographicCoordinateRepository = $geographicCoordinateRepository;
        $this->ficheToJsonFormat = $ficheToJsonFormat;
    }

    /**
     * @Route("/fiche", name="post_new_fiche", methods="POST")
     */
    public function postFiche(Request $request, EntityManagerInterface $em)
    {
        //TODO ajouter les verifs si user existe, si categorie existe, si status existe, si bien du string envoyer de description
        //TODO Que faire des photos ?

        $params = json_decode($request->getContent(), true);

        try {

            $callback =  $this->ficheToJsonFormat->jsonToFiche($params, $em);
            if ($callback == true) {
                return new JsonResponse(["message" => "Fiche ajouter"], Response::HTTP_CREATED);
            }
            //return new JsonResponse([json_encode($attribut)], Response::HTTP_OK);
            return new JsonResponse(["message" => "Erreur survenu", "Details" => "gg"], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Exception $e) {
            return new JsonResponse(["message" => "Erreur survenu", "Details" => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * @Route("/fiche/{id}", name="get_fiche_by_id")
     */
    public function getFicheById($id)
    {
        $json = [];
        try {

            $fiche = $this->ficheRepository->find($id);

            $json = $this->ficheToJsonFormat->format($fiche);

            return new JsonResponse($json, Response::HTTP_OK);
        } catch (Exception $e) {
            return new JsonResponse(["message" => "erreur survenue, verifier l'id"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @Route("/fiche/coordinate/{id}", name="get_fiche_by_coordinate_id")
     */
    public function getFicheByIdCoordinate($id)
    {
        $json = [];

        try {

            $coord = $this->geographicCoordinateRepository->find($id);

            $fiche = $this->ficheRepository->find($coord->getFiche()->getId());

            $json = $this->ficheToJsonFormat->format($fiche);

            return new JsonResponse($json, Response::HTTP_OK);
        } catch (Exception $e) {
            return new JsonResponse(["message" => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Route("/fiches", name="get_all_fiches",methods="GET")
     */
    public function getAllFiche()
    {

        $json = [];

        try {
            $fiches = $this->ficheRepository->findAll();

            foreach ($fiches as $fiche) {

                $json[] = $this->ficheToJsonFormat->format($fiche);
            }

            return new JsonResponse($json, Response::HTTP_OK);
        } catch (Exception $e) {

            return new JsonResponse(["message" => $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR]);
        }
    }
}
