<?php

namespace App\Entity;

use App\Repository\PassportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PassportRepository::class)]
class Passport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numberId = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $deliveryDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $deliveryPlace = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $expirationDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $extensionDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $deliveryAutority = null;

    #[ORM\ManyToOne(inversedBy: 'passports')]
    private ?Person $person = null;

    #[ORM\OneToMany(mappedBy: 'passport', targetEntity: Visa::class)]
    private Collection $visas;

    #[ORM\OneToMany(mappedBy: 'passport', targetEntity: Notarize::class)]
    private Collection $notarizes;

    public function __construct()
    {
        $this->visas = new ArrayCollection();
        $this->notarizes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberId(): ?string
    {
        return $this->numberId;
    }

    public function setNumberId(?string $numberId): static
    {
        $this->numberId = $numberId;

        return $this;
    }

    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(?\DateTimeInterface $deliveryDate): static
    {
        $this->deliveryDate = $deliveryDate;

        return $this;
    }

    public function getDeliveryPlace(): ?string
    {
        return $this->deliveryPlace;
    }

    public function setDeliveryPlace(?string $deliveryPlace): static
    {
        $this->deliveryPlace = $deliveryPlace;

        return $this;
    }

    public function getExpirationDate(): ?\DateTimeInterface
    {
        return $this->expirationDate;
    }

    public function setExpirationDate(?\DateTimeInterface $expirationDate): static
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    public function getExtensionDate(): ?\DateTimeInterface
    {
        return $this->extensionDate;
    }

    public function setExtensionDate(?\DateTimeInterface $extensionDate): static
    {
        $this->extensionDate = $extensionDate;

        return $this;
    }

    public function getDeliveryAutority(): ?string
    {
        return $this->deliveryAutority;
    }

    public function setDeliveryAutority(?string $deliveryAutority): static
    {
        $this->deliveryAutority = $deliveryAutority;

        return $this;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): static
    {
        $this->person = $person;

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
            $visa->setPassport($this);
        }

        return $this;
    }

    public function removeVisa(Visa $visa): static
    {
        if ($this->visas->removeElement($visa)) {
            // set the owning side to null (unless already changed)
            if ($visa->getPassport() === $this) {
                $visa->setPassport(null);
            }
        }

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
            $notarize->setPassport($this);
        }

        return $this;
    }

    public function removeNotarize(Notarize $notarize): static
    {
        if ($this->notarizes->removeElement($notarize)) {
            // set the owning side to null (unless already changed)
            if ($notarize->getPassport() === $this) {
                $notarize->setPassport(null);
            }
        }

        return $this;
    }

}
