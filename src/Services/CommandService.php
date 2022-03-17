<?php 

namespace App\Services;

use App\Entity\Product;

 
   use App\Repository\ProduitConditionnementRepository;
   use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 

class CommandService extends AbstractController
{
   
    private $product;
    private $qte;
    private $unitPrice;
    private $conditionnement;
         
    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): self
    {
        $this->product = $product;

        return $this;
    }
    
    public function getQte(): int
    {
        return $this->qte;
    }

    public function setQte(int $qte): self
    {
        $this->qte = $qte;

        return $this;
    }
    
    public function getUnitPrice(): int
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(int $unitPrice): self
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }
    public function getConditionnement(): string
    {
        return $this->conditionnement;
    }

    public function setConditionnement(string $conditionnement): self
    {
        $this->conditionnement = $conditionnement;

        return $this;
    }
    public function getTotal(): int
    {
        return $this->unitPrice* $this->qte;
    }
   
}