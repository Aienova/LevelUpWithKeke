<?php

namespace App\Entity;

use App\Repository\FormItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormItemRepository::class)]
class FormItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $frName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $enName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $deName = null;

    #[ORM\OneToMany(mappedBy: 'formItem', targetEntity: FormItemSettings::class)]
    private Collection $formItemSettings;

    public function __construct()
    {
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

    public function getFrName(): ?string
    {
        return $this->frName;
    }

    public function setFrName(?string $frName): static
    {
        $this->frName = $frName;

        return $this;
    }

    public function getEnName(): ?string
    {
        return $this->enName;
    }

    public function setEnName(?string $enName): static
    {
        $this->enName = $enName;

        return $this;
    }

    public function getDeName(): ?string
    {
        return $this->deName;
    }

    public function setDeName(?string $deName): static
    {
        $this->deName = $deName;

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
            $formItemSetting->setFormItem($this);
        }

        return $this;
    }

    public function removeFormItemSetting(FormItemSettings $formItemSetting): static
    {
        if ($this->formItemSettings->removeElement($formItemSetting)) {
            // set the owning side to null (unless already changed)
            if ($formItemSetting->getFormItem() === $this) {
                $formItemSetting->setFormItem(null);
            }
        }

        return $this;
    }
}
