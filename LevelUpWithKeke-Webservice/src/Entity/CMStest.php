<?php

namespace App\Entity;

use App\Repository\CMStestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMStestRepository::class)]
class CMStest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $title = null;

    #[ORM\OneToMany(mappedBy: 'test', targetEntity: CMStestQuestion::class)]
    private Collection $CMStestQuestions;

    #[ORM\OneToMany(mappedBy: 'test', targetEntity: CMStestResult::class)]
    private Collection $CMStestResults;

    public function __construct()
    {
        $this->CMStestQuestions = new ArrayCollection();
        $this->CMStestResults = new ArrayCollection();
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

    /**
     * @return Collection<int, CMStestQuestion>
     */
    public function getCMStestQuestions(): Collection
    {
        return $this->CMStestQuestions;
    }

    public function addCMStestQuestion(CMStestQuestion $cMStestQuestion): static
    {
        if (!$this->CMStestQuestions->contains($cMStestQuestion)) {
            $this->CMStestQuestions->add($cMStestQuestion);
            $cMStestQuestion->setTest($this);
        }

        return $this;
    }

    public function removeCMStestQuestion(CMStestQuestion $cMStestQuestion): static
    {
        if ($this->CMStestQuestions->removeElement($cMStestQuestion)) {
            // set the owning side to null (unless already changed)
            if ($cMStestQuestion->getTest() === $this) {
                $cMStestQuestion->setTest(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CMStestResult>
     */
    public function getCMStestResults(): Collection
    {
        return $this->CMStestResults;
    }

    public function addCMStestResult(CMStestResult $cMStestResult): static
    {
        if (!$this->CMStestResults->contains($cMStestResult)) {
            $this->CMStestResults->add($cMStestResult);
            $cMStestResult->setTest($this);
        }

        return $this;
    }

    public function removeCMStestResult(CMStestResult $cMStestResult): static
    {
        if ($this->CMStestResults->removeElement($cMStestResult)) {
            // set the owning side to null (unless already changed)
            if ($cMStestResult->getTest() === $this) {
                $cMStestResult->setTest(null);
            }
        }

        return $this;
    }
}
