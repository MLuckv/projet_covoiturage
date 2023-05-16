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
     * @ORM\ManyToOne(targetEntity=departement::class, inversedBy="villes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $code_departement;

    /**
     * @ORM\OneToMany(targetEntity=Voyage::class, mappedBy="code_ville_depart", orphanRemoval=true)
     */
    private $voyage_deb;

    /**
     * @ORM\OneToMany(targetEntity=Voyage::class, mappedBy="code_ville_arrive")
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

    /*public function getCodeVille(): ?int
    {
        return $this->code_ville;
    }

    public function setCodeVille(int $code_ville): self
    {
        $this->code_ville = $code_ville;

        return $this;
    }*/

    public function getNomVille(): ?string
    {
        return $this->nom_ville;
    }

    public function setNomVille(string $nom_ville): self
    {
        $this->nom_ville = $nom_ville;

        return $this;
    }

    public function getCodeDepartement(): ?departement
    {
        return $this->code_departement;
    }

    public function setCodeDepartement(?departement $code_departement): self
    {
        $this->code_departement = $code_departement;

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
            $voyageDeb->setCodeVilleDepart($this);
        }

        return $this;
    }

    public function removeVoyageDeb(Voyage $voyageDeb): self
    {
        if ($this->voyage_deb->removeElement($voyageDeb)) {
            // set the owning side to null (unless already changed)
            if ($voyageDeb->getCodeVilleDepart() === $this) {
                $voyageDeb->setCodeVilleDepart(null);
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
            $voyageFin->setCodeVilleArrive($this);
        }

        return $this;
    }

    public function removeVoyageFin(Voyage $voyageFin): self
    {
        if ($this->voyage_fin->removeElement($voyageFin)) {
            // set the owning side to null (unless already changed)
            if ($voyageFin->getCodeVilleArrive() === $this) {
                $voyageFin->setCodeVilleArrive(null);
            }
        }

        return $this;
    }
}
