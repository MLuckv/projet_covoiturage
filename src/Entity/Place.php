<?php

namespace App\Entity;

use App\Repository\PlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity=Mark::class, mappedBy="places")
     */
    private $marks_places;


    public function __construct()
    {
        $this->marks_places = new ArrayCollection();
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

    /**
     * @return Collection<int, Mark>
     */
    public function getMarksPlaces(): Collection
    {
        return $this->marks_places;
    }

    public function addMarksPlace(Mark $marksPlace): self
    {
        if (!$this->marks_places->contains($marksPlace)) {
            $this->marks_places[] = $marksPlace;
            $marksPlace->setPlaces($this);
        }

        return $this;
    }

    public function removeMarksPlace(Mark $marksPlace): self
    {
        if ($this->marks_places->removeElement($marksPlace)) {
            // set the owning side to null (unless already changed)
            if ($marksPlace->getPlaces() === $this) {
                $marksPlace->setPlaces(null);
            }
        }

        return $this;
    }
}
