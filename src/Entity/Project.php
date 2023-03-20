<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $Description = null;

    #[ORM\ManyToOne(inversedBy: 'projects')]
    private ?Company $company = null;

    #[ORM\Column]
    private ?bool $Deleted = null;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: HourRegistration::class)]
    private Collection $hourRegistrations;

    public function __construct()
    {
        $this->hourRegistrations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

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
            $hourRegistration->setProject($this);
        }

        return $this;
    }

    public function removeHourRegistration(HourRegistration $hourRegistration): self
    {
        if ($this->hourRegistrations->removeElement($hourRegistration)) {
            // set the owning side to null (unless already changed)
            if ($hourRegistration->getProject() === $this) {
                $hourRegistration->setProject(null);
            }
        }

        return $this;
    }

}
