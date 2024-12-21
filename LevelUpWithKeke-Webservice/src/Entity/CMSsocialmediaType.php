<?php

namespace App\Entity;

use App\Repository\CMSsocialmediaTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSsocialmediaTypeRepository::class)]
class CMSsocialmediaType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    #[ORM\OneToMany(mappedBy: 'socialMediaType', targetEntity: CMSsocialmedia::class)]
    private Collection $cMSsocialmedia;

    public function __construct()
    {
        $this->cMSsocialmedia = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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

    /**
     * @return Collection<int, CMSsocialmedia>
     */
    public function getCMSsocialmedia(): Collection
    {
        return $this->cMSsocialmedia;
    }

    public function addCMSsocialmedia(CMSsocialmedia $cMSsocialmedia): static
    {
        if (!$this->cMSsocialmedia->contains($cMSsocialmedia)) {
            $this->cMSsocialmedia->add($cMSsocialmedia);
            $cMSsocialmedia->setSocialMediaType($this);
        }

        return $this;
    }

    public function removeCMSsocialmedia(CMSsocialmedia $cMSsocialmedia): static
    {
        if ($this->cMSsocialmedia->removeElement($cMSsocialmedia)) {
            // set the owning side to null (unless already changed)
            if ($cMSsocialmedia->getSocialMediaType() === $this) {
                $cMSsocialmedia->setSocialMediaType(null);
            }
        }

        return $this;
    }
}
