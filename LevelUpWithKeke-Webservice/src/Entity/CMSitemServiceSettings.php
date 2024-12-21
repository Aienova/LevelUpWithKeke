<?php

namespace App\Entity;

use App\Repository\CMSitemServiceSettingsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSitemServiceSettingsRepository::class)]
class CMSitemServiceSettings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $icon = null;

    #[ORM\Column(length: 10000, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'services', targetEntity: CMSitemSettings::class)]
    private Collection $CMSitemSettings;

    #[ORM\ManyToOne(inversedBy: 'CMSitemServiceSettings')]
    private ?CMSitemSettings $section = null;

    public function __construct()
    {
        $this->CMSitemSettings = new ArrayCollection();
    }

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

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, CMSitemSettings>
     */
    public function getCMSitemSettings(): Collection
    {
        return $this->CMSitemSettings;
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
