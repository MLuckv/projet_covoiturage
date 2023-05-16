<?php

namespace App\Entity;

use App\Repository\VoyageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VoyageRepository::class)
 */
class Voyage
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
    private $nb_place;

    /**
     * @ORM\Column(type="datetime")
     */
    private $heure_depart;

    /**
     * @ORM\Column(type="datetime")
     */
    private $heure_arrive;

    /**
     * @ORM\ManyToOne(targetEntity=ville::class, inversedBy="voyage_deb")
     * @ORM\JoinColumn(nullable=false)
     */
    private $code_ville_depart;

    /**
     * @ORM\ManyToOne(targetEntity=ville::class, inversedBy="voyage_fin")
     */
    private $code_ville_arrive;

    /**
     * @ORM\ManyToOne(targetEntity=vehicule::class, inversedBy="voyage_veh")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vehicule_id;

    /**
     * @ORM\ManyToOne(targetEntity=user::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbPlace(): ?int
    {
        return $this->nb_place;
    }

    public function setNbPlace(int $nb_place): self
    {
        $this->nb_place = $nb_place;

        return $this;
    }

    public function getHeureDepart(): ?\DateTimeInterface
    {
        return $this->heure_depart;
    }

    public function setHeureDepart(\DateTimeInterface $heure_depart): self
    {
        $this->heure_depart = $heure_depart;

        return $this;
    }

    public function getHeureArrive(): ?\DateTimeInterface
    {
        return $this->heure_arrive;
    }

    public function setHeureArrive(\DateTimeInterface $heure_arrive): self
    {
        $this->heure_arrive = $heure_arrive;

        return $this;
    }

    public function getCodeVilleDepart(): ?ville
    {
        return $this->code_ville_depart;
    }

    public function setCodeVilleDepart(?ville $code_ville_depart): self
    {
        $this->code_ville_depart = $code_ville_depart;

        return $this;
    }

    public function getCodeVilleArrive(): ?ville
    {
        return $this->code_ville_arrive;
    }

    public function setCodeVilleArrive(?ville $code_ville_arrive): self
    {
        $this->code_ville_arrive = $code_ville_arrive;

        return $this;
    }

    public function getVehiculeId(): ?vehicule
    {
        return $this->vehicule_id;
    }

    public function setVehiculeId(?vehicule $vehicule_id): self
    {
        $this->vehicule_id = $vehicule_id;

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
