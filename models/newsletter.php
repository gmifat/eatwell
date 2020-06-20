<?php

function AddEmailToNewsletter($email)
{
    $db = dbConnect();
    $query = $db->prepare('SELECT * FROM newsletters WHERE email=:email');
    $query->execute([
        ':email' => $email
    ]);

    $exist = $query->fetch();
    if ($exist == false)
    {
        $query = $db->prepare('INSERT INTO newsletters (email) VALUES (:email)');
        return $query->execute([
            ':email' => $email
        ]);
    }

    return 'Vous êtes déjà inscrit à la newsletter depuis le '.$exist['registration_date'];
}