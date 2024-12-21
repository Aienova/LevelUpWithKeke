<?php

namespace App\Entity;

use App\Repository\CMSstatRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CMSstatRepository::class)]
class CMSstat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $customerNumber = null;

    #[ORM\Column(nullable: true)]
    private ?int $servicesInProgressNumber = null;

    #[ORM\Column(nullable: true)]
    private ?int $servicesCancelledNumber = null;

    #[ORM\Column(nullable: true)]
    private ?int $servicesCompleteNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $serviceMostWanted = null;

    #[ORM\Column(nullable: true)]
    private ?int $serviceMostWantedNumber = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $bestCustomer = null;

    #[ORM\Column(nullable: true)]
    private ?int $bestCustomerServicesNumber = null;

    #[ORM\Column(nullable: true)]
    private ?float $bestCustomerSpent = null;

    #[ORM\Column(nullable: true)]
    private ?int $bookingNumber = null;

    #[ORM\Column(nullable: true)]
    private ?int $serviceNumber = null;

    #[ORM\Column(nullable: true)]
    private ?int $bookingCancelledNumber = null;

    #[ORM\Column(nullable: true)]
    private ?int $bookingCompleteNumber = null;

    #[ORM\Column(nullable: true)]
    private ?int $bookingInProgressNumber = null;

    #[ORM\Column(nullable: true)]
    private ?int $MailsSentNumber = null;

    #[ORM\Column(nullable: true)]
    private ?int $year = null;

    #[ORM\Column(nullable: true)]
    private ?float $turnover = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomerNumber(): ?int
    {
        return $this->customerNumber;
    }

    public function setCustomerNumber(int $customerNumber): static
    {
        $this->customerNumber = $customerNumber;

        return $this;
    }

    public function getServicesInProgressNumber(): ?int
    {
        return $this->servicesInProgressNumber;
    }

    public function setServicesInProgressNumber(?int $servicesInProgressNumber): static
    {
        $this->servicesInProgressNumber = $servicesInProgressNumber;

        return $this;
    }

    public function getServicesCancelledNumber(): ?int
    {
        return $this->servicesCancelledNumber;
    }

    public function setServicesCancelledNumber(?int $servicesCancelledNumber): static
    {
        $this->servicesCancelledNumber = $servicesCancelledNumber;

        return $this;
    }

    public function getServicesCompleteNumber(): ?int
    {
        return $this->servicesCompleteNumber;
    }

    public function setServicesCompleteNumber(?int $servicesCompleteNumber): static
    {
        $this->servicesCompleteNumber = $servicesCompleteNumber;

        return $this;
    }

    public function getServiceMostWanted(): ?string
    {
        return $this->serviceMostWanted;
    }

    public function setServiceMostWanted(string $serviceMostWanted): static
    {
        $this->serviceMostWanted = $serviceMostWanted;

        return $this;
    }

    public function getServiceMostWantedNumber(): ?int
    {
        return $this->serviceMostWantedNumber;
    }

    public function setServiceMostWantedNumber(?int $serviceMostWantedNumber): static
    {
        $this->serviceMostWantedNumber = $serviceMostWantedNumber;

        return $this;
    }

    public function getBestCustomer(): ?string
    {
        return $this->bestCustomer;
    }

    public function setBestCustomer(?string $bestCustomer): static
    {
        $this->bestCustomer = $bestCustomer;

        return $this;
    }

    public function getBestCustomerServicesNumber(): ?int
    {
        return $this->bestCustomerServicesNumber;
    }

    public function setBestCustomerServicesNumber(?int $bestCustomerServicesNumber): static
    {
        $this->bestCustomerServicesNumber = $bestCustomerServicesNumber;

        return $this;
    }

    public function getBestCustomerSpent(): ?float
    {
        return $this->bestCustomerSpent;
    }

    public function setBestCustomerSpent(?float $bestCustomerSpent): static
    {
        $this->bestCustomerSpent = $bestCustomerSpent;

        return $this;
    }

    public function getBookingNumber(): ?int
    {
        return $this->bookingNumber;
    }

    public function setBookingNumber(?int $bookingNumber): static
    {
        $this->bookingNumber = $bookingNumber;

        return $this;
    }

    public function getServiceNumber(): ?int
    {
        return $this->serviceNumber;
    }

    public function setServiceNumber(?int $serviceNumber): static
    {
        $this->serviceNumber = $serviceNumber;

        return $this;
    }

    public function getBookingCancelledNumber(): ?int
    {
        return $this->bookingCancelledNumber;
    }

    public function setBookingCancelledNumber(?int $bookingCancelledNumber): static
    {
        $this->bookingCancelledNumber = $bookingCancelledNumber;

        return $this;
    }

    public function getBookingCompleteNumber(): ?int
    {
        return $this->bookingCompleteNumber;
    }

    public function setBookingCompleteNumber(?int $bookingCompleteNumber): static
    {
        $this->bookingCompleteNumber = $bookingCompleteNumber;

        return $this;
    }

    public function getBookingInProgressNumber(): ?int
    {
        return $this->bookingInProgressNumber;
    }

    public function setBookingInProgressNumber(?int $bookingInProgressNumber): static
    {
        $this->bookingInProgressNumber = $bookingInProgressNumber;

        return $this;
    }

    public function getMailsSentNumber(): ?int
    {
        return $this->MailsSentNumber;
    }

    public function setMailsSentNumber(?int $MailsSentNumber): static
    {
        $this->MailsSentNumber = $MailsSentNumber;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getTurnover(): ?float
    {
        return $this->turnover;
    }

    public function setTurnover(?float $turnover): static
    {
        $this->turnover = $turnover;

        return $this;
    }

}
