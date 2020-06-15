<?php
    require_once 'models/category.php';

    switch ($_GET['action'])
    {
        case 'list':
            $categories = getAllCategories();
            $pageTitle = 'Liste des catégories';
            $view = 'views/category/list.php';
            break;

        case 'view':
            if (isset($_GET['id']) && !empty($_GET['id']))
            {
                $category = getCategoryByIdWithDetails($_GET['id']);
                if($category == false)
                {
                    $_SESSION['messages_ko'][] = 'Catégorie non trouvée !';
                    header('Location:index.php?controller=categories&action=list');
                    exit;
                }

                $pageTitle = 'Détail de la catégorie';
                $view = 'views/category/view.php';
            }
            else
            {
                header('Location:index.php?controller=categories&action=list');
                exit;
            }
            break;

        case 'new':
            $categories = getAllCategories();
            $pageTitle = 'Ajouter une catégorie';
            $view = 'views/category/add.php';
            break;

        case 'add':
            if (isValidCategory($_POST))
            {
                $resultAdd = addCategory($_POST);
                if ($resultAdd == true)
                {
                    $_SESSION['messages_ok'][] = 'Catégorie ajoutée !';
                }
                else
                {
                    $_SESSION['messages_ko'][] = "Erreur lors de l'ajout de la catégorie.";
                }

                header('Location:index.php?controller=categories&action=list');
                exit;
            }
            else
            {
                $_SESSION['old_inputs'] = $_POST;
                header('Location:index.php?controller=categories&action=new');
                exit;
            }
            break;

        case 'edit':
            if (isset($_GET['id']) && !empty($_GET['id']))
            {
                if (!isset($_SESSION['old_inputs']))
                {
                    $category = getCategoryById($_GET['id']);
                }
                else
                {
                    $category = $_SESSION['old_inputs'];
                }

                if($category == false)
                {
                    $_SESSION['messages_ko'][] = 'Catégorie non trouvée !';
                    header('Location:index.php?controller=categories&action=list');
                    exit;
                }

                $categories = getAllCategories($_GET['id']);
                $pageTitle = 'Modifier une catégorie';
                $view = 'views/category/edit.php';
            }
            else if (isset($_POST['id']) && !empty($_POST['id']))
            {
                 // mise à jour de la catégorie
                if (isValidCategory($_POST))
                {
                    $update = updateCategory($_POST);
                    if ($update == true)
                    {
                        $_SESSION['messages_ok'][] = 'Catégorie modifiée !';
                    }
                    else
                    {
                        $_SESSION['messages_ko'][] = "Erreur lors de l'enregistrement de la catégorie.";
                    }

                    header('Location:index.php?controller=categories&action=list');
                    exit;
                }
                else
                {
                    $_SESSION['old_inputs'] = $_POST;
                    header('Location:index.php?controller=categories&action=edit&id='.$_POST['id']);
                    exit;
                }
            }
            else
            {
                header('Location:index.php?controller=categories&action=list');
                exit;
            }
            break;

        case 'delete':
            if (isset($_GET['id']) && !empty($_GET['id']))
            {
                $category = getCategoryByIdWithDetails($_GET['id']);
                if($category == false)
                {
                    $_SESSION['messages_ko'][] = 'Catégorie non trouvée !';
                    header('Location:index.php?controller=categories&action=list');
                    exit;
                }

                $pageTitle = 'Supprimer une catégorie';
                $view = 'views/category/delete.php';
            }
            else if (isset($_POST['id']) && !empty($_POST['id']))
            {
                $delete = deleteCategory($_POST);
                if ($delete == true)
                {
                    $_SESSION['messages_ok'][] = 'Catégorie supprimée !';
                }
                else
                {
                    $_SESSION['messages_ko'][] = "Erreur lors de la suppression de la catégorie.";
                }

                header('Location:index.php?controller=categories&action=list');
                exit;
            }
            else
            {
                header('Location:index.php?controller=categories&action=list');
                exit;
            }
            break;

        default:
            header('Location:index.php?controller=categories&action=list');
            exit;
    }