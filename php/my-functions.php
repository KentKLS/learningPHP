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
