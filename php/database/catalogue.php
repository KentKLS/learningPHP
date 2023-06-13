<?php
require_once 'database.php';
require_once 'product.php';

class Catalog{
    public array $productList;
    public function __construct()
    {
        $db = new PDO('mysql:host=localhost;dbname=new_e-commerce;charset=utf8', 'Quentin', '');
        $products = getProductList($db);
        foreach($products as $product){
            $this->productList[]= new product( $product['product_name'],$product['product_description'],$product['product_price'],$product['product_weight'],$product['product_imgURL'],$product['product_quantity_available'])  ;      
        }
    }
}