<?php

namespace App\ApiAdress;

class ApiAdress
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $version;

    /**
     * @var array
     */
    private $features;

    /**
     * @var string
     */
    private $attribution;

    /**
     * @var string
     */
    private $licence;

    /**
     * @var int
     */
    private $limit;


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
     * @return string|null
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string|null $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return array|null
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * @param array|null $features
     */
    public function setFeatures($features)
    {
        $this->features = $features;
    }

    /**
     * @return string|null
     */
    public function getAttribution()
    {
        return $this->attribution;
    }

    /**
     * @param string|null $attribution
     */
    public function setAttribution($attribution)
    {
        $this->attribution = $attribution;
    }

    /**
     * @return string|null
     */
    public function getLicence()
    {
        return $this->licence;
    }

    /**
     * @param string|null $licence
     */
    public function setLicence($licence)
    {
        $this->licence = $licence;
    }

    /**
     * @return int|null
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param int|null $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }
}
