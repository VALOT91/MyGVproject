<?php

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

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'commandShopLines')]
    #[ORM\JoinColumn(nullable: false)]
    private $produit;

    #[ORM\ManyToOne(targetEntity: CommandShop::class, inversedBy: 'commandShopLines')]
    private $commandShop;

    private $product;


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

    public function getProduit(): ?Product
    {
        return $this->produit;
    }

    public function setProduit(?Product $produit): self
    {
        $this->produit = $produit;

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

}
