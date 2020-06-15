<?php
    function getAllRecipes()
    {
        $db = dbConnect();
        $query = $db->query('SELECT * FROM recipes ORDER BY name');
        $recipes = $query->fetchAll();
        return $recipes;
    }

    function getRecipeById($id)
    {
        $db = dbConnect();
        $query = $db->prepare('SELECT * FROM recipes WHERE id = :id');
        $query->execute([':id' => $id]);
        $recipe = $query->fetch();
        return $recipe;
    }

    function getRecipeByIdWithDetails($id)
    {
        $db = dbConnect();
        $query = $db->prepare('SELECT recipe.id, recipe.name, recipe.description, COUNT(product_recipe.product_id) nb_products FROM recipes recipe LEFT JOIN product_recipes product_recipe on recipe.id = product_recipe.recipe_id  WHERE recipe.id = :id GROUP BY recipe.id, recipe.name, recipe.description');
        $query->execute([':id' => $id]);
        $recipe = $query->fetch();
        return $recipe;
    }

    function getAllProductsOfRecipe($id)
    {
        $db = dbConnect();
        $query = $db->prepare('SELECT recipe.*, product.id product_id, product.name product_name, product.short_description, product.thumbnail 
FROM recipes recipe 
LEFT JOIN product_recipes product_recipe on recipe.id = product_recipe.recipe_id  
LEFT JOIN products product on product.id = product_recipe.product_id  
WHERE recipe.id = :id');
        $query->execute([':id' => $id]);
        $products = $query->fetchAll();
        return $products;
    }

    function isValidRecipe($informations)
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

        // si les données sont valides, on vérifie que ce n'est pas un doublon
        if ($return) {
            $db = dbConnect();
            if (isset($informations['id']) && !empty($informations['id'])) {
                $query = $db->prepare('SELECT * FROM recipes recipe WHERE id!=:id && name=:name');
                $query->execute([
                    ':id' => $informations['id'],
                    ':name' => $informations['name'],
                ]);
            } else {
                $query = $db->prepare('SELECT * FROM recipes recipe WHERE name=:name');
                $query->execute([
                    ':name' => $informations['name'],
                ]);
            }

            if ($query->fetch() != false) {
                $_SESSION['messages_ko'][] = 'Une recette existe avec le même nom !';
                $return = false;
            }
        }
        return $return;
    }

    function addRecipe($informations)
    {
        $db = dbConnect();
        $query = $db->prepare('INSERT INTO recipes(name, description) VALUES (:name, :description)');
        return $query->execute([
            ':name' => $informations['name'],
            ':description' => $informations['description'],
        ]);
    }

    function updateRecipe($informations)
    {
        $db = dbConnect();
        $query = $db->prepare('UPDATE recipes SET name=:name, description=:description WHERE id=:id');
        return $query->execute([
            ':id' => $informations['id'],
            ':name' => $informations['name'],
            ':description' => $informations['description'],
        ]);
    }

    function deleteRecipe($informations)
    {
        $db = dbConnect();
        $query = $db->prepare('DELETE FROM recipes WHERE id=:id');
        return $query->execute([
            ':id' => $informations['id'],
        ]);
    }
