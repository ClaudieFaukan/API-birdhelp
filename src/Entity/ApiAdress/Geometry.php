<?php

namespace App\ApiAdress;

class Geometry
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var array
     */
    private $coordinates;


    /**
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return array|null
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * @param array|null $coordinates
     */
    public function setCoordinates($coordinates)
    {
        $this->coordinates = $coordinates;
    }
}
