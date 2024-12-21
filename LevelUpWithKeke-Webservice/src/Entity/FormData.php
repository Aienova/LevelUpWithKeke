<?php

namespace App\Entity;

use App\Repository\FormDataRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormDataRepository::class)]
class FormData
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'formData')]
    private ?Form $form = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 10000, nullable: true)]
    private ?string $value = null;

    #[ORM\ManyToOne(inversedBy: 'formData')]
    private ?Customer $customer = null;

    #[ORM\ManyToOne(inversedBy: 'formData')]
    private ?Notarize $notarize = null;

    #[ORM\Column(nullable: true)]
    private ?int $columnNumber = null;

    #[ORM\Column(nullable: true)]
    private ?int $rowNumber = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getForm(): ?Form
    {
        return $this->form;
    }

    public function setForm(?Form $form): static
    {
        $this->form = $form;

        return $this;
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

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): static
    {
        $this->value = $value;

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

    public function getNotarize(): ?Notarize
    {
        return $this->notarize;
    }

    public function setNotarize(?Notarize $notarize): static
    {
        $this->notarize = $notarize;

        return $this;
    }

    public function getColumnNumber(): ?int
    {
        return $this->columnNumber;
    }

    public function setColumnNumber(?int $columnNumber): static
    {
        $this->columnNumber = $columnNumber;

        return $this;
    }

    public function getRowNumber(): ?int
    {
        return $this->rowNumber;
    }

    public function setRowNumber(?int $rowNumber): static
    {
        $this->rowNumber = $rowNumber;

        return $this;
    }
}
