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
     * @ORM\JoinColumn(nullable=false)
     */
    private $voy_id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

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

    public function getVoyId(): ?voyage
    {
        return $this->voy_id;
    }

    public function setVoyId(?voyage $voy_id): self
    {
        $this->voy_id = $voy_id;

        return $this;
    }

    public function getUserId(): ?user
    {
        return $this->user_id;
    }

    public function setUserId(?user $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
}
