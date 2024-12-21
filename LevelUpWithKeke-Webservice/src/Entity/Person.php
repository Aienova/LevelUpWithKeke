<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonRepository::class)]
class Person
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $surname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $maidenname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $spouseName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profession = null;

    #[ORM\ManyToOne(inversedBy: 'people')]
    private ?MaritalStatus $maritalStatus = null;

    #[ORM\Column(nullable: true)]
    private ?int $height = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $job = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $company = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $haircolor = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $eyecolor = null;

    #[ORM\ManyToOne(inversedBy: 'people')]
    private ?Nation $spouseNationality = null;

    #[ORM\ManyToOne(inversedBy: 'people')]
    private ?Gender $gender = null;

    #[ORM\ManyToOne(inversedBy: 'people')]
    private ?NationalType $nationalType = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $birthdate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $birthplace = null;

    #[ORM\ManyToOne(inversedBy: 'peopleOrigin')]
    private ?Nation $origin = null;

    #[ORM\ManyToOne(inversedBy: 'peopleResident')]
    private ?Nation $residenceCountry = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $arrivalDate = null;

    #[ORM\Column(nullable: true)]
    private ?bool $criminalRecord = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $residenceAdress = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $postalCode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $birthCertificateNumber = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $birthCertificateDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $birthCertificateOrganisation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $judgementNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $birthCertificateDeclarant = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fatherName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $motherName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fatherProfession = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $motherProfession = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $parentEmail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $parentTelephone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fatherAddress = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $motherAddress = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $department = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $district = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $emergencyPersonFirstname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $emergencyPersonSurname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $emergencyPersonAddress = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $emergencyPersonTelephone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $emergencyPersonLink = null;

    #[ORM\ManyToOne(inversedBy: 'people')]
    private ?IdentityType $identityType = null;

    #[ORM\Column(nullable: true)]
    private ?int $identityNumber = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $deliveryDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $expirationDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $deliveredBy = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $deliveryPlace = null;

    #[ORM\ManyToOne(inversedBy: 'PeopleNationality')]
    private ?Nation $nationality = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $nationalityDate = null;

    #[ORM\OneToMany(mappedBy: 'person', targetEntity: Visa::class)]
    private Collection $visas;

    #[ORM\OneToMany(mappedBy: 'person', targetEntity: Passport::class)]
    private Collection $passports;

    #[ORM\ManyToOne(inversedBy: 'peopleBirthCountry')]
    private ?Nation $birthCountry = null;

    #[ORM\OneToOne(inversedBy: 'person', cascade: ['persist', 'remove'])]
    private ?Customer $customer = null;

    #[ORM\OneToMany(mappedBy: 'person', targetEntity: Notarize::class)]
    private Collection $notarizes;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $residenceAdressDate = null;

    #[ORM\OneToOne(mappedBy: 'person', cascade: ['persist', 'remove'])]
    private ?Photo $photo = null;

    #[ORM\Column(nullable: true)]
    private ?bool $complete = null;

    #[ORM\Column(nullable: true)]
    private ?bool $consularCard = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $consularCardId = null;

    public function __construct()
    {
        $this->visas = new ArrayCollection();
        $this->passports = new ArrayCollection();
        $this->notarizes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getMaidenname(): ?string
    {
        return $this->maidenname;
    }

    public function setMaidenname(?string $maidenname): static
    {
        $this->maidenname = $maidenname;

        return $this;
    }

    public function getSpouseName(): ?string
    {
        return $this->spouseName;
    }

    public function setSpouseName(?string $spouseName): static
    {
        $this->spouseName = $spouseName;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(?string $profession): static
    {
        $this->profession = $profession;

        return $this;
    }

    public function getMaritalStatus(): ?MaritalStatus
    {
        return $this->maritalStatus;
    }

    public function setMaritalStatus(?MaritalStatus $maritalStatus): static
    {
        $this->maritalStatus = $maritalStatus;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(?string $job): static
    {
        $this->job = $job;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getHaircolor(): ?string
    {
        return $this->haircolor;
    }

    public function setHaircolor(?string $haircolor): static
    {
        $this->haircolor = $haircolor;

        return $this;
    }

    public function getEyecolor(): ?string
    {
        return $this->eyecolor;
    }

    public function setEyecolor(?string $eyecolor): static
    {
        $this->eyecolor = $eyecolor;

        return $this;
    }

    public function getSpouseNationality(): ?Nation
    {
        return $this->spouseNationality;
    }

    public function setSpouseNationality(?Nation $spouseNationality): static
    {
        $this->spouseNationality = $spouseNationality;

        return $this;
    }

    public function getGender(): ?Gender
    {
        return $this->gender;
    }

    public function setGender(?Gender $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getNationalType(): ?NationalType
    {
        return $this->nationalType;
    }

    public function setNationalType(?NationalType $nationalType): static
    {
        $this->nationalType = $nationalType;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): static
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getBirthplace(): ?string
    {
        return $this->birthplace;
    }

    public function setBirthplace(?string $birthplace): static
    {
        $this->birthplace = $birthplace;

        return $this;
    }

    public function getOrigin(): ?Nation
    {
        return $this->origin;
    }

    public function setOrigin(?Nation $origin): static
    {
        $this->origin = $origin;

        return $this;
    }

    public function getResidenceCountry(): ?Nation
    {
        return $this->residenceCountry;
    }

    public function setResidenceCountry(?Nation $residenceCountry): static
    {
        $this->residenceCountry = $residenceCountry;

        return $this;
    }

    public function getArrivalDate(): ?\DateTimeInterface
    {
        return $this->arrivalDate;
    }

    public function setArrivalDate(?\DateTimeInterface $arrivalDate): static
    {
        $this->arrivalDate = $arrivalDate;

        return $this;
    }

    public function isCriminalRecord(): ?bool
    {
        return $this->criminalRecord;
    }

    public function setCriminalRecord(?bool $criminalRecord): static
    {
        $this->criminalRecord = $criminalRecord;

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

    public function getResidenceAdress(): ?string
    {
        return $this->residenceAdress;
    }

    public function setResidenceAdress(?string $residenceAdress): static
    {
        $this->residenceAdress = $residenceAdress;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): static
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;

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

    public function getBirthCertificateNumber(): ?string
    {
        return $this->birthCertificateNumber;
    }

    public function setBirthCertificateNumber(?string $birthCertificateNumber): static
    {
        $this->birthCertificateNumber = $birthCertificateNumber;

        return $this;
    }

    public function getBirthCertificateDate(): ?\DateTimeInterface
    {
        return $this->birthCertificateDate;
    }

    public function setBirthCertificateDate(?\DateTimeInterface $birthCertificateDate): static
    {
        $this->birthCertificateDate = $birthCertificateDate;

        return $this;
    }

    public function getBirthCertificateOrganisation(): ?string
    {
        return $this->birthCertificateOrganisation;
    }

    public function setBirthCertificateOrganisation(?string $birthCertificateOrganisation): static
    {
        $this->birthCertificateOrganisation = $birthCertificateOrganisation;

        return $this;
    }

    public function getJudgementNumber(): ?string
    {
        return $this->judgementNumber;
    }

    public function setJudgementNumber(?string $judgementNumber): static
    {
        $this->judgementNumber = $judgementNumber;

        return $this;
    }

    public function getBirthCertificateDeclarant(): ?string
    {
        return $this->birthCertificateDeclarant;
    }

    public function setBirthCertificateDeclarant(?string $birthCertificateDeclarant): static
    {
        $this->birthCertificateDeclarant = $birthCertificateDeclarant;

        return $this;
    }

    public function getFatherName(): ?string
    {
        return $this->fatherName;
    }

    public function setFatherName(?string $fatherName): static
    {
        $this->fatherName = $fatherName;

        return $this;
    }

    public function getMotherName(): ?string
    {
        return $this->motherName;
    }

    public function setMotherName(?string $motherName): static
    {
        $this->motherName = $motherName;

        return $this;
    }

    public function getFatherProfession(): ?string
    {
        return $this->fatherProfession;
    }

    public function setFatherProfession(?string $fatherProfession): static
    {
        $this->fatherProfession = $fatherProfession;

        return $this;
    }

    public function getMotherProfession(): ?string
    {
        return $this->motherProfession;
    }

    public function setMotherProfession(?string $motherProfession): static
    {
        $this->motherProfession = $motherProfession;

        return $this;
    }

    public function getParentEmail(): ?string
    {
        return $this->parentEmail;
    }

    public function setParentEmail(?string $parentEmail): static
    {
        $this->parentEmail = $parentEmail;

        return $this;
    }

    public function getParentTelephone(): ?string
    {
        return $this->parentTelephone;
    }

    public function setParentTelephone(?string $parentTelephone): static
    {
        $this->parentTelephone = $parentTelephone;

        return $this;
    }

    public function getFatherAddress(): ?string
    {
        return $this->fatherAddress;
    }

    public function setFatherAddress(?string $fatherAddress): static
    {
        $this->fatherAddress = $fatherAddress;

        return $this;
    }

    public function getMotherAddress(): ?string
    {
        return $this->motherAddress;
    }

    public function setMotherAddress(?string $motherAddress): static
    {
        $this->motherAddress = $motherAddress;

        return $this;
    }

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment(?string $department): static
    {
        $this->department = $department;

        return $this;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function setDistrict(?string $district): static
    {
        $this->district = $district;

        return $this;
    }

    public function getEmergencyPersonFirstname(): ?string
    {
        return $this->emergencyPersonFirstname;
    }

    public function setEmergencyPersonFirstname(?string $emergencyPersonFirstname): static
    {
        $this->emergencyPersonFirstname = $emergencyPersonFirstname;

        return $this;
    }

    public function getEmergencyPersonSurname(): ?string
    {
        return $this->emergencyPersonSurname;
    }

    public function setEmergencyPersonSurname(?string $emergencyPersonSurname): static
    {
        $this->emergencyPersonSurname = $emergencyPersonSurname;

        return $this;
    }

    public function getEmergencyPersonAddress(): ?string
    {
        return $this->emergencyPersonAddress;
    }

    public function setEmergencyPersonAddress(?string $emergencyPersonAddress): static
    {
        $this->emergencyPersonAddress = $emergencyPersonAddress;

        return $this;
    }

    public function getEmergencyPersonTelephone(): ?string
    {
        return $this->emergencyPersonTelephone;
    }

    public function setEmergencyPersonTelephone(?string $emergencyPersonTelephone): static
    {
        $this->emergencyPersonTelephone = $emergencyPersonTelephone;

        return $this;
    }

    public function getEmergencyPersonLink(): ?string
    {
        return $this->emergencyPersonLink;
    }

    public function setEmergencyPersonLink(?string $emergencyPersonLink): static
    {
        $this->emergencyPersonLink = $emergencyPersonLink;

        return $this;
    }

    public function getIdentityType(): ?IdentityType
    {
        return $this->identityType;
    }

    public function setIdentityType(?IdentityType $identityType): static
    {
        $this->identityType = $identityType;

        return $this;
    }

    public function getIdentityNumber(): ?int
    {
        return $this->identityNumber;
    }

    public function setIdentityNumber(?int $identityNumber): static
    {
        $this->identityNumber = $identityNumber;

        return $this;
    }

    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(?\DateTimeInterface $deliveryDate): static
    {
        $this->deliveryDate = $deliveryDate;

        return $this;
    }

    public function getExpirationDate(): ?\DateTimeInterface
    {
        return $this->expirationDate;
    }

    public function setExpirationDate(?\DateTimeInterface $expirationDate): static
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    public function getDeliveredBy(): ?string
    {
        return $this->deliveredBy;
    }

    public function setDeliveredBy(?string $deliveredBy): static
    {
        $this->deliveredBy = $deliveredBy;

        return $this;
    }

    public function getDeliveryPlace(): ?string
    {
        return $this->deliveryPlace;
    }

    public function setDeliveryPlace(?string $deliveryPlace): static
    {
        $this->deliveryPlace = $deliveryPlace;

        return $this;
    }

    public function getNationality(): ?Nation
    {
        return $this->nationality;
    }

    public function setNationality(?Nation $nationality): static
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getNationalityDate(): ?\DateTimeInterface
    {
        return $this->nationalityDate;
    }

    public function setNationalityDate(?\DateTimeInterface $nationalityDate): static
    {
        $this->nationalityDate = $nationalityDate;

        return $this;
    }

    /**
     * @return Collection<int, Visa>
     */
    public function getVisas(): Collection
    {
        return $this->visas;
    }

    public function addVisa(Visa $visa): static
    {
        if (!$this->visas->contains($visa)) {
            $this->visas->add($visa);
            $visa->setPerson($this);
        }

        return $this;
    }

    public function removeVisa(Visa $visa): static
    {
        if ($this->visas->removeElement($visa)) {
            // set the owning side to null (unless already changed)
            if ($visa->getPerson() === $this) {
                $visa->setPerson(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Passport>
     */
    public function getPassports(): Collection
    {
        return $this->passports;
    }

    public function addPassport(Passport $passport): static
    {
        if (!$this->passports->contains($passport)) {
            $this->passports->add($passport);
            $passport->setPerson($this);
        }

        return $this;
    }

    public function removePassport(Passport $passport): static
    {
        if ($this->passports->removeElement($passport)) {
            // set the owning side to null (unless already changed)
            if ($passport->getPerson() === $this) {
                $passport->setPerson(null);
            }
        }

        return $this;
    }

    public function getBirthCountry(): ?Nation
    {
        return $this->birthCountry;
    }

    public function setBirthCountry(?Nation $birthCountry): static
    {
        $this->birthCountry = $birthCountry;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return Collection<int, Notarize>
     */
    public function getNotarizes(): Collection
    {
        return $this->notarizes;
    }

    public function addNotarize(Notarize $notarize): static
    {
        if (!$this->notarizes->contains($notarize)) {
            $this->notarizes->add($notarize);
            $notarize->setPerson($this);
        }

        return $this;
    }

    public function removeNotarize(Notarize $notarize): static
    {
        if ($this->notarizes->removeElement($notarize)) {
            // set the owning side to null (unless already changed)
            if ($notarize->getPerson() === $this) {
                $notarize->setPerson(null);
            }
        }

        return $this;
    }

    public function getResidenceAdressDate(): ?\DateTimeInterface
    {
        return $this->residenceAdressDate;
    }

    public function setResidenceAdressDate(?\DateTimeInterface $residenceAdressDate): static
    {
        $this->residenceAdressDate = $residenceAdressDate;

        return $this;
    }

    public function getPhoto(): ?Photo
    {
        return $this->photo;
    }

    public function setPhoto(?Photo $photo): static
    {
        // unset the owning side of the relation if necessary
        if ($photo === null && $this->photo !== null) {
            $this->photo->setPerson(null);
        }

        // set the owning side of the relation if necessary
        if ($photo !== null && $photo->getPerson() !== $this) {
            $photo->setPerson($this);
        }

        $this->photo = $photo;

        return $this;
    }

    public function isComplete(): ?bool
    {
        return $this->complete;
    }

    public function setComplete(?bool $complete): static
    {
        $this->complete = $complete;

        return $this;
    }

    public function isConsularCard(): ?bool
    {
        return $this->consularCard;
    }

    public function setConsularCard(?bool $consularCard): static
    {
        $this->consularCard = $consularCard;

        return $this;
    }

    public function getConsularCardId(): ?string
    {
        return $this->consularCardId;
    }

    public function setConsularCardId(?string $consularCardId): static
    {
        $this->consularCardId = $consularCardId;

        return $this;
    }


}
