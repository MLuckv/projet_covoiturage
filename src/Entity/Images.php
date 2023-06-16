<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImagesRepository::class)
 */
class Images
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
    private $name;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="profile_picture", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_picture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUserPicture(): ?User
    {
        return $this->user_picture;
    }

    public function setUserPicture(User $user_picture): self
    {
        $this->user_picture = $user_picture;

        return $this;
    }

    public function __toString(){
        return $this->name;
    }
}
