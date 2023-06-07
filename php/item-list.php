<?php
include "./database.php";

function getProductList($db)
{
    
    $getProductList = $db->prepare(
        "SELECT *
        FROM products"
    );
    $getProductList->execute();
    $productList = $getProductList->fetchAll($mode = PDO::FETCH_ASSOC);
    return $productList;
}


function getProduct($productName,$db) {
    $products = getProductList($db);



    return $products[$productName];
}