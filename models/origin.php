<?php
function getAllOrigins()
{
    $db = dbConnect();
    $query = $db->query('SELECT * FROM origins ORDER BY position');
    $origins = $query->fetchAll();
    return $origins;
}