<?php

namespace App\Entity;

use App\Repository\CMSUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSUserRepository::class)]
class CMSUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $login = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $password = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $creationDate = null;

    #[ORM\ManyToOne(inversedBy: 'CMSUsers')]
    private ?CMSLevel $level = null;

    #[ORM\OneToOne(mappedBy: 'CMSUser', cascade: ['persist', 'remove'])]
    private ?CMSTheme $CMSTheme = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $surname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $token = null;

    #[ORM\Column(nullable: true)]
    private ?bool $connected = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $connectionDate = null;

    #[ORM\Column(nullable: true)]
    private ?int $state = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\OneToMany(mappedBy: 'assignTo', targetEntity: NotarizeDocument::class)]
    private Collection $notarizeDocuments;

    public function __construct()
    {
        $this->notarizeDocuments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(?string $login): static
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(?\DateTimeInterface $creationDate): static
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getLevel(): ?CMSLevel
    {
        return $this->level;
    }

    public function setLevel(?CMSLevel $level): static
    {
        $this->level = $level;

        return $this;
    }

    public function getCMSTheme(): ?CMSTheme
    {
        return $this->CMSTheme;
    }

    public function setCMSTheme(?CMSTheme $CMSTheme): static
    {
        // unset the owning side of the relation if necessary
        if ($CMSTheme === null && $this->CMSTheme !== null) {
            $this->CMSTheme->setCMSUser(null);
        }

        // set the owning side of the relation if necessary
        if ($CMSTheme !== null && $CMSTheme->getCMSUser() !== $this) {
            $CMSTheme->setCMSUser($this);
        }

        $this->CMSTheme = $CMSTheme;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): static
    {
        $this->token = $token;

        return $this;
    }

    public function isConnected(): ?bool
    {
        return $this->connected;
    }

    public function setConnected(?bool $connected): static
    {
        $this->connected = $connected;

        return $this;
    }

    public function getConnectionDate(): ?\DateTimeInterface
    {
        return $this->connectionDate;
    }

    public function setConnectionDate(?\DateTimeInterface $connectionDate): static
    {
        $this->connectionDate = $connectionDate;

        return $this;
    }

    public function getState(): ?int
    {
        return $this->state;
    }

    public function setState(?int $state): static
    {
        $this->state = $state;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, NotarizeDocument>
     */
    public function getNotarizeDocuments(): Collection
    {
        return $this->notarizeDocuments;
    }

    public function addNotarizeDocument(NotarizeDocument $notarizeDocument): static
    {
        if (!$this->notarizeDocuments->contains($notarizeDocument)) {
            $this->notarizeDocuments->add($notarizeDocument);
            $notarizeDocument->setAssignTo($this);
        }

        return $this;
    }

    public function removeNotarizeDocument(NotarizeDocument $notarizeDocument): static
    {
        if ($this->notarizeDocuments->removeElement($notarizeDocument)) {
            // set the owning side to null (unless already changed)
            if ($notarizeDocument->getAssignTo() === $this) {
                $notarizeDocument->setAssignTo(null);
            }
        }

        return $this;
    }

}
