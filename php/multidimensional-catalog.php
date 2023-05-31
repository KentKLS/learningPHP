<?php
include "./header.php";
include './my-functions.php';
include "./item-list.php";
$products = getProducts();
?>
<form action="cart.php" method="POST">
    <section class="mainContainer">
        <div class="cardContainer">
            <?php foreach ($products as $product => $value) :

            ?>



                <div class="productCard">
                    <div class="cardImgContainer">
                        <img src='<?= $products[$product]['picture_url'] ?>'>
                    </div>
                    <h3><?= $products[$product]['name'] ?></h3>
                    <p> Prix : <?php formatPrice($products[$product]['price'])  ?></p>
                    <p>Poids : <?= $products[$product]['weight']  ?>g</p>
                    <p>Price after <?= $products[$product]['discount']   ?>% discount :
                        <?php
                        $discountedPrice =  discountedPrice($products[$product]['price'], $products[$product]['discount']);
                        formatPrice($discountedPrice);
                        ?>
                    </p>
                    <label for="numberOrdered[]">Quantité :</label>
                    <input type="hidden" name="product[]" value="<?php echo $products[$product]["name"] ?>">
                    <input type="number" class="numberInput" value="0" min="0" max="99" name="numberOrdered[]">
                </div>

            <?php endforeach ?>
        </div>
        <div class="containerFlexCentered">
            <button class="addToCart">Ajoutez article selectionné au panier</button>
        </div>
    </section>
</form>
<?php include "./footer.php"; ?>