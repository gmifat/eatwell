<?php
require_once 'models/promotion.php';

switch ($_GET['action'])
{
    case 'list':
        $promotions = getAllPromotions();
        $pageTitle = 'Liste des promotions';
        $view = 'views/promotion/list.php';
        break;
    case 'new':
        $discount_types = getAllDiscountTypes();
        $pageTitle = 'Ajouter une promotion';
        $view = 'views/promotion/add.php';
        break;
    default:
        header('Location:index.php?controller=promotions&action=list');
        exit;
}