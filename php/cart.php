<?php
include "./item-list.php";
include "./my-functions.php";

$product = getProduct($_POST["product"]);
$numberOrdered = $_POST["numberOrdered"];
?>

<div class="mainContainer contentIsCentered">

    <?php if ($_POST["numberOrdered"] != null) : ?>

        <div class="tableContainer">
            <table>
                <tr>
                    <th>Produit</th>
                    <th>Prix Unitaire</th>
                    <th>Quantité</th>
                    <th>Total</th>
                </tr>
                <tr>
                    <td><?php echo $product["name"] ?></td>
                    <td> <?php echo formatPrice($product["price"]) ?></td>
                    <td> <?php echo $numberOrdered ?></td>
                    <td><?php echo formatPrice($product["price"] * $numberOrdered ) ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Total HT</td>
                    <td> <?php echo formatPrice(priceExcludingVAT($product["price"])) ?> </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>TVA</td>
                    <td> <?php echo $product["VAT"] ?>%</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Total TTC</td>
                    <td><?php echo formatPrice($product["price"]) ?></td>
                </tr>

            </table>
        </div>
    <?php else : ?>
        <div>
            La quantité choisis n'est pas valide
        </div>

    <?php endif; ?>

    <form action="" method="POST">
        <input type="hidden" name="product" value="<?php echo $product["name"] ?>">
        <input type="hidden" name="numberOrdered" value="<?php echo $numberOrdered ?>">
        <select name="transporter">
            <option value="laPoste">La Poste</option>
            <option value="chronoPost">ChronoPost</option>
        </select>
        <button>VALIDER</button>
    </form>
<?php if (isset($_POST["transporter"])): ?>
<table>
    <tr>
        
        <td>TRANSPORT</td>
        <td><?php echo formatPrice(priceTransporter($_POST["transporter"],$product["weight"]*$numberOrdered,$product["price"])); ?></td>

    </tr>
    <tr>
        
        <td>Total TTC</td>
        <td><?php echo formatPrice(priceTransporter($_POST["transporter"],$product["weight"]*$numberOrdered,$product["price"])+ $product["price"])  ?></td>

    </tr>
    
</table>
<?php endif ?>
</div>