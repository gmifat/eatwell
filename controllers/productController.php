<?php

require 'models/product.php';
require 'models/category.php';
require 'models/origin.php';
require 'models/recipe.php';
require 'models/size.php';

// Fil d'ariane
$breadcrumb[] = '<a href="index.php">Accueil</a>';
$breadcrumb[] = '<a href="index.php?p=shop">Boutique</a>';

$categories = getAllCategories();
$sizes = getAllSizes();
$origins = getAllOrigins();
$recipes = getAllRecipes();

if (isset($_GET['id']) && !empty($_GET['id']))
{
    $product = getProductById($_GET['id']);
    if($product == false)
    {
        $_SESSION['messages_ko'][] = 'Produit introuvable';
        header('location:index.php?p=shop');
        exit;
    }

    $similarProducts = getSimilarProducts($_GET['id']);
}
else
{
    $_SESSION['messages_ko'][] = 'Merci de choisir un produit dans la liste';
    header('location:index.php?p=shop');
    exit;
}

$breadcrumb[] = '<a href="index.php?p=shop&category_id='.$product['category_id'].'">'.$product['category_name'].'</a>';
$breadcrumb[] = $product['name'];


$view = 'views/product.php';
