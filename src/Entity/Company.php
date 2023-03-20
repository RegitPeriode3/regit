<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $AccountNr = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $InvoiceAddress = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Name = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $Country = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Address = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $PhoneNr = null;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $Zipcode = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $Location = null;

    #[ORM\Column(nullable: true)]
    private ?bool $Active = null;

    #[ORM\Column(nullable: true)]
    private ?bool $Deleted = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    private ?Configuration $Configuration = null;

    #[ORM\OneToMany(mappedBy: 'Company', targetEntity: Employee::class)]
    private Collection $employees;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: Project::class)]
    private Collection $projects;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: HourRegistration::class)]
    private Collection $hourRegistrations;


    public function __construct()
    {
        $this->employees = new ArrayCollection();
        $this->projects = new ArrayCollection();
        $this->hourRegistrations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccountNr(): ?string
    {
        return $this->AccountNr;
    }

    public function setAccountNr(?string $AccountNr): self
    {
        $this->AccountNr = $AccountNr;

        return $this;
    }

    public function getInvoiceAddress(): ?string
    {
        return $this->InvoiceAddress;
    }

    public function setInvoiceAddress(?string $InvoiceAddress): self
    {
        $this->InvoiceAddress = $InvoiceAddress;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(?string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->Country;
    }

    public function setCountry(?string $Country): self
    {
        $this->Country = $Country;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(?string $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    public function getPhoneNr(): ?string
    {
        return $this->PhoneNr;
    }

    public function setPhoneNr(?string $PhoneNr): self
    {
        $this->PhoneNr = $PhoneNr;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->Zipcode;
    }

    public function setZipcode(?string $Zipcode): self
    {
        $this->Zipcode = $Zipcode;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->Location;
    }

    public function setLocation(?string $Location): self
    {
        $this->Location = $Location;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->Active;
    }

    public function setActive(?bool $Active): self
    {
        $this->Active = $Active;

        return $this;
    }

    public function isDeleted(): ?bool
    {
        return $this->Deleted;
    }

    public function setDeleted(?bool $Deleted): self
    {
        $this->Deleted = $Deleted;

        return $this;
    }

    public function getConfiguration(): ?Configuration
    {
        return $this->Configuration;
    }

    public function setConfiguration(Configuration $Configuration): self
    {
        $this->Configuration = $Configuration;

        return $this;
    }

    /**
     * @return Collection<int, Employee>
     */
    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    public function addEmployee(Employee $employee): self
    {
        if (!$this->employees->contains($employee)) {
            $this->employees->add($employee);
            $employee->setCompany($this);
        }

        return $this;
    }

    public function removeEmployee(Employee $employee): self
    {
        if ($this->employees->removeElement($employee)) {
            // set the owning side to null (unless already changed)
            if ($employee->getCompany() === $this) {
                $employee->setCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
            $project->setCompany($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->removeElement($project)) {
            // set the owning side to null (unless already changed)
            if ($project->getCompany() === $this) {
                $project->setCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, HourRegistration>
     */
    public function getHourRegistrations(): Collection
    {
        return $this->hourRegistrations;
    }

    public function addHourRegistration(HourRegistration $hourRegistration): self
    {
        if (!$this->hourRegistrations->contains($hourRegistration)) {
            $this->hourRegistrations->add($hourRegistration);
            $hourRegistration->setCompany($this);
        }

        return $this;
    }

    public function removeHourRegistration(HourRegistration $hourRegistration): self
    {
        if ($this->hourRegistrations->removeElement($hourRegistration)) {
            // set the owning side to null (unless already changed)
            if ($hourRegistration->getCompany() === $this) {
                $hourRegistration->setCompany(null);
            }
        }

        return $this;
    }

}
