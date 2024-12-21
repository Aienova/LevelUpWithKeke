<?php

namespace App\Entity;

use App\Repository\TravelReasonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TravelReasonRepository::class)]
class TravelReason
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $enName = null;

    #[ORM\Column(length: 255)]
    private ?string $frName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $deName = null;

    #[ORM\OneToMany(mappedBy: 'travelReason', targetEntity: Visa::class)]
    private Collection $visas;

    public function __construct()
    {
        $this->visas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEnName(): ?string
    {
        return $this->enName;
    }

    public function setEnName(?string $enName): static
    {
        $this->enName = $enName;

        return $this;
    }

    public function getFrName(): ?string
    {
        return $this->frName;
    }

    public function setFrName(string $frName): static
    {
        $this->frName = $frName;

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
            $visa->setTravelReason($this);
        }

        return $this;
    }

    public function removeVisa(Visa $visa): static
    {
        if ($this->visas->removeElement($visa)) {
            // set the owning side to null (unless already changed)
            if ($visa->getTravelReason() === $this) {
                $visa->setTravelReason(null);
            }
        }

        return $this;
    }
}
