<?php
$products = ["iPhone", "iPad", "iMac"];

sort($products);

foreach ($products as $key => $val) {
    echo "Produits[" . $key . "] = " . $val . " \n";
}

echo " Le premier produit du tableau est: $products[0] \n";

echo " Le dernier produit du tableau est:$products[2] \n";
