<?php
include './my-functions.php';
include './database/catalogue.php';
$catalog = new Catalog;
include './header.php';


?>

<section class="mainContainer">
    <div class="cardContainer">
        <?php displayCatalog($catalog) ?>

    </div>
</section>
    <?php
    include './footer.php';
