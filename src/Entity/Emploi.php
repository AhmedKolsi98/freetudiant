<?php

namespace App\Entity;

use App\Repository\EmploiRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmploiRepository::class)
 */
class Emploi
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
    private $emploiTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $emploiDesc;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $emploiRenum;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $renumType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmploiTitle(): ?string
    {
        return $this->emploiTitle;
    }

    public function setEmploiTitle(string $emploiTitle): self
    {
        $this->emploiTitle = $emploiTitle;

        return $this;
    }

    public function getEmploiDesc(): ?string
    {
        return $this->emploiDesc;
    }

    public function setEmploiDesc(?string $emploiDesc): self
    {
        $this->emploiDesc = $emploiDesc;

        return $this;
    }

    public function getEmploiRenum(): ?string
    {
        return $this->emploiRenum;
    }

    public function setEmploiRenum(string $emploiRenum): self
    {
        $this->emploiRenum = $emploiRenum;

        return $this;
    }

    public function getRenumType(): ?string
    {
        return $this->renumType;
    }

    public function setRenumType(string $renumType): self
    {
        $this->renumType = $renumType;

        return $this;
    }
}
