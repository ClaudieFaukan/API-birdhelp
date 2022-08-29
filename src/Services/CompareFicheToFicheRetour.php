<?php

namespace App\Services;

use DateTime;
use Exception;
use App\Entity\Fiche;
use App\Entity\Animal;
use App\Entity\Category;
use App\Repository\UserRepository;
use App\Repository\FicheRepository;
use App\Entity\GeographicCoordinate;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\HealthStatusRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class CompareFicheToFicheRetour
{
    protected $ficherepository;
    protected $categoryRepository;
    protected $healthStatusRepository;
    protected $helperRepository;

    public function __construct(FicheRepository $ficherepository, HealthStatusRepository $healthStatusRepository, CategoryRepository $categoryRepository, UserRepository $helper)
    {
        $this->ficherepository = $ficherepository;
        $this->categoryRepository = $categoryRepository;
        $this->healthStatusRepository = $healthStatusRepository;
        $this->helperRepository = $helper;
    }

    public function compareFicheEntityToFicheRetourJson(array $params, EntityManagerInterface $em)
    {
        try {
            $id = $params['id'];
            $helper = $params["helper"];
            $animalP = $params["Animal"];
            /** @var GeographicCoordinate */
            $coordinate = $params["geographicCoordinate"];
            $date = $params["date"];
            $photo = $params["photo"];
            $healthStatus = $params["healthstatus"];
            $description = $params["description"];
            $category = $params["category"];
            $color = $params["color"] != "" ? $params["color"] : "non-renseigner";

            $ficheBDD = $this->ficherepository->find($id);
            if (!$ficheBDD) {
                return new JsonResponse(Response::HTTP_BAD_REQUEST);
            }

            switch ($params) {
                case $coordinate != [0]:
                    $ficheBDD->getCoordinate()->setLattitude($coordinate[0])->setLongitude($coordinate[1])->setDiffDist(($coordinate[0] + $coordinate[1]));
                    break;
                case $animalP != 0:
                    $ficheBDD = $this->updateAnimal($animalP, $ficheBDD);
                    break;
                case $healthStatus != 0:
                    $ficheBDD = $this->updateHealthStatus($healthStatus, $ficheBDD);
                    break;
                case $color != "":
                    $ficheBDD = $this->updateColor($color, $ficheBDD);
                    break;
                case $description != "":
                    $ficheBDD = $this->updateDescription($description, $ficheBDD);
                    break;
                case $photo != null:
                    $ficheBDD = $this->updatePhoto($photo, $ficheBDD);
                    break;
                default:
                    break;
            }

            $em->flush();

            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    private function updateAnimal(int $idAnimal, Fiche $fiche): Fiche
    {
        $newCategoryAnimal = $this->categoryRepository->find($idAnimal);
        $fiche->getAnimal()->setCategorie($newCategoryAnimal);
        return $fiche;
    }

    private function updateHealthStatus(int $id, Fiche $fiche): Fiche
    {
        $newHealthStatus = $this->healthStatusRepository->find($id);
        $fiche->setHealthstatus($newHealthStatus);
        return $fiche;
    }
    private function updateColor(string $color, Fiche $fiche): Fiche
    {
        $fiche->getAnimal()->setColor($color);
        return $fiche;
    }
    private function updateDescription(string $desc, Fiche $fiche): Fiche
    {
        $fiche->setDescription($desc);
        return $fiche;
    }
    private function updatePhoto(string $urlImage, Fiche $fiche): Fiche
    {
        $fiche->setPhoto($urlImage);
        return $fiche;
    }
}
