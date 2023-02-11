<?php

namespace App\Entity;

use App\Repository\ConfigurationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConfigurationRepository::class)]
class Configuration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $NameSender = null;

    #[ORM\Column(length: 60)]
    private ?string $EmailSender = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $SmtpServer = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $SmtpPort = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Username = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Password = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameSender(): ?string
    {
        return $this->NameSender;
    }

    public function setNameSender(?string $NameSender): self
    {
        $this->NameSender = $NameSender;

        return $this;
    }

    public function getEmailSender(): ?string
    {
        return $this->EmailSender;
    }

    public function setEmailSender(string $EmailSender): self
    {
        $this->EmailSender = $EmailSender;

        return $this;
    }

    public function getSmtpServer(): ?string
    {
        return $this->SmtpServer;
    }

    public function setSmtpServer(?string $SmtpServer): self
    {
        $this->SmtpServer = $SmtpServer;

        return $this;
    }

    public function getSmtpPort(): ?string
    {
        return $this->SmtpPort;
    }

    public function setSmtpPort(?string $SmtpPort): self
    {
        $this->SmtpPort = $SmtpPort;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->Username;
    }

    public function setUsername(?string $Username): self
    {
        $this->Username = $Username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(?string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }
}
