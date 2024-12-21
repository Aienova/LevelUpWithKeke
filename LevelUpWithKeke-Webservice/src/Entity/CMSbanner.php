<?php

namespace App\Entity;

use App\Repository\CMSbannerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSbannerRepository::class)]
class CMSbanner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $buttonPosition = null;

    #[ORM\Column(nullable: true)]
    private ?int $position = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $textPosition = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
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

    public function getButtonPosition(): ?string
    {
        return $this->buttonPosition;
    }

    public function setButtonPosition(?string $buttonPosition): static
    {
        $this->buttonPosition = $buttonPosition;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getTextPosition(): ?string
    {
        return $this->textPosition;
    }

    public function setTextPosition(?string $textPosition): static
    {
        $this->textPosition = $textPosition;

        return $this;
    }
}
