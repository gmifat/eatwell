<?php
function isInfoStepValid()
{
    $result = true;
    if (!isset($_POST['first_name']) || empty($_POST['first_name']))
    {
        $_SESSION['messages_ko'][] = 'Le champ prénom est obligatoire !';
        $result = false;
    }
    else
    {
        $_SESSION['order_inputs']['info']['first_name'] = $_POST['first_name'];
    }

    if (!isset($_POST['last_name']) || empty($_POST['last_name']))
    {
        $_SESSION['messages_ko'][] = 'Le champ nom est obligatoire !';
        $result = false;
    }
    else
    {
        $_SESSION['order_inputs']['info']['last_name'] = $_POST['last_name'];
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

    if (isset($_POST['phone_number']))
    {
        $_SESSION['order_inputs']['info']['phone_number'] = $_POST['phone_number'];
    }

    return $result;
}


function isAddressStepValid($address)
{
    $result = true;
    if (!isset($_POST['first_name']) || empty($_POST['first_name']))
    {
        $_SESSION['messages_ko'][] = 'Le champ nom est obligatoire !';
        $result = false;
    }
    else
    {
        $_SESSION['order_inputs'][$address]['first_name'] = $_POST['first_name'];
    }

    if (!isset($_POST['last_name']) || empty($_POST['last_name']))
    {
        $_SESSION['messages_ko'][] = 'Le champ prénom est obligatoire !';
        $result = false;
    }
    else
    {
        $_SESSION['order_inputs'][$address]['last_name'] = $_POST['last_name'];
    }

    if (!isset($_POST['street_name']) || empty($_POST['street_name']))
    {
        $_SESSION['messages_ko'][] = 'Le champ adresse est obligatoire !';
        $_SESSION['order_inputs'][$address]['street_name'] = '';
        $result = false;
    }
    else
    {
        $_SESSION['order_inputs'][$address]['street_name'] = $_POST['street_name'];
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

    if (!isset($_POST['postal_code']) || empty($_POST['postal_code']))
    {
        $_SESSION['messages_ko'][] = 'Le champ code postale est obligatoire !';
        $result = false;
    }
    else
    {
        $_SESSION['order_inputs'][$address]['postal_code'] = $_POST['postal_code'];
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
function verifyOrder()
{
    $db = dbConnect();
    $query = $db->prepare('SELECT id, name, quantity, is_deleted FROM products where id=:product_id');
    $cart_products = $_SESSION['cart'];
    $is_valid = true;
    foreach ($cart_products as $key => $value)
    {
        if ($key !== 'count')
        {
            $cart_product = $value['product'];
            $query->execute(['product_id' => $cart_product['id']]);
            $product = $query->fetch();
            if ($product['is_deleted'] == 1)
            {
                $_SESSION['messages_ko'][] = 'Le produit '.$product['name'].'n\'est plus disponible à la vente';
                $is_valid = false;
            }

            if ($product['quantity'] < $value['quantity'])
            {
                $_SESSION['messages_ko'][] = 'Le quantité du produit '.$product['name'].' restante en stock n\'est plus suffisante';
                $is_valid = false;
            }
        }
        else
        {
            if ($value == 0)
            {
                $_SESSION['messages_ko'][] = 'Aucun produit dans votre panier';
                $is_valid = false;
            }
        }
    }

    return $is_valid;
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

    $query = $db->prepare('INSERT INTO orders (user_id, first_name, last_name, email, phone_number, order_amount, delivery_amount, delivery_address_id, billing_address_id) 
VALUES (:user_id, :first_name, :last_name, :email, :phone_number, :order_amount, :delivery_amount, :delivery_address_id, :billing_address_id)');

    $info = $_SESSION['order_inputs']['info'];
    $query->execute([
        ':user_id' => $_SESSION['user_id'],
        ':first_name' => $info['first_name'],
        ':last_name' => $info['last_name'],
        ':email' => $info['email'],
        ':phone_number' => $info['phone_number'],
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

            // Modifier la quantité dans le produit acheté
            $update_product = $db->prepare('UPDATE products SET quantity = quantity - :quantity WHERE id=:product_id');
            $update_product->execute([
                ':product_id' => $cart_product['id'],
                ':quantity' => $value['quantity'],
            ]);
        }
    }

    // réinitialiser les données de sessions
    unset($_SESSION['cart']);
    unset($_SESSION['order_inputs']);
    $_SESSION['cart'] = array();
    $_SESSION['cart']['count'] = 0;
    $_SESSION['order_inputs'] = array(
        'info' => array('user_id' => '', 'first_name' => '', 'last_name' => '', 'email' => '', 'phone_number' => ''),
        'delivery' => array('first_name' => '', 'last_name' => '', 'street_name' => '', 'complementary_address_1' => '', 'complementary_address_2' => '', 'city' => '', 'postal_code' => '', 'address-invoice' => true),
        'invoice'  => array('first_name' => '', 'last_name' => '', 'street_name' => '', 'complementary_address_1' => '', 'complementary_address_2' => '', 'city' => '', 'postal_code' => '', 'address-invoice' => ''),
        'payment' => array('name-on-card' => '','card-number' => '', 'expiry-date' => '', 'security-code' => '', 'save' => false)
    );
}