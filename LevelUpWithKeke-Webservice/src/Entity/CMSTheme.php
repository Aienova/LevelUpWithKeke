<?php

namespace App\Entity;

use App\Repository\CMSThemeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSThemeRepository::class)]
class CMSTheme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'CMSTheme', cascade: ['persist', 'remove'])]
    private ?CMSUser $CMSUser = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $font = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $color = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCMSUser(): ?CMSUser
    {
        return $this->CMSUser;
    }

    public function setCMSUser(?CMSUser $CMSUser): static
    {
        $this->CMSUser = $CMSUser;

        return $this;
    }

    public function getFont(): ?string
    {
        return $this->font;
    }

    public function setFont(?string $font): static
    {
        $this->font = $font;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): static
    {
        $this->color = $color;

        return $this;
    }
}
