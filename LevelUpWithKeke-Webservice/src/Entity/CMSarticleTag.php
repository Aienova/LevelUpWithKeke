<?php

namespace App\Entity;

use App\Repository\CMSarticleTagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSarticleTagRepository::class)]
class CMSarticleTag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $title = null;

    #[ORM\OneToMany(mappedBy: 'tag', targetEntity: CMSarticle::class)]
    private Collection $CMSarticles;

    public function __construct()
    {
        $this->CMSarticles = new ArrayCollection();
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
            $cMSarticle->setTag($this);
        }

        return $this;
    }

    public function removeCMSarticle(CMSarticle $cMSarticle): static
    {
        if ($this->CMSarticles->removeElement($cMSarticle)) {
            // set the owning side to null (unless already changed)
            if ($cMSarticle->getTag() === $this) {
                $cMSarticle->setTag(null);
            }
        }

        return $this;
    }
}
