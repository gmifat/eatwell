<?php

// Afficher le fil d'arianne
$breadcrumb[] = '<a href="index.php">Accueil</a>';

if (isset($_GET['action']) && !empty($_GET['action']))
{
    switch($_GET['action'])
    {
        case 'new';
            $breadcrumb[] = 'Créer votre compte';
            $view = 'views/create-account.php';
            break;
        case 'create';
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
            $breadcrumb[] = 'Mon compte';
            $view = 'views/useraccount.php';
            break;
        case 'edit';
            $tt = true;
            break;
        case 'login';
            if (isset($_POST['email']) && !empty($_POST['email']))
            {
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
            header('location:index.php?p=useraccount');
            exit;
            break;
    }
}
else
{
    $view = 'views/useraccount.php';
}

