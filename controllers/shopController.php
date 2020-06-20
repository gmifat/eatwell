<?php

if(isset($_GET['cart']))
{

}

require 'models/product.php';
require 'models/category.php';
require 'models/origin.php';
require 'models/recipe.php';
require 'models/size.php';

// Fil d'ariane
$breadcrumb[] = '<a href="index.php">Accueil</a>';


$categories = getAllCategories();
$sizes = getAllSizes();
$origins = getAllOrigins();
$recipes = getAllRecipes();

if (isset($_GET['category_id']) && !empty($_GET['category_id']))
{
    $selected_category = null;
    foreach ($categories as $category)
    {
        if ($category['id'] == $_GET['category_id'])
        {
            $selected_category = $category;
        }
    }

    if ($selected_category == null)
    {
        $_SESSION['message_ko'] = 'Catégorie non trouvée';
        $breadcrumb[] = 'Boutique';
        $products = getAllActiveProducts();
    }
    else
    {
        $breadcrumb[] = '<a href="index.php?p=shop">Boutique</a>';
        $breadcrumb[] = $selected_category['name'];
        $products = getAllActiveProducts($selected_category['id']);
    }
}
else
{
    $breadcrumb[] = 'Boutique';
    $products = getAllActiveProducts();
}




$view = 'views/shop.php';