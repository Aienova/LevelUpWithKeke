<?php

namespace App\Entity;

use App\Repository\CMSitemCarouselSettingsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSitemCarouselSettingsRepository::class)]
class CMSitemCarouselSettings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $timing = null;

    #[ORM\Column(nullable: true)]
    private ?bool $infinte = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image4 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image5 = null;

    #[ORM\ManyToOne(inversedBy: 'CMSitemCarouselSettings')]
    private ?CMSitemSettings $section = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTiming(): ?int
    {
        return $this->timing;
    }

    public function setTiming(?int $timing): static
    {
        $this->timing = $timing;

        return $this;
    }

    public function isInfinte(): ?bool
    {
        return $this->infinte;
    }

    public function setInfinte(?bool $infinte): static
    {
        $this->infinte = $infinte;

        return $this;
    }

    public function getImage1(): ?string
    {
        return $this->image1;
    }

    public function setImage1(?string $image1): static
    {
        $this->image1 = $image1;

        return $this;
    }

    public function getImage2(): ?string
    {
        return $this->image2;
    }

    public function setImage2(?string $image2): static
    {
        $this->image2 = $image2;

        return $this;
    }

    public function getImage3(): ?string
    {
        return $this->image3;
    }

    public function setImage3(?string $image3): static
    {
        $this->image3 = $image3;

        return $this;
    }

    public function getImage4(): ?string
    {
        return $this->image4;
    }

    public function setImage4(?string $image4): static
    {
        $this->image4 = $image4;

        return $this;
    }

    public function getImage5(): ?string
    {
        return $this->image5;
    }

    public function setImage5(?string $image5): static
    {
        $this->image5 = $image5;

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
