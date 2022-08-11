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

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\ManyToOne(targetEntity=HealthStatus::class, inversedBy="fiches")
     */
    private $healthstatus;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="fiches")
     */
    private $category;

    /**
     * @ORM\OneToOne(targetEntity=GeographicCoordinate::class, cascade={"persist", "remove"})
     */
    private $coordinate;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getHealthstatus(): ?HealthStatus
    {
        return $this->healthstatus;
    }

    public function setHealthstatus(?HealthStatus $healthstatus): self
    {
        $this->healthstatus = $healthstatus;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCoordinate(): ?GeographicCoordinate
    {
        return $this->coordinate;
    }

    public function setCoordinate(?GeographicCoordinate $coordinate): self
    {
        $this->coordinate = $coordinate;

        return $this;
    }
}
