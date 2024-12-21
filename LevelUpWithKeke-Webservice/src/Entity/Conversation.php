<?php

namespace App\Entity;

use App\Repository\ConversationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConversationRepository::class)]
class Conversation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $candidateId = null;

    #[ORM\Column(nullable: true)]
    private ?int $recruiterId = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(nullable: true)]
    private ?bool $closeByCandidate = null;

    #[ORM\Column(nullable: true)]
    private ?bool $closeByRecruiter = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCandidateId(): ?int
    {
        return $this->candidateId;
    }

    public function setCandidateId(?int $candidateId): static
    {
        $this->candidateId = $candidateId;

        return $this;
    }

    public function getRecruiterId(): ?int
    {
        return $this->recruiterId;
    }

    public function setRecruiterId(?int $recruiterId): static
    {
        $this->recruiterId = $recruiterId;

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

    public function isCloseByCandidate(): ?bool
    {
        return $this->closeByCandidate;
    }

    public function setCloseByCandidate(?bool $closeByCandidate): static
    {
        $this->closeByCandidate = $closeByCandidate;

        return $this;
    }

    public function isCloseByRecruiter(): ?bool
    {
        return $this->closeByRecruiter;
    }

    public function setCloseByRecruiter(?bool $closeByRecruiter): static
    {
        $this->closeByRecruiter = $closeByRecruiter;

        return $this;
    }
}
