<?php

namespace App\Entity;

use App\Repository\CMStestimonialsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMStestimonialsRepository::class)]
class CMStestimonials
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $rate = null;

    #[ORM\Column(length: 1000000, nullable: true)]
    private ?string $comment = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $beforePicture = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $afterPicture = null;

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

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(?int $rate): static
    {
        $this->rate = $rate;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function getBeforePicture(): ?string
    {
        return $this->beforePicture;
    }

    public function setBeforePicture(string $beforePicture): static
    {
        $this->beforePicture = $beforePicture;

        return $this;
    }

    public function getAfterPicture(): ?string
    {
        return $this->afterPicture;
    }

    public function setAfterPicture(?string $afterPicture): static
    {
        $this->afterPicture = $afterPicture;

        return $this;
    }
}
