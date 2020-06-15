<?php
    require_once 'models/category.php';
    require_once 'models/origin.php';
    require_once 'models/unit.php';
    require_once 'models/size.php';
    require_once 'models/recipe.php';
    require_once 'models/product.php';
    require_once 'models/promotion.php';

    switch ($_GET['action'])
    {
        case 'list':
            $products = getAllProducts(isset($_GET['filter']) ? $_GET['filter'] : 'active');
            $pageTitle = 'Liste des produits';
            $view = 'views/product/list.php';
            break;
        case 'view':
            if (isset($_GET['id']) && !empty($_GET['id']))
            {
                $product = getProductById($_GET['id']);
                if($product == false)
                {
                    $_SESSION['messages_ko'][] = 'Produit non trouvé !';
                    header('Location:index.php?controller=products&action=list');
                    exit;
                }

                $pageTitle = "Détails d'un produit";
                $view = 'views/product/view.php';
            }
            else
            {
                header('Location:index.php?controller=products&action=list');
                exit;
            }
            break;
        case 'new':
            //formulaire vide
            // catégorie feuille uniquement
            $categories = getAllCategories();
            $units = getAllUnits();
            $sizes = getAllSizes();
            $recipes = getAllRecipes();
            $origins = getAllOrigins();
            $discount_types = getAllDiscountTypes();
            $pageTitle = 'Ajouter un nouveau produit';
            $view = 'views/product/add.php';
            break;
        case 'add':
            if (isValidProduct($_POST))
            {
                $resultAdd = addProduct($_POST);
                if ($resultAdd == true)
                {
                    $_SESSION['messages_ok'][] = 'Produit ajouté !';
                }
                else
                {
                    $_SESSION['messages_ko'][] = "Erreur lors de l'ajout du produit.";
                }

                header('Location:index.php?controller=products&action=list');
                exit;
            }
            else
            {
                $_SESSION['old_inputs'] = $_POST;
                header('Location:index.php?controller=products&action=new');
                exit;
            }
            break;
        case 'edit':
            if (isset($_GET['id']) && !empty($_GET['id']))
            {
                if (!isset($_SESSION['old_inputs']))
                {
                    $product = getProductById($_GET['id']);
                }
                else
                {
                    $product = $_SESSION['old_inputs'];
                }

                if($product == false)
                {
                    $_SESSION['messages_ko'][] = 'Produit non trouvé !';
                    header('Location:index.php?controller=products&action=list');
                    exit;
                }

                $categories = getAllCategories();
                $units = getAllUnits();
                $sizes = getAllSizes();
                $recipes = getAllRecipes();
                $origins = getAllOrigins();
                $discount_types = getAllDiscountTypes();
                $pageTitle = 'Modifier un produit';
                $view = 'views/product/edit.php';
            }
            else if (isset($_POST['id']) && !empty($_POST['id']))
            {
                // mise à jour du produit
                if (isValidProduct($_POST))
                {
                    $update = updateProduct($_POST);
                    if ($update == true)
                    {
                        $_SESSION['messages_ok'][] = 'Produit modifié !';
                    }
                    else
                    {
                        $_SESSION['messages_ko'][] = "Erreur lors de l'enregistrement du produit.";
                    }

                    header('Location:index.php?controller=products&action=list');
                    exit;
                }
                else
                {
                    $_SESSION['old_inputs'] = $_POST;
                    header('Location:index.php?controller=products&action=edit&id='.$_POST['id']);
                    exit;
                }
            }
            else
            {
                header('Location:index.php?controller=products&action=list');
                exit;
            }
            break;
        case 'delete':
            if (isset($_GET['id']) && !empty($_GET['id']))
            {
                $product = getProductById($_GET['id']);
                if($product == false)
                {
                    $_SESSION['messages_ko'][] = 'Produit non trouvé !';
                    header('Location:index.php?controller=products&action=list');
                    exit;
                }

                $pageTitle = 'Supprimer un produit';
                $view = 'views/product/delete.php';
            }
            else if (isset($_POST['id']) && !empty($_POST['id']))
            {
                $delete = deleteProduct($_POST['id']);
                if ($delete == true)
                {
                    $_SESSION['messages_ok'][] = 'Produit archivé avec succès !';
                }
                else
                {
                    $_SESSION['messages_ko'][] = "Erreur lors de l'archivage du produit.";
                }

                header('Location:index.php?controller=products&action=list');
                exit;
            }
            else
            {
                header('Location:index.php?controller=products&action=list');
                exit;
            }
            break;
        case 'activate':
            if (isset($_GET['id']) && !empty($_GET['id']))
            {
                $product = getProductById($_GET['id']);
                if($product == false)
                {
                    $_SESSION['messages_ko'][] = 'Produit non trouvé !';
                    header('Location:index.php?controller=products&action=list');
                    exit;
                }

                $pageTitle = 'Activer un produit';
                $view = 'views/product/activate.php';
            }
            else if (isset($_POST['id']) && !empty($_POST['id']))
            {
                $delete = undeleteProduct($_POST['id']);
                if ($delete == true)
                {
                    $_SESSION['messages_ok'][] = 'Produit activé avec succès !';
                }
                else
                {
                    $_SESSION['messages_ko'][] = "Erreur lors de l'activage du produit.";
                }

                header('Location:index.php?controller=products&action=list');
                exit;
            }
            else
            {
                header('Location:index.php?controller=products&action=list');
                exit;
            }
            break;
        default:
            header('Location:index.php?controller=products&action=list');
            exit;
    }