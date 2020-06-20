<?php
    require_once 'models/order.php';

    switch ($_GET['action'])
    {
        case 'list':
            $orders = getAllOrders();
            $pageTitle = 'List des commandes';
            $view = 'views/order/list.php';
            break;

        case 'view':
            if (isset($_GET['id']) && !empty($_GET['id']))
            {
                $order = getOrderById($_GET['id']);
                if($order == false)
                {
                    $_SESSION['messages_ko'][] = 'Commande non trouvée !';
                    header('Location:index.php?controller=orders&action=list');
                    exit;
                }

                $pageTitle = 'Détail de la commande';
                $view = 'views/order/view.php';
            }
            else
            {
                header('Location:index.php?controller=orders&action=list');
                exit;
            }

            break;
        default:
            header('Location:index.php?controller=orders&action=list');
            exit;
    }