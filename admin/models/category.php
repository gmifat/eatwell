<?php
    function getAllCategories($without_id = null)
    {
        $db = dbConnect();

        if ($without_id != null)
        {
            $query = $db->prepare('SELECT category.*, parent.name parent_name FROM categories category LEFT JOIN categories parent on category.parent_id = parent.id WHERE category.id != :id ORDER BY category.parent_id, name ');
            $query->execute([':id' => $without_id]);
        }
        else
        {
            $query = $db->query('SELECT category.*, parent.name parent_name FROM categories category LEFT JOIN categories parent on category.parent_id = parent.id ORDER BY category.parent_id, name ');
        }

        $categories = $query->fetchAll();
        $query->closeCursor();

        return $categories;
    }

    function getCategoryById($id)
    {
        $db = dbConnect();
        $query = $db->prepare('SELECT category.*, parent.name parent_name 
FROM categories category 
LEFT JOIN categories parent on category.parent_id = parent.id 
WHERE category.id = :id
ORDER BY category.parent_id, name');
        $query->execute([':id' => $id]);
        $category = $query->fetch();
        $query->closeCursor();
        return $category;
    }

    function getCategoryByIdWithDetails($id)
    {
        $category = getCategoryById($id);
        if ($category == false)
        {
            return false;
        }

        // récupérer les sous catégories
        $db = dbConnect();
        $query = $db->prepare('SELECT *
FROM categories category 
WHERE category.parent_id = :id
ORDER BY name');
        $query->execute([':id' => $id]);
        $sub_categories = $query->fetchAll();
        $query->closeCursor();
        $category['sub_categories'] = $sub_categories;

        // récupérer les produits de la catégorie et des sous catégories
        $in_array[] = $id;
        if ($sub_categories != false)
        {
            foreach ($sub_categories as $sub_category)
            {
                $in_array[] = $sub_category['id'];
            }
        }
        $in  = str_repeat('?,', count($in_array) - 1) . '?';

        $query = $db->prepare("SELECT product.*, category.* 
FROM products product
JOIN categories category on category.id = product.category_id 
WHERE category.id IN ($in)
ORDER BY category.name, product.name");
        $query->execute($in_array);
        $products = $query->fetchAll();
        $query->closeCursor();
        $category['products'] = $products;
        return $category;
    }