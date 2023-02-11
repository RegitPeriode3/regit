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
    private ?string $InvoiceAdress = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Name = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $Country = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Adress = null;

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

    #[ORM\OneToMany(mappedBy: 'Company', targetEntity: Action::class)]
    private Collection $actions;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Configuration $Configuration = null;

    public function __construct()
    {
        $this->actions = new ArrayCollection();
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

    public function getInvoiceAdress(): ?string
    {
        return $this->InvoiceAdress;
    }

    public function setInvoiceAdress(?string $InvoiceAdress): self
    {
        $this->InvoiceAdress = $InvoiceAdress;

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

    public function getAdress(): ?string
    {
        return $this->Adress;
    }

    public function setAdress(?string $Adress): self
    {
        $this->Adress = $Adress;

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

    /**
     * @return Collection<int, Action>
     */
    public function getActions(): Collection
    {
        return $this->actions;
    }

    public function addAction(Action $action): self
    {
        if (!$this->actions->contains($action)) {
            $this->actions->add($action);
            $action->setCompany($this);
        }

        return $this;
    }

    public function removeAction(Action $action): self
    {
        if ($this->actions->removeElement($action)) {
            // set the owning side to null (unless already changed)
            if ($action->getCompany() === $this) {
                $action->setCompany(null);
            }
        }

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
}
