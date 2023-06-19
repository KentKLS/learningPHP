<?php
require_once './database/Cart.php';
require_once './header.php';
require_once './my-functions.php';
require_once './database/catalogue.php';
$catalog = new Catalog;

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = new Cart;
}

if (isset($_POST["product"])) {
    $_SESSION['cart']->addToCart($_POST["product"]);
}

var_dump( $_SESSION['cart']->getCart())
?>

<section class="mainContainer">
    <div class="cardContainer">

        <?php displayCatalog($catalog) ?>

    </div>


</section>
<?php
include './footer.php';
