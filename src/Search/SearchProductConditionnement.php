<?php 

namespace App\Search;

class SearchProductConditionnement
{
    private $filterByReference;

    private $filterByProduct;

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
}