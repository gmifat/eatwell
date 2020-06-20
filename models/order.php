<?php
function isInfoStepValid()
{
    $result = true;
    if (!isset($_POST['firstname']) || empty($_POST['firstname']))
    {
        $_SESSION['messages_ko'][] = 'Le champ prénom est obligatoire !';
        $result = false;
    }
    else
    {
        $_SESSION['order_inputs']['info']['firstname'] = $_POST['firstname'];
    }

    if (!isset($_POST['lastname']) || empty($_POST['lastname']))
    {
        $_SESSION['messages_ko'][] = 'Le champ nom est obligatoire !';
        $result = false;
    }
    else
    {
        $_SESSION['order_inputs']['info']['lastname'] = $_POST['lastname'];
    }

    if (!isset($_POST['email']) || empty($_POST['email']))
    {
        $_SESSION['messages_ko'][] = 'Le champ email est obligatoire !';
        $result = false;
    }
    else
    {
        $_SESSION['order_inputs']['info']['email'] = $_POST['email'];
    }

    if (!isset($_POST['phonenumber']) || empty($_POST['phonenumber']))
    {
        $_SESSION['messages_ko'][] = 'Le champ téléphone est obligatoire !';
        $result = false;
    }
    else
    {
        $_SESSION['order_inputs']['info']['phonenumber'] = $_POST['phonenumber'];
    }

    return $result;
}


function isAddressStepValid($address)
{
    $result = true;
    if (!isset($_POST['address']) || empty($_POST['address']))
    {
        $_SESSION['messages_ko'][] = 'Le champ adresse est obligatoire !';
        $result = false;
        $_SESSION['order_inputs'][$address]['address'] = '';
    }
    else
    {
        $_SESSION['order_inputs'][$address]['address'] = $_POST['address'];
    }

    if (!isset($_POST['city']) || empty($_POST['city']))
    {
        $_SESSION['messages_ko'][] = 'Le champ ville est obligatoire !';
        $result = false;
    }
    else
    {
        $_SESSION['order_inputs'][$address]['city'] = $_POST['city'];
    }

    if (!isset($_POST['postal-code']) || empty($_POST['postal-code']))
    {
        $_SESSION['messages_ko'][] = 'Le champ code postale est obligatoire !';
        $result = false;
    }
    else
    {
        $_SESSION['order_inputs'][$address]['postal-code'] = $_POST['postal-code'];
    }

    if (isset($_POST['address-invoice']))
    {
        $_SESSION['order_inputs'][$address]['address-invoice'] = true;
    }
    else
    {
        $_SESSION['order_inputs'][$address]['address-invoice'] = false;
    }

    return $result;
}

function saveAddress($db, $address)
{
    $query = $db->prepare('INSERT INTO addresses (firstname, lastname, street_name, complementary_address_1, complementary_address_2, postal_code, city) 
VALUES (:firstname, :lastname, :street_name, :complementary_address_1, :complementary_address_2, :postal_code, :city)');

    $query->execute([
        ':firstname' => $address['firstname'],
        ':lastname' => $address['lastname'],
        ':street_name' => $address['address'],
        ':complementary_address_1' => $address['additional-address'],
        ':complementary_address_2' => $address['additional-address2'],
        ':postal_code' => $address['postal-code'],
        ':city' => $address['city']
    ]);

    return $db->lastInsertId();
}

function saveOrder()
{
    include_once 'product.php';
    $db = dbConnect();
    $addressDeliveryId = saveAddress($db, $_SESSION['order_inputs']['delivery']);
    $addressInvoiceId = null;
    if ($_SESSION['order_inputs']['delivery']['address-invoice'] == 0)
    {
        $addressInvoiceId = saveAddress($db, $_SESSION['order_inputs']['invoice']);;
    }

    $cart_products = $_SESSION['cart'];
    $total = 0;
    foreach ($cart_products as $key => $value)
    {
        if ($key !== 'count') {
            $cart_product = $value['product'];
            $price = $value['quantity'] * getPrice($cart_product);
            $total += $price;
        }
    }

    $query = $db->prepare('INSERT INTO orders (user_id, email, phone_number, order_amount, delivery_amount, delivery_address_id, billing_address_id) 
VALUES (:user_id, :email, :phone_number, :order_amount, :delivery_amount, :delivery_address_id, :billing_address_id)');

    $info = $_SESSION['order_inputs']['info'];
    $query->execute([
        ':user_id' => isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null,
        ':email' => $info['email'],
        ':phone_number' => $info['phonenumber'],
        ':order_amount' => $total * 100,
        ':delivery_amount' => '1000',
        ':delivery_address_id' => $addressDeliveryId,
        ':billing_address_id' => $addressInvoiceId
    ]);

    $order_id = $db->lastInsertId();

    foreach ($cart_products as $key => $value)
    {
        if ($key !== 'count') {
            $cart_product = $value['product'];
            $price = $value['quantity'] * getPrice($cart_product);
            $total += $price;
            $query = $db->prepare('INSERT INTO order_details (order_id, product_id, quantity, price, name, short_description) 
VALUES (:order_id, :product_id, :quantity, :price, :name, :short_description)');

            $query->execute([
                ':order_id' => $order_id,
                ':product_id' => $cart_product['id'],
                ':quantity' => $value['quantity'],
                ':price' => getPrice($cart_product) * 100,
                ':name' => $cart_product['name'],
                ':short_description' => $cart_product['short_description']
            ]);
        }
    }

    unset($_SESSION['cart']);
    $_SESSION['cart'] = array();
    $_SESSION['cart']['count'] = 0;
}