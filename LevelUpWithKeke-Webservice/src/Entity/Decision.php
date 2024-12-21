<?php

namespace App\Entity;

use App\Repository\DecisionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DecisionRepository::class)]
class Decision
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $frName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $enName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $deName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $classColor = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $symbol = null;

    #[ORM\OneToMany(mappedBy: 'decision', targetEntity: Notarize::class)]
    private Collection $notarizes;

    #[ORM\OneToMany(mappedBy: 'decision', targetEntity: Booking::class)]
    private Collection $bookings;

    public function __construct()
    {
        $this->notarizes = new ArrayCollection();
        $this->bookings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFrName(): ?string
    {
        return $this->frName;
    }

    public function setFrName(?string $frName): static
    {
        $this->frName = $frName;

        return $this;
    }

    public function getEnName(): ?string
    {
        return $this->enName;
    }

    public function setEnName(string $enName): static
    {
        $this->enName = $enName;

        return $this;
    }

    public function getDeName(): ?string
    {
        return $this->deName;
    }

    public function setDeName(?string $deName): static
    {
        $this->deName = $deName;

        return $this;
    }

    public function getClassColor(): ?string
    {
        return $this->classColor;
    }

    public function setClassColor(?string $classColor): static
    {
        $this->classColor = $classColor;

        return $this;
    }

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(?string $symbol): static
    {
        $this->symbol = $symbol;

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
            $notarize->setDecision($this);
        }

        return $this;
    }

    public function removeNotarize(Notarize $notarize): static
    {
        if ($this->notarizes->removeElement($notarize)) {
            // set the owning side to null (unless already changed)
            if ($notarize->getDecision() === $this) {
                $notarize->setDecision(null);
            }
        }

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
            $booking->setDecision($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): static
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getDecision() === $this) {
                $booking->setDecision(null);
            }
        }

        return $this;
    }
}
