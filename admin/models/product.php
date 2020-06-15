<?php
    function getAllProducts($filter)
    {
        $db = dbConnect();
        $string_query = 'select product.*, category.name category_name, origin.name origin_name, size.name size_name, unit.name unit_name, discount_type.code discount_type_code, discount_type.name discount_type_name from products product
LEFT JOIN categories category on product.category_id = category.id
LEFT JOIN origins origin on product.origin_id = origin.id
LEFT JOIN sizes size on product.size_id = size.id
LEFT JOIN units unit on product.unit_id = unit.id
LEFT JOIN discount_types discount_type on product.discount_type_id = discount_type.id';

        switch ($filter)
        {
            case 'active':
                $string_query.= ' WHERE is_deleted = 0';
                break;
            case 'deleted':
                $string_query.= ' WHERE is_deleted = 1';
                break;
        }

        $string_query.=' ORDER BY name';

        $query = $db->query($string_query);
        $products = $query->fetchAll();

        return $products;
    }

    function getAllProductsPagination($limit, $page)
    {
        $db = dbConnect();
        $start = ($page - 1) * $limit;
        $query = $db->prepare('SELECT * FROM products LIMIT :limit OFFSET :start ORDER BY name');
        $query->execute([
            ':limit' => $limit,
            ':start' => $start]);
        $products = $query->fetchAll();

        return $products;
    }


    function isValidProduct($informations)
    {
        $return = true;
        if (empty($informations['name']))
        {
            $_SESSION['messages_ko'][] = 'Le champ nom est obligatoire !';
            $return = false;
        }


        if (empty($informations['reference']))
        {
            $_SESSION['messages_ko'][] = 'Le champ reference est obligatoire !';
            $return = false;
        }

        if (empty($informations['short_description']))
        {
            $_SESSION['messages_ko'][] = 'Le champ description courte est obligatoire !';
            $return = false;
        }

        if (empty($informations['long_description']))
        {
            $_SESSION['messages_ko'][] = 'Le champ description longue est obligatoire !';
            $return = false;
        }

        if (empty($informations['price']))
        {
            $_SESSION['messages_ko'][] = 'Le champ prix est obligatoire !';
            $return = false;
        }

        if (empty($informations['unit_price']))
        {
            $_SESSION['messages_ko'][] = 'Le champ prix unitaire est obligatoire !';
            $return = false;
        }

        if (empty($informations['category_id']))
        {
            $_SESSION['messages_ko'][] = 'Le champ catégorie est obligatoire !';
            $return = false;
        }

        if (empty($informations['unit_id']))
        {
            $_SESSION['messages_ko'][] = 'Le type d\'unité  est obligatoire !';
            $return = false;
        }

        if (empty($informations['origin_id']))
        {
            $_SESSION['messages_ko'][] = 'Le champ origine est obligatoire !';
            $return = false;
        }
        if (!empty($informations['discount']) && empty($informations['discount_type_id']))
        {
            $_SESSION['messages_ko'][] = 'Le champ type de promotion est obligatoire !';
            $return = false;
        }

        // si les données sont valides, on vérifie que ce n'est pas un doublon
        if ($return) {
            $db = dbConnect();
            if (isset($informations['id']) && !empty($informations['id'])) {
                $query = $db->prepare('SELECT * FROM products product WHERE id!=:id && (name=:name || reference=:reference)');
                $query->execute([
                    ':id' => $informations['id'],
                    ':name' => $informations['name'],
                    ':reference' => $informations['reference']
                ]);
            } else {
                $query = $db->prepare('SELECT * FROM products product WHERE name=:name || reference=:reference');
                $query->execute([
                    ':name' => $informations['name'],
                    ':reference' => $informations['reference']
                ]);
            }

            if ($query->fetch() != false) {
                $_SESSION['messages_ko'][] = 'Un produit existe déjà avec le même nom ou la même référence !';
                $return = false;
            }
        }
        return $return;
    }

    function addProduct($informations)
    {
        $db = dbConnect();
        $query = $db->prepare('INSERT INTO products(reference, name, short_description, long_description, price, unit_price, unit_id, origin_id, category_id, size_id, is_new, 
is_home_page, is_available, discount, discount_type_id) 
VALUES (:reference, :name, :short_description, :long_description, :price, :unit_price, :unit_id, :origin_id, :category_id, :size_id, :is_new, :is_home_page, :is_available, :discount, :discount_type_id)');
        $result = $query->execute([
            ':reference' => $informations['reference'],
            ':name' => $informations['name'],
            ':short_description' => $informations['short_description'],
            ':long_description' => $informations['long_description'],
            ':price' => $informations['price'],
            ':unit_price' => $informations['unit_price'],
            ':unit_id' => $informations['unit_id'],
            ':origin_id' => $informations['origin_id'],
            ':category_id' => $informations['category_id'],
            ':size_id' => $informations['size_id'],
            ':is_new' =>  (isset($informations['is_new']) && $informations['is_new'] == 'is_new') ? 1 : 0,
            ':is_home_page' => (isset($informations['is_home_page']) && $informations['is_home_page'] == 'is_home_page') ? 1 : 0,
            ':is_available' => (isset($informations['is_available']) && $informations['is_available'] == 'is_available') ? 1 : 0,
            ':discount' => empty($informations['discount']) ? null : $informations['discount'],
            ':discount_type_id' => empty($informations['discount_type_id']) ? null : $informations['discount_type_id']
        ]);

        if($result)
        {
            $product_id = $db->lastInsertId();
            setRecipes($db, $product_id, $informations);
            updateThumbnailAndImage($db, $product_id);
        }

        return $result;
    }

    function updateProduct($informations)
    {
        $db = dbConnect();
        $query = $db->prepare('UPDATE products SET reference=:reference, name=:name, short_description=:short_description, long_description=:long_description, price=:price, unit_price=:unit_price, 
unit_id=:unit_id, origin_id=:origin_id, category_id=:category_id, size_id=:size_id, is_new=:is_new, 
is_home_page=:is_home_page, is_available=:is_available, discount=:discount, discount_type_id=:discount_type_id WHERE id=:id');
        $result =  $query->execute([
            ':id' => $informations['id'],
            ':reference' => $informations['reference'],
            ':name' => $informations['name'],
            ':short_description' => $informations['short_description'],
            ':long_description' => $informations['long_description'],
            ':price' => $informations['price'],
            ':unit_price' => $informations['unit_price'],
            ':unit_id' => $informations['unit_id'],
            ':origin_id' => $informations['origin_id'],
            ':category_id' => $informations['category_id'],
            ':size_id' => $informations['size_id'],
            ':is_new' =>  (isset($informations['is_new']) && $informations['is_new'] == 'is_new') ? 1 : 0,
            ':is_home_page' => (isset($informations['is_home_page']) && $informations['is_home_page'] == 'is_home_page') ? 1 : 0,
            ':is_available' => (isset($informations['is_available']) && $informations['is_available'] == 'is_available') ? 1 : 0,
            ':discount' => empty($informations['discount']) ? null : $informations['discount'],
            ':discount_type_id' => empty($informations['discount_type_id']) ? null : $informations['discount_type_id']
        ]);

        if($result)
        {
            $query = $db->prepare("DELETE FROM product_recipes WHERE product_id = :id");
            $result = $query->execute([':id' => $informations['id']]);
            setRecipes($db, $informations['id'], $informations);
            updateThumbnailAndImage($db, $informations['id']);
        }

        return $result;
    }

    function deleteProduct($id)
    {
        $db = dbConnect();
        $query = $db->prepare('UPDATE products set is_deleted = 1 WHERE id=:id');
        $result = $query->execute([
            ':id' => $id,
        ]);
        /*
        if ($result)
        {
            if(!empty($product['thumbnail']))
            {
                $destination = '../assets/images/product/thumbnail/' . $product['thumbnail'];
                if(file_exists($destination)) {
                    unlink($destination);
                }
            }

            foreach ($product['images'] as $image)
            {
                $destination = '../assets/images/product/image/' . $image['src_image'];
                if(file_exists($destination)) {
                    unlink($destination);
                }
            }
        }
*/
        return $result;
    }

    function undeleteProduct($id)
    {
        $db = dbConnect();
        $query = $db->prepare('UPDATE products set is_deleted = 0 WHERE id=:id');
        $result = $query->execute([
            ':id' => $id,
        ]);
        return $result;
    }

    function getProductById($id)
    {
        $db = dbConnect();
        $query = $db->prepare('select product.*, category.name category_name, origin.name origin_name, size.name size_name, unit.name unit_name, discount_type.code discount_type_code, discount_type.name discount_type_name from products product
LEFT JOIN categories category on product.category_id = category.id
LEFT JOIN origins origin on product.origin_id = origin.id
LEFT JOIN sizes size on product.size_id = size.id
LEFT JOIN units unit on product.unit_id = unit.id
LEFT JOIN discount_types discount_type on product.discount_type_id = discount_type.id
WHERE product.id=:id');
        $query->execute([
            ':id' => $id,
        ]);
        $product = $query->fetch();
        if ($product == false)
        {
            return false;
        }

        $query = $db->prepare('SELECT recipe_id FROM product_recipes WHERE product_id=:id');
        $query->execute([
            ':id' => $id,
        ]);

        $product_recipes = $query->fetchAll();
        $product['product_recipes'] = $product_recipes;

        $query = $db->prepare('SELECT * FROM images WHERE product_id=:id order by position ');
        $query->execute([
            ':id' => $id,
        ]);

        $product_images = $query->fetchAll();
        foreach ($product_images as $product_image) {
            $product['image'.$product_image['position']] = $product_image['src_image'];
        }
        return $product;
    }

    function setRecipes($db, $product_id, $informations)
    {
        if (isset($informations['recipe_ids']))
        {
            $queryString = "INSERT INTO product_recipes (product_id,recipe_id) VALUES ";
            $queryValues = [];

            foreach ($informations['recipe_ids'] as $key => $recipeId)
            {
                //generation dynamique de $queryString
                $queryString .= '(?,?)';
                if ($key == array_key_last($informations['recipe_ids']))
                {
                    $queryString.=';';
                }
                else
                {
                    $queryString.=',';
                }
                //generation dynamique $queryValues
                //à chaque boucle on ajoute au tableau les valeurs correspondantes à
                $queryValues[] = $product_id;
                $queryValues[] = $recipeId;
            }

            $query = $db->prepare($queryString);
            $result = $query->execute($queryValues);
        }
    }

    function updateThumbnailAndImage($db, $product_id)
    {
        if (isset($_FILES['product_thumbnail']) && !empty($_FILES['product_thumbnail']))
        {
            $allowed_extensions = array( 'jpg' , 'jpeg' , 'gif', 'png' );
            $my_file_extension = pathinfo( $_FILES['product_thumbnail']['name'] , PATHINFO_EXTENSION);

            if (in_array($my_file_extension , $allowed_extensions))
            {
                $new_file_name = $product_id . '.' . $my_file_extension;
                $destination = '../assets/images/product/thumbnail/' . $new_file_name;
                $_SESSION['debug'][] = $destination;
                if(file_exists($destination)) {
                    unlink($destination);
                }

                $result = move_uploaded_file($_FILES['product_thumbnail']['tmp_name'], $destination);
                if ($result)
                {
                    $db->query("UPDATE products SET thumbnail = '$new_file_name' WHERE id = $product_id");
                }
            }
        }

        uploadImage($db, $product_id, 'product_image1', 1);
        uploadImage($db, $product_id, 'product_image2', 2);
        uploadImage($db, $product_id, 'product_image3', 3);
        uploadImage($db, $product_id, 'product_image4', 4);
        uploadImage($db, $product_id, 'product_image5', 5);
    }


    function uploadImage($db, $product_id, $input_name, $position)
    {
        $result = false;
        if (!isset($_FILES[$input_name]) || empty($_FILES[$input_name]))
        {
            return $result;
        }
        $_SESSION['debug'][] = $_FILES[$input_name];

        $allowed_extensions = array( 'jpg' , 'jpeg' , 'gif', 'png' );
        $my_file_extension = pathinfo( $_FILES[$input_name]['name'] , PATHINFO_EXTENSION);

        if (in_array($my_file_extension , $allowed_extensions))
        {
            $new_file_name = $product_id . '_'. $position . '.' . $my_file_extension;
            $destination = '../assets/images/product/image/' . $new_file_name;
            if(file_exists($destination)) {
                unlink($destination);
            }

            $result = move_uploaded_file($_FILES[$input_name]['tmp_name'], $destination);
            if ($result)
            {
                $query = $db->prepare('INSERT INTO images(src_image, position, product_id) VALUES (:src_image, :position, :product_id)');
                $result = $query->execute([
                    ':src_image' => $new_file_name,
                    ':position' => $position,
                    ':product_id' => $product_id
                ]);
            }
        }

        return $result;
    }

