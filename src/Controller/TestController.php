<?php

namespace App\Controller;

use Exception;
use App\Entity\Fiche;
use Doctrine\DBAL\Query;
use App\ApiAdress\ApiAdress;
use App\Repository\FicheRepository;
use App\Entity\GeographicCoordinate;
use Symfony\Component\HttpFoundation\Request;
use App\Services\CalculatorDistanceGeographic;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GeographicCoordinateRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController
{
    protected $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    /**
     * @Route("/test", name="app_test")
     */
    public function index()
    {
        $longitude = 1.0838469999398;
        $latitude = 49.883856579769;

        $response = $this->client->request(
            'GET',
            "https://api-adresse.data.gouv.fr/reverse/?lon=$longitude&lat=$latitude"
        );
        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();

        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        /** @var ApiAdress */
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]
        dd($content->getFeatures());
    }
}
