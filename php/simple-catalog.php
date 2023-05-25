<?php
$products = ["iPhone", "iPad", "iMac"];

sort($products);

foreach ($products as $key => $val) {
    echo "Produits[" . $key . "] = " . $val . " \n";
}

for($i = 0; $i < count($products); $i++ ){
    echo "Produits [".$i."] = ".$products[$i]."\n";
}
$n = 0;
while ($n < count($products)){
    echo "Produits [".$n."] = ".$products[$n]."\n";
    $n++;
}
$j = 0;
do{
    echo "Produits [".$j."] = ".$products[$j]."\n";
    $j++; 
}while($j < count($products));


echo " Le premier produit du tableau est: $products[0] \n";

echo " Le dernier produit du tableau est:$products[2] \n";
