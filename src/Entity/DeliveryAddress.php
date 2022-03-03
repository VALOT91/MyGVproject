<?php

namespace App\Entity;

use App\Repository\DeliveryAddressRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeliveryAddressRepository::class)]
class DeliveryAddress
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(inversedBy: 'deliveryAddress', targetEntity: CommandShop::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $commandShop;

    #[ORM\Column(type: 'string', length: 255)]
    private $country;

    #[ORM\Column(type: 'string', length: 255)]
    private $city;

    #[ORM\Column(type: 'string', length: 255)]
    private $postalCode;

    #[ORM\Column(type: 'string', length: 255)]
    private $street;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $complement;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $commentary;

    #[ORM\Column(type: 'string', length: 255)]
    private $raisonSoc;

   
    private $CGV;

    // #[ORM\OneToOne(inversedBy: 'deliveryAddress', targetEntity: CommandShop::class, cascade: ['persist', 'remove'])]
    // #[ORM\JoinColumn(nullable: false)]
    // private $commandShop;

    public function getId(): ?int
    {
        return $this->id;
    }

    // public function getCGV(): ?string
    // {
    //     return $this->CGV;
    // }

    // public function setCGV(?string $CGV): self
    // {
    //     $this->CGV = $CGV;

    //     return $this;
    // }



    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getComplement(): ?string
    {
        return $this->complement;
    }

    public function setComplement(string $complement): self
    {
        $this->complement = $complement;

        return $this;
    }

    public function getCommentary(): ?string
    {
        return $this->commentary;
    }

    public function setCommentary(string $commentary): self
    {
        $this->commentary = $commentary;

        return $this;
    }

    public function getCommandShop(): ?CommandShop
    {
        return $this->commandShop;
    }

    public function setCommandShop(CommandShop $commandShop): self
    {
        $this->commandShop = $commandShop;

        return $this;
    }

    public function getRaisonSoc(): ?string
    {
        return $this->raisonSoc;
    }

    public function setRaisonSoc(string $raisonSoc): self
    {
        $this->raisonSoc = $raisonSoc;

        return $this;
    }


}




