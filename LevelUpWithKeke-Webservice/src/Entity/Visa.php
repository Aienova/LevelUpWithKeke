<?php

namespace App\Entity;

use App\Repository\VisaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VisaRepository::class)]
class Visa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'visas')]
    private ?Person $person = null;

    #[ORM\ManyToOne(inversedBy: 'visas')]
    private ?VisaType $visaType = null;

    #[ORM\ManyToOne(inversedBy: 'visas')]
    private ?TravelReason $travelReason = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $congoAddress = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $congoArrivalDate = null;

    #[ORM\ManyToOne(inversedBy: 'visas')]
    private ?Passport $passport = null;

    #[ORM\OneToMany(mappedBy: 'visa', targetEntity: Notarize::class)]
    private Collection $notarizes;

    #[ORM\ManyToOne(inversedBy: 'visas')]
    private ?Customer $customer = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $startPlace = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $previousVisaNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $previousVisaDeliver = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $previousVisaDate = null;

    #[ORM\Column(nullable: true)]
    private ?bool $firstTime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $lastTravelDate = null;

    #[ORM\Column(nullable: true)]
    private ?bool $allreadyLived = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $last3YearsTravelDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastTravel3YearsLocation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $congoDepartureLocation = null;

    #[ORM\Column(nullable: true)]
    private ?bool $noWorkContract = null;

    #[ORM\Column(nullable: true)]
    private ?bool $noImmigration = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $timeTravel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastTravelLocation = null;

    public function __construct()
    {
        $this->notarizes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getVisaType(): ?VisaType
    {
        return $this->visaType;
    }

    public function setVisaType(?VisaType $visaType): static
    {
        $this->visaType = $visaType;

        return $this;
    }

    public function getTravelReason(): ?TravelReason
    {
        return $this->travelReason;
    }

    public function setTravelReason(?TravelReason $travelReason): static
    {
        $this->travelReason = $travelReason;

        return $this;
    }

    public function getCongoAddress(): ?string
    {
        return $this->congoAddress;
    }

    public function setCongoAddress(?string $congoAddress): static
    {
        $this->congoAddress = $congoAddress;

        return $this;
    }

    public function getCongoArrivalDate(): ?\DateTimeInterface
    {
        return $this->congoArrivalDate;
    }

    public function setCongoArrivalDate(?\DateTimeInterface $congoArrivalDate): static
    {
        $this->congoArrivalDate = $congoArrivalDate;

        return $this;
    }

    public function getPassport(): ?Passport
    {
        return $this->passport;
    }

    public function setPassport(?Passport $passport): static
    {
        $this->passport = $passport;

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
            $notarize->setVisa($this);
        }

        return $this;
    }

    public function removeNotarize(Notarize $notarize): static
    {
        if ($this->notarizes->removeElement($notarize)) {
            // set the owning side to null (unless already changed)
            if ($notarize->getVisa() === $this) {
                $notarize->setVisa(null);
            }
        }

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    public function getStartPlace(): ?string
    {
        return $this->startPlace;
    }

    public function setStartPlace(?string $startPlace): static
    {
        $this->startPlace = $startPlace;

        return $this;
    }

    public function getPreviousVisaNumber(): ?string
    {
        return $this->previousVisaNumber;
    }

    public function setPreviousVisaNumber(?string $previousVisaNumber): static
    {
        $this->previousVisaNumber = $previousVisaNumber;

        return $this;
    }

    public function getPreviousVisaDeliver(): ?string
    {
        return $this->previousVisaDeliver;
    }

    public function setPreviousVisaDeliver(?string $previousVisaDeliver): static
    {
        $this->previousVisaDeliver = $previousVisaDeliver;

        return $this;
    }

    public function getPreviousVisaDate(): ?\DateTimeInterface
    {
        return $this->previousVisaDate;
    }

    public function setPreviousVisaDate(?\DateTimeInterface $previousVisaDate): static
    {
        $this->previousVisaDate = $previousVisaDate;

        return $this;
    }

    public function isFirstTime(): ?bool
    {
        return $this->firstTime;
    }

    public function setFirstTime(?bool $firstTime): static
    {
        $this->firstTime = $firstTime;

        return $this;
    }

    public function getLastTravelDate(): ?\DateTimeInterface
    {
        return $this->lastTravelDate;
    }

    public function setLastTravelDate(?\DateTimeInterface $lastTravelDate): static
    {
        $this->lastTravelDate = $lastTravelDate;

        return $this;
    }

    public function isAllreadyLived(): ?bool
    {
        return $this->allreadyLived;
    }

    public function setAllreadyLived(?bool $allreadyLived): static
    {
        $this->allreadyLived = $allreadyLived;

        return $this;
    }

    public function getLast3YearsTravelDate(): ?\DateTimeInterface
    {
        return $this->last3YearsTravelDate;
    }

    public function setLast3YearsTravelDate(?\DateTimeInterface $last3YearsTravelDate): static
    {
        $this->last3YearsTravelDate = $last3YearsTravelDate;

        return $this;
    }

    public function getLastTravel3YearsLocation(): ?string
    {
        return $this->lastTravel3YearsLocation;
    }

    public function setLastTravel3YearsLocation(?string $lastTravel3YearsLocation): static
    {
        $this->lastTravel3YearsLocation = $lastTravel3YearsLocation;

        return $this;
    }

    public function getCongoDepartureLocation(): ?string
    {
        return $this->congoDepartureLocation;
    }

    public function setCongoDepartureLocation(?string $congoDepartureLocation): static
    {
        $this->congoDepartureLocation = $congoDepartureLocation;

        return $this;
    }

    public function isNoWorkContract(): ?bool
    {
        return $this->noWorkContract;
    }

    public function setNoWorkContract(?bool $noWorkContract): static
    {
        $this->noWorkContract = $noWorkContract;

        return $this;
    }

    public function isNoImmigration(): ?bool
    {
        return $this->noImmigration;
    }

    public function setNoImmigration(?bool $noImmigration): static
    {
        $this->noImmigration = $noImmigration;

        return $this;
    }

    public function getTimeTravel(): ?string
    {
        return $this->timeTravel;
    }

    public function setTimeTravel(?string $timeTravel): static
    {
        $this->timeTravel = $timeTravel;

        return $this;
    }

    public function getLastTravelLocation(): ?string
    {
        return $this->lastTravelLocation;
    }

    public function setLastTravelLocation(?string $lastTravelLocation): static
    {
        $this->lastTravelLocation = $lastTravelLocation;

        return $this;
    }

}
