<?php

namespace App\Entity;

use App\Repository\CMSmailTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSmailTypeRepository::class)]
class CMSmailType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'mailType', targetEntity: CMSmail::class)]
    private Collection $CMSmails;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $urlDemo = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $backgroundImage = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    public function __construct()
    {
        $this->CMSmails = new ArrayCollection();
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

    /**
     * @return Collection<int, CMSmail>
     */
    public function getCMSmails(): Collection
    {
        return $this->CMSmails;
    }

    public function addCMSmail(CMSmail $cMSmail): static
    {
        if (!$this->CMSmails->contains($cMSmail)) {
            $this->CMSmails->add($cMSmail);
            $cMSmail->setMailType($this);
        }

        return $this;
    }

    public function removeCMSmail(CMSmail $cMSmail): static
    {
        if ($this->CMSmails->removeElement($cMSmail)) {
            // set the owning side to null (unless already changed)
            if ($cMSmail->getMailType() === $this) {
                $cMSmail->setMailType(null);
            }
        }

        return $this;
    }

    public function getUrlDemo(): ?string
    {
        return $this->urlDemo;
    }

    public function setUrlDemo(?string $urlDemo): static
    {
        $this->urlDemo = $urlDemo;

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

    public function getBackgroundImage(): ?string
    {
        return $this->backgroundImage;
    }

    public function setBackgroundImage(?string $backgroundImage): static
    {
        $this->backgroundImage = $backgroundImage;

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
}
