<?php

namespace App\Entity;

use App\Repository\FormStepRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormStepRepository::class)]
class FormStep
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $position = null;

    #[ORM\ManyToOne(inversedBy: 'formSteps')]
    private ?Form $form = null;

    #[ORM\OneToMany(mappedBy: 'formStep', targetEntity: FormItemSettings::class)]
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

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): static
    {
        $this->position = $position;

        return $this;
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
            $formItemSetting->setFormStep($this);
        }

        return $this;
    }

    public function removeFormItemSetting(FormItemSettings $formItemSetting): static
    {
        if ($this->formItemSettings->removeElement($formItemSetting)) {
            // set the owning side to null (unless already changed)
            if ($formItemSetting->getFormStep() === $this) {
                $formItemSetting->setFormStep(null);
            }
        }

        return $this;
    }
}
