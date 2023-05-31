<?php


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


function createProductsArray($productName, $numberOrdered)
{
    $i = 0;
    foreach ($productName as $name) {
        $productsArray[$i]["product"] = getProduct($name);
        $i++;
    }

    $i = 0;
    foreach ($numberOrdered as $number) {
        $productsArray[$i]["number"] = $number;
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

function emptyCart($session){
    foreach ($session as $keyArray => $array){
       $session[$keyArray] = 0;       
    }
    
    return $session;
}