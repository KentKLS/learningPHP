<?php
session_start();
include "./header.php";
require_once "./my-functions.php";



if (isset($_POST["product"]) && isset($_POST["numberOrdered"])) {
    $_SESSION["product"] = $_POST["product"];
    $_SESSION["numberOrdered"] = $_POST["numberOrdered"];
}
if (isset($_POST["emptyCart"])) {
    $_SESSION["numberOrdered"] = emptyCart($_SESSION["numberOrdered"]);
}

$productName = $_SESSION["product"];
$numberOrdered = $_SESSION["numberOrdered"];
$totalPrice = 0;
$productsArray = createProductsArray($productName, $numberOrdered, $db);




?>

<div class="mainContainer contentIsCentered isFullPage">

    <?php

    if (!isset($_POST["emptyCart"])) :
        if (!isset($_POST["orderPassed"])) :
    ?>



            <div class="tableContainer">
                <form action="" method="POST">
                    <table>
                        <tr>
                            <th>Produit</th>
                            <th>Prix Unitaire</th>
                            <th>Quantité</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                        <?php foreach ($productsArray as $arrayKey => $array) :
                            if ($array["numberOrdered"] != 0) :
                                $totalPrice = $totalPrice + ($array["price"] * $array["numberOrdered"]);
                        ?>
                                <tr>
                                    <td><?php echo $array["name"] ?></td>
                                    <td> <?php echo formatPrice($array["price"]) ?></td>
                                    <td>
                                        <input class="numberInput" max="99" type="number" name="numberOrdered[]" min="0" value="<?php echo $array["numberOrdered"] ?>">
                                    </td>
                                    <td><?php echo formatPrice($array["price"] * $array["numberOrdered"]) ?></td>
                                    <td>
                                        <input type="hidden" name="product[]" value="<?php echo $array["name"] ?>">

                                    </td>
                                </tr>

                        <?php
                            endif;
                        endforeach;
                        ?>

                        <tr>
                            <td></td>
                            <td></td>
                            <td>Total HT</td>
                            <td> <?php echo formatPrice(priceExcludingVAT($totalPrice)) ?> </td>

                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>TVA</td>
                            <td> <?php echo 20 ?>%</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Total TTC</td>
                            <td><?php echo formatPrice($totalPrice) ?></td>
                        </tr>

                    </table>
                    <button>Mettre à jour tableau</button>


            </div>




            <div class="horizontalDiv">
                <label for="transporter">Transporteur:</label>
                <select name="transporter">
                    <option value="laPoste">La Poste</option>
                    <option value="chronoPost">ChronoPost</option>
                </select>
                <button>VALIDER</button>

            </div>
            <?php if (isset($_POST["transporter"])) : ?>
                <table>
                    <tr>

                        <td>TRANSPORT</td>
                        <td><?php echo formatPrice(priceTransporter($_POST["transporter"], $array["weight"] * $array["numberOrdered"], $array["price"])); ?></td>

                    </tr>
                    <tr>

                        <td>Total TTC</td>
                        <td><?php echo formatPrice(priceTransporter($_POST["transporter"], $array["weight"] * $array["numberOrdered"], $array["price"]) + $totalPrice)  ?></td>

                    </tr>

                </table>

            <?php
            endif;
            ?>
            </form>
            <form action="" method="POST">
                <button>Vidé le panier</button>
                <input type="hidden" name="emptyCart" value="0">

            </form>
            <form action="" method="POST">
                <button>Validé Commande</button>
                <input type="hidden" name="orderPassed" value="0">

            </form>
</div>
<?php else :
           
            $totalPrice = calculTotalPrice($productsArray);
            $orderID = insertNewOrderAndReturnOrderID($db, $totalPrice);
            foreach ($productsArray as $product) {
                if ($product["numberOrdered"] != 0) {
                    insertNewOrder_product($db, $product["numberOrdered"], $product["productID"], $orderID);
                }
            }


?>
    <div>
        Commande Enregistrée
    </div>
<?php   endif; ?>
<?php else :   ?>

    <div>
        Le panier est vide
    </div>
<?php endif; ?>


<?php include "./footer.php"; ?>