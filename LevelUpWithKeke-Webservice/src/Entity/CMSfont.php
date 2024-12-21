<?php

namespace App\Entity;

use App\Repository\CMSfontRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSfontRepository::class)]
class CMSfont
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?bool $serif = null;

    #[ORM\OneToMany(mappedBy: 'fontTitle', targetEntity: CMSgraphics::class)]
    private Collection $CMSgraphicsTitle;

    #[ORM\OneToMany(mappedBy: 'fontText', targetEntity: CMSgraphics::class)]
    private Collection $CMSgraphicsText;

    public function __construct()
    {
        $this->CMSgraphicsTitle = new ArrayCollection();
        $this->CMSgraphicsText = new ArrayCollection();
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

    public function isSerif(): ?bool
    {
        return $this->serif;
    }

    public function setSerif(?bool $serif): static
    {
        $this->serif = $serif;

        return $this;
    }

    /**
     * @return Collection<int, CMSgraphics>
     */
    public function getCMSgraphicsTitle(): Collection
    {
        return $this->CMSgraphicsTitle;
    }

    public function addCMSgraphicsTitle(CMSgraphics $cMSgraphicsTitle): static
    {
        if (!$this->CMSgraphicsTitle->contains($cMSgraphicsTitle)) {
            $this->CMSgraphicsTitle->add($cMSgraphicsTitle);
            $cMSgraphicsTitle->setFontTitle($this);
        }

        return $this;
    }

    public function removeCMSgraphicsTitle(CMSgraphics $cMSgraphicsTitle): static
    {
        if ($this->CMSgraphicsTitle->removeElement($cMSgraphicsTitle)) {
            // set the owning side to null (unless already changed)
            if ($cMSgraphicsTitle->getFontTitle() === $this) {
                $cMSgraphicsTitle->setFontTitle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CMSgraphics>
     */
    public function getCMSgraphicsText(): Collection
    {
        return $this->CMSgraphicsText;
    }

    public function addCMSgraphicsText(CMSgraphics $cMSgraphicsText): static
    {
        if (!$this->CMSgraphicsText->contains($cMSgraphicsText)) {
            $this->CMSgraphicsText->add($cMSgraphicsText);
            $cMSgraphicsText->setFontText($this);
        }

        return $this;
    }

    public function removeCMSgraphicsText(CMSgraphics $cMSgraphicsText): static
    {
        if ($this->CMSgraphicsText->removeElement($cMSgraphicsText)) {
            // set the owning side to null (unless already changed)
            if ($cMSgraphicsText->getFontText() === $this) {
                $cMSgraphicsText->setFontText(null);
            }
        }

        return $this;
    }
}
