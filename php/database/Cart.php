<?php
class Cart
{

    public array $cart;

    function __construct()
    {
        $this->cart = array();
    }

    public function addToCart($productId)
    {
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]++;
        } else {
            $this->cart[$productId] = 1;
        }
    }
    public function updateCart($productId, int $quantity)
    {
        if (isset($this->cart[$productId])) {
            $this->cart[$productId] = $quantity;
        } else {
            throw new Exception("cart not found");
        }
    }
    public function deleteCart($productId)
    {
        if (isset($this->cart[$productId])) {
            unset($this->cart[$productId]);
        }
    }

    public function setSessionCart(array $cart)
    {
        $this->cart = $cart;
    }

    public function getCart()
    {
        return $this->cart;
    }
}
