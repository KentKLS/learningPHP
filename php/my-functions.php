<?php


function formatPrice($price){

    echo number_format($price/100,2)," €";
}

function priceExcludingVAT($priceTTC) {
    $priceHT = (100*$priceTTC)/(100+20);    
    return $priceHT;
}

function discountedPrice($price, $discount){
    $discountedPrice = $price - ($price * $discount/100 );
    return $discountedPrice;
}