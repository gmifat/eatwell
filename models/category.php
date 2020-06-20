<?php

    // Récupérer la liste des catégories
    function getAllCategories()
    {
        $db = dbConnect();
        $query = $db->query('SELECT categories.id, categories.name, categories.parent_id, COUNT(products.id) nb_products FROM categories 
LEFT JOIN products on products.category_id = categories.id
Group by categories.id, categories.name, categories.parent_id
order by categories.parent_id');
        $categories = $query->fetchAll();
        $query->closeCursor();

        return $categories;
    }