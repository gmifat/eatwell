<?php

function getAllSizes()
{
    $db = dbConnect();
    $query = $db->query('SELECT * FROM sizes ORDER BY name');
    $sizes = $query->fetchAll();
    return $sizes;
}