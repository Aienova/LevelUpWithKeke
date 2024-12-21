<?php

namespace App\Entity;

use App\Repository\NotarizeDocumentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NotarizeDocumentRepository::class)]
class NotarizeDocument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $documentId = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $sender = null;

    #[ORM\ManyToOne(inversedBy: 'notarizeDocuments')]
    private ?Customer $customer = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $sendDate = null;

    #[ORM\ManyToOne(inversedBy: 'notarizeDocuments')]
    private ?CMSUser $assignTo = null;

    #[ORM\ManyToOne(inversedBy: 'notarizeDocuments')]
    private ?NotarizeType $notarizeType = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getDocumentId(): ?string
    {
        return $this->documentId;
    }

    public function setDocumentId(?string $documentId): static
    {
        $this->documentId = $documentId;

        return $this;
    }

    public function getSender(): ?string
    {
        return $this->sender;
    }

    public function setSender(?string $sender): static
    {
        $this->sender = $sender;

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

    public function getSendDate(): ?\DateTimeInterface
    {
        return $this->sendDate;
    }

    public function setSendDate(?\DateTimeInterface $sendDate): static
    {
        $this->sendDate = $sendDate;

        return $this;
    }

    public function getAssignTo(): ?CMSUser
    {
        return $this->assignTo;
    }

    public function setAssignTo(?CMSUser $assignTo): static
    {
        $this->assignTo = $assignTo;

        return $this;
    }

    public function getNotarizeType(): ?NotarizeType
    {
        return $this->notarizeType;
    }

    public function setNotarizeType(?NotarizeType $notarizeType): static
    {
        $this->notarizeType = $notarizeType;

        return $this;
    }
}
