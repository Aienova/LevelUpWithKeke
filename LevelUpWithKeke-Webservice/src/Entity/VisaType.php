<?php

namespace App\Entity;

use App\Repository\VisaTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VisaTypeRepository::class)]
class VisaType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $enName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $frName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $deName = null;

    #[ORM\OneToMany(mappedBy: 'visaType', targetEntity: Visa::class)]
    private Collection $visas;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    #[ORM\Column(nullable: true)]
    private ?int $day = null;

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

    public function setFrName(?string $frName): static
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
            $visa->setVisaType($this);
        }

        return $this;
    }

    public function removeVisa(Visa $visa): static
    {
        if ($this->visas->removeElement($visa)) {
            // set the owning side to null (unless already changed)
            if ($visa->getVisaType() === $this) {
                $visa->setVisaType(null);
            }
        }

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDay(): ?int
    {
        return $this->day;
    }

    public function setDay(?int $day): static
    {
        $this->day = $day;

        return $this;
    }
}
