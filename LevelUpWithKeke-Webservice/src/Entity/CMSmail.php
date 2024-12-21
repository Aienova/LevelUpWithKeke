<?php

namespace App\Entity;

use App\Repository\CMSmailRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSmailRepository::class)]
class CMSmail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $header = null;

    #[ORM\Column(length: 10000, nullable: true)]
    private ?string $body = null;

    #[ORM\Column(length: 50000, nullable: true)]
    private ?string $footer = null;

    #[ORM\ManyToOne(inversedBy: 'CMSmails')]
    private ?CMSmailType $mailType = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeader(): ?string
    {
        return $this->header;
    }

    public function setHeader(?string $header): static
    {
        $this->header = $header;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): static
    {
        $this->body = $body;

        return $this;
    }

    public function getFooter(): ?string
    {
        return $this->footer;
    }

    public function setFooter(?string $footer): static
    {
        $this->footer = $footer;

        return $this;
    }

    public function getMailType(): ?CMSmailType
    {
        return $this->mailType;
    }

    public function setMailType(?CMSmailType $mailType): static
    {
        $this->mailType = $mailType;

        return $this;
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
}
