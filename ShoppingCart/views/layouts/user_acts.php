<!DOCTYPE html>
<html>
<head>
    <title>Shopping cart</title>
    <meta charset="UTF-8">
    <!-- Load the styles -->
    <link rel= "stylesheet" href="../../css/bootstrap.css"/>
    <link rel= "stylesheet" href="../../css/bootstrap-theme-superhero.css"/>
    <link rel= "stylesheet" type="text/css" href="../../css/styles.css"/>
</head>
<body>
    <div class="container">
        <?php include 'navbar.php';?>
        <div class="col-lg-12">
            <?= $this->getLayoutData('body'); ?>
        </div>
        <?php include 'footer.php';?>
    </div>
</body>

</html>