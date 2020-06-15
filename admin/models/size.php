<?php

    function getAllSizes()
    {
        $db = dbConnect();
        $query = $db->query('SELECT * FROM sizes ORDER BY name');
        $sizes = $query->fetchAll();
        return $sizes;
    }

    function getSizeById($id)
    {
        $db = dbConnect();
        $query = $db->prepare('SELECT * FROM sizes WHERE id = :id');
        $query->execute([':id' => $id]);
        $size = $query->fetch();
        return $size;
    }

    function getSizeByIdWithDetails($id)
    {
        $db = dbConnect();
        $query = $db->prepare('SELECT size.id, size.name, size.description, size.code, size.diameter, size.length , size.average_weight , size.average_number_per_kg, COUNT(product.id) nb_products FROM sizes size LEFT JOIN products product on size.id = product.size_id  WHERE size.id = :id
 GROUP BY size.id, size.name, size.description,size.code, size.diameter, size.length , size.average_weight , size.average_number_per_kg');
        $query->execute([':id' => $id]);
        $size = $query->fetch();
        return $size;
    }

    function getAllProductsOfSize($id)
    {
        $db = dbConnect();
        $query = $db->prepare('SELECT size.*, product.id product_id, product.name product_name, product.short_description, product.thumbnail 
    FROM sizes size 
    LEFT JOIN products product on product.id = product.size_id  
    WHERE size.id = :id');
        $query->execute([':id' => $id]);
        $products = $query->fetchAll();
        return $products;
    }

    function isValidSize($informations)
    {
        $return = true;
        if (empty($informations['name'])) {
            $_SESSION['messages_ko'][] = 'Le champ nom est obligatoire !';
            $return = false;
        }

        if (empty($informations['description'])) {
            $_SESSION['messages_ko'][] = 'Le champ description est obligatoire !';
            $return = false;
        }

        if (empty($informations['code'])) {
            $_SESSION['messages_ko'][] = 'Le champ code est obligatoire !';
            $return = false;
        }

        // si les données sont valides, on vérifie que ce n'est pas un doublon
        if ($return) {
            $db = dbConnect();
            if (isset($informations['id']) && !empty($informations['id'])) {
                $query = $db->prepare('SELECT * FROM sizes size WHERE id!=:id && name=:name && code=:code && description=:description');
                $query->execute([
                    ':id' => $informations['id'],
                    ':name' => $informations['name'],
                    ':code' => $informations['code'],
                    ':description' => $informations['description'],
                ]);
            } else {
                $query = $db->prepare('SELECT * FROM sizes size WHERE name=:name && code=:code && description=:description');
                $query->execute([
                    ':name' => $informations['name'],
                    ':code' => $informations['code'],
                    ':description' => $informations['description'],
                ]);
            }

            if ($query->fetch() != false) {
                $_SESSION['messages_ko'][] = 'Un calibre existe déjà avec le même nom, code et description !';
                $return = false;
            }
        }
        return $return;
    }

    function addSize($informations)
    {
        $db = dbConnect();
        $query = $db->prepare('INSERT INTO sizes(name, description, code, diameter, length, average_weight, average_number_per_kg) VALUES (:name, :description, :code, :diameter, :length, :average_weight, :average_number_per_kg)');
        return $query->execute([
            ':name' => $informations['name'],
            ':description' => $informations['description'],
            ':code' => $informations['code'],
            ':diameter' => $informations['diameter'],
            ':length' => $informations['length'],
            ':average_weight' => $informations['average_weight'],
            ':average_number_per_kg' => $informations['average_number_per_kg'],
        ]);
    }

    function updateSize($informations)
    {
        $db = dbConnect();
        $query = $db->prepare('UPDATE sizes SET name=:name, description=:description, code=:code, diameter=:diameter, length=:length, average_weight=:average_weight, average_number_per_kg=:average_number_per_kg WHERE id=:id');
        return $query->execute([
            ':id' => $informations['id'],
            ':name' => $informations['name'],
            ':description' => $informations['description'],
            ':code' => $informations['code'],
            ':diameter' => $informations['diameter'],
            ':length' => $informations['length'],
            ':average_weight' => $informations['average_weight'],
            ':average_number_per_kg' => $informations['average_number_per_kg'],
        ]);
    }

    function deleteSize($informations)
    {
        $db = dbConnect();
        $query = $db->prepare('DELETE FROM sizes WHERE id=:id');
        return $query->execute([
            ':id' => $informations['id'],
        ]);
    }
