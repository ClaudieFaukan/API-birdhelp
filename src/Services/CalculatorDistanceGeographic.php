<?php

namespace App\Services;

use App\Entity\GeographicCoordinate;

class CalculatorDistanceGeographic
{

    public function getDistanceBeetweenTwoPoints(GeographicCoordinate $currentPoint, GeographicCoordinate $secondPoint)
    {
        $radCurrentLat = M_PI * floatval($currentPoint->getLattitude()) / 180;
        $radCurrentLong = M_PI * floatval($currentPoint->getLongitude()) / 180;

        $radSecondLat = M_PI * floatval($secondPoint->getLattitude()) / 180;
        $radSecondLong = M_PI * floatval($currentPoint->getLongitude()) / 180;

        $theta = floatval($currentPoint->getLongitude()) - floatval($secondPoint->getLongitude());
        $radtheta = M_PI * $theta / 180;

        $dist = sin($radCurrentLat) * sin($radSecondLat) + cos($radCurrentLat) * cos($radSecondLat) * cos($radtheta);

        $dist = acos($dist);
        $dist = $dist * 180 / M_PI;
        $dist = $dist * 60 * 1.1515;
        $dist = $dist * 1.609344;

        return $dist;
    }
}
