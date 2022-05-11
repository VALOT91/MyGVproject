<?php

// Entité  commandeShopLine () ligne détail )

namespace App\Entity;

use App\Repository\CommandShopLineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandShopLineRepository::class)]
class CommandShopLine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $quantity;

    #[ORM\ManyToOne(targetEntity: CommandShop::class, inversedBy: 'commandShopLines')]
    private $commandShop;

    private $product;

    #[ORM\Column(type: 'integer')]
    private $produit_id;

    #[ORM\Column(type: 'integer')]
    private $unitPrice;

    #[ORM\Column(type: 'string', length: 255)]
    private $conditionnement;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCommandShop(): ?CommandShop
    {
        return $this->commandShop;
    }

    public function setCommandShop(?CommandShop $commandShop): self
    {
        $this->commandShop = $commandShop;

        return $this;
    }

    public function getProduct(): ?Product  
      {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    // public function getProductId(): ?int
    // {
    //     return $this->product_id;
    // }

    // public function setProductId(int $product_id): self
    // {
    //     $this->product_id = $product_id;

    //     return $this;
    // }

    public function getProduitId(): ?int
    {
        return $this->produit_id;
    }

    public function setProduitId(int $produit_id): self
    {
        $this->produit_id = $produit_id;

        return $this;
    }

    public function getUnitPrice(): ?int
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(int $unitPrice): self
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    public function getConditionnement(): ?string
    {
        return $this->conditionnement;
    }

    public function setConditionnement(string $conditionnement): self
    {
        $this->conditionnement = $conditionnement;

        return $this;
    }

}
