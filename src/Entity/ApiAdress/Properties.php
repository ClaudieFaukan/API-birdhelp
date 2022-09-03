<?php

namespace App\ApiAdress;

class Properties
{
    /**
     * @var string
     */
    private $label;

    /**
     * @var float
     */
    private $score;

    /**
     * @var string
     */
    private $housenumber;

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $postcode;

    /**
     * @var string
     */
    private $citycode;

    /**
     * @var float
     */
    private $x;

    /**
     * @var float
     */
    private $y;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $context;

    /**
     * @var string
     */
    private $type;

    /**
     * @var float
     */
    private $importance;

    /**
     * @var string
     */
    private $street;

    /**
     * @var int
     */
    private $distance;


    /**
     * @return string|null
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string|null $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return float|null
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param float|null $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * @return string|null
     */
    public function getHousenumber()
    {
        return $this->housenumber;
    }

    /**
     * @param string|null $housenumber
     */
    public function setHousenumber($housenumber)
    {
        $this->housenumber = $housenumber;
    }

    /**
     * @return string|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @param string|null $postcode
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }

    /**
     * @return string|null
     */
    public function getCitycode()
    {
        return $this->citycode;
    }

    /**
     * @param string|null $citycode
     */
    public function setCitycode($citycode)
    {
        $this->citycode = $citycode;
    }

    /**
     * @return float|null
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param float|null $x
     */
    public function setX($x)
    {
        $this->x = $x;
    }

    /**
     * @return float|null
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param float|null $y
     */
    public function setY($y)
    {
        $this->y = $y;
    }

    /**
     * @return string|null
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string|null
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param string|null $context
     */
    public function setContext($context)
    {
        $this->context = $context;
    }

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
     * @return float|null
     */
    public function getImportance()
    {
        return $this->importance;
    }

    /**
     * @param float|null $importance
     */
    public function setImportance($importance)
    {
        $this->importance = $importance;
    }

    /**
     * @return string|null
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string|null $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return int|null
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @param int|null $distance
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;
    }
}
