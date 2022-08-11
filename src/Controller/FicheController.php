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
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\HealthStatusRepository;
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
        $this->ficheRepository = $ficheRepository;
        $this->categoryRepository = $categoryRepository;
        $this->healthStatusRepository = $healthStatusRepository;
    }

    /**
     * @Route("/fiche", name="post_new_fiche", methods="POST")
     */
    public function postFiche(Request $request, EntityManagerInterface $em)
    {
        //TODO ajouter les verifs si user existe, si categorie existe, si status existe, si bien du string envoyer de description
        //TODO Que faire des photos ?

        $params = json_decode($request->getContent(), true);

        $helper = $params["helper"];
        $animalP = $params["Animal"];
        $coordinate = $params["geographicCoordinate"];
        $date = $params["date"];
        $photo = $params["photo"];
        $healthStatus = $params["healthstatus"];
        $description = $params["description"];
        $category = $params["category"];
        $color = $params["color"] = !null ? $params["color"] : "non-renseigner";

        $categoryEntity = $this->categoryRepository->find($animalP);
        $healthStatusEntity = $this->healthStatusRepository->find($healthStatus);

        try {

            $user = new User;
            $user->setEmail($helper)
                ->setFirstName("anonyme")
                ->setLastName("anonyme");

            $datetime = new DateTime($date);


            $animal = new Animal;
            $animal->setCategorie($categoryEntity)
                ->setColor($color);

            $coord = new GeographicCoordinate;
            $coord->setLattitude(strval($coordinate[0]))
                ->setLongitude(strval($coordinate[1]));

            $fiche = new Fiche;
            $fiche->setHelper($user)
                ->setAnimal($animal)
                ->setDate($datetime)
                ->setPhoto($photo)
                ->setHealthstatus($healthStatusEntity)
                ->setDescription($description)
                ->setCategory($categoryEntity)
                ->setCoordinate($coord);

            //$em->persist($animal);
            $em->persist($user);
            $em->persist($fiche);
            $em->persist($coord);
            $em->flush();

            //return new JsonResponse([json_encode($attribut)], Response::HTTP_OK);
            return new JsonResponse(["message" => "Fiche ajouter"], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return new JsonResponse(["message" => "Erreur survenu", "Details" => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Route("/fiches", name="get_all_fiches")
     */
    public function getAllFiche()
    {
    }
}
