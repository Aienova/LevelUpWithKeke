<?php

namespace App\Entity;

use App\Repository\CMSitemSettingsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSitemSettingsRepository::class)]
class CMSitemSettings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'CMSitemSettings')]
    private ?CMSitem $item = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bannerImage = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $mainTitle = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $secondTitle = null;

    #[ORM\Column(nullable: true)]
    private ?int $columnNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 10000000, nullable: true)]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'CMSitemSettings')]
    private ?CMSPage $page = null;

    #[ORM\Column(nullable: true)]
    private ?bool $home = null;

    #[ORM\Column(nullable: true)]
    private ?int $position = null;

    #[ORM\OneToMany(mappedBy: 'section', targetEntity: CMSitemServiceSettings::class)]
    private Collection $CMSitemServiceSettings;

    #[ORM\OneToMany(mappedBy: 'section', targetEntity: CMSitemBookingSettings::class)]
    private Collection $CMSitemBookingSettings;

    #[ORM\OneToMany(mappedBy: 'section', targetEntity: CMSitemCarouselSettings::class)]
    private Collection $CMSitemCarouselSettings;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bannerImage2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bannerImage3 = null;

    public function __construct()
    {
        $this->CMSitemServiceSettings = new ArrayCollection();
        $this->CMSitemBookingSettings = new ArrayCollection();
        $this->CMSitemCarouselSettings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItem(): ?CMSitem
    {
        return $this->item;
    }

    public function setItem(?CMSitem $item): static
    {
        $this->item = $item;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getBannerImage(): ?string
    {
        return $this->bannerImage;
    }

    public function setBannerImage(?string $bannerImage): static
    {
        $this->bannerImage = $bannerImage;

        return $this;
    }

    public function getMainTitle(): ?string
    {
        return $this->mainTitle;
    }

    public function setMainTitle(?string $mainTitle): static
    {
        $this->mainTitle = $mainTitle;

        return $this;
    }

    public function getSecondTitle(): ?string
    {
        return $this->secondTitle;
    }

    public function setSecondTitle(?string $secondTitle): static
    {
        $this->secondTitle = $secondTitle;

        return $this;
    }

    public function getColumnNumber(): ?int
    {
        return $this->columnNumber;
    }

    public function setColumnNumber(?int $columnNumber): static
    {
        $this->columnNumber = $columnNumber;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

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

    public function getPage(): ?CMSPage
    {
        return $this->page;
    }

    public function setPage(?CMSPage $page): static
    {
        $this->page = $page;

        return $this;
    }

    public function isHome(): ?bool
    {
        return $this->home;
    }

    public function setHome(?bool $home): static
    {
        $this->home = $home;

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
     * @return Collection<int, CMSitemServiceSettings>
     */
    public function getCMSitemServiceSettings(): Collection
    {
        return $this->CMSitemServiceSettings;
    }

    public function addCMSitemServiceSetting(CMSitemServiceSettings $cMSitemServiceSetting): static
    {
        if (!$this->CMSitemServiceSettings->contains($cMSitemServiceSetting)) {
            $this->CMSitemServiceSettings->add($cMSitemServiceSetting);
            $cMSitemServiceSetting->setSection($this);
        }

        return $this;
    }

    public function removeCMSitemServiceSetting(CMSitemServiceSettings $cMSitemServiceSetting): static
    {
        if ($this->CMSitemServiceSettings->removeElement($cMSitemServiceSetting)) {
            // set the owning side to null (unless already changed)
            if ($cMSitemServiceSetting->getSection() === $this) {
                $cMSitemServiceSetting->setSection(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CMSitemBookingSettings>
     */
    public function getCMSitemBookingSettings(): Collection
    {
        return $this->CMSitemBookingSettings;
    }

    public function addCMSitemBookingSetting(CMSitemBookingSettings $cMSitemBookingSetting): static
    {
        if (!$this->CMSitemBookingSettings->contains($cMSitemBookingSetting)) {
            $this->CMSitemBookingSettings->add($cMSitemBookingSetting);
            $cMSitemBookingSetting->setSection($this);
        }

        return $this;
    }

    public function removeCMSitemBookingSetting(CMSitemBookingSettings $cMSitemBookingSetting): static
    {
        if ($this->CMSitemBookingSettings->removeElement($cMSitemBookingSetting)) {
            // set the owning side to null (unless already changed)
            if ($cMSitemBookingSetting->getSection() === $this) {
                $cMSitemBookingSetting->setSection(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CMSitemCarouselSettings>
     */
    public function getCMSitemCarouselSettings(): Collection
    {
        return $this->CMSitemCarouselSettings;
    }

    public function addCMSitemCarouselSetting(CMSitemCarouselSettings $cMSitemCarouselSetting): static
    {
        if (!$this->CMSitemCarouselSettings->contains($cMSitemCarouselSetting)) {
            $this->CMSitemCarouselSettings->add($cMSitemCarouselSetting);
            $cMSitemCarouselSetting->setSection($this);
        }

        return $this;
    }

    public function removeCMSitemCarouselSetting(CMSitemCarouselSettings $cMSitemCarouselSetting): static
    {
        if ($this->CMSitemCarouselSettings->removeElement($cMSitemCarouselSetting)) {
            // set the owning side to null (unless already changed)
            if ($cMSitemCarouselSetting->getSection() === $this) {
                $cMSitemCarouselSetting->setSection(null);
            }
        }

        return $this;
    }

    public function getBannerImage2(): ?string
    {
        return $this->bannerImage2;
    }

    public function setBannerImage2(?string $bannerImage2): static
    {
        $this->bannerImage2 = $bannerImage2;

        return $this;
    }

    public function getBannerImage3(): ?string
    {
        return $this->bannerImage3;
    }

    public function setBannerImage3(?string $bannerImage3): static
    {
        $this->bannerImage3 = $bannerImage3;

        return $this;
    }
}
