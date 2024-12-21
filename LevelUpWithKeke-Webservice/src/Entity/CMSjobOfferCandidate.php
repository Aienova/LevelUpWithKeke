<?php

namespace App\Entity;

use App\Repository\CMSjobOfferCandidateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSjobOfferCandidateRepository::class)]
class CMSjobOfferCandidate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $surname = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $telephone = null;

    #[ORM\ManyToMany(targetEntity: CMSjobOffer::class, inversedBy: 'CMSjobOfferCandidates')]
    private Collection $jobOffer;

    #[ORM\OneToOne(inversedBy: 'CMSjobOfferCandidate', cascade: ['persist', 'remove'])]
    private ?CMSDocument $cv = null;

    #[ORM\Column(length: 100000, nullable: true)]
    private ?string $motivation = null;

    public function __construct()
    {
        $this->jobOffer = new ArrayCollection();
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

    /**
     * @return Collection<int, CMSjobOffer>
     */
    public function getJobOffer(): Collection
    {
        return $this->jobOffer;
    }

    public function addJobOffer(CMSjobOffer $jobOffer): static
    {
        if (!$this->jobOffer->contains($jobOffer)) {
            $this->jobOffer->add($jobOffer);
        }

        return $this;
    }

    public function removeJobOffer(CMSjobOffer $jobOffer): static
    {
        $this->jobOffer->removeElement($jobOffer);

        return $this;
    }

    public function getCv(): ?CMSDocument
    {
        return $this->cv;
    }

    public function setCv(?CMSDocument $cv): static
    {
        $this->cv = $cv;

        return $this;
    }

    public function getMotivation(): ?string
    {
        return $this->motivation;
    }

    public function setMotivation(?string $motivation): static
    {
        $this->motivation = $motivation;

        return $this;
    }
}
