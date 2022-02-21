<?php 

namespace App\Services;


class CartRealProduct
{
    private $product;

    private $qty;

    private $typePrice;

    private $price;

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct($product)
    {
        $this->product = $product;
        return $this;
    }

    public function getQty()
    {
        return $this->qty;
    }

    public function setQty($qty)
    {
        $this->qty =$qty;
        return $this;
    }


    public function getTypePrice()
    {
        return $this->typePrice;
    }

    public function setTypePrice($typePrice)
    {
        $this->typePrice =$typePrice;
        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price =$price;
        return $this;
    }

    public function getTotal()
    {
        return  $this->price * $this->qty;;
    }

   
}