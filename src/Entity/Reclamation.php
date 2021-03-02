<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReclamationRepository::class)
 */
class Reclamation
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
    public $description_rec;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescriptionRec(): ?string
    {
        return $this->description_rec;
    }

    public function setDescriptionRec(string $description_rec): self
    {
        $this->description_rec = $description_rec;

        return $this;
    }


}
