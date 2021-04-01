<?php

namespace App\Entity;

use App\Repository\NotificationfRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NotificationfRepository::class)
 */
class Notificationf
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
    private $notif;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNotif(): ?string
    {
        return $this->notif;
    }

    public function setNotif(string $notif): self
    {
        $this->notif = $notif;

        return $this;
    }
}
