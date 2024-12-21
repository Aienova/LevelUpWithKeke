<?php

namespace App\Entity;

use App\Repository\CMSgalleryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSgalleryRepository::class)]
class CMSgallery
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $creationDate = null;

    #[ORM\Column(nullable: true)]
    private ?bool $visibility = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToMany(targetEntity: CMSMedia::class, inversedBy: 'CMSgalleries')]
    private Collection $pictures;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $urlDemo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tag = null;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
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

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): static
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function isVisibility(): ?bool
    {
        return $this->visibility;
    }

    public function setVisibility(?bool $visibility): static
    {
        $this->visibility = $visibility;

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

    /**
     * @return Collection<int, CMSmedia>
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(CMSmedia $picture): static
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures->add($picture);
        }

        return $this;
    }

    public function removePicture(CMSmedia $picture): static
    {
        $this->pictures->removeElement($picture);

        return $this;
    }

    public function getUrlDemo(): ?string
    {
        return $this->urlDemo;
    }

    public function setUrlDemo(?string $urlDemo): static
    {
        $this->urlDemo = $urlDemo;

        return $this;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(?string $tag): static
    {
        $this->tag = $tag;

        return $this;
    }
}
