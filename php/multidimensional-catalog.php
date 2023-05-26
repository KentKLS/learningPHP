<?php
include './my-functions.php';
include "./item-list.php"
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
    <form action="cart.php" method="POST">

        <label for="iPhoneOrderedNumber">Quantité :</label>
        <input type="number" name="iPhoneOrderedNumber">
        <button class="buyButton">Achetez cet article</button>
        
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
    <form action="cart.php" method="POST">
        <label for="iPadOrderedNumber">Quantité :</label>
        <input type="number" name="iPadOrderedNumber">
        <button class="buyButton">Achetez cet article</button>
        
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
    <form action="cart.php" method="POST">

        <label for="iMacOrderedNumber">Quantité :</label>
        <input type="number" name="iMacOrderedNumber">
        <button class="buyButton">Achetez cet article</button>
        
    </form>
    <img src='<?= $products["iMac"]['picture_url']  ?>'>
</div>