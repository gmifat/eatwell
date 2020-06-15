<?php
require_once 'models/review.php';

switch ($_GET['action'])
{
    case 'list':
        $orders = getAllReviews();
        $pageTitle = 'Liste des avis';
        $view = 'views/review/list.php';
        break;

    case 'new':

        break;
    default:
        header('Location:index.php?controller=reviews&action=list');
        exit;
}