<?php

namespace App\Entity;

use App\Repository\NotarizeTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NotarizeTypeRepository::class)]
class NotarizeType
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

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: Notarize::class)]
    private Collection $notarizes;

    #[ORM\Column(length: 50000, nullable: true)]
    private ?string $details = null;



    #[ORM\OneToMany(mappedBy: 'notarizeType', targetEntity: Form::class)]
    private Collection $forms;

    #[ORM\OneToMany(mappedBy: 'notarizeType', targetEntity: NotarizeDocument::class)]
    private Collection $notarizeDocuments;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    #[ORM\Column(nullable: true)]
    private ?bool $consularDocument = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $symbol = null;

    public function __construct()
    {
        $this->notarizes = new ArrayCollection();
        $this->forms = new ArrayCollection();
        $this->notarizeDocuments = new ArrayCollection();
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
            $notarize->setType($this);
        }

        return $this;
    }

    public function removeNotarize(Notarize $notarize): static
    {
        if ($this->notarizes->removeElement($notarize)) {
            // set the owning side to null (unless already changed)
            if ($notarize->getType() === $this) {
                $notarize->setType(null);
            }
        }

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): static
    {
        $this->details = $details;

        return $this;
    }


    /**
     * @return Collection<int, Form>
     */
    public function getForms(): Collection
    {
        return $this->forms;
    }

    public function addForm(Form $form): static
    {
        if (!$this->forms->contains($form)) {
            $this->forms->add($form);
            $form->setNotarizeType($this);
        }

        return $this;
    }

    public function removeForm(Form $form): static
    {
        if ($this->forms->removeElement($form)) {
            // set the owning side to null (unless already changed)
            if ($form->getNotarizeType() === $this) {
                $form->setNotarizeType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, NotarizeDocument>
     */
    public function getNotarizeDocuments(): Collection
    {
        return $this->notarizeDocuments;
    }

    public function addNotarizeDocument(NotarizeDocument $notarizeDocument): static
    {
        if (!$this->notarizeDocuments->contains($notarizeDocument)) {
            $this->notarizeDocuments->add($notarizeDocument);
            $notarizeDocument->setNotarizeType($this);
        }

        return $this;
    }

    public function removeNotarizeDocument(NotarizeDocument $notarizeDocument): static
    {
        if ($this->notarizeDocuments->removeElement($notarizeDocument)) {
            // set the owning side to null (unless already changed)
            if ($notarizeDocument->getNotarizeType() === $this) {
                $notarizeDocument->setNotarizeType(null);
            }
        }

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function isConsularDocument(): ?bool
    {
        return $this->consularDocument;
    }

    public function setConsularDocument(?bool $consularDocument): static
    {
        $this->consularDocument = $consularDocument;

        return $this;
    }

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(?string $symbol): static
    {
        $this->symbol = $symbol;

        return $this;
    }
}
