<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $EmployeeID = null;

    #[ORM\Column(length: 40)]
    private ?string $DisplayName = null;

    #[ORM\Column(length: 255)]
    private ?string $UserName = null;

    #[ORM\Column(length: 255)]
    private ?string $Password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Email = null;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $PhoneNr = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $Country = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $Location = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $Zipcode = null;

    #[ORM\Column(length: 70, nullable: true)]
    private ?string $Address = null;

    #[ORM\Column(nullable: true)]
    private ?bool $Active = true;

    #[ORM\Column(nullable: true)]
    private ?bool $Deleted = false;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Clearence $Clearence = null;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: Employee::class)]
    private Collection $employees;

    public function __construct()
    {
        $this->employees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmployeeID(): ?int
    {
        return $this->EmployeeID;
    }

    public function setEmployeeID(int $EmployeeID): self
    {
        $this->EmployeeID = $EmployeeID;

        return $this;
    }

    public function getDisplayName(): ?string
    {
        return $this->DisplayName;
    }

    public function setDisplayName(string $DisplayName): self
    {
        $this->DisplayName = $DisplayName;

        return $this;
    }

    public function getUserName(): ?string
    {
        return $this->UserName;
    }

    public function setUserName(string $UserName): self
    {
        $this->UserName = $UserName;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

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

    public function getCountry(): ?string
    {
        return $this->Country;
    }

    public function setCountry(?string $Country): self
    {
        $this->Country = $Country;

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

    public function getZipcode(): ?string
    {
        return $this->Zipcode;
    }

    public function setZipcode(?string $Zipcode): self
    {
        $this->Zipcode = $Zipcode;

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

    public function isActive(): ?bool
    {
        return $this->Active;
    }

    public function setActive(bool $Active): self
    {
        $this->Active = $Active;

        return $this;
    }

    public function isDeleted(): ?bool
    {
        return $this->Deleted;
    }

    public function setDeleted(bool $Deleted): self
    {
        $this->Deleted = $Deleted;

        return $this;
    }

    public function getClearence(): ?Clearence
    {
        return $this->Clearence;
    }

    public function setClearence(?Clearence $Clearence): self
    {
        $this->Clearence = $Clearence;

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
            $employee->setUser($this);
        }

        return $this;
    }

    public function removeEmployee(Employee $employee): self
    {
        if ($this->employees->removeElement($employee)) {
            // set the owning side to null (unless already changed)
            if ($employee->getUser() === $this) {
                $employee->setUser(null);
            }
        }

        return $this;
    }
}
