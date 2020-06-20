<?php

// Afficher le fil d'arianne
$breadcrumb[] = '<a href="index.php">Accueil</a>';

if (isset($_GET['action']) && !empty($_GET['action']))
{
    switch($_GET['action'])
    {
        case 'new';
            if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
            {
                header('location:index.php?p=useraccount&action=view');
                exit;
            }
            $breadcrumb[] = 'Créer votre compte';
            $view = 'views/create-account.php';
            break;
        case 'create';
            if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
            {
                header('location:index.php?p=useraccount&action=view');
                exit;
            }
            include_once 'models/user.php';
            if (isValidUser($_POST))
            {
                $resultAdd = addUser($_POST);
                if ($resultAdd == true)
                {
                    $_SESSION['messages_ok'][] = 'Votre compte est crée avec succès !';
                }
                else
                {
                    $_SESSION['messages_ko'][] = "Erreur lors de la création de votre compte. Merci de réessayer ultérieurement";
                }

                header('Location:index.php?p=useraccount&action=login');
                exit;
            }
            else
            {
                $_SESSION['old_inputs'] = $_POST;
                header('Location:index.php?p=useraccount&action=new');
                exit;
            }
            break;
        case 'view';
            if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id']))
            {
                header('location:index.php?p=useraccount&action=login');
                exit;
            }
            include_once 'models/user.php';
            $orders = getUserOrders($_SESSION['user_id']);
            $breadcrumb[] = 'Mon compte';
            $view = 'views/useraccount.php';
            break;
        case 'view_order';
            if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id']))
            {
                header('location:index.php?p=useraccount&action=login');
                exit;
            }

            if (!isset($_GET['id']) || empty($_GET['id']))
            {
                $_SESSION['messages_ok'][] = 'Merci de choisir une commande';
                header('location:index.php?p=useraccount&action=view');
                exit;
            }

            include_once 'models/user.php';
            $order_detail = getUserOrderById($_SESSION['user_id'], $_GET['id']);
            if ($order_detail == false)
            {
                $_SESSION['messages_ok'][] = 'Commande invalide ou introuvable';
                header('location:index.php?p=useraccount&action=view');
                exit;
            }

            $breadcrumb[] = 'Détail de ma commande';
            $view = 'views/user_order.php';
            break;
        case 'edit';
            if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id']))
            {
                header('location:index.php?p=useraccount&action=login');
                exit;
            }

            include_once 'models/user.php';
            include_once 'models/address.php';

            if (isset($_POST['id']) && !empty($_POST['id']))
            {
                $delivery_address = array();
                $billing_address = array();
                if (isValidUserForUpdate($_POST))
                {
                    $delivery_address = array('first_name' => $_POST['first_name'], 'last_name' => $_POST['last_name'], 'street_name' => $_POST['street_name'], 'complementary_address_1' => $_POST['complementary_address_1'], 'complementary_address_2' => $_POST['complementary_address_2'], 'city' => $_POST['city'], 'postal_code' => $_POST['postal_code']);
                    if (isAddressValid($delivery_address))
                    {
                        if (!isset($_POST['address-invoice']))
                        {
                            $billing_address = array('first_name' => $_POST['first_name'], 'last_name' => $_POST['last_name'], 'street_name' => $_POST['billing-address'], 'complementary_address_1' => $_POST['billing-complementary_address_1'], 'complementary_address_2' => $_POST['billing-complementary_address_2'], 'city' => $_POST['billing-city'], 'postal_code' => $_POST['billing-postal_code']);
                            if (!isAddressValid($billing_address, 'facturation'))
                            {
                                header('location:index.php?p=useraccount&action=edit');
                                exit;
                            }
                        }
                    }
                    else
                    {
                        header('location:index.php?p=useraccount&action=edit');
                        exit;
                    }
                }
                else
                {
                    header('location:index.php?p=useraccount&action=edit');
                    exit;
                }

                /**/
                $delivery_address_id = empty($_POST['delivery_address_id']) ? null : $_POST['delivery_address_id'];
                $billing_address_id = empty($_POST['billing_address_id']) ? null : $_POST['billing_address_id'];
                if (isset($_POST['delivery_address_id']) && !empty($_POST['delivery_address_id']))
                {
                    $delivery_address['id'] = $_POST['delivery_address_id'];
                    updateAddress($delivery_address);
                }
                else
                {
                    $delivery_address_id = addAddress($delivery_address);
                }

                if (sizeof($billing_address) > 0)
                {
                    if (isset($_POST['billing_address_id']) && !empty($_POST['billing_address_id']))
                    {
                        $billing_address['id'] = $_POST['billing_address_id'];
                        updateAddress($billing_address);
                    }
                    else
                    {
                        $billing_address_id = addAddress($billing_address);
                    }
                }


                // Modifier le user
                updateUser($_POST, $delivery_address_id, $billing_address_id);
                header('location:index.php?p=useraccount&action=view');
                exit;/**/
            }
            else
            {
                $user = getUserById($_SESSION['user_id']);
                $user['delivery_address']['address-invoice'] = $user['billing_address_id'] == null ? 1 : 0;
                $breadcrumb[] = 'Modifier mes information';
                $view = 'views/user_edit.php';
            }

            break;
        case 'login';
            if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
            {
                header('location:index.php?p=useraccount&action=view');
                exit;
            }
            if (isset($_POST['email']))
            {
                $has_errors = false;
                if(empty($_POST['email']))
                {
                    $_SESSION['messages_ko'][] = 'Le login est obligatoire';
                    $has_errors = true;
                }

                if(empty($_POST['password']))
                {
                    $_SESSION['messages_ko'][] = 'Le mot de passe est obligatoire';
                    $has_errors = true;
                }

                if ($has_errors)
                {
                    header('location:index.php?p=useraccount&action=login');
                    exit;
                }

                include_once 'models/user.php';
                $user = LoginUser($_POST['email'], $_POST['password']);
                if ($user === false)
                {
                    $_SESSION['messages_ko'][] = 'Login ou mot de passe incorrectes !';
                    $_SESSION['old_inputs'] = $_POST;
                }
                else
                {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user'] = $user;
                    header('location:index.php?p=useraccount&action=view');
                    exit;
                }
            }

            $breadcrumb[] = 'Se connecter';
            $view = 'views/login.php';
            break;
        case 'disconnect';
            unset($_SESSION['user_id']);
            unset($_SESSION['user']);
            header('location:index.php?p=useraccount&action=login');
            exit;
            break;

        default:
            if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id']))
            {
                header('location:index.php?p=useraccount&action=login');
                exit;
            }
            header('location:index.php?p=useraccount&action=view');
            exit;
            break;
    }
}
else
{
    if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id']))
    {
        header('location:index.php?p=useraccount&action=login');
        exit;
    }

    $view = 'views/useraccount.php';
}

