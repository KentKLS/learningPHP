<?php 
class Cart{

    public array $cart;

    function __construct()
    {
        $this->cart = array();
    }

    public function addToCart($productId){
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]++;
        } else {
            $this->cart[$productId] = 1;
        }
    }
    public function updateCart($productId, $quantity){
        if (isset($this->cart[$productId])) {
            $this->cart[$productId] += $quantity;
        } else {
            $this->cart[$productId] = $quantity;
        }
    }
    public function deleteCart($productId){
        if (isset($this->cart[$productId])) {
            unset($this->cart[$productId]);
        }
    }

    public function getCart(){
        return $this->cart;
    }

    
}







