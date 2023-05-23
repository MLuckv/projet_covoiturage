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
     * @ORM\ManyToOne(targetEntity=Ville::class, inversedBy="voyage_deb")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ville_depart;

    // si problème Case mismatch between loaded and declared class names: "App\Entity\user" vs "App\Entity\User". doit changer les min en maj avant les variable dans le fichier concerné

    /**
     * @ORM\ManyToOne(targetEntity=Ville::class, inversedBy="voyage_fin")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ville_arrive;

    /**
     * @ORM\ManyToOne(targetEntity=Vehicule::class, inversedBy="voyage_veh")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vehicule;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->slug = uniqid();
    }

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

    public function getVilleDepart(): ?ville
    {
        return $this->ville_depart;
    }

    public function setVilleDepart(?ville $ville_depart): self
    {
        $this->ville_depart = $ville_depart;

        return $this;
    }

    public function getVilleArrive(): ?ville
    {
        return $this->ville_arrive;
    }

    public function setVilleArrive(?ville $ville_arrive): self
    {
        $this->ville_arrive = $ville_arrive;

        return $this;
    }

    public function getVehicule(): ?vehicule
    {
        return $this->vehicule;
    }

    public function setVehicule(?vehicule $vehicule): self
    {
        $this->vehicule = $vehicule;

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
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
