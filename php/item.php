<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/normalize.css">

    <script src="https://kit.fontawesome.com/9b4d5c1e32.js" crossorigin="anonymous"></script>

    <title>index</title>
</head>
<body>
<?php 

include 'header.php';

$name = "test";
$price = "22$";
$path = "test.com";

    echo "Nom: $name \n Prix: $price \n URL: $path";

include 'footer.php';
?>

</body>