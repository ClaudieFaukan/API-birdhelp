<?php

namespace App\Controller;

use Exception;
use App\Repository\UserRepository;
use App\Repository\FicheRepository;
use App\Services\FicheToJsonFormat;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    protected $helperRepository;
    protected $ficheRepository;
    protected $ficheToJsonFormat;
    public function __construct(UserRepository $userRepository, FicheRepository $ficheRepository, FicheToJsonFormat $ficheToJsonFormat)
    {
        $this->helperRepository = $userRepository;
        $this->ficheRepository = $ficheRepository;
        $this->ficheToJsonFormat = $ficheToJsonFormat;
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
}
