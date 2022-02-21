<?php

namespace App\Entity;

 
class Article  
{

    
    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getProduitConditionnements(): Array
    {
        return $this->produitConditionnements;
    }

    public function setProduitConditionnements(Array $produitConditionnements): self
    {
        $this->produitConditionnements = $produitConditionnements;

        return $this;
    }

    public function getConditionnements(): Array
    {
        return $this->conditionnements;
    }

    public function setConditionnements(Array $conditionnements): self
    {
        $this->conditionnements = $conditionnements;

        return $this;
    }

    public function getTarifs(): Array
    {
        return $this->tarifs;
    }

    public function setTarifs(Array $tarifs): self
    {
        $this->tarifs = $tarifs;

        return $this;
    }


}