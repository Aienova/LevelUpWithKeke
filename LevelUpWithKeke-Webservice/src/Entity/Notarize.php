<?php

namespace App\Entity;

use App\Repository\NotarizeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NotarizeRepository::class)]
class Notarize
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numberId = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateDecision = null;

    #[ORM\Column(nullable: true)]
    private ?int $state = null;

    #[ORM\Column(length: 1000000, nullable: true)]
    private ?string $comment = null;

    #[ORM\ManyToOne(inversedBy: 'notarizes')]
    private ?NotarizeType $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $document = null;

    #[ORM\ManyToOne(inversedBy: 'notarizes')]
    private ?Visa $visa = null;

    #[ORM\ManyToOne(inversedBy: 'notarizes')]
    private ?Passport $passport = null;

    #[ORM\ManyToOne(inversedBy: 'notarizes')]
    private ?Customer $customer = null;

    #[ORM\Column(nullable: true)]
    private ?bool $paid = null;

    #[ORM\Column(nullable: true)]
    private ?bool $cancelled = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $paymentCode = null;

    #[ORM\Column(nullable: true)]
    private ?float $cost = null;

    #[ORM\OneToMany(mappedBy: 'notarize', targetEntity: FormData::class)]
    private Collection $formData;

    #[ORM\OneToMany(mappedBy: 'notarize', targetEntity: CMSDocument::class)]
    private Collection $CMSDocuments;

    #[ORM\ManyToOne(inversedBy: 'notarizes')]
    private ?Decision $decision = null;

    #[ORM\Column(length: 1000000, nullable: true)]
    private ?string $companyComment = null;

    #[ORM\ManyToOne(inversedBy: 'notarizes')]
    private ?Person $person = null;

    #[ORM\ManyToOne(inversedBy: 'notarizes')]
    private ?Form $form = null;

    public function __construct()
    {
        $this->formData = new ArrayCollection();
        $this->CMSDocuments = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberId(): ?string
    {
        return $this->numberId;
    }

    public function setNumberId(?string $numberId): static
    {
        $this->numberId = $numberId;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(?\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateDecision(): ?\DateTimeInterface
    {
        return $this->dateDecision;
    }

    public function setDateDecision(?\DateTimeInterface $dateDecision): static
    {
        $this->dateDecision = $dateDecision;

        return $this;
    }

    public function getState(): ?int
    {
        return $this->state;
    }

    public function setState(?int $state): static
    {
        $this->state = $state;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function getType(): ?NotarizeType
    {
        return $this->type;
    }

    public function setType(?NotarizeType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function setDocument(?string $document): static
    {
        $this->document = $document;

        return $this;
    }

    public function getVisa(): ?Visa
    {
        return $this->visa;
    }

    public function setVisa(?Visa $visa): static
    {
        $this->visa = $visa;

        return $this;
    }

    public function getPassport(): ?Passport
    {
        return $this->passport;
    }

    public function setPassport(?Passport $passport): static
    {
        $this->passport = $passport;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    public function isPaid(): ?bool
    {
        return $this->paid;
    }

    public function setPaid(?bool $paid): static
    {
        $this->paid = $paid;

        return $this;
    }

    public function isCancelled(): ?bool
    {
        return $this->cancelled;
    }

    public function setCancelled(?bool $cancelled): static
    {
        $this->cancelled = $cancelled;

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

    public function getPaymentCode(): ?string
    {
        return $this->paymentCode;
    }

    public function setPaymentCode(?string $paymentCode): static
    {
        $this->paymentCode = $paymentCode;

        return $this;
    }

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCost(?float $cost): static
    {
        $this->cost = $cost;

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
            $formData->setNotarize($this);
        }

        return $this;
    }

    public function removeFormData(FormData $formData): static
    {
        if ($this->formData->removeElement($formData)) {
            // set the owning side to null (unless already changed)
            if ($formData->getNotarize() === $this) {
                $formData->setNotarize(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CMSDocument>
     */
    public function getCMSDocuments(): Collection
    {
        return $this->CMSDocuments;
    }

    public function addCMSDocument(CMSDocument $cMSDocument): static
    {
        if (!$this->CMSDocuments->contains($cMSDocument)) {
            $this->CMSDocuments->add($cMSDocument);
            $cMSDocument->setNotarize($this);
        }

        return $this;
    }

    public function removeCMSDocument(CMSDocument $cMSDocument): static
    {
        if ($this->CMSDocuments->removeElement($cMSDocument)) {
            // set the owning side to null (unless already changed)
            if ($cMSDocument->getNotarize() === $this) {
                $cMSDocument->setNotarize(null);
            }
        }

        return $this;
    }

    public function getDecision(): ?Decision
    {
        return $this->decision;
    }

    public function setDecision(?Decision $decision): static
    {
        $this->decision = $decision;

        return $this;
    }

    public function getCompanyComment(): ?string
    {
        return $this->companyComment;
    }

    public function setCompanyComment(?string $companyComment): static
    {
        $this->companyComment = $companyComment;

        return $this;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): static
    {
        $this->person = $person;

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

}
