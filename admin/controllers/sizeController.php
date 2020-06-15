<?php
require_once 'models/size.php';

switch ($_GET['action'])
{
    case 'list':
        $sizes = getAllSizes();
        $pageTitle = 'Type de calibres';
        $view = 'views/size/list.php';
        break;
    case 'list_produit':
        if (isset($_GET['id']) && !empty($_GET['id']))
        {
            $products = getAllProductsOfSize($_GET['id']);
            if($products == false)
            {
                $_SESSION['messages_ko'][] = 'Calibre non trouvée !';
                header('Location:index.php?controller=sizes&action=list');
                exit;
            }
            $pageTitle = "List des produits référençant le Calibre \"{$products[0]['name']}\"";
            $view = 'views/size/list_produit.php';
        }
        else
        {
            header('Location:index.php?controller=sizes&action=list');
            exit;
        }
        break;
    case 'view':
        if (isset($_GET['id']) && !empty($_GET['id']))
        {
            $size = getSizeByIdWithDetails($_GET['id']);
            if($size == false)
            {
                $_SESSION['messages_ko'][] = 'Calibre non trouvée !';
                header('Location:index.php?controller=sizes&action=list');
                exit;
            }

            $pageTitle = "Détails du calibre";
            $view = 'views/size/view.php';
        }
        else
        {
            header('Location:index.php?controller=sizes&action=list');
            exit;
        }
        break;
    case 'new':
        $pageTitle = 'Ajouter un calibre';
        $view = 'views/size/add.php';
        break;
    case 'add':
        if (isValidSize($_POST))
        {
            $resultAdd = addSize($_POST);
            if ($resultAdd == true)
            {
                $_SESSION['messages_ok'][] = 'Calibre ajoutée !';
            }
            else
            {
                $_SESSION['messages_ko'][] = "Erreur lors de l'ajout du calibre.";
            }

            header('Location:index.php?controller=sizes&action=list');
            exit;
        }
        else
        {
            $_SESSION['old_inputs'] = $_POST;
            header('Location:index.php?controller=sizes&action=new');
            exit;
        }
        break;
    case 'edit':
        if (isset($_GET['id']) && !empty($_GET['id']))
        {
            if (!isset($_SESSION['old_inputs']))
            {
                $size = getSizeById($_GET['id']);
            }
            else
            {
                $size = $_SESSION['old_inputs'];
            }

            if($size == false)
            {
                $_SESSION['messages_ko'][] = 'Calibre non trouvée !';
                header('Location:index.php?controller=sizes&action=list');
                exit;
            }

            $pageTitle = 'Modifier un calibre';
            $view = 'views/size/edit.php';
        }
        else if (isset($_POST['id']) && !empty($_POST['id']))
        {
            // mise à jour de l'sizee
            if (isValidSize($_POST))
            {
                $update = updateSize($_POST);
                if ($update == true)
                {
                    $_SESSION['messages_ok'][] = 'Calibre modifié !';
                }
                else
                {
                    $_SESSION['messages_ko'][] = "Erreur lors de l'enregistrement du calibre.";
                }

                header('Location:index.php?controller=sizes&action=list');
                exit;
            }
            else
            {
                $_SESSION['old_inputs'] = $_POST;
                header('Location:index.php?controller=sizes&action=edit&id='.$_POST['id']);
                exit;
            }
        }
        else
        {
            header('Location:index.php?controller=sizes&action=list');
            exit;
        }
        break;
    case 'delete':
        if (isset($_GET['id']) && !empty($_GET['id']))
        {
            $size = getSizeByIdWithDetails($_GET['id']);
            if($size == false)
            {
                $_SESSION['messages_ko'][] = 'Calibre non trouvé !';
                header('Location:index.php?controller=sizes&action=list');
                exit;
            }

            $pageTitle = 'Supprimer un calibre';
            $view = 'views/size/delete.php';
        }
        else if (isset($_POST['id']) && !empty($_POST['id']))
        {
            $delete = deleteSize($_POST);
            if ($delete == true)
            {
                $_SESSION['messages_ok'][] = 'Calibre supprimé !';
            }
            else
            {
                $_SESSION['messages_ko'][] = "Erreur lors de la suppression du calibre.";
            }

            header('Location:index.php?controller=sizes&action=list');
            exit;
        }
        else
        {
            header('Location:index.php?controller=sizes&action=list');
            exit;
        }
        break;
    default:
        header('Location:index.php?controller=sizes&action=list');
        exit;
}