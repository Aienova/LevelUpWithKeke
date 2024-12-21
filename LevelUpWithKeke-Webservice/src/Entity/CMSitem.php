<?php

namespace App\Entity;

use App\Repository\CMSitemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSitemRepository::class)]
class CMSitem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?bool $premium = null;

    #[ORM\Column(length: 10000, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'item', targetEntity: CMSitemSettings::class)]
    private Collection $CMSitemSettings;

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

    public function isPremium(): ?bool
    {
        return $this->premium;
    }

    public function setPremium(?bool $premium): static
    {
        $this->premium = $premium;

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

    public function addCMSitemSetting(CMSitemSettings $cMSitemSetting): static
    {
        if (!$this->CMSitemSettings->contains($cMSitemSetting)) {
            $this->CMSitemSettings->add($cMSitemSetting);
            $cMSitemSetting->setItem($this);
        }

        return $this;
    }

    public function removeCMSitemSetting(CMSitemSettings $cMSitemSetting): static
    {
        if ($this->CMSitemSettings->removeElement($cMSitemSetting)) {
            // set the owning side to null (unless already changed)
            if ($cMSitemSetting->getItem() === $this) {
                $cMSitemSetting->setItem(null);
            }
        }

        return $this;
    }
}
