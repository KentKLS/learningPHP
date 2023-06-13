<?php
class Product
{
    public string $productName, $productDescription, $productImgURL;
    public int $productPrice, $productWeight, $productStock;
    public bool $productAvailability;

    function __construct($productName, $productDescription, $productPrice, $productWeight,$productImgURL, $productStock)
    {
        $this->productName = $productName;
        $this->productDescription = $productDescription;
        $this->productPrice = $productPrice;
        $this->productWeight = $productWeight;
        $this->productImgURL= $productImgURL;
        $this->productStock = $productStock;
        $this->productAvailability = $this->getProductAvailability();
    }

    public function addProductStock(int $addToStock): void
    {
        $this->productStock += $addToStock;
    }
    public function getProductStock(): int
    {
        return $this->productStock;
    }

    public function getProductAvailability(): bool
    {
        return $this->productStock > 0;
    }
    
}
