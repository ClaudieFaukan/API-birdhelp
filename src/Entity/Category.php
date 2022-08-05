<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Fiche::class, mappedBy="category")
     */
    private $fiches;

    public function __construct()
    {
        $this->fiches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Fiche>
     */
    public function getFiches(): Collection
    {
        return $this->fiches;
    }

    public function addFich(Fiche $fich): self
    {
        if (!$this->fiches->contains($fich)) {
            $this->fiches[] = $fich;
            $fich->setCategory($this);
        }

        return $this;
    }

    public function removeFich(Fiche $fich): self
    {
        if ($this->fiches->removeElement($fich)) {
            // set the owning side to null (unless already changed)
            if ($fich->getCategory() === $this) {
                $fich->setCategory(null);
            }
        }

        return $this;
    }
}
