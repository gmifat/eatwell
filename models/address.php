<?php
function isAddressValid($address, $address_type='livraison')
{
    $result = true;
    if (!isset($address['first_name']) || empty($address['first_name'])) {
        $_SESSION['messages_ko'][] = 'Le champ nom de l\'adresse de '.$address_type.'  est obligatoire !';
        $result = false;
    }

    if (!isset($address['last_name']) || empty($address['last_name'])) {
        $_SESSION['messages_ko'][] = 'Le champ prénom de l\'adresse de '.$address_type.'  est obligatoire !';
        $result = false;
    }

    if (!isset($address['street_name']) || empty($address['street_name']))
    {
        $_SESSION['messages_ko'][] = 'Le champ adresse de l\'adresse de '.$address_type.' est obligatoire !';
        $result = false;
    }

    if (!isset($address['city']) || empty($address['city']))
    {
        $_SESSION['messages_ko'][] = 'Le champ ville de l\'adresse de '.$address_type.' est obligatoire !';
        $result = false;
    }

    if (!isset($address['postal_code']) || empty($address['postal_code']))
    {
        $_SESSION['messages_ko'][] = 'Le champ code de l\'adresse de '.$address_type.' postale est obligatoire !';
        $result = false;
    }

    return $result;
}

function addAddress($address)
{
    $db = dbConnect();
    $query = $db->prepare('INSERT INTO addresses (first_name, last_name, street_name, complementary_address_1, complementary_address_2, postal_code, city) 
VALUES (:first_name, :last_name, :street_name, :complementary_address_1, :complementary_address_2, :postal_code, :city)');

    $query->execute([
        ':first_name' => $address['first_name'],
        ':last_name' => $address['last_name'],
        ':street_name' => $address['street_name'],
        ':complementary_address_1' => $address['complementary_address_1'],
        ':complementary_address_2' => $address['complementary_address_2'],
        ':postal_code' => $address['postal_code'],
        ':city' => $address['city']
    ]);

    return $db->lastInsertId();
}

function updateAddress($address)
{

    $db = dbConnect();
    $query = $db->prepare('UPDATE addresses SET first_name=:first_name, last_name=:last_name,
    street_name=:street_name, complementary_address_1=:complementary_address_1, complementary_address_2=:complementary_address_2, postal_code=:postal_code, city=:city 
    WHERE id=:id');

    return $query->execute([
        ':id' => $address['id'],
        ':first_name' => $address['first_name'],
        ':last_name' => $address['last_name'],
        ':street_name' => $address['street_name'],
        ':complementary_address_1' => $address['complementary_address_1'],
        ':complementary_address_2' => $address['complementary_address_2'],
        ':postal_code' => $address['postal_code'],
        ':city' => $address['city']
    ]);
}