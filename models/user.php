<?php

function isValidUser($informations, $from_admin = false)
{
    $return = true;
    if (empty($informations['first_name']))
    {
        $_SESSION['messages_ko'][] = 'Le champ prénom est obligatoire !';
        $return = false;
    }

    if (empty($informations['last_name']))
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

    if ($from_admin == false && empty($informations['accept-condition']))
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
            if ($from_admin == true)
            {
                $_SESSION['messages_ko'][] = 'Cet email est déjà utilisé!';
            }
            else
            {
                $_SESSION['messages_ko'][] = 'Cet email est déjà utilisé. Essayez de vous connecter ou réinitialiser votre mot de passe. !';
            }

            $return = false;
        }
    }
    return $return;
}

function addUser($informations)
{
    $db = dbConnect();
    $query = $db->prepare('INSERT INTO users (first_name, last_name, email, password, is_admin) VALUES (:first_name, :last_name, :email, :password, 0)');
    $result = $query->execute([
        ':first_name' => $informations['first_name'],
        ':last_name' => $informations['last_name'],
        ':email' => $informations['email'],
        ':password' => password_hash($informations['password'], PASSWORD_BCRYPT),
    ]);

    return $result;
}

function LoginUser($email, $password)
{
    $db = dbConnect();
    $query = $db->prepare("SELECT id, first_name, last_name, email, created_date, password, avatar, is_admin from users WHERE email = :email ");
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
    $query = $db->prepare("SELECT id, first_name, last_name, email, phonenumber, delivery_address_id, billing_address_id from users WHERE id = :id ");
    $query->execute([ ':id' => $id ]);
    return $query->fetch();
}

function isValidUserForUpdate($informations)
{
    $return = true;
    if (empty($informations['first_name']))
    {
        $_SESSION['messages_ko'][] = 'Le champ prénom est obligatoire !';
        $return = false;
    }

    if (empty($informations['last_name']))
    {
        $_SESSION['messages_ko'][] = 'Le champ nom est obligatoire !';
        $return = false;
    }


    if (empty($informations['email']))
    {
        $_SESSION['messages_ko'][] = 'Le champ email est obligatoire !';
        $return = false;
    }

    if (!empty($informations['password']) || !empty($informations['password-confirm']))
    {
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
    }

    // si les données sont valides, on vérifie que ce n'est pas un doublon
    if ($return) {
        $db = dbConnect();
        $query = $db->prepare('SELECT * FROM users WHERE email=:email AND id != :id');
        $query->execute([
            ':email' => $informations['email'],
            ':id' => $informations['id']
        ]);

        if ($query->fetch() != false) {
            $_SESSION['messages_ko'][] = 'Cet email est déjà utilisé!';
            $return = false;
        }
    }
    return $return;
}

function updateUser($informations)
{
    $db = dbConnect();
    if (empty($informations['password']))
    {
        $query = $db->prepare('UPDATE users SET first_name=:first_name, last_name = :last_name, email=:email WHERE id=:id');
        $result = $query->execute([
            ':id' => $informations['id'],
            ':first_name' => $informations['first_name'],
            ':last_name' => $informations['last_name'],
            ':email' => $informations['email'],
        ]);
    }
    else
    {
        $query = $db->prepare('UPDATE users SET first_name=:first_name, last_name = :last_name, email=:email, password=:password WHERE id=:id');
        $result = $query->execute([
            ':id' => $informations['id'],
            ':first_name' => $informations['first_name'],
            ':last_name' => $informations['last_name'],
            ':email' => $informations['email'],
            ':password' => password_hash($informations['password'], PASSWORD_BCRYPT),
        ]);
    }

    return $result;
}