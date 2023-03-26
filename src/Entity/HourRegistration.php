<?php

namespace App\Entity;

use App\Repository\HourRegistrationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HourRegistrationRepository::class)]
class HourRegistration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $Description = null;

    #[ORM\Column]
    private ?float $HourlyCost = null;

    #[ORM\Column(nullable: true)]
    private ?float $Time = null;

    #[ORM\Column(nullable: true)]
    private ?bool $Deleted = null;

    #[ORM\ManyToOne(inversedBy: 'hourRegistrations')]
    private ?Invoice $Invoice = null;

    #[ORM\ManyToOne(inversedBy: 'hourRegistrations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Activity $Activity = null;

    #[ORM\ManyToOne(inversedBy: 'hourRegistrations')]
    private ?Company $company = null;

    #[ORM\ManyToOne(inversedBy: 'hourRegistrations')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'hourRegistrations')]
    private ?Project $project = null;

    #[ORM\Column(nullable: true)]
    private ?bool $addToInvoice = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

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

    public function getHourlyCost(): ?float
    {
        return $this->HourlyCost;
    }

    public function setHourlyCost(float $HourlyCost): self
    {
        $this->HourlyCost = $HourlyCost;

        return $this;
    }

    public function getTime(): ?float
    {
        return $this->Time;
    }

    public function setTime(?float $Time): self
    {
        $this->Time = $Time;

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

    public function getInvoice(): ?Invoice
    {
        return $this->Invoice;
    }

    public function setInvoice(?Invoice $Invoice): self
    {
        $this->Invoice = $Invoice;

        return $this;
    }

    public function getActivity(): ?Activity
    {
        return $this->Activity;
    }

    public function setActivity(?Activity $Activity): self
    {
        $this->Activity = $Activity;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function isAddToInvoice(): ?bool
    {
        return $this->addToInvoice;
    }

    public function setAddToInvoice(?bool $addToInvoice): self
    {
        $this->addToInvoice = $addToInvoice;

        return $this;
    }

}
