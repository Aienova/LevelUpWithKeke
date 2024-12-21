<?php

namespace App\Entity;

use App\Repository\CMSWebsiteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSWebsiteRepository::class)]
class CMSWebsite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $owner = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $activity = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $country = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $link = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $domain = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $location = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $companyId = null;

    #[ORM\ManyToOne(inversedBy: 'CMSWebsites')]
    private ?CMSHomepage $homepage = null;

    #[ORM\ManyToOne(inversedBy: 'CMSWebsitesLogo')]
    private ?CMSMedia $logo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $companyName = null;

    #[ORM\Column(nullable: true)]
    private ?int $vat = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $cuidlink = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?string
    {
        return $this->owner;
    }

    public function setOwner(?string $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getActivity(): ?string
    {
        return $this->activity;
    }

    public function setActivity(?string $activity): static
    {
        $this->activity = $activity;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): static
    {
        $this->country = $country;

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

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(?string $domain): static
    {
        $this->domain = $domain;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getCompanyId(): ?string
    {
        return $this->companyId;
    }

    public function setCompanyId(?string $companyId): static
    {
        $this->companyId = $companyId;

        return $this;
    }

    public function getHomepage(): ?CMSHomepage
    {
        return $this->homepage;
    }

    public function setHomepage(?CMSHomepage $homepage): static
    {
        $this->homepage = $homepage;

        return $this;
    }

    public function getLogo(): ?CMSMedia
    {
        return $this->logo;
    }

    public function setLogo(?CMSMedia $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName): static
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getVat(): ?int
    {
        return $this->vat;
    }

    public function setVat(?int $vat): static
    {
        $this->vat = $vat;

        return $this;
    }

    public function getCuidlink(): ?string
    {
        return $this->cuidlink;
    }

    public function setCuidlink(?string $cuidlink): static
    {
        $this->cuidlink = $cuidlink;

        return $this;
    }
}
