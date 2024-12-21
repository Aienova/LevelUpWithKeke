<?php

namespace App\Entity;

use App\Repository\MessagingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessagingRepository::class)]
class Messaging
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $conversationId = null;

    #[ORM\Column(nullable: true)]
    private ?int $senderType = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $sendingDate = null;

    #[ORM\Column(nullable: true)]
    private ?bool $readByCandidate = null;

    #[ORM\Column(nullable: true)]
    private ?bool $readByRecruiter = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $MessageText = null;

    #[ORM\Column(nullable: true)]
    private ?int $senderId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConversationId(): ?int
    {
        return $this->conversationId;
    }

    public function setConversationId(?int $conversationId): static
    {
        $this->conversationId = $conversationId;

        return $this;
    }

    public function getSenderType(): ?int
    {
        return $this->senderType;
    }

    public function setSenderType(?int $senderType): static
    {
        $this->senderType = $senderType;

        return $this;
    }

    public function getSendingDate(): ?\DateTimeInterface
    {
        return $this->sendingDate;
    }

    public function setSendingDate(?\DateTimeInterface $sendingDate): static
    {
        $this->sendingDate = $sendingDate;

        return $this;
    }

    public function isReadByCandidate(): ?bool
    {
        return $this->readByCandidate;
    }

    public function setReadByCandidate(?bool $readByCandidate): static
    {
        $this->readByCandidate = $readByCandidate;

        return $this;
    }

    public function isReadByRecruiter(): ?bool
    {
        return $this->readByRecruiter;
    }

    public function setReadByRecruiter(?bool $readByRecruiter): static
    {
        $this->readByRecruiter = $readByRecruiter;

        return $this;
    }

    public function getMessageText(): ?string
    {
        return $this->MessageText;
    }

    public function setMessageText(?string $MessageText): static
    {
        $this->MessageText = $MessageText;

        return $this;
    }

    public function getSenderId(): ?int
    {
        return $this->senderId;
    }

    public function setSenderId(?int $senderId): static
    {
        $this->senderId = $senderId;

        return $this;
    }
}
