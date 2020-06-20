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
    $query = $db->prepare("SELECT id, first_name, last_name, email, created_date, password, avatar, is_admin, delivery_address_id, billing_address_id from users WHERE email = :email");
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
            if ($result['delivery_address_id'] != null)
            {
                $query = $db->query('SELECT * from addresses WHERE id='.$result['delivery_address_id']);
                $deliveryAddress = $query->fetch();
                if ($deliveryAddress != false)
                {
                    $result['delivery_address'] = $deliveryAddress;
                }
            }

            if ($result['billing_address_id'] != null)
            {
                $query = $db->query('SELECT * from addresses WHERE id='.$result['billing_address_id']);
                $billingAddress = $query->fetch();
                if ($billingAddress != false)
                {
                    $result['billing_address'] = $billingAddress;
                }
            }

            return $result;
        }
    }

    return false;
}

function getUserInfoById($id)
{
    $db = dbConnect();
    $query = $db->prepare("SELECT id, first_name, last_name, email, phone_number, delivery_address_id, billing_address_id from users WHERE id = :id ");
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

function updateUser($informations, $delivery_address_id, $billing_address_id)
{
    $db = dbConnect();
    if (empty($informations['password']))
    {
        $query = $db->prepare('UPDATE users SET first_name=:first_name, last_name = :last_name, email=:email, phone_number=:phone_number, delivery_address_id=:delivery_address_id, billing_address_id=:billing_address_id WHERE id=:id');
        $result = $query->execute([
            ':id' => $informations['id'],
            ':first_name' => $informations['first_name'],
            ':last_name' => $informations['last_name'],
            ':email' => $informations['email'],
            ':phone_number' => $informations['phone_number'],
            ':delivery_address_id' => $delivery_address_id,
            ':billing_address_id' => $billing_address_id,
        ]);
    }
    else
    {
        $query = $db->prepare('UPDATE users SET first_name=:first_name, last_name = :last_name, email=:email, phone_number=:phone_number, password=:password, delivery_address_id=:delivery_address_id, billing_address_id=:billing_address_id WHERE id=:id');
        $result = $query->execute([
            ':id' => $informations['id'],
            ':first_name' => $informations['first_name'],
            ':last_name' => $informations['last_name'],
            ':email' => $informations['email'],
            ':phone_number' => $informations['phone_number'],
            ':password' => password_hash($informations['password'], PASSWORD_BCRYPT),
            ':delivery_address_id' => $delivery_address_id,
            ':billing_address_id' => $billing_address_id,
        ]);
    }

    return $result;
}

function getUserOrders($user_id)
{
    $db = dbConnect();
    $query = $db->prepare('SELECT * FROM orders WHERE orders.user_id=:user_id');
    $query->execute([':user_id' => $user_id]);
    $orders = $query->fetchAll();
    return $orders;
}

function getUserOrderById($user_id, $id)
{
    $db = dbConnect();
    $query = $db->prepare('SELECT orders.*, order_details.name product_name, order_details.quantity, order_details.price, products.id product_id  FROM orders
 JOIN order_details ON order_details.order_id = orders.id
 LEFT JOIN products ON products.id = order_details.product_id
 WHERE orders.user_id = :user_id AND orders.id = :id');
    $query->execute([':id' => $id, ':user_id' => $user_id]);
    $origin = $query->fetchAll();
    return $origin;
}

function getUserById($id)
{
    $result = getUserInfoById($id);
    $db = dbConnect();
    if ($result['delivery_address_id'] != null)
    {
        $query = $db->query('SELECT * from addresses WHERE id='.$result['delivery_address_id']);
        $deliveryAddress = $query->fetch();
        if ($deliveryAddress != false)
        {
            $result['delivery_address'] = $deliveryAddress;
        }
    }
    else
    {
        $result['delivery_address'] = array('first_name' => '','last_name' => '','street_name' => '', 'complementary_address_1' => null, 'complementary_address_2' => null, 'city' => null, 'postal_code' => null, 'address-invoice' => true);
    }

    if ($result['billing_address_id'] != null)
    {
        $query = $db->query('SELECT * from addresses WHERE id='.$result['billing_address_id']);
        $billingAddress = $query->fetch();
        if ($billingAddress != false)
        {
            $result['billing_address'] = $billingAddress;
        }
    }
    else
    {
        $result['billing_address'] = array('first_name' => '','last_name' => '', 'street_name' => '', 'complementary_address_1' => null, 'complementary_address_2' => null, 'city' => null, 'postal_code' => null, 'address-invoice' => true);
    }
    return $result;
}