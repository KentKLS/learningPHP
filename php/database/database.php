<?php



try {
        $db = new PDO('mysql:host=localhost;dbname=new_e-commerce;charset=utf8', 'Quentin', '');
} catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
}

function getProduct(pdo $db, int $productID)
{
        $getProduct = $db->prepare(
                "SELECT *
        FROM products
        WHERE product_id = $productID
        "
        );
        $getProduct->execute();
        $product = $getProduct->fetchAll(PDO::FETCH_ASSOC);
        return $product;
}



function getCartProducts(array $cart):array
{
        $db = new PDO('mysql:host=localhost;dbname=new_e-commerce;charset=utf8', 'Quentin', '');
        $cartProducts =[];
        foreach ($cart as $productID => $quantity) {
                $cartProducts = getProduct($db, $productID);
        }
        return $cartProducts;
}

// 1
function getCustomerThatOrderedToday(pdo $db)
{
        $selectCustomerThatOrderedToday = $db->prepare(
                "SELECT customer_id
        FROM customers
        INNER JOIN orders on customers_customer_id = customer_id
        WHERE CAST(order_date as DATE) = CURDATE()"
        );

        $selectCustomerThatOrderedToday->execute();
        $customerThatOrderedToday = $selectCustomerThatOrderedToday->fetchAll($mode = PDO::FETCH_ASSOC);
        return $customerThatOrderedToday;
}

// 2
function getStockValue(pdo $db)
{
        $selectStockValue = $db->prepare(
                "SELECT product_name,
        SUM(product_price*product_quantity_available)
        FROM products
        GROUP BY product_name
        ORDER BY product_id"
        );

        $selectStockValue->execute();
        $stockValue = $selectStockValue->fetchAll($mode = PDO::FETCH_ASSOC);
        return $stockValue;
}
// 3
function getCommandListWithException($exception, pdo $db)
{
        $selectCommandListWithException = $db->prepare(
                "SELECT *
                FROM orders 
                INNER JOIN products ON products_product_id = product_id
                INNER JOIN order_product ON orders_order_id = order_id
                WHERE product_id != $exception"
        );
        $selectCommandListWithException->execute();
        $commandListWithException = $selectCommandListWithException->fetchAll($mode = PDO::FETCH_ASSOC);
        return $commandListWithException;
};

// 4
function getCategoryListIfProductIsAvailable(pdo $db): array
{
        $selectCategoryListIfProductIsAvailable = $db->prepare(
                "SELECT *
        FROM categories
        INNER JOIN products ON category_id = categories_category_id
        WHERE product_availability = TRUE"
        );

        $selectCategoryListIfProductIsAvailable->execute();

        $categoryListIfProductIsAvailable = $selectCategoryListIfProductIsAvailable->fetchAll($mode = PDO::FETCH_ASSOC);
        return $categoryListIfProductIsAvailable;
}
//5 
function getCategoryListIfAtleastOneProductIsAvailable(pdo $db): array
{

        $selectCategoryListIfAtleastOneProductIsAvailable = $db->prepare(
                "SELECT *
        FROM categories
        INNER JOIN products ON category_id = categories_category_id
        GROUP BY categories_category_id
        HAVING MIN(product_availability) = 1"
        );

        $selectCategoryListIfAtleastOneProductIsAvailable->execute();

        $categoryListIfAtleastOneProductIsAvailable = $selectCategoryListIfAtleastOneProductIsAvailable->fetchAll($mode = PDO::FETCH_ASSOC);
        return $categoryListIfAtleastOneProductIsAvailable;
}
//6 

function deleteProduct($id, $db)
{
        $deleteProduct = $db->prepare(
                "DELETE FROM products 
                WHERE product_id = $id"
        );
        $deleteProduct->execute();
}

function updateProductStockQuantity($productID, $addedQuantity, $db)
{
        $updatedProductStock = $db->prepare(
                "UPDATE products
                SET product_quantity_available = product_quantity_available + $addedQuantity
                WHERE product_id = $productID; "
        );

        $updatedProductStock->execute();
}

function getProductList($db)
{

        $getProductList = $db->prepare(
                "SELECT *
        FROM products"
        );
        $getProductList->execute();
        $productList = $getProductList->fetchAll($mode = PDO::FETCH_ASSOC);
        return $productList;
}
function getUsedProductList($db)
{
        $getUsedProductList = $db->prepare(
                "SELECT * 
                FROM products 
                LEFT JOIN used_products ON products.product_id = used_products.product_id 
                ORDER BY products.product_id;"
        );
        $getUsedProductList->execute();
        $usedProductList = $getUsedProductList->fetchAll($mode = PDO::FETCH_ASSOC);
        return $usedProductList;
}


function getOrdersList($db)
{

        $getOrdersList = $db->prepare(
                "SELECT *
        FROM orders"
        );
        $getOrdersList->execute();
        $ordersList = $getOrdersList->fetchAll($mode = PDO::FETCH_ASSOC);
        return $ordersList;
}

function insertNewOrderAndReturnOrderID($db, $totalPrice)
{
        $currDate = date('Y-m-d H:i:s');

        $randomNum = random_int(0000, 9999);
        $ordersList = getOrdersList($db);
        foreach ($ordersList as $order) {
                if ($order["order_number"] == "NO $randomNum") {
                        continue;
                } else {
                        $newOrder = $db->prepare(
                                " INSERT INTO orders ( `order_number`, `order_date`, `order_cost`, `customers_customer_id`) VALUES
                               ('NO $randomNum' , '$currDate' , $totalPrice , 1 );"
                        );
                }
        }
        $newOrder->execute();
        return $db->lastInsertID();
}

function insertNewOrder_product($db, $quantity, $productID, $orderID)
{

        $newOrder_product = $db->prepare(
                "INSERT INTO order_product ( `order_product_quantity`, `products_product_id`, `orders_order_id`) VALUES
                ($quantity, $productID, $orderID);"
        );
        $newOrder_product->execute();
}
