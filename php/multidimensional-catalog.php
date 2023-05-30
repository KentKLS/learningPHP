<?php
include "./header.php";
include './my-functions.php';
include "./item-list.php";
$products = getProducts();
?>

<?php foreach ($products as $product => $value):
        
?>
<div>
    <h3> <?= $products[$product]['name'] ?></h3>
    <p>
        Prix : <?php formatPrice($products[$product]['price'])  ?>
    </p>
    <p>
        Poids : <?= $products[$product]['weight']  ?>g
    </p>
    <p>
        Price after <?= $products[$product]['discount']   ?>
        % discount :
        <?php
        $discountedPrice =  discountedPrice($products[$product]['price'], $products[$product]['discount']);
        formatPrice($discountedPrice);
        ?>
    </p>

    <form action="cart.php" method="POST">

        <label for="numberOrdered">Quantité :</label>
        <input type="hidden" name="product" value="<?php echo $products[$product]["name"]?>">
        <input type="number" min="1" name="numberOrdered">
        <button class="buyButton">Achetez cet article</button>
        
    </form>
    <img src='<?= $products[$product]['picture_url'] ?>'>

</div>
<?php endforeach ?>

<?php include "./footer.php"; ?>
