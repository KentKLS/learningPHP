<?php
include './my-functions.php';
$products = [
    "iPhone" => [
        "name" => 'iPhone',
        "price" => 45000,
        "weight" => 200,
        "discount" => 10,
        "picture_url" => "https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/iphone-card-40-iphone14pro-202209?wid=680&hei=528&fmt=p-jpg&qlt=95&.v=1663611329492"
    ],
    "iPad" => [
        "name" => 'iPad',
        "price" => 575000,
        "weight" => 300,
        "discount" => 20,
        "picture_url" => "https://images.pexels.com/photos/1334597/pexels-photo-1334597.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
    ],
    "iMac" => [
        "name" => 'iMac',
        "price" => 750000,
        "weight" => 250,
        "discount" => 15,
        "picture_url" => "https://www.apple.com/v/macbook-pro-14-and-16/e/images/overview/performance/choose_size__b11uc4j8f36u_large.jpg"
    ],
];
?>

<div>
    <h3> <?= $products["iPhone"]['name'] ?></h3>
    <p>
        Prix : <?php formatPrice($products["iPhone"]['price'])  ?>
    </p>
    <p>
        Poids : <?= $products["iPhone"]['weight']  ?>g
    </p>
    <p>
        Price after <?= $products["iPhone"]['discount']   ?>
        % discount :
        <?php 
        $discountedPrice =  discountedPrice($products["iPhone"]['price'], $products["iPhone"]['discount']);
        formatPrice($discountedPrice);
        ?>
    </p>
    <form>
        <label for="iPhoneOrderedNumber">Quantité :</label>
        <input type="number" name="iPhoneOrderedNumber">
        <button class ="buyButton">Achetez cet article</button>
    </form>
    <img src='<?= $products["iPhone"]['picture_url'] ?>'>
   
</div>
<div>
    <h3> <?= $products["iPad"]['name'] ?></h3>
    <p>
        Prix : <?php formatPrice($products["iPad"]['price']) ?>
    </p>
    <p>
        Poids : <?= $products["iPad"]['weight'] ?>g
    </p>
    <p>
        Price after <?= $products["iPad"]['discount']   ?>% discount : <?php
                                                                        $discountedPrice =  discountedPrice($products["iPad"]['price'], $products["iPad"]['discount']);
                                                                        formatPrice($discountedPrice) ?>
    </p>
    <form action="" method="GET">
        <label for="iPadOrderedNumber">Quantité :</label>
        <input type="number" name="iPadOrderedNumber">
        <button class ="buyButton">Achetez cet article</button>
    </form>
    <img src='<?= $products["iPad"]['picture_url'] ?>'>
    
</div>
<div>
    <h3> <?= $products["iMac"]['name'] ?></h3>
    <p>
        Prix : <?php formatPrice($products["iMac"]['price'])   ?>
    </p>
    <p>
        Poids : <?= $products["iMac"]['weight']   ?>g
    </p>
    <p>
        Price after <?= $products["iMac"]['discount']   ?>% discount : <?php
                                                                        $discountedPrice =  discountedPrice($products["iMac"]['price'], $products["iMac"]['discount']);
                                                                        formatPrice($discountedPrice) ?>
    </p>
    <form>
        <label for="iMacOrderedNumber">Quantité :</label>
        <input type="number" name="iMacOrderedNumber">
        <button class ="buyButton">Achetez cet article</button>
    </form>
    <img src='<?= $products["iMac"]['picture_url']  ?>'>
</div>