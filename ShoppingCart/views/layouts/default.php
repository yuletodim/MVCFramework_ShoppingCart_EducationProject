<!DOCTYPE html>
<html>
<head>
    <title><?= $this->title; ?></title>
    <meta charset="UTF-8">
    <!-- Load the styles -->
    <link rel= "stylesheet" href="../../ShoppingCart/public/css/bootstrap.css"/>
    <link rel= "stylesheet" href="../../ShoppingCart/public/css/bootstrap-theme-superhero.css"/>
    <link rel= "stylesheet" type="text/css" href="../../ShoppingCart/public/css/styles.css"/>
</head>
<body>
<div class="container" ng-if="anonymousUser">
    <div class="row">
        alabala
    </div>

</div>
    <?= $this->getLayoutData('body'); ?>
    <?= $this->getLayoutData('body2'); ?>
</body>

</html>