<?php
include "./database/database.php";


function formatPrice($price)
{

    echo number_format($price / 100, 2), " €";
}

function priceExcludingVAT($priceTTC, $VAT = 20)
{

    $priceHT = (100 * $priceTTC) / (100 + $VAT);
    return $priceHT;
}

function discountedPrice($price, $discount)
{
    if ($discount > 0) {
        $discountedPrice = $price - ($price * $discount / 100);
        return $discountedPrice;
    }

    return $price;
}

function priceTransporter($transporter, $weight, $price)
{
    if ($transporter == "laPoste") {
        if ($weight < 500) {
            $transporterPrice = 500;
        } elseif ($weight > 500 && $weight < 2000) {
            $transporterPrice = $price / 10;
        } else {
            $transporterPrice = 0;
        }
    } else if ($transporter == "chronoPost") {
        if ($weight < 500) {
            $transporterPrice = 499;
        } elseif ($weight > 500 && $weight < 2000) {
            $transporterPrice = $price / 7;
        } else {
            $transporterPrice = 1;
        }
    }
    return $transporterPrice;
}


function createProductsArray($productName, $numberOrdered, $db)
{
    $productList = getProductList($db);
    $i = 0;
    foreach ($productName as $name) {
        $productsArray[$i]["name"] = $productList[$i]["product_name"];
        $productsArray[$i]["price"] = $productList[$i]["product_price"];
        $productsArray[$i]["productID"] = $productList[$i]["product_id"];
        $productsArray[$i]["weight"] = $productList[$i]["product_weight"];



        $i++;
    }

    $i = 0;
    foreach ($numberOrdered as $number) {
        $productsArray[$i]["numberOrdered"] = $number;
        $i++;
    }
    return $productsArray;
}


function myDump($variable)
{
    echo '<pre>';
    print_r($variable);
    echo '</pre>';
}

function emptyCart($session)
{
    foreach ($session as $keyArray => $array) {
        $session[$keyArray] = 0;
    }
    return $session;
}

function calculTotalPrice($productsArray)
{
    $totalPrice = 0;
    foreach ($productsArray as $product) {
        if ($product["numberOrdered"] != 0) {
            $totalPrice = $totalPrice + ($product["price"] * $product["numberOrdered"]);
            return $totalPrice;
        }
    }
}

function displayProduct(Product $product)
{
    $beforeVAT = priceExcludingVAT($product->productPrice);
    echo "
    <div class='productCard'>
    <div class='cardImgContainer'>
        <img src='$product->productImgURL'>
    </div>
    <h3>$product->productName</h3>
    <p>Price before VAT : $beforeVAT </p>
    <p>Price after VAT : $product->productPrice</p>
    <p>Weight : $product->productWeight</p>
    </div>";
}

function displayCatalog(Catalog $catalog){
    $productList = $catalog->productList;
    foreach($productList as $product){
        displayProduct($product);
    }
}