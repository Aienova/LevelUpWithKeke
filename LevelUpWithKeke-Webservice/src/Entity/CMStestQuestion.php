<?php

namespace App\Entity;

use App\Repository\CMStestQuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMStestQuestionRepository::class)]
class CMStestQuestion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 1000000000, nullable: true)]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'CMStestQuestions')]
    private ?CMStest $test = null;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: CMStestAnswer::class)]
    private Collection $CMStestAnswers;

    public function __construct()
    {
        $this->CMStestAnswers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTest(): ?CMStest
    {
        return $this->test;
    }

    public function setTest(?CMStest $test): static
    {
        $this->test = $test;

        return $this;
    }

    /**
     * @return Collection<int, CMStestAnswer>
     */
    public function getCMStestAnswers(): Collection
    {
        return $this->CMStestAnswers;
    }

    public function addCMStestAnswer(CMStestAnswer $cMStestAnswer): static
    {
        if (!$this->CMStestAnswers->contains($cMStestAnswer)) {
            $this->CMStestAnswers->add($cMStestAnswer);
            $cMStestAnswer->setQuestion($this);
        }

        return $this;
    }

    public function removeCMStestAnswer(CMStestAnswer $cMStestAnswer): static
    {
        if ($this->CMStestAnswers->removeElement($cMStestAnswer)) {
            // set the owning side to null (unless already changed)
            if ($cMStestAnswer->getQuestion() === $this) {
                $cMStestAnswer->setQuestion(null);
            }
        }

        return $this;
    }
}
