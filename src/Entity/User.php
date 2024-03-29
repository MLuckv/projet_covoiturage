<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $firstname;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $num_tel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=Voyage::class, mappedBy="user")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $voyage_user;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="sender", orphanRemoval=true)
     */
    private $sent;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="recipient", orphanRemoval=true)
     */
    private $receive;

    /**
     * @ORM\OneToOne(targetEntity=Conducteur::class, inversedBy="users", cascade={"persist", "remove"})
     */
    private $driver;

    /**
     * @ORM\OneToMany(targetEntity=Mark::class, mappedBy="user_mark", orphanRemoval=true)
     */
    private $user_marks;

    /**
     * @ORM\OneToMany(targetEntity=Mark::class, mappedBy="receive_mark", orphanRemoval=true)
     */
    private $receive_marks;

    private $average = null;

    /**
     * @ORM\OneToOne(targetEntity=Images::class, mappedBy="user_picture", cascade={"persist", "remove"})
     */
    private $profile_picture;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->slug = uniqid();
        $this->voyage_user = new ArrayCollection();
        $this->sent = new ArrayCollection();
        $this->receive = new ArrayCollection();
        $this->driver = null;
        $this->user_marks = new ArrayCollection();
        $this->receive_marks = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

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

    public function getNumTel(): ?string
    {
        return $this->num_tel;
    }

    public function setNumTel(string $num_tel): self
    {
        $this->num_tel = $num_tel;

        return $this;
    }

    public function __toString(){
        return $this->email;
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


    /**
     * @return Collection<int, Voyage>
     */
    public function getVoyageUser(): Collection
    {
        return $this->voyage_user;
    }

    public function addVoyageUser(Voyage $voyage_users): self
    {
        if (!$this->voyage_user->contains($voyage_users)) {
            $this->voyage_user[] = $voyage_users;
            $voyage_users->setUser($this);
        }

        return $this;
    }

    public function removeVoyageUser(Voyage $voyage_users): self
    {
        if ($this->voyage_user->removeElement($voyage_users)) {
            // set the owning side to null (unless already changed)
            if ($voyage_users->getUser() === $this) {
                $voyage_users->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getSent(): Collection
    {
        return $this->sent;
    }

    public function addSent(Message $sent): self
    {
        if (!$this->sent->contains($sent)) {
            $this->sent[] = $sent;
            $sent->setSender($this);
        }

        return $this;
    }

    public function removeSent(Message $sent): self
    {
        if ($this->sent->removeElement($sent)) {
            // set the owning side to null (unless already changed)
            if ($sent->getSender() === $this) {
                $sent->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getReceive(): Collection
    {
        return $this->receive;
    }

    public function addReceive(Message $receive): self
    {
        if (!$this->receive->contains($receive)) {
            $this->receive[] = $receive;
            $receive->setRecipient($this);
        }

        return $this;
    }

    public function removeReceive(Message $receive): self
    {
        if ($this->receive->removeElement($receive)) {
            // set the owning side to null (unless already changed)
            if ($receive->getRecipient() === $this) {
                $receive->setRecipient(null);
            }
        }

        return $this;
    }

    public function getDriver(): ?Conducteur
    {
        return $this->driver;
    }

    public function setDriver(?Conducteur $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * @return Collection<int, Mark>
     */
    public function getUserMarks(): Collection
    {
        return $this->user_marks;
    }

    public function addUserMark(Mark $userMark): self
    {
        if (!$this->user_marks->contains($userMark)) {
            $this->user_marks[] = $userMark;
            $userMark->setUserMark($this);
        }

        return $this;
    }

    public function removeUserMark(Mark $userMark): self
    {
        if ($this->user_marks->removeElement($userMark)) {
            // set the owning side to null (unless already changed)
            if ($userMark->getUserMark() === $this) {
                $userMark->setUserMark(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Mark>
     */
    public function getReceiveMarks(): Collection
    {
        return $this->receive_marks;
    }

    public function addReceiveMark(Mark $receiveMark): self
    {
        if (!$this->receive_marks->contains($receiveMark)) {
            $this->receive_marks[] = $receiveMark;
            $receiveMark->setReceiveMark($this);
        }

        return $this;
    }

    public function removeReceiveMark(Mark $receiveMark): self
    {
        if ($this->receive_marks->removeElement($receiveMark)) {
            // set the owning side to null (unless already changed)
            if ($receiveMark->getReceiveMark() === $this) {
                $receiveMark->setReceiveMark(null);
            }
        }

        return $this;
    }

    public function getAverage()
    {
        $mark = $this->receive_marks;

        if($mark->toArray() === []){
            $this->average = null;
            return $this->average;
        }

        $total = 0;
        foreach($mark as $marks){
            $total += $marks->getMark();
        }

        $this->average = $total / count($mark);

        return $this->average;
    }

    public function getProfilePicture(): ?Images
    {
        return $this->profile_picture;
    }

    public function setProfilePicture(Images $profile_picture): self
    {
        // set the owning side of the relation if necessary
        if ($profile_picture->getUserPicture() !== $this) {
            $profile_picture->setUserPicture($this);
        }

        $this->profile_picture = $profile_picture;

        return $this;
    }

}
