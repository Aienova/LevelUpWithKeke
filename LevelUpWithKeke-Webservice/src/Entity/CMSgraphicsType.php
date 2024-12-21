<?php

namespace App\Entity;

use App\Repository\CMSgraphicsTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSgraphicsTypeRepository::class)]
class CMSgraphicsType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\OneToMany(mappedBy: 'section', targetEntity: CMSgraphics::class)]
    private Collection $CMSgraphics;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $url = null;

    public function __construct()
    {
        $this->CMSgraphics = new ArrayCollection();
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
     * @return Collection<int, CMSgraphics>
     */
    public function getCMSgraphics(): Collection
    {
        return $this->CMSgraphics;
    }

    public function addCMSgraphic(CMSgraphics $cMSgraphic): static
    {
        if (!$this->CMSgraphics->contains($cMSgraphic)) {
            $this->CMSgraphics->add($cMSgraphic);
            $cMSgraphic->setSection($this);
        }

        return $this;
    }

    public function removeCMSgraphic(CMSgraphics $cMSgraphic): static
    {
        if ($this->CMSgraphics->removeElement($cMSgraphic)) {
            // set the owning side to null (unless already changed)
            if ($cMSgraphic->getSection() === $this) {
                $cMSgraphic->setSection(null);
            }
        }

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
}
