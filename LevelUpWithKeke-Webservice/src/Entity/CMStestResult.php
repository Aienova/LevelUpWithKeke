<?php

namespace App\Entity;

use App\Repository\CMStestResultRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMStestResultRepository::class)]
class CMStestResult
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'CMStestResults')]
    private ?CMStest $test = null;

    #[ORM\Column(length: 100000, nullable: true)]
    private ?string $customer = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateResult = null;

    #[ORM\Column(length: 100000000000, nullable: true)]
    private ?string $content = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $deadlineResponse = null;

    #[ORM\Column(length: 1000000, nullable: true)]
    private ?string $response = null;

    #[ORM\Column(length: 10000, nullable: true)]
    private ?string $customerEmail = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTest(): ?CMStest
    {
        return $this->test;
    }

    public function setTest(?CMStest $test): static
    {
        $this->test = $test;

        return $this;
    }

    public function getCustomer(): ?string
    {
        return $this->customer;
    }

    public function setCustomer(?string $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    public function getDateResult(): ?\DateTimeInterface
    {
        return $this->dateResult;
    }

    public function setDateResult(?\DateTimeInterface $dateResult): static
    {
        $this->dateResult = $dateResult;

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

    public function getDeadlineResponse(): ?\DateTimeInterface
    {
        return $this->deadlineResponse;
    }

    public function setDeadlineResponse(?\DateTimeInterface $deadlineResponse): static
    {
        $this->deadlineResponse = $deadlineResponse;

        return $this;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }

    public function setResponse(?string $response): static
    {
        $this->response = $response;

        return $this;
    }

    public function getCustomerEmail(): ?string
    {
        return $this->customerEmail;
    }

    public function setCustomerEmail(?string $customerEmail): static
    {
        $this->customerEmail = $customerEmail;

        return $this;
    }
}
