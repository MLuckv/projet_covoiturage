<?php

namespace App\Entity;

use App\Repository\DepartementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DepartementRepository::class)
 */
class Departement
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
    private $nom_departement;

    /**
     * @ORM\OneToMany(targetEntity=Ville::class, mappedBy="departement", orphanRemoval=true)
     */
    private $villes;

    /**
     * @ORM\Column(type="integer")
     */
    private $code_departement;

    public function __construct()
    {
        $this->villes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDepartement(): ?string
    {
        return $this->nom_departement;
    }

    public function setNomDepartement(string $nom_departement): self
    {
        $this->nom_departement = $nom_departement;

        return $this;
    }

    /**
     * @return Collection<int, Ville>
     */
    public function getVilles(): Collection
    {
        return $this->villes;
    }

    public function addVille(Ville $ville): self
    {
        if (!$this->villes->contains($ville)) {
            $this->villes[] = $ville;
            $ville->setDepartement($this);
        }

        return $this;
    }

    public function removeVille(Ville $ville): self
    {
        if ($this->villes->removeElement($ville)) {
            // set the owning side to null (unless already changed)
            if ($ville->getDepartement() === $this) {
                $ville->setDepartement(null);
            }
        }

        return $this;
    }

    public function getCodeDepartement(): ?int
    {
        return $this->code_departement;
    }

    public function setCodeDepartement(int $code_departement): self
    {
        $this->code_departement = $code_departement;

        return $this;
    }
}
