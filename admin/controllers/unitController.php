<?php
require_once 'models/unit.php';

switch ($_GET['action'])
{
    case 'list':
        $units = getAllUnits();
        $pageTitle = 'Liste des unités';
        $view = 'views/unit/list.php';
        break;

    case 'list_produit':
        if (isset($_GET['id']) && !empty($_GET['id']))
        {
            $products = getAllProductsOfUnit($_GET['id']);
            if($products == false)
            {
                $_SESSION['messages_ko'][] = 'Unité non trouvée !';
                header('Location:index.php?controller=units&action=list');
                exit;
            }
            $pageTitle = "List des produits référençant l'unité \"{$products[0]['name']} ({$products[0]['symbol']})\"";
            $view = 'views/unit/list_produit.php';
        }
        else
        {
            header('Location:index.php?controller=units&action=list');
            exit;
        }
        break;

    case 'view':
        if (isset($_GET['id']) && !empty($_GET['id']))
        {
            $unit = getUnitByIdWithDetails($_GET['id']);
            if($unit == false)
            {
                $_SESSION['messages_ko'][] = 'Unité non trouvée !';
                header('Location:index.php?controller=units&action=list');
                exit;
            }

            $pageTitle = "Détails de l'unité";
            $view = 'views/unit/view.php';
        }
        else
        {
            header('Location:index.php?controller=units&action=list');
            exit;
        }
        break;

    case 'new':
        $pageTitle = 'Ajouter une unité';
        $view = 'views/unit/add.php';
        break;

    case 'add':
        if (isValidUnit($_POST))
        {
            $resultAdd = addUnit($_POST);
            if ($resultAdd == true)
            {
                $_SESSION['messages_ok'][] = 'Unité ajoutée !';
            }
            else
            {
                $_SESSION['messages_ko'][] = "Erreur lors de l'ajout de l'unité.";
            }

            header('Location:index.php?controller=units&action=list');
            exit;
        }
        else
        {
            $_SESSION['old_inputs'] = $_POST;
            header('Location:index.php?controller=units&action=new');
            exit;
        }
        break;

    case 'edit':
        if (isset($_GET['id']) && !empty($_GET['id']))
        {
            if (!isset($_SESSION['old_inputs']))
            {
                $unit = getUnitById($_GET['id']);
            }
            else
            {
                $unit = $_SESSION['old_inputs'];
            }

            if($unit == false)
            {
                $_SESSION['messages_ko'][] = 'Unité non trouvée !';
                header('Location:index.php?controller=units&action=list');
                exit;
            }

            $pageTitle = 'Modifier une unité';
            $view = 'views/unit/edit.php';
        }
        else if (isset($_POST['id']) && !empty($_POST['id']))
        {
            // mise à jour de l'unité
            if (isValidUnit($_POST))
            {
                $update = updateUnit($_POST);
                if ($update == true)
                {
                    $_SESSION['messages_ok'][] = 'Unité modifiée !';
                }
                else
                {
                    $_SESSION['messages_ko'][] = "Erreur lors de l'enregistrement de l'unité.";
                }

                header('Location:index.php?controller=units&action=list');
                exit;
            }
            else
            {
                $_SESSION['old_inputs'] = $_POST;
                header('Location:index.php?controller=units&action=edit&id='.$_POST['id']);
                exit;
            }
        }
        else
        {
            header('Location:index.php?controller=units&action=list');
            exit;
        }
        break;

    case 'delete':
        if (isset($_GET['id']) && !empty($_GET['id']))
        {
            $unit = getUnitByIdWithDetails($_GET['id']);
            if($unit == false)
            {
                $_SESSION['messages_ko'][] = 'Unité non trouvée !';
                header('Location:index.php?controller=units&action=list');
                exit;
            }

            $pageTitle = 'Supprimer une unité';
            $view = 'views/unit/delete.php';
        }
        else if (isset($_POST['id']) && !empty($_POST['id']))
        {
            $delete = deleteUnit($_POST);
            if ($delete == true)
            {
                $_SESSION['messages_ok'][] = 'Unité supprimée !';
            }
            else
            {
                $_SESSION['messages_ko'][] = "Erreur lors de la suppression de l'unité.";
            }

            header('Location:index.php?controller=units&action=list');
            exit;
        }
        else
        {
            header('Location:index.php?controller=units&action=list');
            exit;
        }
        break;

    default:
        header('Location:index.php?controller=units&action=list');
        exit;
}