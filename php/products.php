<?php
class products
{
    public string $productName, $productDescription, $productImgURL;
    public int $productPrice, $productWeight, $productStock;
    public bool $productAvailability;

    function __construct($productName, $productDescription, $productPrice, $productWeight,$productStock)
    {
        $this->productName = $productName;
        $this->productDescription = $productDescription;
        $this->productPrice = $productPrice;
        $this->productWeight = $productWeight;
        $this->productStock = $productStock;
    }

    function addProductStock(int $addToStock)
    {
        $this->productStock += $addToStock;
    }
    function getProductStock(): int
    {
        return $this->productStock;
    }
   
    function getProductAvailability(): bool
    {
        if ($this->productStock > 0) {
           return true;
        } else {
           return false;
        }
        
    }
}
