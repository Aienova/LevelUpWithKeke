<?php

namespace App\Entity;

use App\Repository\CMSjobOfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSjobOfferRepository::class)]
class CMSjobOffer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $diploma = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(nullable: true)]
    private ?float $wage = null;

    #[ORM\Column(length: 10000000000, nullable: true)]
    private ?string $content = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $tag = null;

    #[ORM\ManyToMany(targetEntity: CMSjobOfferCandidate::class, mappedBy: 'jobOffer')]
    private Collection $CMSjobOfferCandidates;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $description = null;

    public function __construct()
    {
        $this->CMSjobOfferCandidates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDiploma(): ?string
    {
        return $this->diploma;
    }

    public function setDiploma(string $diploma): static
    {
        $this->diploma = $diploma;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getWage(): ?float
    {
        return $this->wage;
    }

    public function setWage(?float $wage): static
    {
        $this->wage = $wage;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(?string $tag): static
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return Collection<int, CMSjobOfferCandidate>
     */
    public function getCMSjobOfferCandidates(): Collection
    {
        return $this->CMSjobOfferCandidates;
    }

    public function addCMSjobOfferCandidate(CMSjobOfferCandidate $cMSjobOfferCandidate): static
    {
        if (!$this->CMSjobOfferCandidates->contains($cMSjobOfferCandidate)) {
            $this->CMSjobOfferCandidates->add($cMSjobOfferCandidate);
            $cMSjobOfferCandidate->addJobOffer($this);
        }

        return $this;
    }

    public function removeCMSjobOfferCandidate(CMSjobOfferCandidate $cMSjobOfferCandidate): static
    {
        if ($this->CMSjobOfferCandidates->removeElement($cMSjobOfferCandidate)) {
            $cMSjobOfferCandidate->removeJobOffer($this);
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }
}
