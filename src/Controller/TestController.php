<?php

namespace App\Controller;

use App\Entity\Fiche;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="app_test")
     */
    public function index(Request $request)
    {

        $json = json_encode(
            [
                "helper" => 0, "Animal" => 5, "geographicCoordinate" => [-122.084, 37.4219983],
                "date" => "2022-08-11:27:59.949183",
                "photo" => null,
                "healthstatus" => 3,
                "description" => "il a peur il a peur\n",
                "category" => 0
            ]
        );
    }
}
