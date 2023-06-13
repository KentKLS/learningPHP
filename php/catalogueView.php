<?php 
include './my-functions.php';
include './database/catalogue.php';
$catalog = new Catalog;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php displayCatalog($catalog) ?>
</body>
</html>