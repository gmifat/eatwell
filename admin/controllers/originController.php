<?php
require_once 'models/origin.php';

switch ($_GET['action'])
{
    case 'list':
        $origins = getAllOrigins();
        $pageTitle = 'Origine des produits';
        $view = 'views/origin/list.php';
        break;
    case 'list_produit':
        if (isset($_GET['id']) && !empty($_GET['id']))
        {
            $products = getAllProductsOfOrigin($_GET['id']);
            if($products == false)
            {
                $_SESSION['messages_ko'][] = 'Origine produit non trouvée !';
                header('Location:index.php?controller=origins&action=list');
                exit;
            }
            $pageTitle = "List des produits référençant l'origine produit \"{$products[0]['name']}\"";
            $view = 'views/origin/list_produit.php';
        }
        else
        {
            header('Location:index.php?controller=origins&action=list');
            exit;
        }
        break;
    case 'view':
        if (isset($_GET['id']) && !empty($_GET['id']))
        {
            $origin = getOriginByIdWithDetails($_GET['id']);
            if($origin == false)
            {
                $_SESSION['messages_ko'][] = 'Origine produit non trouvée !';
                header('Location:index.php?controller=origins&action=list');
                exit;
            }

            $pageTitle = "Détails de l'origine produit";
            $view = 'views/origin/view.php';
        }
        else
        {
            header('Location:index.php?controller=origins&action=list');
            exit;
        }
        break;
    case 'new':
        $pageTitle = 'Ajouter une origine des produits';
        $view = 'views/origin/add.php';
        break;
    case 'add':
        if (isValidOrigin($_POST))
        {
            $resultAdd = addOrigin($_POST);
            if ($resultAdd == true)
            {
                $_SESSION['messages_ok'][] = 'Origine produit ajoutée !';
            }
            else
            {
                $_SESSION['messages_ko'][] = "Erreur lors de l'ajout de l'origine du produit.";
            }

            header('Location:index.php?controller=origins&action=list');
            exit;
        }
        else
        {
            $_SESSION['old_inputs'] = $_POST;
            header('Location:index.php?controller=origins&action=new');
            exit;
        }
        break;
    case 'edit':
        if (isset($_GET['id']) && !empty($_GET['id']))
        {
            if (!isset($_SESSION['old_inputs']))
            {
                $origin = getOriginById($_GET['id']);
            }
            else
            {
                $origin = $_SESSION['old_inputs'];
            }

            if($origin == false)
            {
                $_SESSION['messages_ko'][] = 'Origine produit non trouvée !';
                header('Location:index.php?controller=origins&action=list');
                exit;
            }

            $pageTitle = 'Modifier une origine des produits';
            $view = 'views/origin/edit.php';
        }
        else if (isset($_POST['id']) && !empty($_POST['id']))
        {
            // mise à jour de l'origine
            if (isValidOrigin($_POST))
            {
                $update = updateOrigin($_POST);
                if ($update == true)
                {
                    $_SESSION['messages_ok'][] = 'Origine produit modifiée !';
                }
                else
                {
                    $_SESSION['messages_ko'][] = "Erreur lors de l'enregistrement de l'origine produit.";
                }

                header('Location:index.php?controller=origins&action=list');
                exit;
            }
            else
            {
                $_SESSION['old_inputs'] = $_POST;
                header('Location:index.php?controller=origins&action=edit&id='.$_POST['id']);
                exit;
            }
        }
        else
        {
            header('Location:index.php?controller=origins&action=list');
            exit;
        }
        break;
    case 'delete':
        if (isset($_GET['id']) && !empty($_GET['id']))
        {
            $origin = getOriginByIdWithDetails($_GET['id']);
            if($origin == false)
            {
                $_SESSION['messages_ko'][] = 'Origine produit non trouvée !';
                header('Location:index.php?controller=origins&action=list');
                exit;
            }

            $pageTitle = 'Supprimer un origine de produit';
            $view = 'views/origin/delete.php';
        }
        else if (isset($_POST['id']) && !empty($_POST['id']))
        {
            $delete = deleteOrigin($_POST);
            if ($delete == true)
            {
                $_SESSION['messages_ok'][] = 'Origine produit supprimée !';
            }
            else
            {
                $_SESSION['messages_ko'][] = "Erreur lors de la suppression de l'origine produit.";
            }

            header('Location:index.php?controller=origins&action=list');
            exit;
        }
        else
        {
            header('Location:index.php?controller=origins&action=list');
            exit;
        }
        break;
    default:
        header('Location:index.php?controller=origins&action=list');
        exit;
}