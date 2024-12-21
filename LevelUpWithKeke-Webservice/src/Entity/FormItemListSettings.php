<?php

namespace App\Entity;

use App\Repository\FormItemListSettingsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormItemListSettingsRepository::class)]
class FormItemListSettings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\OneToMany(mappedBy: 'formItemListSettings', targetEntity: FormItemListOptionSettings::class)]
    private Collection $formItemListOptionSettings;

    #[ORM\OneToMany(mappedBy: 'formItemListSettings', targetEntity: FormItemSettings::class)]
    private Collection $formItemSettings;

    #[ORM\Column(nullable: true)]
    private ?int $optionsTotal = null;

    public function __construct()
    {
        $this->formItemListOptionSettings = new ArrayCollection();
        $this->formItemSettings = new ArrayCollection();
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, FormItemListOptionSettings>
     */
    public function getFormItemListOptionSettings(): Collection
    {
        return $this->formItemListOptionSettings;
    }

    public function addFormItemListOptionSetting(FormItemListOptionSettings $formItemListOptionSetting): static
    {
        if (!$this->formItemListOptionSettings->contains($formItemListOptionSetting)) {
            $this->formItemListOptionSettings->add($formItemListOptionSetting);
            $formItemListOptionSetting->setFormItemListSettings($this);
        }

        return $this;
    }

    public function removeFormItemListOptionSetting(FormItemListOptionSettings $formItemListOptionSetting): static
    {
        if ($this->formItemListOptionSettings->removeElement($formItemListOptionSetting)) {
            // set the owning side to null (unless already changed)
            if ($formItemListOptionSetting->getFormItemListSettings() === $this) {
                $formItemListOptionSetting->setFormItemListSettings(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FormItemSettings>
     */
    public function getFormItemSettings(): Collection
    {
        return $this->formItemSettings;
    }

    public function addFormItemSetting(FormItemSettings $formItemSetting): static
    {
        if (!$this->formItemSettings->contains($formItemSetting)) {
            $this->formItemSettings->add($formItemSetting);
            $formItemSetting->setFormItemListSettings($this);
        }

        return $this;
    }

    public function removeFormItemSetting(FormItemSettings $formItemSetting): static
    {
        if ($this->formItemSettings->removeElement($formItemSetting)) {
            // set the owning side to null (unless already changed)
            if ($formItemSetting->getFormItemListSettings() === $this) {
                $formItemSetting->setFormItemListSettings(null);
            }
        }

        return $this;
    }

    public function getOptionsTotal(): ?int
    {
        return $this->optionsTotal;
    }

    public function setOptionsTotal(?int $optionsTotal): static
    {
        $this->optionsTotal = $optionsTotal;

        return $this;
    }
}
