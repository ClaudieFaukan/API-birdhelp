<?php

namespace App\Services;

use DateTime;
use Exception;
use App\Entity\Fiche;
use App\Entity\Animal;
use App\Repository\FicheRepository;
use App\Entity\GeographicCoordinate;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class CompareFicheToFicheRetour extends FicheToJsonFormat
{
    protected $ficherepository;

    public function __construct(FicheRepository $ficherepository)
    {
        $this->ficherepository = $ficherepository;
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

            switch ($ficheBDD) {
                case $ficheBDD->getCoordinate() != $coordinate:
                    # code...
                    break;
                case $ficheBDD->getAnimal() != null:

                    # code...
                    break;
            }

            return true;
        } catch (Exception $e) {
            return $e;
        }
    }
}
