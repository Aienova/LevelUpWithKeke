<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $surname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $token = null;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: Booking::class)]
    private Collection $bookings;

    #[ORM\Column(nullable: true)]
    private ?int $aiecoins = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $login = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mainLocation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $recoverCode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $activationCode = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $creationDate = null;

    #[ORM\Column(nullable: true)]
    private ?int $state = null;

    #[ORM\Column(nullable: true)]
    private ?bool $connected = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $connectionDate = null;

    #[ORM\Column(nullable: true)]
    private ?bool $signedUp = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tempCode = null;

    #[ORM\Column(nullable: true)]
    private ?int $opinionRate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $opinionComment = null;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: Notarize::class)]
    private Collection $notarizes;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: Visa::class)]
    private Collection $visas;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: FormData::class)]
    private Collection $formData;

    #[ORM\OneToOne(mappedBy: 'customer', cascade: ['persist', 'remove'])]
    private ?Person $person = null;

    #[ORM\OneToOne(mappedBy: 'customer', cascade: ['persist', 'remove'])]
    private ?Newsletter $newsletter = null;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: NotarizeDocument::class)]
    private Collection $notarizeDocuments;


    public function __construct()
    {
        $this->bookings = new ArrayCollection();
        $this->notarizes = new ArrayCollection();
        $this->visas = new ArrayCollection();
        $this->formData = new ArrayCollection();
        $this->notarizeDocuments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): static
    {
        $this->password = $password;

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

    /**
     * @return Collection<int, Booking>
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): static
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings->add($booking);
            $booking->setCustomer($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): static
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getCustomer() === $this) {
                $booking->setCustomer(null);
            }
        }

        return $this;
    }

    public function getAiecoins(): ?int
    {
        return $this->aiecoins;
    }

    public function setAiecoins(?int $aiecoins): static
    {
        $this->aiecoins = $aiecoins;

        return $this;
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

    public function getMainLocation(): ?string
    {
        return $this->mainLocation;
    }

    public function setMainLocation(?string $mainLocation): static
    {
        $this->mainLocation = $mainLocation;

        return $this;
    }

    public function getRecoverCode(): ?string
    {
        return $this->recoverCode;
    }

    public function setRecoverCode(?string $recoverCode): static
    {
        $this->recoverCode = $recoverCode;

        return $this;
    }

    public function getActivationCode(): ?string
    {
        return $this->activationCode;
    }

    public function setActivationCode(?string $activationCode): static
    {
        $this->activationCode = $activationCode;

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

    public function getState(): ?int
    {
        return $this->state;
    }

    public function setState(?int $state): static
    {
        $this->state = $state;

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

    public function isSignedUp(): ?bool
    {
        return $this->signedUp;
    }

    public function setSignedUp(?bool $signedUp): static
    {
        $this->signedUp = $signedUp;

        return $this;
    }

    public function getTempCode(): ?string
    {
        return $this->tempCode;
    }

    public function setTempCode(?string $tempCode): static
    {
        $this->tempCode = $tempCode;

        return $this;
    }

    public function getOpinionRate(): ?int
    {
        return $this->opinionRate;
    }

    public function setOpinionRate(?int $opinionRate): static
    {
        $this->opinionRate = $opinionRate;

        return $this;
    }

    public function getOpinionComment(): ?string
    {
        return $this->opinionComment;
    }

    public function setOpinionComment(?string $opinionComment): static
    {
        $this->opinionComment = $opinionComment;

        return $this;
    }

    /**
     * @return Collection<int, Notarize>
     */
    public function getNotarizes(): Collection
    {
        return $this->notarizes;
    }

    public function addNotarize(Notarize $notarize): static
    {
        if (!$this->notarizes->contains($notarize)) {
            $this->notarizes->add($notarize);
            $notarize->setCustomer($this);
        }

        return $this;
    }

    public function removeNotarize(Notarize $notarize): static
    {
        if ($this->notarizes->removeElement($notarize)) {
            // set the owning side to null (unless already changed)
            if ($notarize->getCustomer() === $this) {
                $notarize->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Visa>
     */
    public function getVisas(): Collection
    {
        return $this->visas;
    }

    public function addVisa(Visa $visa): static
    {
        if (!$this->visas->contains($visa)) {
            $this->visas->add($visa);
            $visa->setCustomer($this);
        }

        return $this;
    }

    public function removeVisa(Visa $visa): static
    {
        if ($this->visas->removeElement($visa)) {
            // set the owning side to null (unless already changed)
            if ($visa->getCustomer() === $this) {
                $visa->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FormData>
     */
    public function getFormData(): Collection
    {
        return $this->formData;
    }

    public function addFormData(FormData $formData): static
    {
        if (!$this->formData->contains($formData)) {
            $this->formData->add($formData);
            $formData->setCustomer($this);
        }

        return $this;
    }

    public function removeFormData(FormData $formData): static
    {
        if ($this->formData->removeElement($formData)) {
            // set the owning side to null (unless already changed)
            if ($formData->getCustomer() === $this) {
                $formData->setCustomer(null);
            }
        }

        return $this;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): static
    {
        // unset the owning side of the relation if necessary
        if ($person === null && $this->person !== null) {
            $this->person->setCustomer(null);
        }

        // set the owning side of the relation if necessary
        if ($person !== null && $person->getCustomer() !== $this) {
            $person->setCustomer($this);
        }

        $this->person = $person;

        return $this;
    }

    public function getNewsletter(): ?Newsletter
    {
        return $this->newsletter;
    }

    public function setNewsletter(?Newsletter $newsletter): static
    {
        // unset the owning side of the relation if necessary
        if ($newsletter === null && $this->newsletter !== null) {
            $this->newsletter->setCustomer(null);
        }

        // set the owning side of the relation if necessary
        if ($newsletter !== null && $newsletter->getCustomer() !== $this) {
            $newsletter->setCustomer($this);
        }

        $this->newsletter = $newsletter;

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
            $notarizeDocument->setCustomer($this);
        }

        return $this;
    }

    public function removeNotarizeDocument(NotarizeDocument $notarizeDocument): static
    {
        if ($this->notarizeDocuments->removeElement($notarizeDocument)) {
            // set the owning side to null (unless already changed)
            if ($notarizeDocument->getCustomer() === $this) {
                $notarizeDocument->setCustomer(null);
            }
        }

        return $this;
    }


}
