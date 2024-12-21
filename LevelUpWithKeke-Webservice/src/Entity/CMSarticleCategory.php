<?php

namespace App\Entity;

use App\Repository\CMSarticleCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSarticleCategoryRepository::class)]
class CMSarticleCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 100000, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: CMSarticle::class)]
    private Collection $CMSarticles;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $title = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Event::class)]
    private Collection $events;

    public function __construct()
    {
        $this->CMSarticles = new ArrayCollection();
        $this->events = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, CMSarticle>
     */
    public function getCMSarticles(): Collection
    {
        return $this->CMSarticles;
    }

    public function addCMSarticle(CMSarticle $cMSarticle): static
    {
        if (!$this->CMSarticles->contains($cMSarticle)) {
            $this->CMSarticles->add($cMSarticle);
            $cMSarticle->setCategory($this);
        }

        return $this;
    }

    public function removeCMSarticle(CMSarticle $cMSarticle): static
    {
        if ($this->CMSarticles->removeElement($cMSarticle)) {
            // set the owning side to null (unless already changed)
            if ($cMSarticle->getCategory() === $this) {
                $cMSarticle->setCategory(null);
            }
        }

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

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): static
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setCategory($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getCategory() === $this) {
                $event->setCategory(null);
            }
        }

        return $this;
    }
}
