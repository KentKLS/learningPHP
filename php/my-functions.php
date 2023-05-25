<?php
$price = 1000;

function formatPrice($price){

    echo number_format($price/100,2),"€";
}

formatPrice($price);