<?php
    function getAllReviews()
    {
        $db = dbConnect();
        $query = $db->query('SELECT * FROM user_reviews ORDER BY name');
        $reviews = $query->fetchAll();
        return $reviews;
    }