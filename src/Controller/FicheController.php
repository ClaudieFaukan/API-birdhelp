<?php

namespace App\Controller;

use App\Entity\Animal;
use DateTime;
use App\Entity\User;
use App\Entity\Fiche;
use App\Repository\FicheRepository;
use App\Entity\GeographicCoordinate;
use App\Repository\CategoryRepository;
use App\Repository\HealthStatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FicheController extends AbstractController
{
    protected $ficheRepository;
    protected $categoryRepository;
    protected $healthStatusRepository;

    public function __construct(FicheRepository $ficheRepository, CategoryRepository $categoryRepository, HealthStatusRepository $healthStatusRepository)
    {
        $this->ficherepository = $ficheRepository;
        $this->categoryRepository = $categoryRepository;
        $this->healthStatusRepository = $healthStatusRepository;
    }

    /**
     * @Route("/fiche", name="post_new_fiche", methods="POST")
     */
    public function postFiche(Request $request, EntityManagerInterface $em)
    {
        $params = json_decode($request->getContent(), true);

        $helper = $params["helper"];
        $animalP = $params["Animal"];
        $coordinate = $params["geographicCoordinate"];
        $date = $params["date"];
        $photo = $params["photo"];
        $healthStatus = $params["healthstatus"];
        $description = $params["description"];
        $category = $params["category"];

        $categoryEntity = $this->categoryRepository->find($animalP);
        $fiche = new Fiche;
        $coord = new GeographicCoordinate;
        $user = new User;
        $healthStatusEntity = $this->healthStatusRepository->find($healthStatus);
        $user->setEmail($helper);
        $datetime = new DateTime($date);
        $animal = new Animal;
        $animal->setCategorie($categoryEntity);

        //$coord->setLattitude($coord[1])
        //    ->setLongitude($coord[0]);

        $fiche->setHelper($user)
            ->setAnimal($animal)
            ->setDate($datetime)
            ->setPhoto($photo)
            ->setHealthstatus($healthStatusEntity)
            ->setDescription($description);
        $em->persist($user);
        $em->persist($animal);
        $em->persist($fiche);
        //$em->persist($coord);
        $em->flush();

        //return new JsonResponse([json_encode($attribut)], Response::HTTP_OK);
        return new JsonResponse($params, Response::HTTP_CREATED);
    }
}
