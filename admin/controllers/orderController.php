<?php
    require_once 'models/order.php';

    switch ($_GET['action'])
    {
        case 'list':
            $orders = getAllOrders();
            $pageTitle = 'List des commandes';
            $view = 'views/order/list.php';
            break;

        case 'new':

            break;
        default:
            header('Location:index.php?controller=orders&action=list');
            exit;
    }