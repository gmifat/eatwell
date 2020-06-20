<?php
require 'models/product.php';

if (isset($_GET['action']) && !empty($_GET['action']))
{
    switch($_GET['action'])
    {
        case 'add';
            $addToCart = false;
            $messages_ok = array();
            $messages_ko = array();
            $product_id = 0;
            // vérifier que le produit existe
            if (isset($_GET['product_id']) && !empty($_GET['product_id']))
            {
                $product_id = $_GET['product_id'];
                // récupérer le produit
                $product = getLightProductById($_GET['product_id']);

                // vérifier que le produit existe et il y a quoi vendre
                if ($product)
                {
                    if ($product['quantity'] > 0)
                    {
                        // si on a la quantité
                        if (isset($_GET['quantity']) && !empty($_GET['quantity'])) {
                            $quantity = $_GET['quantity'];
                            // si la quantité n'est pas numérique ou négatif ou si le type n'est pas en vrac et la valeur non entière
                            if (!is_numeric($quantity) || $product['is_in_bulk'] == 0 && !ctype_digit($quantity) || $product['is_in_bulk'] == 1 && floatval($quantity) <= 0) {
                                $messages_ko[] = 'Désolé mais la quantité demandée est invalide, merci de réessayer !';
                            } else {
                                // si on a suffisamment de la quantité
                                if ($product['quantity'] >= $quantity) {
                                    // Ajouter un produit au panier
                                    if (array_key_exists($product_id, $_SESSION['cart']))
                                    {
                                        if ($_SESSION['cart'][$product['id']]['quantity'] != $quantity)
                                        {
                                            $messages_ok[] = 'La quantité du produit est modifiée';
                                        }
                                        else
                                        {
                                            $messages_ok[] = 'Ce produit est déjà dans votre panier';
                                        }
                                    }
                                    else
                                    {
                                        $messages_ok[] = 'Le produit est ajouté avec succès au panier';
                                    }

                                    $_SESSION['cart'][$product['id']] = ['product' => $product, 'quantity' => floatval($quantity)];

                                    $addToCart = true;
                                } else {
                                    // Sinon on informe l'utilisateur de la quantité restante
                                    $messages_ko[] = 'Désolé il ne reste que ' . $product['quantity'] . ' de ce produit !';
                                }
                            }
                        } else
                        {
                            // sinon on demande à l'utilisateur de choisir une quantité
                            $messages_ko[] = 'Merci de préciser la quantité souhaitée !';
                        }
                    }
                    else
                    {
                        $messages_ko[] = 'Désolé, ce produit sera disponible bientôt !';
                    }
                }
                else
                {
                    $messages_ko[] = 'Désolé ce produit est introuvable !';
                }
            }
            else
            {
                $messages_ko[] = 'Merci de choisir un produit pour l\'ajouter au panier !';
            }

            // On envoie la réponse en json
            $message_ok = '<div class="alert alert-success">';
            foreach ($messages_ok as $message)
            {
                $message_ok .= $message.'<br>';
            }
            $message_ok.= '</div>';

            $message_ko = '<div class="alert alert-danger">';
            foreach ($messages_ko as $message)
            {
                $message_ko .= $message.'<br>';
            }
            $message_ko.= '</div>';

            $count = 0;
            foreach ($_SESSION['cart'] as $cart_product)
            {
                $count += $cart_product['quantity'];
            }

            $_SESSION['cart']['count'] = $count;

             if (isset($_GET['refresh']))
             {
                 if ($addToCart) {
                     $_SESSION['messages_ok']= $messages_ok;
                 }
                 else{
                     $_SESSION['messages_ko'] = $messages_ko;
                 }
                 header('location:index.php?p=cart');
                 exit;
             }
            echo json_encode(
                array
                (
                    'success' => $addToCart,
                    'product_id' => $product_id,
                    'message_ok' => $message_ok,
                    'message_ko' => $message_ko,
                    'cart' => $_SESSION['cart']
                )
            );
            exit;
            break;
        case 'remove';
            // Supprimer un produit du panier
            $message_ok = '';
            $message_ko = '';
            $product_id = 0;
            if (isset($_GET['product_id']))
            {
                $product_id = $_GET['product_id'];
                if (array_key_exists($product_id, $_SESSION['cart'])) {
                    unset($_SESSION['cart'][$_GET['product_id']]);
                    $message_ok = 'Le produit est bien supprimé de votre panier!';
                    $remove = true;
                } else {
                    $remove = false;
                    $message_ko = 'Produit non trouvé dans le panier!';
                }
            }
            else
            {
                $message_ko = 'Merci de choisir un produit  !';
            }

            $count = 0;
            foreach ($_SESSION['cart'] as $cart_product)
            {
                $count += $cart_product['quantity'];
            }

            $_SESSION['cart']['count'] = $count;

            if (isset($_GET['refresh']))
            {
                if ($remove) {
                    $_SESSION['messages_ok'][] = $message_ok;
                }
                else{
                    $_SESSION['messages_ko'][] = $message_ko;
                }
                header('location:index.php?p=cart');
                exit;
            }
            echo json_encode(
                array
                (
                    'product_id' => $product_id,
                    'success' => $remove,
                    'message_ok' => '<div class="alert alert-success">'.$message_ok.'</div>',
                    'message_ko' => '<div class="alert alert-danger">'.$message_ko.'</div>',
                    'cart' => $_SESSION['cart']
                )
            );
            exit;
            break;
        case 'content';
            // Le contenu du panier
            //retourner les données sous format JSON (utiliser dans l'affichage hover du panier
            echo json_encode(
                array
                (
                    'success' => true,
                    'cart' => $_SESSION['cart']
                )
            );
            exit;
            break;
        case 'display';
            // Afficher le panier
            // Fil d'ariane
            $breadcrumb[] = '<a href="index.php">Accueil</a>';
            $breadcrumb[] = '<a href="index.php?p=shop">Boutique</a>';
            $breadcrumb[] = 'Panier';
            $cart_products = $_SESSION['cart'];
            $view = 'views/cart.php';
            break;
        default:
            header('location:index.php?p=shop');
            exit;
            break;
    }
}
else
{
    // Afficher le panier
    $breadcrumb[] = '<a href="index.php">Accueil</a>';
    $breadcrumb[] = '<a href="index.php?p=shop">Boutique</a>';
    $breadcrumb[] = 'Panier';
    $cart_products = $_SESSION['cart'];
    $view = 'views/cart.php';
}