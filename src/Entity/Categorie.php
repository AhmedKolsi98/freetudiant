<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $categorieName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $categorieDesc;

    /**
     * @ORM\OneToMany(targetEntity=Emploi::class, mappedBy="categorie")
     */
    private $emplois;

    public function __construct()
    {
        $this->emplois = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorieName(): ?string
    {
        return $this->categorieName;
    }

    public function setCategorieName(string $categorieName): self
    {
        $this->categorieName = $categorieName;

        return $this;
    }

    public function getCategorieDesc(): ?string
    {
        return $this->categorieDesc;
    }

    public function setCategorieDesc(?string $categorieDesc): self
    {
        $this->categorieDesc = $categorieDesc;

        return $this;
    }

    /**
     * @return Collection|Emploi[]
     */
    public function getEmplois(): Collection
    {
        return $this->emplois;
    }

    public function addEmploi(Emploi $emploi): self
    {
        if (!$this->emplois->contains($emploi)) {
            $this->emplois[] = $emploi;
            $emploi->setCategorie($this);
        }

        return $this;
    }

    public function removeEmploi(Emploi $emploi): self
    {
        if ($this->emplois->removeElement($emploi)) {
            // set the owning side to null (unless already changed)
            if ($emploi->getCategorie() === $this) {
                $emploi->setCategorie(null);
            }
        }

        return $this;
    }
}
