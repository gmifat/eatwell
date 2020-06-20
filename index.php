<?php
session_start();
/*
session_unset();
session_destroy();
session_reset();
exit;*/

// initialiser tous les valeurs pour éviter de trop tester avec l'isset
if(!isset($_SESSION['cart']))
{
    $_SESSION['cart'] = array();
    $_SESSION['cart']['count'] = 0;
    $_SESSION['order_inputs'] = array(
        'info' => array('user_id' => '', 'first_name' => '', 'last_name' => '', 'email' => '', 'phone_number' => ''),
        'delivery' => array('first_name' => '', 'last_name' => '', 'street_name' => '', 'complementary_address_1' => '', 'complementary_address_2' => '', 'city' => '', 'postal_code' => '', 'address-invoice' => true),
        'invoice'  => array('first_name' => '', 'last_name' => '', 'street_name' => '', 'complementary_address_1' => '', 'complementary_address_2' => '', 'city' => '', 'postal_code' => '', 'address-invoice' => ''),
        'payment' => array('name-on-card' => '','card-number' => '', 'expiry-date' => '', 'security-code' => '', 'save' => false)
    );
}

    require_once ('helpers.php');

    if(isset($_GET['p'])) {
        switch ($_GET['p']) {
            case 'product':
                require 'controllers/productController.php';
                break;
            case 'shop':
                require 'controllers/shopController.php';
                break;
            case 'cart':
                require 'controllers/cartController.php';
                break;
            case 'useraccount':
                require 'controllers/userAccountController.php';
                break;
            case 'newsletter':
                require 'controllers/newsletterController.php';
                break;
            case 'favorites':
                require 'controllers/favoriteController.php';
                break;
            case 'order':
                require 'controllers/orderController.php';
                break;
            case 'contact':
                require 'controllers/contactController.php';
                break;
            case 'about':
                require 'controllers/aboutController.php';
                break;
            case 'legal':
                require 'controllers/legalController.php';
                break;
            case 'privacy':
                require 'controllers/privacyController.php';
                break;
            case 'payment':
                require 'controllers/paymentController.php';
                break;
            case 'search':
                require 'controllers/searchController.php';
                break;
            case 'delete-data':
                require 'controllers/delete-personal-data.php';
                break;
            default :
                require 'controllers/indexController.php';
                break;
        }
    }
    else{
        require 'controllers/indexController.php';
    }

    include ('views/layout.php');


    if (isset($_SESSION['messages_ok'])) {
        unset($_SESSION['messages_ok']);
    }

    if (isset($_SESSION['messages_ko'])) {
        unset($_SESSION['messages_ko']);
    }

    if (isset($_SESSION['old_inputs'])) {
        unset($_SESSION['old_inputs']);
    }