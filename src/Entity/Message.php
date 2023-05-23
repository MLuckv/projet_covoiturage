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

    /**
     * @ORM\Column(type="text")
     */
    private $msg;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $expediteur;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $destinataire;

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

    public function getExpediteur(): ?user
    {
        return $this->expediteur;
    }

    public function setExpediteur(?user $expediteur): self
    {
        $this->expediteur = $expediteur;

        return $this;
    }

    public function getDestinataire(): ?user
    {
        return $this->destinataire;
    }

    public function setDestinataire(?user $destinataire): self
    {
        $this->destinataire = $destinataire;

        return $this;
    }
}
