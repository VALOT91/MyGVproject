<?php 

namespace App\Search;

class SearchTarif
{
    private $filterByReference;

    private $filterByProduct;

    private $filterByTarifType;


    /**
     * Get the value of filterByReference
     */ 
    public function getFilterByReference()
    {
        return $this->filterByReference;
    }

    /**
     * Set the value of filterByReference
     *
     * @return  self
     */ 
    public function setFilterByReference($filterByReference)
    {
        $this->filterByReference = $filterByReference;

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
     /**
     * Get the value of filterByProduct
     */ 
    public function getFilterByTarifType()
    {
        return $this->filterByTarifType;
    }

    /**
     * Set the value of filterByType
     *
     * @return  self
     */ 
    public function setFilterByTarifType($filterByTarifType)
    {
        $this->filterByTarifType = $filterByTarifType;

        return $this;
    }

     
}