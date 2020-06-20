<?php
    session_start();
    require ('../helpers.php');
    $controller = 'login';
    if (isset($_GET['controller']))
    {
        $controller = $_GET['controller'];
    }

    // Vérifier que le user est connecté et admin sinon redirection vers la page login
    if ($controller !== 'login')
    {
        if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id']))
        {
            $_SESSION['messages_ko'][] = 'Merci de vous connecter pour accéder à l\'admin';
            header('location:index.php?controller=login');
            exit;
        }
        else if ($_SESSION['user']['is_admin'] == 0)
        {
            $_SESSION['messages_ko'][] = 'Merci de vous connecter avec votre compte administrateur';
            header('location:index.php?controller=login');
            exit;
        }
    }

    switch ($controller)
    {
        case 'categories':
            require 'controllers/categoryController.php';
            break;
        case 'newsletters':
            require 'controllers/newsletterController.php';
            break;
        case 'orders':
            require 'controllers/orderController.php';
            break;
        case 'origins':
            require 'controllers/originController.php';
            break;
        case 'products':
            require 'controllers/productController.php';
            break;
        case 'promotions':
            require 'controllers/promotionController.php';
            break;
        case 'recipes':
            require 'controllers/recipeController.php';
            break;
        case 'review':
            require 'controllers/reviewController.php';
            break;
        case 'sizes':
            require 'controllers/sizeController.php';
            break;
        case 'units':
            require 'controllers/unitController.php';
            break;
        case 'users':
            require 'controllers/userController.php';
            break;
        default:
            require 'controllers/indexController.php';
            break;
    }
?>
    <!doctype html>
    <html lang="fr">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
            <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
            <link rel="shortcut icon" type="image/png" href="assets/images/logo64.png"/>
            <script src="https://kit.fontawesome.com/2cf3ba0c41.js" crossorigin="anonymous"></script>
            <title>EatWell <?= $pageTitle ?></title>
        </head>
        <body>
            <div class="container-fluid">
                <header class="header">
                    <?php require ('views/partials/header.php'); ?>
                    <?php require ('views/partials/menu.php'); ?>
                </header>
                <main>
                    <?php require ('views/partials/alertMessages.php'); ?>
                    <?php include ($view); ?>
                </main>
                <footer  class="footer text-muted bg-info">
                    <?php require ('views/partials/footer.php'); ?>
                </footer>
            </div>
        </body>
    </html>
<?php

    if(isset($_SESSION['messages_ok'])){
        unset($_SESSION['messages_ok']);
    }

    if(isset($_SESSION['messages_ko'])){
        unset($_SESSION['messages_ko']);
    }

    if(isset($_SESSION['old_inputs'])){
        unset($_SESSION['old_inputs']);
    }

    if(isset($_SESSION['debug'])){
        unset($_SESSION['debug']);
    }
