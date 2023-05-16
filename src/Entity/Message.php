<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 */
class Message
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
    
    //private $msg_id;

    /**
     * @ORM\Column(type="text")
     */
    private $msg;

    /**
     * @ORM\ManyToOne(targetEntity=user::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $expediteur_id;

    /**
     * @ORM\ManyToOne(targetEntity=user::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $destinataire_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    /*public function getMsgId(): ?int //deja id pas utile
    {
        return $this->msg_id;
    }

    public function setMsgId(int $msg_id): self
    {
        $this->msg_id = $msg_id;

        return $this;
    }*/

    public function getMsg(): ?string
    {
        return $this->msg;
    }

    public function setMsg(string $msg): self
    {
        $this->msg = $msg;

        return $this;
    }

    public function getExpediteurId(): ?user
    {
        return $this->expediteur_id;
    }

    public function setExpediteurId(?user $expediteur_id): self
    {
        $this->expediteur_id = $expediteur_id;

        return $this;
    }

    public function getDestinataireId(): ?user
    {
        return $this->destinataire_id;
    }

    public function setDestinataireId(?user $destinataire_id): self
    {
        $this->destinataire_id = $destinataire_id;

        return $this;
    }
}
