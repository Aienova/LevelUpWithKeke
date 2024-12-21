<?php

namespace App\Entity;

use App\Repository\CMSDocumentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSDocumentRepository::class)]
class CMSDocument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateUploaded = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $link = null;

    #[ORM\ManyToOne(inversedBy: 'CMSDocuments')]
    private ?Notarize $notarize = null;

    #[ORM\OneToOne(mappedBy: 'cv', cascade: ['persist', 'remove'])]
    private ?CMSjobOfferCandidate $CMSjobOfferCandidate = null;

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

    public function getDateUploaded(): ?\DateTimeInterface
    {
        return $this->dateUploaded;
    }

    public function setDateUploaded(?\DateTimeInterface $dateUploaded): static
    {
        $this->dateUploaded = $dateUploaded;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): static
    {
        $this->link = $link;

        return $this;
    }

    public function getNotarize(): ?Notarize
    {
        return $this->notarize;
    }

    public function setNotarize(?Notarize $notarize): static
    {
        $this->notarize = $notarize;

        return $this;
    }

    public function getCMSjobOfferCandidate(): ?CMSjobOfferCandidate
    {
        return $this->CMSjobOfferCandidate;
    }

    public function setCMSjobOfferCandidate(?CMSjobOfferCandidate $CMSjobOfferCandidate): static
    {
        // unset the owning side of the relation if necessary
        if ($CMSjobOfferCandidate === null && $this->CMSjobOfferCandidate !== null) {
            $this->CMSjobOfferCandidate->setCv(null);
        }

        // set the owning side of the relation if necessary
        if ($CMSjobOfferCandidate !== null && $CMSjobOfferCandidate->getCv() !== $this) {
            $CMSjobOfferCandidate->setCv($this);
        }

        $this->CMSjobOfferCandidate = $CMSjobOfferCandidate;

        return $this;
    }
}
