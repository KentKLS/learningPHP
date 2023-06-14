<?php
require_once 'database.php';
require_once 'product.php';
require_once 'UsedProduct.php';

class Catalog
{
    public array $productList;
    function __construct()
    {
        $db = new PDO('mysql:host=localhost;dbname=new_e-commerce;charset=utf8', 'Quentin', '');
        $products = getProductList($db);
        foreach ($products as $product) {
            $this->productList[] = new Product(
                $product['product_name'],
                $product['product_description'],
                $product['product_price'],
                $product['product_weight'],
                $product['product_imgURL'],
                $product['product_quantity_available'],
                $product['is_used']
            );
        }
        $usedProducts = getUsedProductList($db);
        foreach ($this->productList as $key => $product) {
            if ($product->productIsUsed >0) {
                $this->productList[$key] = new UsedProduct(
                    $product->productName,
                    $product->productDescription,
                    $product->productPrice,
                    $product->productWeight,
                    $product->productImgURL,
                    $product->productStock,
                    $product->productIsUsed,
                    $usedProducts[$key]['mileage'],
                    $usedProducts[$key]['condition']
                );
            }
        }
        
    }
}
