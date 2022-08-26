<?php

namespace App\Controller;

use App\Entity\GeographicCoordinate;
use Exception;
use App\Repository\UserRepository;
use App\Repository\FicheRepository;
use App\Repository\GeographicCoordinateRepository;
use App\Services\FicheToJsonFormat;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    protected $helperRepository;
    protected $ficheRepository;
    protected $ficheToJsonFormat;
    protected $coordinateRepository;
    public function __construct(UserRepository $userRepository, FicheRepository $ficheRepository, FicheToJsonFormat $ficheToJsonFormat, GeographicCoordinateRepository $coordinateRepository)
    {
        $this->helperRepository = $userRepository;
        $this->ficheRepository = $ficheRepository;
        $this->ficheToJsonFormat = $ficheToJsonFormat;
        $this->coordinateRepository = $coordinateRepository;
    }
    /**
     * @Route("/user/fiches/{id}", name="get_all_fiches_by_user")
     */
    public function getAllfichesByUser($id)
    {
        $json = [];
        try {
            $user = $this->helperRepository->findOneBy(["Email" => $id]);
            if ($user == null) {
                return new JsonResponse(null, Response::HTTP_FORBIDDEN);
            }
            $fiches = $this->ficheRepository->findBy(["helper" => $user->getId()]);

            foreach ($fiches as $fiche) {

                $json[] = $this->ficheToJsonFormat->format($fiche);
            }

            return new JsonResponse($json, Response::HTTP_OK);
        } catch (Exception $e) {
            return new JsonResponse(["error" => $e->getCode(), "Detail" => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Route("/user/delete/fiche/{id}", name="delete_fiche_by_id",methods="POST")
     */
    public function deleteFicheuserById($id, Request $request)
    {
        try {
            //controller si id de fiche existe
            $fiche = $this->ficheRepository->findOneBy(['id' => $id]);
            //sinon degage
            if (!$fiche) {
                //204
                return new JsonResponse(["Erreur" => "Aucune fiche n'est trouvé"], Response::HTTP_NO_CONTENT);
            }

            $params = json_decode($request->getContent(), true);
            $userMail = $params["email"];
            //Controller si le user existe
            $user = $this->helperRepository->findOneBy(["Email" => $userMail]);
            if (!$user) {
                //204
                return new JsonResponse(["Erreur" => "Aucun utilisateur n'est trouvé"], Response::HTTP_NO_CONTENT);
            }
            //Controller si l'id fiche correspond a l'utilisateur
            if ($fiche->getHelper()->getId() != $user->getId()) {
                //403
                return new JsonResponse(["Erreur" => "l'utilisateur n'est pas autorisé a modifier cette fiche"], Response::HTTP_FORBIDDEN);
            }
            $coord = $this->coordinateRepository->findOneBy(["id" => $fiche->getCoordinate()->getId()]);
            //supprimer le point geographique
            $this->coordinateRepository->remove($coord);
            $this->ficheRepository->remove($fiche);

            return new JsonResponse(Response::HTTP_OK);
        } catch (Exception $e) {
            return new JsonResponse(["Erreur" => $e->getMessage], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Route("/user/fiche/update/{id}", name="fiche_update_by_id", methods="POST")
     */
    public function updateFicheById($id, Request $request)
    {

        $params = json_decode($request->getContent(), true);
        $params = $params[0];
        dd($params);
        $fiche = $this->ficheRepository->find($id);
        if (!$fiche) {
            return new JsonResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        dump($params);
        dump($fiche);
        dd();
    }
}
