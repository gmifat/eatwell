<?php
function getNewProducts()
{
    $db = dbConnect();
    $query = $db->query("SELECT products.*, discount_types.code, discount_types.symbol, categories.id category_id, categories.name category_name, categories.color FROM products 
JOIN categories ON products.category_id = categories.id
LEFT JOIN discount_types ON products.discount_type_id = discount_types.id WHERE is_new = 1");
    return $query->fetchAll();
}


function getAllActiveProducts($category_id = null, $filter = null)
{
    $db = dbConnect();
    $str_query = 'SELECT products.*, discount_types.code, discount_types.symbol, categories.id category_id, categories.name category_name, categories.color FROM products 
 JOIN categories ON products.category_id = categories.id
 LEFT JOIN discount_types ON products.discount_type_id = discount_types.id 
 WHERE products.is_deleted = 0';
    if ($category_id != null) {
        $str_query.= ' and (products.category_id=:category_id OR categories.parent_id=:category_id)  ORDER BY name';
        $query = $db->prepare($str_query);
        $query->execute([
            ':category_id' => $category_id]);
    }
    else {
        $str_query.= ' ORDER BY name';
        $query = $db->query($str_query);
    }

    $products = $query->fetchAll();
    return $products;
}

function getLightProductById($id, $is_active = true)
{
    $db = dbConnect();
    if ($is_active) {
        $query = $db->prepare('SELECT product.*, unit.name unit_name, discount_type.code, discount_type.symbol FROM products product 
LEFT JOIN units unit on product.unit_id = unit.id
LEFT JOIN discount_types discount_type on product.discount_type_id = discount_type.id
WHERE product.is_deleted = 0 AND product.id=:id');
    }
    else{
        $query = $db->prepare('SELECT product.*, unit.name unit_name, discount_type.code, discount_type.symbol FROM products product 
LEFT JOIN units unit on product.unit_id = unit.id
LEFT JOIN discount_types discount_type on product.discount_type_id = discount_type.id
WHERE product.id=:id');
    }
    $query->execute([
        ':id' => $id,
    ]);
    $product = $query->fetch();
    if ($product == false)
    {
        return false;
    }

    return $product;
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

function getPrice($product)
{
    $price = $product['price'];
    if (isset($product['discount']) && !empty($product['discount']))
    {
        switch ($product['code'])
        {
            case 'percent':
                $price -= (($product['discount'] * $price ) / 100);
                break;
            case 'fix':
                $price -= $product['discount'];
                break;
        }
    }

    return round($price / 100, 2);
}

function getDiscount($product)
{
    if (isset($product['discount']) && !empty($product['discount']))
    {
        switch ($product['code'])
        {
            case 'percent':
                return $product['discount'];
            case 'fix':
                return $product['discount'] / 100;
                break;
        }
    }

    return '';
}

function getSimilarProducts($id)
{
    $db = dbConnect();
    $query = $db->prepare('SELECT * FROM similar_products WHERE product_id1 = :id OR product_id2 = :id');
    $query->execute([ ':id' => $id ]);
    $products = $query->fetchAll();
    $similarProducts = array();
    if($products != false)
    {
        foreach ($products as $product) {
            $s_id = $product['product_id1'] === $id ? $product['product_id2'] : $product['product_id1'];
            $query = $db->prepare("SELECT products.*, discount_types.code, discount_types.symbol, categories.id category_id, categories.name category_name, categories.color FROM products 
JOIN categories ON products.category_id = categories.id
LEFT JOIN discount_types ON products.discount_type_id = discount_types.id WHERE products.id = :id");
            $query->execute([':id' => $s_id]);
            $similarProducts[] = $query->fetch();
        }
    }

    return $similarProducts;
}