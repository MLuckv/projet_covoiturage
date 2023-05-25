<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 */
class Ville
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

    //private $code_ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_ville;

    /**
     * @ORM\ManyToOne(targetEntity=Departement::class, inversedBy="villes")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $departement;

    /**
     * @ORM\OneToMany(targetEntity=Voyage::class, mappedBy="ville_depart", orphanRemoval=true)
     */
    private $voyage_deb;

    /**
     * @ORM\OneToMany(targetEntity=Voyage::class, mappedBy="ville_arrive")
     */
    private $voyage_fin;

    public function __construct()
    {
        $this->voyage_deb = new ArrayCollection();
        $this->voyage_fin = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomVille(): ?string
    {
        return $this->nom_ville;
    }

    public function setNomVille(string $nom_ville): self
    {
        $this->nom_ville = $nom_ville;

        return $this;
    }

    public function getDepartement(): ?departement
    {
        return $this->departement;
    }

    public function setDepartement(?departement $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * @return Collection<int, Voyage>
     */
    public function getVoyageDeb(): Collection
    {
        return $this->voyage_deb;
    }

    public function addVoyageDeb(Voyage $voyageDeb): self
    {
        if (!$this->voyage_deb->contains($voyageDeb)) {
            $this->voyage_deb[] = $voyageDeb;
            $voyageDeb->setVilleDepart($this);
        }

        return $this;
    }

    public function removeVoyageDeb(Voyage $voyageDeb): self
    {
        if ($this->voyage_deb->removeElement($voyageDeb)) {
            // set the owning side to null (unless already changed)
            if ($voyageDeb->getVilleDepart() === $this) {
                $voyageDeb->setVilleDepart(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Voyage>
     */
    public function getVoyageFin(): Collection
    {
        return $this->voyage_fin;
    }

    public function addVoyageFin(Voyage $voyageFin): self
    {
        if (!$this->voyage_fin->contains($voyageFin)) {
            $this->voyage_fin[] = $voyageFin;
            $voyageFin->setVilleArrive($this);
        }

        return $this;
    }

    public function removeVoyageFin(Voyage $voyageFin): self
    {
        if ($this->voyage_fin->removeElement($voyageFin)) {
            // set the owning side to null (unless already changed)
            if ($voyageFin->getVilleArrive() === $this) {
                $voyageFin->setVilleArrive(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->nom_ville;
    }
}
