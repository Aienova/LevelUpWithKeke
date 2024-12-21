<?php

namespace App\Entity;

use App\Repository\FormItemSettingsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormItemSettingsRepository::class)]
class FormItemSettings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'formItemSettings')]
    private ?FormItem $formItem = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $placeholder = null;

    #[ORM\Column(nullable: true)]
    private ?int $min = null;

    #[ORM\Column(nullable: true)]
    private ?int $max = null;

    #[ORM\ManyToOne(inversedBy: 'formItemSettings')]
    private ?FormItemListSettings $formItemListSettings = null;

    #[ORM\ManyToOne(inversedBy: 'formItemSettings')]
    private ?Form $form = null;

    #[ORM\ManyToOne(inversedBy: 'formItemSettings')]
    private ?FormStep $formStep = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormItem(): ?FormItem
    {
        return $this->formItem;
    }

    public function setFormItem(?FormItem $formItem): static
    {
        $this->formItem = $formItem;

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

    public function getPlaceholder(): ?string
    {
        return $this->placeholder;
    }

    public function setPlaceholder(?string $placeholder): static
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    public function getMin(): ?int
    {
        return $this->min;
    }

    public function setMin(?int $min): static
    {
        $this->min = $min;

        return $this;
    }

    public function getMax(): ?int
    {
        return $this->max;
    }

    public function setMax(?int $max): static
    {
        $this->max = $max;

        return $this;
    }

    public function getFormItemListSettings(): ?FormItemListSettings
    {
        return $this->formItemListSettings;
    }

    public function setFormItemListSettings(?FormItemListSettings $formItemListSettings): static
    {
        $this->formItemListSettings = $formItemListSettings;

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

    public function getFormStep(): ?FormStep
    {
        return $this->formStep;
    }

    public function setFormStep(?FormStep $formStep): static
    {
        $this->formStep = $formStep;

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
}
