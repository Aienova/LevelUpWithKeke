<?php

namespace App\Entity;

use App\Repository\CMSPageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSPageRepository::class)]
class CMSPage
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

    #[ORM\Column(length: 10000000, nullable: true)]
    private ?string $content = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $symbol = null;

    #[ORM\OneToMany(mappedBy: 'page', targetEntity: CMSmenu::class)]
    private Collection $CMSmenus;

    #[ORM\OneToMany(mappedBy: 'page', targetEntity: CMSsubmenu::class)]
    private Collection $CMSsubmenus;

    #[ORM\OneToMany(mappedBy: 'page', targetEntity: CMSitemSettings::class)]
    private Collection $CMSitemSettings;

    public function __construct()
    {
        $this->CMSmenus = new ArrayCollection();
        $this->CMSsubmenus = new ArrayCollection();
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;

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

    /**
     * @return Collection<int, CMSmenu>
     */
    public function getCMSmenus(): Collection
    {
        return $this->CMSmenus;
    }

    public function addCMSmenu(CMSmenu $cMSmenu): static
    {
        if (!$this->CMSmenus->contains($cMSmenu)) {
            $this->CMSmenus->add($cMSmenu);
            $cMSmenu->setPage($this);
        }

        return $this;
    }

    public function removeCMSmenu(CMSmenu $cMSmenu): static
    {
        if ($this->CMSmenus->removeElement($cMSmenu)) {
            // set the owning side to null (unless already changed)
            if ($cMSmenu->getPage() === $this) {
                $cMSmenu->setPage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CMSsubmenu>
     */
    public function getCMSsubmenus(): Collection
    {
        return $this->CMSsubmenus;
    }

    public function addCMSsubmenu(CMSsubmenu $cMSsubmenu): static
    {
        if (!$this->CMSsubmenus->contains($cMSsubmenu)) {
            $this->CMSsubmenus->add($cMSsubmenu);
            $cMSsubmenu->setPage($this);
        }

        return $this;
    }

    public function removeCMSsubmenu(CMSsubmenu $cMSsubmenu): static
    {
        if ($this->CMSsubmenus->removeElement($cMSsubmenu)) {
            // set the owning side to null (unless already changed)
            if ($cMSsubmenu->getPage() === $this) {
                $cMSsubmenu->setPage(null);
            }
        }

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
            $cMSitemSetting->setPage($this);
        }

        return $this;
    }

    public function removeCMSitemSetting(CMSitemSettings $cMSitemSetting): static
    {
        if ($this->CMSitemSettings->removeElement($cMSitemSetting)) {
            // set the owning side to null (unless already changed)
            if ($cMSitemSetting->getPage() === $this) {
                $cMSitemSetting->setPage(null);
            }
        }

        return $this;
    }
}
