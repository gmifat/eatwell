<?php
function getAllRecipes()
{
    $db = dbConnect();
    $query = $db->query('SELECT * FROM recipes ORDER BY name');
    $recipes = $query->fetchAll();
    return $recipes;
}