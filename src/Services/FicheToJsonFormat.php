<?php

namespace App\Services;

use DateTime;
use Exception;
use App\Entity\User;
use App\Entity\Fiche;
use App\Entity\Animal;
use App\Entity\HealthStatus;
use App\Entity\GeographicCoordinate;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\HealthStatusRepository;

class FicheToJsonFormat
{
    protected $categoryRepository;
    protected $healthStatusRepository;

    public function __construct(HealthStatusRepository $healthStatusRepository, CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->healthStatusRepository = $healthStatusRepository;
    }

    public function format(Fiche $fiche): array
    {
        $json = [];
        $json["id"] = $fiche->getId();
        $json["helper"] =
            [
                "id" => $fiche->getHelper()->getId(),
                "FirstName" => $fiche->getHelper()->getFirstName(),
                "LastName" => $fiche->getHelper()->getLastName(),
                "Email" => $fiche->getHelper()->getEmail()
            ];
        $json["animal"] = [
            "id" => $fiche->getAnimal()->getId(),
            "color" => $fiche->getAnimal()->getColor(),
        ];
        $json["healthStatus"] = $fiche->getHealthstatus()->getStatus();
        $json["category"] = $fiche->getCategory()->getName();
        $json["date"] = $fiche->getDate()->format("Y-m-d H:i:s");
        $json["photo"] = $fiche->getPhoto();
        $json["description"] = $fiche->getDescription();
        $json["coordinates"] = [
            "id" => $fiche->getCoordinate()->getId(),
            "latitude" => floatval($fiche->getCoordinate()->getLattitude()),
            "longitude" => floatval($fiche->getCoordinate()->getLongitude())
        ];
        return $json;
    }

    public function jsonToFiche(array $params, EntityManagerInterface $em): bool
    {
        try {

            $helper = $params["helper"];
            $animalP = $params["Animal"];
            $coordinate = $params["geographicCoordinate"];
            $date = $params["date"];
            $photo = $params["photo"];
            $healthStatus = $params["healthstatus"];
            $description = $params["description"];
            $category = $params["category"];
            $color = $params["color"] != "" ? $params["color"] : "non-renseigner";

            $categoryEntity = $this->categoryRepository->find($animalP);
            $healthStatusEntity = $this->healthStatusRepository->find($healthStatus);


            $user = new User;
            $user->setEmail($helper)
                ->setFirstName("anonyme")
                ->setLastName("anonyme");

            $datetime = new DateTime($date);


            $animal = new Animal;
            $animal->setCategorie($categoryEntity)
                ->setColor($color);

            $coord = new GeographicCoordinate;
            $coord->setLattitude(strval($coordinate[1]))
                ->setLongitude(strval($coordinate[0]));

            $fiche = new Fiche;
            $fiche->setHelper($user)
                ->setAnimal($animal)
                ->setDate($datetime)
                ->setPhoto($photo)
                ->setHealthstatus($healthStatusEntity)
                ->setDescription($description)
                ->setCategory($categoryEntity)
                ->setCoordinate($coord);

            $coord->setFiche($fiche);

            $em->persist($animal);
            $em->persist($user);
            $em->persist($fiche);
            $em->persist($coord);
            $em->flush();
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }
}
