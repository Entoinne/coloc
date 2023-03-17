<?php

namespace App\Entity;

use App\Repository\AppartementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppartementRepository::class)]
class Appartement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(length: 255)]
    private ?string $Address = null;

    #[ORM\Column(nullable: true)]
    private ?int $StreetNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $City = null;

    #[ORM\Column]
    private ?float $LivingSpace = null;

    #[ORM\Column(nullable: true)]
    private ?float $Price = null;

    #[ORM\Column]
    private ?int $Owner = null;

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

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    public function getStreetNumber(): ?int
    {
        return $this->StreetNumber;
    }

    public function setStreetNumber(?int $StreetNumber): self
    {
        $this->StreetNumber = $StreetNumber;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(string $City): self
    {
        $this->City = $City;

        return $this;
    }

    public function getLivingSpace(): ?float
    {
        return $this->LivingSpace;
    }

    public function setLivingSpace(float $LivingSpace): self
    {
        $this->LivingSpace = $LivingSpace;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(?float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getOwner(): ?int
    {
        return $this->Owner;
    }

    public function setOwner(int $Owner): self
    {
        $this->Owner = $Owner;

        return $this;
    }
}
