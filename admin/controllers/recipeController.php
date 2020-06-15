<?php
require_once 'models/recipe.php';

switch ($_GET['action'])
{
    case 'list':
        $recipes = getAllRecipes();
        $pageTitle = 'Type de recettes';
        $view = 'views/recipe/list.php';
        break;
    case 'list_produit':
        if (isset($_GET['id']) && !empty($_GET['id']))
        {
            $products = getAllProductsOfRecipe($_GET['id']);
            if($products == false)
            {
                $_SESSION['messages_ko'][] = 'Recette non trouvée !';
                header('Location:index.php?controller=recipes&action=list');
                exit;
            }
            $pageTitle = "List des produits référençant la Recette \"{$products[0]['name']}\"";
            $view = 'views/recipe/list_produit.php';
        }
        else
        {
            header('Location:index.php?controller=recipes&action=list');
            exit;
        }
        break;
    case 'view':
        if (isset($_GET['id']) && !empty($_GET['id']))
        {
            $recipe = getRecipeByIdWithDetails($_GET['id']);
            if($recipe == false)
            {
                $_SESSION['messages_ko'][] = 'Recette non trouvée !';
                header('Location:index.php?controller=recipes&action=list');
                exit;
            }

            $pageTitle = "Détails de la recette";
            $view = 'views/recipe/view.php';
        }
        else
        {
            header('Location:index.php?controller=recipes&action=list');
            exit;
        }
        break;
    case 'new':
        $pageTitle = 'Ajouter une recette';
        $view = 'views/recipe/add.php';
        break;
    case 'add':
        if (isValidRecipe($_POST))
        {
            $resultAdd = addRecipe($_POST);
            if ($resultAdd == true)
            {
                $_SESSION['messages_ok'][] = 'Recette ajoutée !';
            }
            else
            {
                $_SESSION['messages_ko'][] = "Erreur lors de l'ajout de la recette.";
            }

            header('Location:index.php?controller=recipes&action=list');
            exit;
        }
        else
        {
            $_SESSION['old_inputs'] = $_POST;
            header('Location:index.php?controller=recipes&action=new');
            exit;
        }
        break;
    case 'edit':
        if (isset($_GET['id']) && !empty($_GET['id']))
        {
            if (!isset($_SESSION['old_inputs']))
            {
                $recipe = getRecipeById($_GET['id']);
            }
            else
            {
                $recipe = $_SESSION['old_inputs'];
            }

            if($recipe == false)
            {
                $_SESSION['messages_ko'][] = 'Recette non trouvée !';
                header('Location:index.php?controller=recipes&action=list');
                exit;
            }

            $pageTitle = 'Modifier une recette';
            $view = 'views/recipe/edit.php';
        }
        else if (isset($_POST['id']) && !empty($_POST['id']))
        {
            // mise à jour de l'recipee
            if (isValidRecipe($_POST))
            {
                $update = updateRecipe($_POST);
                if ($update == true)
                {
                    $_SESSION['messages_ok'][] = 'Recette modifiée !';
                }
                else
                {
                    $_SESSION['messages_ko'][] = "Erreur lors de l'enregistrement de la recette.";
                }

                header('Location:index.php?controller=recipes&action=list');
                exit;
            }
            else
            {
                $_SESSION['old_inputs'] = $_POST;
                header('Location:index.php?controller=recipes&action=edit&id='.$_POST['id']);
                exit;
            }
        }
        else
        {
            header('Location:index.php?controller=recipes&action=list');
            exit;
        }
        break;
    case 'delete':
        if (isset($_GET['id']) && !empty($_GET['id']))
        {
            $recipe = getRecipeByIdWithDetails($_GET['id']);
            if($recipe == false)
            {
                $_SESSION['messages_ko'][] = 'Recette non trouvée !';
                header('Location:index.php?controller=recipes&action=list');
                exit;
            }

            $pageTitle = 'Supprimer une recette';
            $view = 'views/recipe/delete.php';
        }
        else if (isset($_POST['id']) && !empty($_POST['id']))
        {
            $delete = deleteRecipe($_POST);
            if ($delete == true)
            {
                $_SESSION['messages_ok'][] = 'Recette supprimée !';
            }
            else
            {
                $_SESSION['messages_ko'][] = "Erreur lors de la suppression de la recette.";
            }

            header('Location:index.php?controller=recipes&action=list');
            exit;
        }
        else
        {
            header('Location:index.php?controller=recipes&action=list');
            exit;
        }
        break;
    default:
        header('Location:index.php?controller=recipes&action=list');
        exit;
}