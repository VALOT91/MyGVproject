<?php 

namespace App\Search;

class SearchArticles
{
    private $filterByKeyWords;

    

    /**
     * Get the value of filterByName
     */ 
    public function getFilterByKeyWords()
    {
        return $this->filterByKeyWords;
    }

    /**
     * Set the value of filterByName
     *
     * @return  self
     */ 
    public function setFilterByKeyWords($filterByKeyWords)
    {
        $this->filterByKeyWords = $filterByKeyWords;

        return $this;
    }
    
}