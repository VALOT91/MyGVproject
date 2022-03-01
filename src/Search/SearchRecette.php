<?php 

namespace App\Search;

class SearchRecette
{
    private $filterByNom;

    private $filterByProduct;

   
    /**
     * Get the value of filterByNom
     */ 
    public function getFilterByNom()
    {
        return $this->filterByNom;
    }

    /**
     * Set the value of filterByReference
     *
     * @return  self
     */ 
    public function setFilterByNom($filterByNom)
    {
        $this->filterByNom = $filterByNom;

        return $this;
    }

    /**
     * Get the value of filterByProduct
     */ 
    public function getFilterByProduct()
    {
        return $this->filterByProduct;
    }

     /**
     * Set the value of filterByProduct
     *
     * @return  self
     */ 
    public function setFilterByProduct($filterByProduct)
    {
        $this->filterByProduct = $filterByProduct;

        return $this;
    }
     

    
     
}