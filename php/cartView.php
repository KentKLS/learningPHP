<?php
require_once './database/Cart.php';
require_once "./my-functions.php";
require_once './database/product.php';
include "./header.php";


if (isset($_POST["product"]) && isset($_POST["numberOrdered"])) {
    $_SESSION['cart']->updateCart($_POST["product"], $_POST["numberOrdered"]);
}

if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart']->getCart();
    $cartProducts = getCartProducts($cart);
}

if(isset($_POST['deleteProduct'])){    
    $_SESSION['cart']->deleteCart($_POST["product"]);
}


?>

<div class="mainContainer contentIsCentered isFullPage">



    <?php if (!empty($_SESSION['cart']->cart) ) : ?>
        <div class="tableContainer">
            <table>
                <tr>
                    <th>Produit</th>
                    <th>Prix Unitaire</th>
                    <th>Quantité</th>
                    <th></th>
                    <th>Total</th>
                    <th></th>
                </tr>

                <?php
                $totalPrice =displayCart($_SESSION['cart'])
                ?>


                <tr>
                    <td></td>
                    <td></td>
                    <td>Total HT</td>
                    <td> <?php formatPrice(priceExcludingVAT($totalPrice)) ?> </td>

                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>TVA</td>
                    <td> <?= 20 ?>%</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Total TTC</td>
                    <td><?php formatPrice($totalPrice) ?></td>
                </tr>

            </table>



        </div>


    <?php else : ?>


        Le panier est vide



    <?php endif ?>

</div>
<?php
// $totalPrice = calculTotalPrice($productsArray);
// $orderID = insertNewOrderAndReturnOrderID($db, $totalPrice);
// foreach ($productsArray as $product) {
//     if ($product["numberOrdered"] != 0) {
//         insertNewOrder_product($db, $product["numberOrdered"], $product["productID"], $orderID);
//     }
// }


include "./footer.php"; ?>