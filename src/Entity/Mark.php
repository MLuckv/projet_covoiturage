<?php

namespace App\Entity;

use App\Repository\MarkRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=MarkRepository::class)
 * @UniqueEntity(
 *     fields={"user_mark", "receive_mark"},
 *     errorPath="user_mark",
 *     message="cette utilisateur a déjà noté cette recette."
 * )
 */
class Mark
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     * @Assert\LessThan(6)
     */


    private $mark;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="user_marks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_mark;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="receive_marks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $receive_mark;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $texte;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
    
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMark(): ?int
    {
        return $this->mark;
    }

    public function setMark(int $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getUserMark(): ?User
    {
        return $this->user_mark;
    }

    public function setUserMark(?User $user_mark): self
    {
        $this->user_mark = $user_mark;

        return $this;
    }

    public function getReceiveMark(): ?User
    {
        return $this->receive_mark;
    }

    public function setReceiveMark(?User $receive_mark): self
    {
        $this->receive_mark = $receive_mark;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->created_at = $createdAt;

        return $this;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(?string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }
}
