<?php
session_start();
include "./header.php";
include "./my-functions.php";
$products = getProductList($db);
$orders = getOrdersList($db);

?>
<form action="cart.php" method="POST">
    <section class="mainContainer">
        <div class="cardContainer">
            <?php foreach ($products as $product => $value) :

            ?>



                <div class="productCard">
                    <div class="cardImgContainer">
                        <img src='<?= $products[$product]['product_imgURL'] ?>'>
                    </div>
                    <h3><?= $products[$product]['product_name'] ?> </h3>
                    <p> Prix : <?php formatPrice($products[$product]['product_price'])  ?></p>
                    <p>Poids : <?= $products[$product]['product_weight']  ?>g</p>
                    <p>Price after <?= 0   ?>% discount :
                        <?php
                        $discountedPrice =  discountedPrice($products[$product]['product_price'], 0);
                        formatPrice($discountedPrice);
                        ?>
                    </p>
                    <label for="numberOrdered[]">Quantité :</label>
                    <input type="hidden" name="product[]" value="<?php echo $products[$product]["product_name"] ?>">
                    <input type="number" class="numberInput" value="<?=$_SESSION["numberOrdered"][$product] ??  0 ?>" min="0" max="99" name="numberOrdered[<?= $product ?>]">
                </div>

            <?php endforeach ?>
        </div>
        <div class="containerFlexCentered">
            <button class="addToCart">Ajoutez article selectionné au panier</button>
        </div>
    </section>
</form>
<?php include "./footer.php"; ?>