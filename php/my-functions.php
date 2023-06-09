<?php
include "./database/database.php";


function formatPrice($price)
{

    echo number_format($price / 100, 2), " €";
}

function priceExcludingVAT($priceTTC, $VAT = 20)
{

    $priceHT = (100 * $priceTTC) / (100 + $VAT);
    return $priceHT;
}

function discountedPrice($price, $discount)
{
    if ($discount > 0) {
        $discountedPrice = $price - ($price * $discount / 100);
        return $discountedPrice;
    }

    return $price;
}

function priceTransporter($transporter, $weight, $price)
{
    if ($transporter == "laPoste") {
        if ($weight <= 500) {
            $transporterPrice = 500;
        } elseif ($weight > 500 && $weight < 2000) {
            $transporterPrice = $price / 10;
        } else {
            $transporterPrice = 0;
        }
    } else if ($transporter == "chronoPost") {
        if ($weight <= 500) {
            $transporterPrice = 499;
        } elseif ($weight > 500 && $weight < 2000) {
            $transporterPrice = $price / 7;
        } else {
            $transporterPrice = 1;
        }
    }
    return $transporterPrice;
}


function createProductsArray($productName, $numberOrdered, $db)
{
    $productList = getProductList($db);
    $i = 0;
    foreach ($productName as $name) {
        $productsArray[$i]["name"] = $productList[$i]["product_name"];
        $productsArray[$i]["price"] = $productList[$i]["product_price"];
        $productsArray[$i]["productID"] = $productList[$i]["product_id"];
        $productsArray[$i]["weight"] = $productList[$i]["product_weight"];



        $i++;
    }

    $i = 0;
    foreach ($numberOrdered as $number) {
        $productsArray[$i]["numberOrdered"] = $number;
        $i++;
    }
    return $productsArray;
}


function myDump($variable)
{
    echo '<pre>';
    print_r($variable);
    echo '</pre>';
}

function emptyCart($session)
{
    foreach ($session as $keyArray => $array) {
        $session[$keyArray] = 0;
    }
    return $session;
}

function calculTotalPrice($productsArray)
{
    $totalPrice = 0;
    foreach ($productsArray as $product) {
        if ($product["numberOrdered"] != 0) {
            $totalPrice = $totalPrice + ($product["price"] * $product["numberOrdered"]);
            return $totalPrice;
        }
    }
}

function displayProduct(Product $product)
{
    if ($product->productStock > 0):
?>
    <form action='' method='POST'>
        <div class='productCard'>
            <div class='cardImgContainer'>
                <img src='<?= $product->productImgURL ?>'>
            </div>
            <h3><?= $product->productName ?></h3>
            <p>Price before VAT : <?= formatPrice(priceExcludingVAT($product->productPrice)) ?></p>
            <p>Price after VAT : <?= formatPrice($product->productPrice) ?></p>
            <p>Weight : <?= $product->productWeight ?> g</p>
            <input type='hidden' name='product' value='<?= $product->productId ?>'>
            <button>Ajouté au panier</button>
        </div>
    </form>
    <?php
    endif;
}

function displayCatalog(Catalog $catalog)
{
    $productList = $catalog->productList;
    foreach ($productList as $product) {
        displayProduct($product);
    }
}

function displayCart(Cart $cart)
{
    $db = new PDO('mysql:host=localhost;dbname=new_e-commerce;charset=utf8', 'Quentin', '');
    $cartArray = $cart->getCart();
    $orderTotalPrice = 0;
    foreach ($cartArray as $productId => $quantity) {
        $products = getProduct($db, $productId);
        foreach ($products as $product) {

            $productObject = new Product(
                $product['product_id'],
                $product['product_name'],
                $product['product_description'],
                $product['product_price'],
                $product['product_weight'],
                $product['product_imgURL'],
                $product['product_quantity_available'],
                $product['is_used']
            );

            $totalPricePerLine = $quantity * $productObject->productPrice;
           
    ?>
            <tr>
                <td> <?= $productObject->productName ?></td>
                <td> <?= formatPrice($productObject->productPrice) ?> </td>
                <td>
                    <form action="./cartView.php" method="POST">
                        <input class='numberInput' max='99' type='number' name='numberOrdered' min='0' value='<?= $quantity ?>'>
                        <input type='hidden' name='product' value='<?= $productObject->productId ?>'>
                </td>
                <td>
                    <button>Modify <br> Quantity</button>
                    </form>
                </td>
                <td> <?= formatPrice($totalPricePerLine) ?> </td>
                <td>
                    <form action="./cartView.php" method="POST">
                        <button>Remove <br> Product </button>
                        <input type="hidden" name="deleteProduct" value="0">
                        <input type='hidden' name='product' value='<?= $productObject->productId ?>'>
                    </form>
                </td>
            </tr>

<?php
           
            $orderTotalPrice += $totalPricePerLine;
        }
    }
    return $orderTotalPrice;
}


function getCartProductsWeight(array $cartProducts)
{
    $weight = 0;

    foreach ($cartProducts as $cartProduct) {

        foreach ($cartProduct as $product) {
            if (is_array($product)) {
                $weight += $product['product_weight'] * $cartProduct['quantity'];
            }
        }
    }
    return $weight;
}

function getCartProductsPrice(array $cartProducts)
{
    $price = 0;

    foreach ($cartProducts as $cartProduct) {

        foreach ($cartProduct as $product) {
            if (is_array($product)) {
                $price += $product['product_price'] * $cartProduct['quantity'];
            }
        }
    }
    return $price;
}
