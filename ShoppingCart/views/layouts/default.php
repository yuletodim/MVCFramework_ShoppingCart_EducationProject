<!DOCTYPE html>
<html>
<head>
    <title>Shopping cart</title>
    <meta charset="UTF-8">
    <!-- Load the styles -->
    <link rel= "stylesheet" href="../../ShoppingCart/public/css/bootstrap.css"/>
    <link rel= "stylesheet" href="../../ShoppingCart/public/css/bootstrap-theme-superhero.css"/>
    <link rel= "stylesheet" type="text/css" href="../../ShoppingCart/public/css/styles.css"/>
</head>
<body>

    <div class="container">
        <?php include 'navbar.php';?>

        <div class="jumbotron">
            <?= $this->getLayoutData('body'); ?>
        </div>

        <?php include 'footer.php';?>
    </div>
</body>

</html>