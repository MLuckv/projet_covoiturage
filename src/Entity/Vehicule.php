<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VehiculeRepository::class)
 */
class Vehicule
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
    private $immatriculation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modele;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $couleur;

    /**
     * @ORM\OneToMany(targetEntity=Voyage::class, mappedBy="vehicule", orphanRemoval=true)
     */
    private $voyage_veh;

    /**
     * @ORM\ManyToOne(targetEntity=user::class)
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $user;

    public function __construct()
    {
        $this->voyage_veh = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(string $immatriculation): self
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * @return Collection<int, Voyage>
     */
    public function getVoyageVeh(): Collection
    {
        return $this->voyage_veh;
    }

    public function addVoyageVeh(Voyage $voyageVeh): self
    {
        if (!$this->voyage_veh->contains($voyageVeh)) {
            $this->voyage_veh[] = $voyageVeh;
            $voyageVeh->setVehicule($this);
        }

        return $this;
    }

    public function removeVoyageVeh(Voyage $voyageVeh): self
    {
        if ($this->voyage_veh->removeElement($voyageVeh)) {
            // set the owning side to null (unless already changed)
            if ($voyageVeh->getVehicule() === $this) {
                $voyageVeh->setVehicule(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->immatriculation;
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
