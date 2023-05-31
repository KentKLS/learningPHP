<?php
include "./header.php";
include "./item-list.php";
include "./my-functions.php";

// $product = getProduct($_POST["product"]);



$productName = $_POST["product"];
$numberOrdered = $_POST["numberOrdered"];
$totalPrice = 0;



$productsArray = createProductsArray($productName, $numberOrdered);

myDump($_POST);


?>

<div class="mainContainer contentIsCentered isFullPage">

    <?php

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
                        if ($array["number"] != 0) :
                            $totalPrice = $totalPrice + ($array["product"]["price"] * $array["number"]);
                ?>
                        <tr>
                            <td><?php echo $array["product"]["name"] ?></td>
                            <td> <?php echo formatPrice($array["product"]["price"]) ?></td>
                            <td>
                                <input class="numberInput" max="99" type="number" name="numberOrdered[]" min="0" value="<?php echo $array["number"] ?>">
                            </td>
                            <td><?php echo formatPrice($array["product"]["price"] * $array["number"]) ?></td>
                            <td>                                
                                <input type="hidden" name="product[]" value="<?php echo $array["product"]["name"]?>">                               

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
                    <td> <?php echo $array["product"]["VAT"] ?>%</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Total TTC</td>
                    <td><?php echo formatPrice($totalPrice) ?></td>
                </tr>

            </table>
            <button>Mettre à jour tableau</button>

        </form>
    </div>





    <form action="" method="POST">
        <input type="hidden" name="product" value="<?php echo $productName ?>">
        <input type="hidden" name="numberOrdered" value="<?php echo $numberOrdered ?>">
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
                <td><?php echo formatPrice(priceTransporter($_POST["transporter"], $product["weight"] * $numberOrdered, $product["price"])); ?></td>

            </tr>
            <tr>

                <td>Total TTC</td>
                <td><?php echo formatPrice(priceTransporter($_POST["transporter"], $product["weight"] * $numberOrdered, $product["price"]) + $product["price"])  ?></td>

            </tr>

        </table>
    <?php endif;
    ?>
</div>

<?php include "./footer.php"; ?>