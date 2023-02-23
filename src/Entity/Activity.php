<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivityRepository::class)]
class Activity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Activity = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $InvoiceDescription = null;

    #[ORM\Column(nullable: true)]
    private ?bool $Deleted = null;

    #[ORM\OneToMany(mappedBy: 'Activity', targetEntity: HourRegistration::class)]
    private Collection $hourRegistrations;

    public function __construct()
    {
        $this->hourRegistrations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActivity(): ?string
    {
        return $this->Activity;
    }

    public function setActivity(string $Activity): self
    {
        $this->Activity = $Activity;

        return $this;
    }

    public function getInvoiceDescription(): ?string
    {
        return $this->InvoiceDescription;
    }

    public function setInvoiceDescription(?string $InvoiceDescription): self
    {
        $this->InvoiceDescription = $InvoiceDescription;

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
            $hourRegistration->setActivity($this);
        }

        return $this;
    }

    public function removeHourRegistration(HourRegistration $hourRegistration): self
    {
        if ($this->hourRegistrations->removeElement($hourRegistration)) {
            // set the owning side to null (unless already changed)
            if ($hourRegistration->getActivity() === $this) {
                $hourRegistration->setActivity(null);
            }
        }

        return $this;
    }
}
