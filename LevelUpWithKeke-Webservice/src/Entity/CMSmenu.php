<?php

namespace App\Entity;

use App\Repository\CMSmenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSmenuRepository::class)]
class CMSmenu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $url = null;

    #[ORM\Column(nullable: true)]
    private ?int $position = null;

    #[ORM\OneToMany(mappedBy: 'CMSmenu', targetEntity: CMSsubmenu::class)]
    private Collection $CMSsubmenus;

    #[ORM\ManyToOne(inversedBy: 'CMSmenus')]
    private ?CMSPage $page = null;

    #[ORM\Column(nullable: false)]
    private ?bool $topmenu = true;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $symbol = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $color = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $backgroundColor = null;


    public function __construct()
    {
        $this->CMSsubmenus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;

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
            $cMSsubmenu->setCMSmenu($this);
        }

        return $this;
    }

    public function removeCMSsubmenu(CMSsubmenu $cMSsubmenu): static
    {
        if ($this->CMSsubmenus->removeElement($cMSsubmenu)) {
            // set the owning side to null (unless already changed)
            if ($cMSsubmenu->getCMSmenu() === $this) {
                $cMSsubmenu->setCMSmenu(null);
            }
        }

        return $this;
    }

    public function getPage(): ?CMSPage
    {
        return $this->page;
    }

    public function setPage(?CMSPage $page): static
    {
        $this->page = $page;

        return $this;
    }

    public function isTopmenu(): ?bool
    {
        return $this->topmenu;
    }

    public function setTopmenu(?bool $topmenu): static
    {
        $this->topmenu = $topmenu;

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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getBackgroundColor(): ?string
    {
        return $this->backgroundColor;
    }

    public function setBackgroundColor(?string $backgroundColor): static
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }

}
