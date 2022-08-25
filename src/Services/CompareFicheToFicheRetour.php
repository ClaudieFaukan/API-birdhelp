<?php

namespace App\Services;

use DateTime;
use App\Entity\Fiche;
use App\Entity\Animal;
use App\Entity\GeographicCoordinate;

class CompareFicheToFicheRetour
{

    public function compareFicheEntityToFicheRetourJson(Fiche $fiche, $json)
    {
        /** @var GeographicCoordinate */
        $coordonne_json = $json["coordinates"];
        /** @var Animal */
        $animal_json = $json["animal"];
        $heathStatus_json = $json["healthStatus"];
        $category_json = $json["category"];
        $date_json = new DateTime();
        $photo_json = $json['photo'];
        $description_json = $json["description"];

        switch ($fiche) {
            case $fiche->getCoordinate() != $coordonne_json:
                $fiche->setCoordinate($coordonne_json);
                break;
            case $fiche->getAnimal() != $animal_json:
                //todo
                break;
            case $fiche->getHealthstatus()->getStatus() != $heathStatus_json;
                //Todo modifier l'id de healthstatus
                $fiche->getHealthstatus()->setStatus($heathStatus_json);
            default:
                # code...
                break;
        }
    }
}
