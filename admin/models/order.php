<?php
    function getAllOrders()
    {
        $db = dbConnect();
        $query = $db->query('SELECT * FROM orders');
        $orders = $query->fetchAll();
        return $orders;
    }

    function getOrderById($id)
    {
        $db = dbConnect();
        $query = $db->prepare('SELECT orders.*, order_details.name product_name, order_details.quantity, order_details.price  FROM orders
 JOIN order_details ON order_details.order_id = orders.id
 LEFT JOIN products ON products.id = order_details.product_id
 WHERE orders.id = :id');
        $query->execute([':id' => $id]);
        $origin = $query->fetchAll();
        return $origin;
    }