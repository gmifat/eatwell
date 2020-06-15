<?php
    function getAllUnits()
    {
        $db = dbConnect();
        $query = $db->query('SELECT * FROM units ORDER BY name');
        $units = $query->fetchAll();
        return $units;
    }

    function getUnitById($id)
    {
        $db = dbConnect();
        $query = $db->prepare('SELECT * FROM units WHERE id = :id');
        $query->execute([':id' => $id]);
        $units = $query->fetch();
        return $units;
    }

    function getUnitByIdWithDetails($id)
    {
        $db = dbConnect();
        $query = $db->prepare('SELECT unit.id, unit.name, unit.symbol, COUNT(product.id) nb_products FROM units unit LEFT JOIN products product on unit.id = product.unit_id  WHERE unit.id = :id GROUP BY unit.id, unit.name, unit.symbol');
        $query->execute([':id' => $id]);
        $units = $query->fetch();
        return $units;
    }

    function getAllProductsOfUnit($id)
    {
        $db = dbConnect();
        $query = $db->prepare('SELECT unit.*, product.id product_id, product.name product_name, product.short_description, product.thumbnail   FROM units unit LEFT JOIN products product on unit.id = product.unit_id  WHERE unit.id = :id');
        $query->execute([':id' => $id]);
        $products = $query->fetchAll();
        return $products;
    }

    function isValidUnit($informations)
    {
        $return = true;
        if(empty($informations['name']))
        {
            $_SESSION['messages_ko'][] = 'Le champ nom est obligatoire !';
            $return = false;
        }

        if(empty($informations['symbol']))
        {
            $_SESSION['messages_ko'][] = 'Le champ symbole est obligatoire !';
            $return = false;
        }

        // si les données sont valides, on vérifie que ce n'est pas un doublon
        if ($return)
        {
            $db = dbConnect();
            if (isset($informations['id']) && !empty($informations['id'])) {
                $query = $db->prepare('SELECT * FROM units unit WHERE id!=:id && (name=:name && symbol=:symbol)');
                $query->execute([
                    ':id' => $informations['id'],
                    ':name' => $informations['name'],
                    ':symbol' => $informations['symbol'],
                ]);
            } else {
                $query = $db->prepare('SELECT * FROM units unit WHERE name=:name && symbol=:symbol');
                $query->execute([
                    ':name' => $informations['name'],
                    ':symbol' => $informations['symbol'],
                ]);
            }

            if ($query->fetch() != false) {
                $_SESSION['messages_ko'][] = 'Une unité existe avec le même nom et le même symbole !';
                $return = false;
            }
        }
        return $return;
    }

    function addUnit($informations)
    {
        $db = dbConnect();
        $query = $db->prepare('INSERT INTO units(name, symbol) VALUES (:name, :symbol)');
        return $query->execute([
            ':name' => $informations['name'],
            ':symbol' => $informations['symbol'],
        ]);
    }

    function updateUnit($informations)
    {
        $db = dbConnect();
        $query = $db->prepare('UPDATE units SET name=:name, symbol=:symbol WHERE id=:id');
        return $query->execute([
            ':id' => $informations['id'],
            ':name' => $informations['name'],
            ':symbol' => $informations['symbol'],
        ]);
    }

    function deleteUnit($informations)
    {
        $db = dbConnect();
        $query = $db->prepare('DELETE FROM units WHERE id=:id');
        return $query->execute([
            ':id' => $informations['id'],
        ]);
    }
