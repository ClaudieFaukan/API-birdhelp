<?php

namespace Services\ApiAdresseGouv;

use App\ApiAdress\ApiAdress;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class ApiAdresse
{
    protected $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    /**
     * Envoie les coordonnées et retourne l'adresse liés
     *
     * @param float $latitude
     * @param float $longitude
     * @return void
     * 
     */
    public function reverse(float $latitude, float $longitude)
    {

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

        return $content;
    }
}
