<?php
function getNewProducts()
{
    $db = dbConnect();
    $query = $db->query("SELECT products.*, discount_types.code, discount_types.symbol  FROM products LEFT JOIN discount_types ON products.discount_type_id = discount_types.id WHERE is_new = 1");
    return $query->fetchAll();
}