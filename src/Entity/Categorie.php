<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
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
}
