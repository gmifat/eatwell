<?php
    function getAllUsers()
    {
        $db = dbConnect();
        $query = $db->query('SELECT * FROM users ORDER BY firstname');
        $users = $query->fetchAll();
        return $users;
    }