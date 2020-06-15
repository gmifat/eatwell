<?php
require_once ('helpers.php');

if(isset($_GET['p'])) {
    switch ($_GET['p']) {
        default :
            require 'controllers/indexController.php';
            break;
    }
}
else{
    require 'controllers/indexController.php';
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" 
		content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans|lato">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans|kaushan">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kaushan Script&display=swap">
        <link rel="stylesheet" href="assets/css/reset.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <script src="https://kit.fontawesome.com/cbd946d966.js" crossorigin="anonymous"></script>
        <title>EatWell</title>
    </head>
    <body>
	<?php require ('views/partials/header.php'); ?>
    <?php
        include ($view);
    ?>
	<?php require ('views/partials/footer.php'); ?>
    </body>
</html>
