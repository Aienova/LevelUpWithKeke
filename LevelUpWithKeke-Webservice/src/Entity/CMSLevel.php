<?php

namespace App\Entity;

use App\Repository\CMSLevelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSLevelRepository::class)]
class CMSLevel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $FRName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ENName = null;

    #[ORM\OneToMany(mappedBy: 'level', targetEntity: CMSUser::class)]
    private Collection $CMSUsers;

    public function __construct()
    {
        $this->CMSUsers = new ArrayCollection();
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

    public function getFRName(): ?string
    {
        return $this->FRName;
    }

    public function setFRName(?string $FRName): static
    {
        $this->FRName = $FRName;

        return $this;
    }

    public function getENName(): ?string
    {
        return $this->ENName;
    }

    public function setENName(?string $ENName): static
    {
        $this->ENName = $ENName;

        return $this;
    }

    /**
     * @return Collection<int, CMSUser>
     */
    public function getCMSUsers(): Collection
    {
        return $this->CMSUsers;
    }

    public function addCMSUser(CMSUser $cMSUser): static
    {
        if (!$this->CMSUsers->contains($cMSUser)) {
            $this->CMSUsers->add($cMSUser);
            $cMSUser->setLevel($this);
        }

        return $this;
    }

    public function removeCMSUser(CMSUser $cMSUser): static
    {
        if ($this->CMSUsers->removeElement($cMSUser)) {
            // set the owning side to null (unless already changed)
            if ($cMSUser->getLevel() === $this) {
                $cMSUser->setLevel(null);
            }
        }

        return $this;
    }
}
