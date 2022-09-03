<?php

namespace App\ApiAdress;

class Features
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var Geometry
     */
    private $geometry;

    /**
     * @var Properties
     */
    private $properties;


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
     * @return Geometry|null
     */
    public function getGeometry()
    {
        return $this->geometry;
    }

    /**
     * @param Geometry|null $geometry
     */
    public function setGeometry($geometry)
    {
        $this->geometry = $geometry;
    }

    /**
     * @return Properties|null
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param Properties|null $properties
     */
    public function setProperties($properties)
    {
        $this->properties = $properties;
    }
}
