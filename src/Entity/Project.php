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

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'company')]
    #[ORM\JoinColumn(nullable: false)]
    private ?self $company = null;

    #[ORM\ManyToOne(inversedBy: 'projects')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Company $Company = null;

    public function __construct()
    {
        $this->company = new ArrayCollection();
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

    public function getCompany(): ?self
    {
        return $this->company;
    }

    public function setCompany(?self $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function addCompany(self $company): self
    {
        if (!$this->company->contains($company)) {
            $this->company->add($company);
            $company->setCompany($this);
        }

        return $this;
    }

    public function removeCompany(self $company): self
    {
        if ($this->company->removeElement($company)) {
            // set the owning side to null (unless already changed)
            if ($company->getCompany() === $this) {
                $company->setCompany(null);
            }
        }

        return $this;
    }
}
