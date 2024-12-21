<?php

namespace App\Entity;

use App\Repository\CMSfontWeightRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSfontWeightRepository::class)]
class CMSfontWeight
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'fontTitleWeight', targetEntity: CMSgraphics::class)]
    private Collection $CMSgraphicsTitle;

    #[ORM\OneToMany(mappedBy: 'fontTextWeight', targetEntity: CMSgraphics::class)]
    private Collection $CMSgraphicsText;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $FRname = null;

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
            $cMSgraphicsTitle->setFontTitleWeight($this);
        }

        return $this;
    }

    public function removeCMSgraphicsTitle(CMSgraphics $cMSgraphicsTitle): static
    {
        if ($this->CMSgraphicsTitle->removeElement($cMSgraphicsTitle)) {
            // set the owning side to null (unless already changed)
            if ($cMSgraphicsTitle->getFontTitleWeight() === $this) {
                $cMSgraphicsTitle->setFontTitleWeight(null);
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
            $cMSgraphicsText->setFontTextWeight($this);
        }

        return $this;
    }

    public function removeCMSgraphicsText(CMSgraphics $cMSgraphicsText): static
    {
        if ($this->CMSgraphicsText->removeElement($cMSgraphicsText)) {
            // set the owning side to null (unless already changed)
            if ($cMSgraphicsText->getFontTextWeight() === $this) {
                $cMSgraphicsText->setFontTextWeight(null);
            }
        }

        return $this;
    }

    public function getFRname(): ?string
    {
        return $this->FRname;
    }

    public function setFRname(?string $FRname): static
    {
        $this->FRname = $FRname;

        return $this;
    }
}
