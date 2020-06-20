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

    // on a un seul niveau de catégorie
    function getAllParentCategories($without_id = null)
    {
        $db = dbConnect();

        if ($without_id != null)
        {
            $query = $db->prepare('SELECT category.* FROM categories category  WHERE category.parent_id is null && category.id != :id ORDER BY name ');
            $query->execute([':id' => $without_id]);
        }
        else
        {
            $query = $db->query('SELECT category.* FROM categories category WHERE category.parent_id is null ORDER BY name');
        }

        $categories = $query->fetchAll();
        $query->closeCursor();

        return $categories;
    }

    function getChild($id)
    {
        $db = dbConnect();
        $query = $db->prepare('SELECT category.* FROM categories category  WHERE category.parent_id = :id ORDER BY name ');
        $query->execute([':id' => $id]);
        return $query->fetchAll();
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

    function isValidCategory($informations)
    {
        $return = true;
        if(empty($informations['name']))
        {
            $_SESSION['messages_ko'][] = 'Le champ nom est obligatoire !';
            $return = false;
        }

        if (!isset($_FILES['thumbnail']) || empty($_FILES['thumbnail']['name']))
        {
            $_SESSION['messages_ko'][] = 'La vignette de la catégorie est obligatoire !';
            $return = false;
        }
        else if($_FILES['thumbnail']['size'] > 2097152)
        {
            $_SESSION['messages_ko'][] = 'La taille de la vignette ne doit dépasser la taille de 2M !';
            $return = false;
        }

        if (isset($_FILES['icon']) && !empty($_FILES['icon']['name']) && $_FILES['icon']['size'] > 2097152)
        {
            $_SESSION['messages_ko'][] = 'La taille de l\'icône ne doit dépasser la taille de 2M !';
            $return = false;
        }

        // si les données sont valides, on vérifie que ce n'est pas un doublon
        if ($return)
        {
            $db = dbConnect();
            if (isset($informations['id']) && !empty($informations['id'])) {
                $query = $db->prepare('SELECT * FROM categories WHERE id!=:id && name=:name');
                $query->execute([
                    ':id' => $informations['id'],
                    ':name' => $informations['name'],
                ]);
            } else {
                $query = $db->prepare('SELECT * FROM categories WHERE name=:name');
                $query->execute([
                    ':name' => $informations['name'],
                ]);
            }

            if ($query->fetch() != false) {
                $_SESSION['messages_ko'][] = 'Une catégorie existe avec le même nom !';
                $return = false;
            }
        }

        return $return;
    }

    function addCategory($informations)
    {
        $db = dbConnect();
        $query = $db->prepare('INSERT INTO categories(name, description, color, parent_id) VALUES (:name, :description, :color, :parent_id)');
        $result=  $query->execute([
            ':name' => $informations['name'],
            ':description' => $informations['description'],
            ':color' => $informations['color'],
            ':parent_id' => empty($informations['parent_id']) ? null : $informations['parent_id'],
        ]);

        if ($result)
        {
            // Ajouter image
            $categoryId = $db->lastInsertId();
            $allowed_extensions = array( 'jpg' , 'jpeg' , 'gif', 'png' );
            if (isset($_FILES['icon']) && !empty($_FILES['icon']))
            {
                $my_file_extension = pathinfo( $_FILES['icon']['name'] , PATHINFO_EXTENSION);

                if (in_array($my_file_extension , $allowed_extensions))
                {
                    $new_file_name = $categoryId . '.' . $my_file_extension;
                    $destination = '../assets/images/category/icon/' . $new_file_name;
                    $result = move_uploaded_file($_FILES['icon']['tmp_name'], $destination);

                    $db->query("UPDATE categories SET icon = '$new_file_name' WHERE id = $categoryId");
                }
            }

            if (isset($_FILES['thumbnail']) && !empty($_FILES['thumbnail']))
            {
                $my_file_extension = pathinfo( $_FILES['thumbnail']['name'] , PATHINFO_EXTENSION);

                if (in_array($my_file_extension , $allowed_extensions))
                {
                    $new_file_name = $categoryId . '.' . $my_file_extension;
                    $destination = '../assets/images/category/thumbnail/' . $new_file_name;
                    $result = move_uploaded_file($_FILES['thumbnail']['tmp_name'], $destination);

                    $db->query("UPDATE categories SET thumbnail = '$new_file_name' WHERE id = $categoryId");
                }
            }
        }

        return $result;
    }

    function updateCategory($informations)
    {
        $db = dbConnect();
        $query = $db->prepare('UPDATE categories SET name=:name, description=:description, color=:color, parent_id =:parent_id WHERE id=:id');
        $result = $query->execute([
            ':id' => $informations['id'],
            ':name' => $informations['name'],
            ':description' => $informations['description'],
            ':color' => $informations['color'],
            ':parent_id' => empty($informations['parent_id']) ? null : $informations['parent_id'],
        ]);

        if ($result)
        {
            // Mise à jour des images
            $allowed_extensions = array( 'jpg' , 'jpeg' , 'gif', 'png' );
            if (isset($_FILES['icon']) && !empty($_FILES['icon']))
            {
                $my_file_extension = pathinfo( $_FILES['icon']['name'] , PATHINFO_EXTENSION);

                if (in_array($my_file_extension , $allowed_extensions))
                {
                    $new_file_name = $categoryId . '.' . $my_file_extension;
                    $destination = '../assets/images/category/icon/' . $new_file_name;
                    clearstatcache();
                    if(file_exists($destination)) {
                        unlink($destination);
                    }
                    $result = move_uploaded_file($_FILES['icon']['tmp_name'], $destination);

                    $db->query("UPDATE categories SET icon = '$new_file_name' WHERE id = $categoryId");
                }
            }

            if (isset($_FILES['thumbnail']) && !empty($_FILES['thumbnail']))
            {
                $my_file_extension = pathinfo( $_FILES['thumbnail']['name'] , PATHINFO_EXTENSION);

                if (in_array($my_file_extension , $allowed_extensions))
                {
                    $new_file_name = $categoryId . '.' . $my_file_extension;
                    $destination = '../assets/images/category/thumbnail/' . $new_file_name;
                    clearstatcache();
                    if(file_exists($destination)) {
                        unlink($destination);
                    }
                    $result = move_uploaded_file($_FILES['thumbnail']['tmp_name'], $destination);
                    $db->query("UPDATE categories SET thumbnail = '$new_file_name' WHERE id = $categoryId");
                }
            }
        }

        return $result;
    }

    function deleteCategory($informations)
    {
        $db = dbConnect();
        $query = $db->prepare('SELECT category.* FROM categories category WHERE category.id = :id');
        $query->execute([':id' => $informations['id']]);
        $category = $query->fetch();
        if ($category)
        {
            $query = $db->prepare('DELETE FROM categories WHERE id=:id');
            $result = $query->execute([':id' => $informations['id']]);
            if ($result) {

                if (!empty($category['icon'])) {
                    $destination = '../assets/images/category/icon/' . $category['icon'];
                    clearstatcache();
                    if (file_exists($destination)) {
                        unlink($destination);
                    }
                }

                if (!empty($category['thumbnail']))
                {
                    $destination = '../assets/images/category/thumbnail/' . $category['thumbnail'];
                    clearstatcache();
                    if (file_exists($destination)) {
                        unlink($destination);
                    }
                }
            }
            return $result;
        }

        return false;
    }