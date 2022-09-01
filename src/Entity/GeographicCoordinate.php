<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GeographicCoordinateRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=GeographicCoordinateRepository::class)
 */
class GeographicCoordinate
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $longitude;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lattitude;

    /**
     * @ORM\OneToOne(targetEntity=Fiche::class, inversedBy="geographicCoordinate")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $fiche;

    /**
     * @ORM\Column(type="float")
     */
    private $diff_dist;

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLattitude(): ?string
    {
        return $this->lattitude;
    }

    public function setLattitude(string $lattitude): self
    {
        $this->lattitude = $lattitude;

        return $this;
    }

    public function getFiche(): ?Fiche
    {
        return $this->fiche;
    }

    public function setFiche(?Fiche $fiche): self
    {
        $this->fiche = $fiche;

        return $this;
    }
    public function __toString()
    {
        return strval($this->id);
    }

    public function getDiffDist(): ?float
    {
        return $this->diff_dist;
    }

    public function setDiffDist(float $diff_dist): self
    {
        $this->diff_dist = $diff_dist;

        return $this;
    }
}
