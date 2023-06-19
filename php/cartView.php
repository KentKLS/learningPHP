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
    $totalWeight = getCartProductsWeight($cartProducts);
    $totalPrice = getCartProductsPrice($cartProducts);
}

if (isset($_POST['deleteProduct'])) {
    $_SESSION['cart']->deleteCart($_POST["product"]);
}





?>

<div class="mainContainer contentIsCentered isFullPage">



    <?php if (!empty($_SESSION['cart']->getCart())) :
            if (!isset($_POST["orderPassed"])) :
             
    ?>
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
                    displayCart($_SESSION['cart'])
                    ?>


                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total HT</td>
                        <td> <?php formatPrice(priceExcludingVAT($totalPrice)) ?> </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>TVA</td>b
                        <td> <?= 20 ?>%</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total TTC</td>
                        <td><?php formatPrice($totalPrice) ?></td>
                    </tr>
                </table>



            </div>
            <form action="" method="POST">

                <select name="transporter">
                    <option value="laPoste">La Poste</option>
                    <option value="chronoPost">ChronoPost</option>
                </select>
                <button>VALIDER</button>
            </form>
            <?php if (isset($_POST["transporter"])) : ?>
                <table>
                    <tr>

                        <td>TRANSPORT</td>
                        <td><?php formatPrice(priceTransporter($_POST["transporter"], $totalWeight, $totalPrice)) ?></td>

                    </tr>
                    <tr>

                        <td>Total TTC</td>
                        <td><?php formatPrice(priceTransporter($_POST["transporter"], $totalWeight, $totalPrice) + $totalPrice) ?></td>

                    </tr>

                </table>
                <form action="" method="POST">
                    <button>Validé Commande</button>
                    <input type="hidden" name="orderPassed" value="0">

                </form>
            <?php endif ?>

        <?php else:

            $orderID = insertNewOrderAndReturnOrderID($db, $totalPrice);
            foreach ($cart as $productID => $quantity) {
                insertNewOrder_product($db, $quantity, $productID, $orderID);
            }
            unset($_SESSION['cart']);

        ?>
            <div>
                Commande Enregistrée
            </div>



        <?php endif ?>

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