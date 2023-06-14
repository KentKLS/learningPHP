<?php
require_once 'product.php';
class UsedProduct extends Product
{
    public int $mileage;
    public string $carCondition;

    function __construct(
        $productName,
        $productDescription,
        $productPrice,
        $productWeight,
        $productImgURL,
        $productStock,
        $productIsUsed,
        $mileage,
        $carCondition
    ) {
        parent::__construct(
            $productName,
            $productDescription,
            $productPrice,
            $productWeight,
            $productImgURL,
            $productStock,
            $productIsUsed
        );
        $this->mileage = $mileage;
        $this->carCondition = $carCondition;
    }
}
