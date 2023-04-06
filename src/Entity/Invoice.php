<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    #[ORM\Column(nullable: true)]
    private ?float $BTW = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $DocLink = null;

    #[ORM\Column(nullable: true)]
    private ?bool $Deleted = null;

    #[ORM\OneToMany(mappedBy: 'Invoice', targetEntity: HourRegistration::class)]
    private Collection $hourRegistrations;

    #[ORM\Column(length: 25, nullable: true)]
    private ?int $invoiceNumber = null;

    public function __construct()
    {
        $this->hourRegistrations = new ArrayCollection();
    }

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

    public function getBTW(): ?float
    {
        return $this->BTW;
    }

    public function setBTW(?float $BTW): self
    {
        $this->BTW = $BTW;

        return $this;
    }

    public function getDocLink(): ?string
    {
        return $this->DocLink;
    }

    public function setDocLink(?string $DocLink): self
    {
        $this->DocLink = $DocLink;

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
            $hourRegistration->setInvoice($this);
        }

        return $this;
    }

    public function removeHourRegistration(HourRegistration $hourRegistration): self
    {
        if ($this->hourRegistrations->removeElement($hourRegistration)) {
            // set the owning side to null (unless already changed)
            if ($hourRegistration->getInvoice() === $this) {
                $hourRegistration->setInvoice(null);
            }
        }

        return $this;
    }

    public function getInvoiceNumber(): ?string
    {
        return $this->invoiceNumber;
    }

    public function setInvoiceNumber(?string $invoiceNumber): self
    {
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }
}
