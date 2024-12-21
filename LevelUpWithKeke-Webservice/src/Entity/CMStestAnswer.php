<?php

namespace App\Entity;

use App\Repository\CMStestAnswerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMStestAnswerRepository::class)]
class CMStestAnswer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'CMStestAnswers')]
    private ?CMStestQuestion $question = null;

    #[ORM\Column(length: 10000000, nullable: true)]
    private ?string $content = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?CMStestQuestion
    {
        return $this->question;
    }

    public function setQuestion(?CMStestQuestion $question): static
    {
        $this->question = $question;

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
}
