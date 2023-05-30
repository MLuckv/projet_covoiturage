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
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Voyage::class, inversedBy="place")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $voy;


    public function __construct()
    {
    }

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

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getVoyage(): ?Voyage
    {
        return $this->voy;
    }

    public function setVoyage(?Voyage $voyage): self
    {
        $this->voy = $voyage;

        return $this;
    }
}
