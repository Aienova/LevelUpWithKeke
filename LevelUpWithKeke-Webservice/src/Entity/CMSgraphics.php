<?php

namespace App\Entity;

use App\Repository\CMSgraphicsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSgraphicsRepository::class)]
class CMSgraphics
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $primaryColor = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $secondaryColor = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $thirdColor = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $backgroundImage = null;

    #[ORM\Column(nullable: true)]
    private ?bool $backgroundRepeat = null;

    #[ORM\Column(nullable: true)]
    private ?bool $activated = null;

    #[ORM\ManyToOne(inversedBy: 'CMSgraphicsTitle')]
    private ?CMSfont $fontTitle = null;

    #[ORM\ManyToOne(inversedBy: 'CMSgraphicsText')]
    private ?CMSfont $fontText = null;

    #[ORM\ManyToOne(inversedBy: 'CMSgraphicsTitle')]
    private ?CMSfontWeight $fontTitleWeight = null;

    #[ORM\ManyToOne(inversedBy: 'CMSgraphicsText')]
    private ?CMSfontWeight $fontTextWeight = null;

    #[ORM\ManyToOne(inversedBy: 'CMSgraphics')]
    private ?CMSgraphicsType $section = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $headerColor = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $footerColor = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrimaryColor(): ?string
    {
        return $this->primaryColor;
    }

    public function setPrimaryColor(?string $primaryColor): static
    {
        $this->primaryColor = $primaryColor;

        return $this;
    }

    public function getSecondaryColor(): ?string
    {
        return $this->secondaryColor;
    }

    public function setSecondaryColor(?string $secondaryColor): static
    {
        $this->secondaryColor = $secondaryColor;

        return $this;
    }

    public function getThirdColor(): ?string
    {
        return $this->thirdColor;
    }

    public function setThirdColor(?string $thirdColor): static
    {
        $this->thirdColor = $thirdColor;

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

    public function isBackgroundRepeat(): ?bool
    {
        return $this->backgroundRepeat;
    }

    public function setBackgroundRepeat(?bool $backgroundRepeat): static
    {
        $this->backgroundRepeat = $backgroundRepeat;

        return $this;
    }

    public function isActivated(): ?bool
    {
        return $this->activated;
    }

    public function setActivated(?bool $activated): static
    {
        $this->activated = $activated;

        return $this;
    }

    public function getFontTitle(): ?CMSfont
    {
        return $this->fontTitle;
    }

    public function setFontTitle(?CMSfont $fontTitle): static
    {
        $this->fontTitle = $fontTitle;

        return $this;
    }

    public function getFontText(): ?CMSfont
    {
        return $this->fontText;
    }

    public function setFontText(?CMSfont $fontText): static
    {
        $this->fontText = $fontText;

        return $this;
    }

    public function getFontTitleWeight(): ?CMSfontWeight
    {
        return $this->fontTitleWeight;
    }

    public function setFontTitleWeight(?CMSfontWeight $fontTitleWeight): static
    {
        $this->fontTitleWeight = $fontTitleWeight;

        return $this;
    }

    public function getFontTextWeight(): ?CMSfontWeight
    {
        return $this->fontTextWeight;
    }

    public function setFontTextWeight(?CMSfontWeight $fontTextWeight): static
    {
        $this->fontTextWeight = $fontTextWeight;

        return $this;
    }

    public function getSection(): ?CMSgraphicsType
    {
        return $this->section;
    }

    public function setSection(?CMSgraphicsType $section): static
    {
        $this->section = $section;

        return $this;
    }

    public function getHeaderColor(): ?string
    {
        return $this->headerColor;
    }

    public function setHeaderColor(?string $headerColor): static
    {
        $this->headerColor = $headerColor;

        return $this;
    }

    public function getFooterColor(): ?string
    {
        return $this->footerColor;
    }

    public function setFooterColor(?string $footerColor): static
    {
        $this->footerColor = $footerColor;

        return $this;
    }


}
