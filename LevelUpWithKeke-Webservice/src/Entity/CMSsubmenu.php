<?php

namespace App\Entity;

use App\Repository\CMSsubmenuRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSsubmenuRepository::class)]
class CMSsubmenu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $url = null;

    #[ORM\ManyToOne(inversedBy: 'CMSsubmenus')]
    private ?CMSmenu $CMSmenu = null;

    #[ORM\ManyToOne(inversedBy: 'CMSsubmenus')]
    private ?CMSPage $page = null;

    #[ORM\Column(nullable: true)]
    private ?int $position = null;

    #[ORM\Column(nullable: true)]
    private ?int $totalsubmenu = null;

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

    public function getCMSmenu(): ?CMSmenu
    {
        return $this->CMSmenu;
    }

    public function setCMSmenu(?CMSmenu $CMSmenu): static
    {
        $this->CMSmenu = $CMSmenu;

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

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getTotalsubmenu(): ?int
    {
        return $this->totalsubmenu;
    }

    public function setTotalsubmenu(?int $totalsubmenu): static
    {
        $this->totalsubmenu = $totalsubmenu;

        return $this;
    }
}
