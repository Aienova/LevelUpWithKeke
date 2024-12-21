<?php

namespace App\Entity;

use App\Repository\NationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NationRepository::class)]
class Nation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $frName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $enName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $deName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code = null;

    #[ORM\OneToMany(mappedBy: 'spouseNationality', targetEntity: Person::class)]
    private Collection $people;

    #[ORM\OneToMany(mappedBy: 'origin', targetEntity: Person::class)]
    private Collection $peopleOrigin;

    #[ORM\OneToMany(mappedBy: 'residenceCountry', targetEntity: Person::class)]
    private Collection $peopleResident;

    #[ORM\OneToMany(mappedBy: 'nationality', targetEntity: Person::class)]
    private Collection $PeopleNationality;

    #[ORM\OneToMany(mappedBy: 'birthCountry', targetEntity: Person::class)]
    private Collection $peopleBirthCountry;

    public function __construct()
    {
        $this->people = new ArrayCollection();
        $this->peopleOrigin = new ArrayCollection();
        $this->peopleResident = new ArrayCollection();
        $this->PeopleNationality = new ArrayCollection();
        $this->peopleBirthCountry = new ArrayCollection();
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

    public function getFrName(): ?string
    {
        return $this->frName;
    }

    public function setFrName(?string $frName): static
    {
        $this->frName = $frName;

        return $this;
    }

    public function getEnName(): ?string
    {
        return $this->enName;
    }

    public function setEnName(?string $enName): static
    {
        $this->enName = $enName;

        return $this;
    }

    public function getDeName(): ?string
    {
        return $this->deName;
    }

    public function setDeName(?string $deName): static
    {
        $this->deName = $deName;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): static
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection<int, Person>
     */
    public function getPeople(): Collection
    {
        return $this->people;
    }

    public function addPerson(Person $person): static
    {
        if (!$this->people->contains($person)) {
            $this->people->add($person);
            $person->setSpouseNationality($this);
        }

        return $this;
    }

    public function removePerson(Person $person): static
    {
        if ($this->people->removeElement($person)) {
            // set the owning side to null (unless already changed)
            if ($person->getSpouseNationality() === $this) {
                $person->setSpouseNationality(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Person>
     */
    public function getPeopleOrigin(): Collection
    {
        return $this->peopleOrigin;
    }

    public function addPeopleOrigin(Person $peopleOrigin): static
    {
        if (!$this->peopleOrigin->contains($peopleOrigin)) {
            $this->peopleOrigin->add($peopleOrigin);
            $peopleOrigin->setOrigin($this);
        }

        return $this;
    }

    public function removePeopleOrigin(Person $peopleOrigin): static
    {
        if ($this->peopleOrigin->removeElement($peopleOrigin)) {
            // set the owning side to null (unless already changed)
            if ($peopleOrigin->getOrigin() === $this) {
                $peopleOrigin->setOrigin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Person>
     */
    public function getPeopleResident(): Collection
    {
        return $this->peopleResident;
    }

    public function addPeopleResident(Person $peopleResident): static
    {
        if (!$this->peopleResident->contains($peopleResident)) {
            $this->peopleResident->add($peopleResident);
            $peopleResident->setResidenceCountry($this);
        }

        return $this;
    }

    public function removePeopleResident(Person $peopleResident): static
    {
        if ($this->peopleResident->removeElement($peopleResident)) {
            // set the owning side to null (unless already changed)
            if ($peopleResident->getResidenceCountry() === $this) {
                $peopleResident->setResidenceCountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Person>
     */
    public function getPeopleNationality(): Collection
    {
        return $this->PeopleNationality;
    }

    public function addPeopleNationality(Person $peopleNationality): static
    {
        if (!$this->PeopleNationality->contains($peopleNationality)) {
            $this->PeopleNationality->add($peopleNationality);
            $peopleNationality->setNationality($this);
        }

        return $this;
    }

    public function removePeopleNationality(Person $peopleNationality): static
    {
        if ($this->PeopleNationality->removeElement($peopleNationality)) {
            // set the owning side to null (unless already changed)
            if ($peopleNationality->getNationality() === $this) {
                $peopleNationality->setNationality(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Person>
     */
    public function getPeopleBirthCountry(): Collection
    {
        return $this->peopleBirthCountry;
    }

    public function addPeopleBirthCountry(Person $peopleBirthCountry): static
    {
        if (!$this->peopleBirthCountry->contains($peopleBirthCountry)) {
            $this->peopleBirthCountry->add($peopleBirthCountry);
            $peopleBirthCountry->setBirthCountry($this);
        }

        return $this;
    }

    public function removePeopleBirthCountry(Person $peopleBirthCountry): static
    {
        if ($this->peopleBirthCountry->removeElement($peopleBirthCountry)) {
            // set the owning side to null (unless already changed)
            if ($peopleBirthCountry->getBirthCountry() === $this) {
                $peopleBirthCountry->setBirthCountry(null);
            }
        }

        return $this;
    }
}
