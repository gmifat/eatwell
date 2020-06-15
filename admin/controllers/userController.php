<?php
require_once 'models/user.php';

switch ($_GET['action'])
{
    case 'list':
        $orders = getAllUsers();
        $pageTitle = 'List des utilisateurs';
        $view = 'views/user/list.php';
        break;

    case 'new':

        break;
    default:
        header('Location:index.php?controller=users&action=list');
        exit;
}