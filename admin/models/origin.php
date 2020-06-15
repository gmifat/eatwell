<?php
    function getAllOrigins()
    {
        $db = dbConnect();
        $query = $db->query('SELECT * FROM origins ORDER BY position');
        $origins = $query->fetchAll();
        return $origins;
    }

    function getOriginById($id)
    {
        $db = dbConnect();
        $query = $db->prepare('SELECT * FROM origins WHERE id = :id');
        $query->execute([':id' => $id]);
        $origin = $query->fetch();
        return $origin;
    }

    function getOriginByIdWithDetails($id)
    {
        $db = dbConnect();
        $query = $db->prepare('SELECT origin.id, origin.name, origin.description , origin.position, COUNT(product.id) nb_products FROM origins origin LEFT JOIN products product on origin.id = product.origin_id  WHERE origin.id = :id GROUP BY origin.id, origin.name, origin.description , origin.position');
        $query->execute([':id' => $id]);
        $origin = $query->fetch();
        return $origin;
    }

    function getAllProductsOfOrigin($id)
    {
        $db = dbConnect();
        $query = $db->prepare('SELECT origin.*, product.id product_id, product.name product_name, product.short_description, product.thumbnail   FROM origins origin LEFT JOIN products product on origin.id = product.origin_id  WHERE origin.id = :id');
        $query->execute([':id' => $id]);
        $products = $query->fetchAll();
        return $products;
    }

    function isValidOrigin($informations)
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

        if (empty($informations['position'])) {
            $_SESSION['messages_ko'][] = 'Le champ position est obligatoire !';
            $return = false;
        }

        // si les données sont valides, on vérifie que ce n'est pas un doublon
        if ($return) {
            $db = dbConnect();
            if (isset($informations['id']) && !empty($informations['id'])) {
                $query = $db->prepare('SELECT * FROM origins origin WHERE id!=:id && name=:name');
                $query->execute([
                    ':id' => $informations['id'],
                    ':name' => $informations['name'],
                ]);
            } else {
                $query = $db->prepare('SELECT * FROM origins origin WHERE name=:name');
                $query->execute([
                    ':name' => $informations['name'],
                ]);
            }

            if ($query->fetch() != false) {
                $_SESSION['messages_ko'][] = 'Une origine existe avec le même nom !';
                $return = false;
            }
        }
        return $return;
    }

    function addOrigin($informations)
    {
        $db = dbConnect();
        $query = $db->prepare('INSERT INTO origins(name, description, position) VALUES (:name, :description, :position)');
        $result = $query->execute([
            ':name' => $informations['name'],
            ':description' => $informations['description'],
            ':position' => $informations['position'],
        ]);

        if($result)
        {
            $originId = $db->lastInsertId();

            $allowed_extensions = array( 'jpg' , 'jpeg' , 'gif', 'png' );
            $my_file_extension = pathinfo( $_FILES['image']['name'] , PATHINFO_EXTENSION);

            if (in_array($my_file_extension , $allowed_extensions))
            {
                $new_file_name = $originId . '.' . $my_file_extension;
                $destination = '../assets/images/origin/' . $new_file_name;
                $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                $db->query("UPDATE origins SET image = '$new_file_name' WHERE id = $originId");
            }
        }

        return $result;
    }

    function updateOrigin($informations)
    {
        $db = dbConnect();
        $query = $db->prepare('UPDATE origins SET name=:name, description=:description, position =:position WHERE id=:id');
        $result = $query->execute([
            ':id' => $informations['id'],
            ':name' => $informations['name'],
            ':description' => $informations['description'],
            ':position' => $informations['position']
        ]);

        if($result)
        {
            $id = $informations['id'];
            $allowed_extensions = array( 'jpg' , 'jpeg' , 'gif', 'png' );
            $my_file_extension = pathinfo( $_FILES['image']['name'] , PATHINFO_EXTENSION);

            if (in_array($my_file_extension , $allowed_extensions))
            {
                $new_file_name = $id . '.' . $my_file_extension;
                $destination = '../assets/images/origin/' . $new_file_name;

                if(file_exists($destination)) {
                    unlink($destination);
                }

                $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                $db->query("UPDATE origins SET image = '$new_file_name' WHERE id = $id");
            }
        }
        return $result;
    }

    function deleteOrigin($informations)
    {
        $db = dbConnect();
        $query = $db->prepare('DELETE FROM origins WHERE id=:id');
        return $query->execute([
            ':id' => $informations['id'],
        ]);
    }
