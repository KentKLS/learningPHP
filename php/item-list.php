<?php

function getProducts() {
    return [
        "iPhone" => [
            "name" => 'iPhone',
            "price" => 45000,
            "weight" => 200,
            "discount" => 10,
            "VAT"=> 20,
            "picture_url" => "https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/iphone-card-40-iphone14pro-202209?wid=680&hei=528&fmt=p-jpg&qlt=95&.v=1663611329492"
        ],
        "iPad" => [
            "name" => 'iPad',
            "price" => 575000,
            "weight" => 300,
            "discount" => 20,
            "VAT"=> 20,
            "picture_url" => "https://images.pexels.com/photos/1334597/pexels-photo-1334597.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
        ],
        "iMac" => [
            "name" => 'iMac',
            "price" => 750000,
            "weight" => 250,
            "discount" => 15,
            "VAT"=> 20,
            "picture_url" => "https://www.apple.com/v/macbook-pro-14-and-16/e/images/overview/performance/choose_size__b11uc4j8f36u_large.jpg"
        ],
    ];
}


function getProduct($productName) {
    $products = getProducts();

    if ( ! isset($products[$productName]) )  {
        throw new Error("Le produit n'existe pas");
    }

    return $products[$productName];
}