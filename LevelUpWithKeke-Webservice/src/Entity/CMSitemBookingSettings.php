<?php

namespace App\Entity;

use App\Repository\CMSitemBookingSettingsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSitemBookingSettingsRepository::class)]
class CMSitemBookingSettings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $location = null;

    #[ORM\Column(nullable: true)]
    private ?int $perimeter = null;

    #[ORM\Column(nullable: true)]
    private ?bool $workingWekkend = null;

    #[ORM\Column(nullable: true)]
    private ?bool $workingHolidays = null;

    #[ORM\ManyToOne(inversedBy: 'CMSitemBookingSettings')]
    private ?CMSitemSettings $section = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getPerimeter(): ?int
    {
        return $this->perimeter;
    }

    public function setPerimeter(?int $perimeter): static
    {
        $this->perimeter = $perimeter;

        return $this;
    }

    public function isWorkingWekkend(): ?bool
    {
        return $this->workingWekkend;
    }

    public function setWorkingWekkend(?bool $workingWekkend): static
    {
        $this->workingWekkend = $workingWekkend;

        return $this;
    }

    public function isWorkingHolidays(): ?bool
    {
        return $this->workingHolidays;
    }

    public function setWorkingHolidays(?bool $workingHolidays): static
    {
        $this->workingHolidays = $workingHolidays;

        return $this;
    }

    public function getSection(): ?CMSitemSettings
    {
        return $this->section;
    }

    public function setSection(?CMSitemSettings $section): static
    {
        $this->section = $section;

        return $this;
    }
}
