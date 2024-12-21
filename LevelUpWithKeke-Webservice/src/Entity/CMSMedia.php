<?php

namespace App\Entity;

use App\Repository\CMSMediaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSMediaRepository::class)]
class CMSMedia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateUploaded = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $link = null;

    #[ORM\Column(nullable: true)]
    private ?bool $video = null;

    #[ORM\OneToMany(mappedBy: 'logo', targetEntity: CMSWebsite::class)]
    private Collection $CMSWebsitesLogo;

    #[ORM\ManyToMany(targetEntity: CMSgallery::class, mappedBy: 'pictures')]
    private Collection $CMSgalleries;

    #[ORM\OneToMany(mappedBy: 'logo', targetEntity: Performance::class)]
    private Collection $performances;

    #[ORM\OneToMany(mappedBy: 'bannerImageId', targetEntity: CMSHomepage::class)]
    private Collection $CMSHomepages;

    public function __construct()
    {
        $this->CMSWebsitesLogo = new ArrayCollection();
        $this->CMSgalleries = new ArrayCollection();
        $this->performances = new ArrayCollection();
        $this->CMSHomepages = new ArrayCollection();
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

    public function getDateUploaded(): ?\DateTimeInterface
    {
        return $this->dateUploaded;
    }

    public function setDateUploaded(?\DateTimeInterface $dateUploaded): static
    {
        $this->dateUploaded = $dateUploaded;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): static
    {
        $this->link = $link;

        return $this;
    }

    public function isVideo(): ?bool
    {
        return $this->video;
    }

    public function setVideo(?bool $video): static
    {
        $this->video = $video;

        return $this;
    }

    /**
     * @return Collection<int, CMSWebsite>
     */
    public function getCMSWebsitesLogo(): Collection
    {
        return $this->CMSWebsitesLogo;
    }

    public function addCMSWebsitesLogo(CMSWebsite $cMSWebsitesLogo): static
    {
        if (!$this->CMSWebsitesLogo->contains($cMSWebsitesLogo)) {
            $this->CMSWebsitesLogo->add($cMSWebsitesLogo);
            $cMSWebsitesLogo->setLogo($this);
        }

        return $this;
    }

    public function removeCMSWebsitesLogo(CMSWebsite $cMSWebsitesLogo): static
    {
        if ($this->CMSWebsitesLogo->removeElement($cMSWebsitesLogo)) {
            // set the owning side to null (unless already changed)
            if ($cMSWebsitesLogo->getLogo() === $this) {
                $cMSWebsitesLogo->setLogo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CMSgallery>
     */
    public function getCMSgalleries(): Collection
    {
        return $this->CMSgalleries;
    }

    public function addCMSgallery(CMSgallery $cMSgallery): static
    {
        if (!$this->CMSgalleries->contains($cMSgallery)) {
            $this->CMSgalleries->add($cMSgallery);
            $cMSgallery->addPicture($this);
        }

        return $this;
    }

    public function removeCMSgallery(CMSgallery $cMSgallery): static
    {
        if ($this->CMSgalleries->removeElement($cMSgallery)) {
            $cMSgallery->removePicture($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Performance>
     */
    public function getPerformances(): Collection
    {
        return $this->performances;
    }

    public function addPerformance(Performance $performance): static
    {
        if (!$this->performances->contains($performance)) {
            $this->performances->add($performance);
            $performance->setLogo($this);
        }

        return $this;
    }

    public function removePerformance(Performance $performance): static
    {
        if ($this->performances->removeElement($performance)) {
            // set the owning side to null (unless already changed)
            if ($performance->getLogo() === $this) {
                $performance->setLogo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CMSHomepage>
     */
    public function getCMSHomepages(): Collection
    {
        return $this->CMSHomepages;
    }

    public function addCMSHomepage(CMSHomepage $cMSHomepage): static
    {
        if (!$this->CMSHomepages->contains($cMSHomepage)) {
            $this->CMSHomepages->add($cMSHomepage);
            $cMSHomepage->setBannerImageId($this);
        }

        return $this;
    }

    public function removeCMSHomepage(CMSHomepage $cMSHomepage): static
    {
        if ($this->CMSHomepages->removeElement($cMSHomepage)) {
            // set the owning side to null (unless already changed)
            if ($cMSHomepage->getBannerImageId() === $this) {
                $cMSHomepage->setBannerImageId(null);
            }
        }

        return $this;
    }
}
