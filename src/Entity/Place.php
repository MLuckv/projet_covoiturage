<?php

namespace App\Entity;

use App\Repository\PlaceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlaceRepository::class)
 */
class Place
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $num_place;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix_place;

    /**
     * @ORM\ManyToOne(targetEntity=Voyage::class)
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $voy;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumPlace(): ?int
    {
        return $this->num_place;
    }

    public function setNumPlace(int $num_place): self
    {
        $this->num_place = $num_place;

        return $this;
    }

    public function getPrixPlace(): ?int
    {
        return $this->prix_place;
    }

    public function setPrixPlace(int $prix_place): self
    {
        $this->prix_place = $prix_place;

        return $this;
    }

    public function getVoy(): ?voyage
    {
        return $this->voy;
    }

    public function setVoy(?voyage $voy): self
    {
        $this->voy = $voy;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }
}
