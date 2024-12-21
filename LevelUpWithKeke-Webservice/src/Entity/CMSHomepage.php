<?php

namespace App\Entity;

use App\Repository\CMSHomepageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSHomepageRepository::class)]
class CMSHomepage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'homepage', targetEntity: CMSWebsite::class)]
    private Collection $CMSWebsites;

    #[ORM\Column(length: 10000000, nullable: true)]
    private ?string $aboutUs = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $aboutUsImage = null;

    #[ORM\Column(length: 10000000, nullable: true)]
    private ?string $ourServices = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $bannerLogo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bannerTitle = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $bannerImage = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bannerVideo = null;

    #[ORM\Column(length: 10000000, nullable: true)]
    private ?string $ourPrices = null;

    #[ORM\Column(nullable: true)]
    private ?int $galleryMax = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $bookingStartPoint = null;

    #[ORM\Column]
    private ?int $bookingRangeZone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $aboutUsTitle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ourServicesTitle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ourPricesTitle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $galleryTitle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bookingTitle = null;

    #[ORM\Column(nullable: true)]
    private ?bool $bannerVideoDisplayed = null;

    #[ORM\ManyToOne(inversedBy: 'CMSHomepages')]
    private ?CMSmedia $bannerImageId = null;

    public function __construct()
    {
        $this->CMSWebsites = new ArrayCollection();
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
     * @return Collection<int, CMSWebsite>
     */
    public function getCMSWebsites(): Collection
    {
        return $this->CMSWebsites;
    }

    public function addCMSWebsite(CMSWebsite $cMSWebsite): static
    {
        if (!$this->CMSWebsites->contains($cMSWebsite)) {
            $this->CMSWebsites->add($cMSWebsite);
            $cMSWebsite->setHomepage($this);
        }

        return $this;
    }

    public function removeCMSWebsite(CMSWebsite $cMSWebsite): static
    {
        if ($this->CMSWebsites->removeElement($cMSWebsite)) {
            // set the owning side to null (unless already changed)
            if ($cMSWebsite->getHomepage() === $this) {
                $cMSWebsite->setHomepage(null);
            }
        }

        return $this;
    }

    public function getAboutUs(): ?string
    {
        return $this->aboutUs;
    }

    public function setAboutUs(?string $aboutUs): static
    {
        $this->aboutUs = $aboutUs;

        return $this;
    }

    public function getAboutUsImage(): ?string
    {
        return $this->aboutUsImage;
    }

    public function setAboutUsImage(?string $aboutUsImage): static
    {
        $this->aboutUsImage = $aboutUsImage;

        return $this;
    }

    public function getOurServices(): ?string
    {
        return $this->ourServices;
    }

    public function setOurServices(?string $ourServices): static
    {
        $this->ourServices = $ourServices;

        return $this;
    }

    public function getBannerLogo(): ?string
    {
        return $this->bannerLogo;
    }

    public function setBannerLogo(?string $bannerLogo): static
    {
        $this->bannerLogo = $bannerLogo;

        return $this;
    }

    public function getBannerTitle(): ?string
    {
        return $this->bannerTitle;
    }

    public function setBannerTitle(?string $bannerTitle): static
    {
        $this->bannerTitle = $bannerTitle;

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

    public function getBannerVideo(): ?string
    {
        return $this->bannerVideo;
    }

    public function setBannerVideo(?string $bannerVideo): static
    {
        $this->bannerVideo = $bannerVideo;

        return $this;
    }

    public function getOurPrices(): ?string
    {
        return $this->ourPrices;
    }

    public function setOurPrices(?string $ourPrices): static
    {
        $this->ourPrices = $ourPrices;

        return $this;
    }

    public function getGalleryMax(): ?int
    {
        return $this->galleryMax;
    }

    public function setGalleryMax(?int $galleryMax): static
    {
        $this->galleryMax = $galleryMax;

        return $this;
    }

    public function getBookingStartPoint(): ?string
    {
        return $this->bookingStartPoint;
    }

    public function setBookingStartPoint(?string $bookingStartPoint): static
    {
        $this->bookingStartPoint = $bookingStartPoint;

        return $this;
    }

    public function getBookingRangeZone(): ?int
    {
        return $this->bookingRangeZone;
    }

    public function setBookingRangeZone(int $bookingRangeZone): static
    {
        $this->bookingRangeZone = $bookingRangeZone;

        return $this;
    }

    public function getAboutUsTitle(): ?string
    {
        return $this->aboutUsTitle;
    }

    public function setAboutUsTitle(?string $aboutUsTitle): static
    {
        $this->aboutUsTitle = $aboutUsTitle;

        return $this;
    }

    public function getOurServicesTitle(): ?string
    {
        return $this->ourServicesTitle;
    }

    public function setOurServicesTitle(?string $ourServicesTitle): static
    {
        $this->ourServicesTitle = $ourServicesTitle;

        return $this;
    }

    public function getOurPricesTitle(): ?string
    {
        return $this->ourPricesTitle;
    }

    public function setOurPricesTitle(?string $ourPricesTitle): static
    {
        $this->ourPricesTitle = $ourPricesTitle;

        return $this;
    }

    public function getGalleryTitle(): ?string
    {
        return $this->galleryTitle;
    }

    public function setGalleryTitle(?string $galleryTitle): static
    {
        $this->galleryTitle = $galleryTitle;

        return $this;
    }

    public function getBookingTitle(): ?string
    {
        return $this->bookingTitle;
    }

    public function setBookingTitle(?string $bookingTitle): static
    {
        $this->bookingTitle = $bookingTitle;

        return $this;
    }

    public function isBannerVideoDisplayed(): ?bool
    {
        return $this->bannerVideoDisplayed;
    }

    public function setBannerVideoDisplayed(?bool $bannerVideoDisplayed): static
    {
        $this->bannerVideoDisplayed = $bannerVideoDisplayed;

        return $this;
    }

    public function getBannerImageId(): ?CMSmedia
    {
        return $this->bannerImageId;
    }

    public function setBannerImageId(?CMSmedia $bannerImageId): static
    {
        $this->bannerImageId = $bannerImageId;

        return $this;
    }
}
