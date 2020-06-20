<?php

function isValidUser($informations)
{
    $return = true;
    if (empty($informations['first-name']))
    {
        $_SESSION['messages_ko'][] = 'Le champ prénom est obligatoire !';
        $return = false;
    }

    if (empty($informations['last-name']))
    {
        $_SESSION['messages_ko'][] = 'Le champ nom est obligatoire !';
        $return = false;
    }


    if (empty($informations['email']))
    {
        $_SESSION['messages_ko'][] = 'Le champ email est obligatoire !';
        $return = false;
    }

    if (empty($informations['password']))
    {
        $_SESSION['messages_ko'][] = 'Le champ mot de passe est obligatoire !';
        $return = false;
    }

    if (empty($informations['password-confirm']))
    {
        $_SESSION['messages_ko'][] = 'Vous devez confirmer votre mot de passe !';
        $return = false;
    }
    else if ($informations['password'] !== $informations['password-confirm'])
    {
        $_SESSION['messages_ko'][] = 'Les deux mots de passes ne sont pas identiques !';
        $return = false;
    }

    if (empty($informations['accept-condition']))
    {
        $_SESSION['messages_ko'][] = 'Merci d\'accepter les conditions générales d\'utilisation de  notre site !';
        $return = false;
    }

    // si les données sont valides, on vérifie que ce n'est pas un doublon
    if ($return) {
        $db = dbConnect();
        $query = $db->prepare('SELECT * FROM users WHERE email=:email');
        $query->execute([
            ':email' => $informations['email']
        ]);

        if ($query->fetch() != false) {
            $_SESSION['messages_ko'][] = 'Cet email est déjà utilisé. Essayez de vous connecter ou réinitialiser votre mot de passe. !';
            $return = false;
        }
    }
    return $return;
}

function addUser($informations)
{
    $db = dbConnect();
    $query = $db->prepare('INSERT INTO users (firstname, lastname, email, password, is_admin) VALUES (:firstname, :lastname, :email, :password, 0)');
    $result = $query->execute([
        ':firstname' => $informations['first-name'],
        ':lastname' => $informations['last-name'],
        ':email' => $informations['email'],
        ':password' => password_hash($informations['password'], PASSWORD_BCRYPT),
    ]);

    return $result;
}

function LoginUser($email, $password)
{
    $db = dbConnect();
    $query = $db->prepare("SELECT id, firstname, lastname, email, created_date, password, avatar from users WHERE email = :email ");
    if($query->execute([
        ':email' => $email
    ]))
    {
        $result = $query->fetch();

        if ($result === false)
        {
            return false;
        }

        if (password_verify($password, $result['password']))
        {
            return $result;
        }
    }

    return false;
}

function getUserInfoById($id)
{
    $db = dbConnect();
    $query = $db->prepare("SELECT id, firstname, lastname, email, phonenumber, delivery_address_id, billing_address_id from users WHERE id = :id ");
    $query->execute([ ':id' => $id ]);
    return $query->fetch();
}