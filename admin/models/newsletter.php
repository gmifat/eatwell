<?php
    function getAllNewsletters()
    {
        $db = dbConnect();
        $query = $db->query('SELECT * FROM newsletters ORDER BY email');
        $newsletters = $query->fetchAll();
        return $newsletters;
    }

    function getNewsletterById($id)
    {
        $db = dbConnect();
        $query = $db->prepare('SELECT * FROM newsletters WHERE id = :id');
        $query->execute([':id' => $id]);
        $origin = $query->fetch();
        return $origin;
    }


    function deleteNewsletter($informations)
    {
        $db = dbConnect();
        $query = $db->prepare('DELETE FROM newsletters WHERE id=:id');
        return $query->execute([
            ':id' => $informations['id'],
        ]);
    }
