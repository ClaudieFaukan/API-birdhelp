<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FicheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=FicheRepository::class)
 */
class Fiche
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="fiches")
     */
    private $helper;

    /**
     * @ORM\OneToOne(targetEntity=Animal::class, cascade={"persist", "remove"})
     */
    private $Animal;

    /**
     * @ORM\OneToMany(targetEntity=GeographicCoordinate::class, mappedBy="fiche")
     */
    private $geographicCoordinate;

    public function __construct()
    {
        $this->geographicCoordinate = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHelper(): ?User
    {
        return $this->helper;
    }

    public function setHelper(?User $helper): self
    {
        $this->helper = $helper;

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->Animal;
    }

    public function setAnimal(?Animal $Animal): self
    {
        $this->Animal = $Animal;

        return $this;
    }

    /**
     * @return Collection<int, GeographicCoordinate>
     */
    public function getGeographicCoordinate(): Collection
    {
        return $this->geographicCoordinate;
    }

    public function addGeographicCoordinate(GeographicCoordinate $geographicCoordinate): self
    {
        if (!$this->geographicCoordinate->contains($geographicCoordinate)) {
            $this->geographicCoordinate[] = $geographicCoordinate;
            $geographicCoordinate->setFiche($this);
        }

        return $this;
    }

    public function removeGeographicCoordinate(GeographicCoordinate $geographicCoordinate): self
    {
        if ($this->geographicCoordinate->removeElement($geographicCoordinate)) {
            // set the owning side to null (unless already changed)
            if ($geographicCoordinate->getFiche() === $this) {
                $geographicCoordinate->setFiche(null);
            }
        }

        return $this;
    }
}
