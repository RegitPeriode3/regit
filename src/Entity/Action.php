<?php

namespace App\Entity;

use App\Repository\ActionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActionRepository::class)]
class Action
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $Description = null;

    #[ORM\Column(nullable: true)]
    private ?float $HourlyCost = null;

    #[ORM\Column]
    private ?float $Time = null;

    #[ORM\ManyToOne(inversedBy: 'actions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    #[ORM\Column(nullable: true)]
    private ?bool $Deleted = null;

    #[ORM\ManyToOne(inversedBy: 'actions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Activity $Activitiy = null;

    #[ORM\ManyToOne(inversedBy: 'actions')]
    private ?Invoice $Invoice = null;

    #[ORM\ManyToOne(inversedBy: 'actions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Company $Company = null;

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

    public function setHourlyCost(?float $HourlyCost): self
    {
        $this->HourlyCost = $HourlyCost;

        return $this;
    }

    public function getTime(): ?float
    {
        return $this->Time;
    }

    public function setTime(float $Time): self
    {
        $this->Time = $Time;

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

    public function isDeleted(): ?bool
    {
        return $this->Deleted;
    }

    public function setDeleted(?bool $Deleted): self
    {
        $this->Deleted = $Deleted;

        return $this;
    }

    public function getActivitiy(): ?Activity
    {
        return $this->Activitiy;
    }

    public function setActivitiy(?Activity $Activitiy): self
    {
        $this->Activitiy = $Activitiy;

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

    public function getCompany(): ?Company
    {
        return $this->Company;
    }

    public function setCompany(?Company $Company): self
    {
        $this->Company = $Company;

        return $this;
    }
}
