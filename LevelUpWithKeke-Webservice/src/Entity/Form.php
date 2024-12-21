<?php

namespace App\Entity;

use App\Repository\FormRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormRepository::class)]
class Form
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?bool $visibility = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $author = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $creationDate = null;

    #[ORM\OneToMany(mappedBy: 'form', targetEntity: FormItemSettings::class)]
    private Collection $formItemSettings;

    #[ORM\OneToMany(mappedBy: 'form', targetEntity: FormStep::class)]
    private Collection $formSteps;

    #[ORM\Column(nullable: true)]
    private ?int $steps = null;

    #[ORM\OneToMany(mappedBy: 'form', targetEntity: FormData::class)]
    private Collection $formData;

    #[ORM\ManyToOne(inversedBy: 'forms')]
    private ?NotarizeType $notarizeType = null;

    #[ORM\OneToMany(mappedBy: 'form', targetEntity: Notarize::class)]
    private Collection $notarizes;

    public function __construct()
    {
        $this->formItemSettings = new ArrayCollection();
        $this->formSteps = new ArrayCollection();
        $this->formData = new ArrayCollection();
        $this->notarizes = new ArrayCollection();
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

    public function isVisibility(): ?bool
    {
        return $this->visibility;
    }

    public function setVisibility(?bool $visibility): static
    {
        $this->visibility = $visibility;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(?\DateTimeInterface $creationDate): static
    {
        $this->creationDate = $creationDate;

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
            $formItemSetting->setForm($this);
        }

        return $this;
    }

    public function removeFormItemSetting(FormItemSettings $formItemSetting): static
    {
        if ($this->formItemSettings->removeElement($formItemSetting)) {
            // set the owning side to null (unless already changed)
            if ($formItemSetting->getForm() === $this) {
                $formItemSetting->setForm(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FormStep>
     */
    public function getFormSteps(): Collection
    {
        return $this->formSteps;
    }

    public function addFormStep(FormStep $formStep): static
    {
        if (!$this->formSteps->contains($formStep)) {
            $this->formSteps->add($formStep);
            $formStep->setForm($this);
        }

        return $this;
    }

    public function removeFormStep(FormStep $formStep): static
    {
        if ($this->formSteps->removeElement($formStep)) {
            // set the owning side to null (unless already changed)
            if ($formStep->getForm() === $this) {
                $formStep->setForm(null);
            }
        }

        return $this;
    }

    public function getSteps(): ?int
    {
        return $this->steps;
    }

    public function setSteps(?int $steps): static
    {
        $this->steps = $steps;

        return $this;
    }

    /**
     * @return Collection<int, FormData>
     */
    public function getFormData(): Collection
    {
        return $this->formData;
    }

    public function addFormData(FormData $formData): static
    {
        if (!$this->formData->contains($formData)) {
            $this->formData->add($formData);
            $formData->setForm($this);
        }

        return $this;
    }

    public function removeFormData(FormData $formData): static
    {
        if ($this->formData->removeElement($formData)) {
            // set the owning side to null (unless already changed)
            if ($formData->getForm() === $this) {
                $formData->setForm(null);
            }
        }

        return $this;
    }

    public function getNotarizeType(): ?NotarizeType
    {
        return $this->notarizeType;
    }

    public function setNotarizeType(?NotarizeType $notarizeType): static
    {
        $this->notarizeType = $notarizeType;

        return $this;
    }

    /**
     * @return Collection<int, Notarize>
     */
    public function getNotarizes(): Collection
    {
        return $this->notarizes;
    }

    public function addNotarize(Notarize $notarize): static
    {
        if (!$this->notarizes->contains($notarize)) {
            $this->notarizes->add($notarize);
            $notarize->setForm($this);
        }

        return $this;
    }

    public function removeNotarize(Notarize $notarize): static
    {
        if ($this->notarizes->removeElement($notarize)) {
            // set the owning side to null (unless already changed)
            if ($notarize->getForm() === $this) {
                $notarize->setForm(null);
            }
        }

        return $this;
    }
}
