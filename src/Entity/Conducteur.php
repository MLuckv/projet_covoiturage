<?php

namespace App\Entity;

use App\Repository\ConducteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConducteurRepository::class)
 */
class Conducteur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Ville::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $ville_user;

    /**
     * @ORM\OneToMany(targetEntity=Vehicule::class, mappedBy="conducteur")
     */
    private $vehicule_user;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    public function __construct()
    {
        $this->vehicule_user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getVilleUser(): ?Ville
    {
        return $this->ville_user;
    }

    public function setVilleUser(?Ville $ville_user): self
    {
        $this->ville_user = $ville_user;

        return $this;
    }

    /**
     * @return Collection<int, Vehicule>
     */
    public function getVehiculeUser(): Collection
    {
        return $this->vehicule_user;
    }

    public function addVehiculeUser(Vehicule $vehiculeUser): self
    {
        if (!$this->vehicule_user->contains($vehiculeUser)) {
            $this->vehicule_user[] = $vehiculeUser;
            $vehiculeUser->setConducteur($this);
        }

        return $this;
    }

    public function removeVehiculeUser(Vehicule $vehiculeUser): self
    {
        if ($this->vehicule_user->removeElement($vehiculeUser)) {
            // set the owning side to null (unless already changed)
            if ($vehiculeUser->getConducteur() === $this) {
                $vehiculeUser->setConducteur(null);
            }
        }

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }
}
