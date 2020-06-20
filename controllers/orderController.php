<?php

if ($_SESSION['cart']['count'] == 0)
{
    $_SESSION['messages_ko'][] = 'Aucun produit dans votre panier.';
    header('location:index.php?p=shop');
    exit;
}

require_once 'models/order.php';

// Afficher le fil d'arianne
$breadcrumb[] = '<a href="index.php">Accueil</a>';
$breadcrumb[] = '<a href="index.php?p=cart">Panier</a>';
$step = 'info';
if (isset($_GET['step']) && !empty($_GET['step']))
{
    $step = $_GET['step'];
}

$steps = array();
$previous_step = '';
$next_step = '';
$can_cancel = true;
switch ($step)
{
    case 'info':
        // Vérifier si on a des données dans la session
        if (!isset($_SESSION['order_inputs']) && !isset($_SESSION['order_inputs']['info']))
        {
            // Si l'utilisateur est connecté chargé les donnée de la base
            if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
            {
                require_once 'models/user.php';
                $user = getUserInfoById($_SESSION['user_id']);
                $_SESSION['order_inputs']['info'] = $user;
            }
        }

        $breadcrumb[] = 'Information';
        $steps[] = ['INFORMATION', 'current'];
        $steps[] = ['LIVRAISON', 'next'];
        $steps[] = ['FACTURATION', 'next'];
        $steps[] = ['PAIEMENT', 'next'];
        $steps[] = ['OK', 'next'];
        $previous_step = '';
        $next_step = 'delivery';
        $sub_view = 'views/order/info.php';

        break;
    case 'delivery':
        if (isInfoStepValid())
        {
            $breadcrumb[] = '<a href="index.php?p=order&step=info">Information</a>';
            $breadcrumb[] = 'Livraison';
            $steps[] = ['INFORMATION', 'previous'];
            $steps[] = ['LIVRAISON', 'current'];
            $steps[] = ['FACTURATION', 'next'];
            $steps[] = ['PAIEMENT', 'next'];
            $steps[] = ['OK', 'next'];
            $previous_step = 'info';
            $next_step = 'invoice';
            $sub_view = 'views/order/delivery.php';
        }
        else
        {
            header('location:index.php?p=order&step=info');
            exit;
        }
        break;
    case 'invoice':
        if (isAddressStepValid('delivery'))
        {
            if ($_SESSION['order_inputs']['delivery']['address-invoice'] == 1)
            {
                header('location:index.php?p=order&step=payment');
                exit;
            }

            $breadcrumb[] = '<a href="index.php?p=order&step=info">Information</a>';
            $breadcrumb[] = '<a href="index.php?p=order&step=delivery">Livraison</a>';
            $breadcrumb[] = 'Facturation';
            $steps[] = ['INFORMATION', 'previous'];
            $steps[] = ['LIVRAISON', 'previous'];
            $steps[] = ['FACTURATION', 'current'];
            $steps[] = ['PAIEMENT', 'next'];
            $steps[] = ['OK', 'next'];
            $previous_step = 'delivery';
            $next_step = 'payment';
            $sub_view = 'views/order/invoice.php';
        }
        else
        {
            header('location:index.php?p=order&step=delivery');
            exit;
        }
        break;
    case 'payment':
        if ($_SESSION['order_inputs']['delivery']['address-invoice'] == true || isAddressStepValid('invoice'))
        {
            include_once 'models/product.php';
            $cart_products = $_SESSION['cart'];
            $total = 0;
            foreach ($cart_products as $key => $value)
            {
                if ($key !== 'count') {
                    $cart_product = $value['product'];
                    $price = $value['quantity'] * getPrice($cart_product);
                    $total += $price;
                }
            }
            $breadcrumb[] = '<a href="index.php?p=order&step=info">Information</a>';
            $breadcrumb[] = '<a href="index.php?p=order&step=delivery">Livraison</a>';
            $breadcrumb[] = '<a href="index.php?p=order&step=invoice">Facturation</a>';
            $breadcrumb[] = 'Paiement';
            $steps[] = ['INFORMATION', 'previous'];
            $steps[] = ['LIVRAISON', 'previous'];
            $steps[] = ['FACTURATION', 'previous'];
            $steps[] = ['PAIEMENT', 'current'];
            $steps[] = ['OK', 'next'];
            $previous_step = 'invoice';
            $next_step = 'ok';
            $sub_view = 'views/order/payment.php';
        }
        else
        {
            header('location:index.php?p=order&step=delivery');
            exit;
        }
        break;
    case 'ok':
        $is_payment_ok = true;
        if (!isset($_POST['name-on-card']) || empty($_POST['name-on-card']))
        {
            $_SESSION['messages_ko'][] = 'Le nom de la carte est obligatoire.';
            $is_payment_ok = false;
        }
        if (!isset($_POST['card-number']) || empty($_POST['card-number']))
        {
            $_SESSION['messages_ko'][] = 'Le numéro de la carte est obligatoire.';
            $is_payment_ok = false;
        }
        if (!isset($_POST['expiry-date']) || empty($_POST['expiry-date']))
        {
            $_SESSION['messages_ko'][] = 'Expire le de la carte est obligatoire.';
            $is_payment_ok = false;
        }

        if (!isset($_POST['security-code']) || empty($_POST['security-code']))
        {
            $_SESSION['messages_ko'][] = 'Le code CVV2 est obligatoire.';
            $is_payment_ok = false;
        }

        if ($is_payment_ok == true)
        {
            $breadcrumb[] = 'Merci';
            $previous_step = '';
            $next_step = '';
            $can_cancel = false;
        }
        else
        {
            header('location:index.php?p=order&step=payment');
            exit;
        }

        $steps[] = ['INFORMATION', 'previous'];
        $steps[] = ['LIVRAISON', 'previous'];
        $steps[] = ['FACTURATION', 'previous'];
        $steps[] = ['PAIEMENT', 'previous'];
        $steps[] = ['OK', 'current'];
        $sub_view = 'views/order/ok.php';
        saveOrder();
        break;
}

$view = 'views/order.php';