<?php
    function getAllPromotions()
    {
        $db = dbConnect();
        $query = $db->query('SELECT promotion.*, discount_type.code discount_type_code , discount_type.name discount_type_name FROM promotions promotion JOIN discount_types discount_type ON promotion.discount_type_id = discount_type.id ORDER BY code');
        $promotions = $query->fetchAll();
        return $promotions;
    }

    function getAllDiscountTypes()
    {
        $db = dbConnect();
        $query = $db->query('SELECT * FROM discount_types ORDER BY name');
        $discount_types = $query->fetchAll();
        return $discount_types;
    }

