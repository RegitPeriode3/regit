<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?float $Rate = null;

    #[ORM\Column(nullable: true)]
    private ?bool $Deleted = null;

    #[ORM\ManyToOne(inversedBy: 'employees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    #[ORM\ManyToOne(inversedBy: 'employees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Company $Company = null;

    #[ORM\OneToMany(mappedBy: 'Employee', targetEntity: HourRegistration::class)]
    private Collection $hourRegistrations;

    public function __construct()
    {
        $this->hourRegistrations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRate(): ?float
    {
        return $this->Rate;
    }

    public function setRate(?float $Rate): self
    {
        $this->Rate = $Rate;

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

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->Company;
    }

    public function setCompany(?Company $Company): self
    {
        $this->Company = $Company;

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
            $hourRegistration->setEmployee($this);
        }

        return $this;
    }

    public function removeHourRegistration(HourRegistration $hourRegistration): self
    {
        if ($this->hourRegistrations->removeElement($hourRegistration)) {
            // set the owning side to null (unless already changed)
            if ($hourRegistration->getEmployee() === $this) {
                $hourRegistration->setEmployee(null);
            }
        }

        return $this;
    }
}
