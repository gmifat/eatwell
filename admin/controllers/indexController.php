<?php

    if (isset($_GET['disconnect']))
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user']);
    }

    if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) && $_SESSION['user']['is_admin'] == 1)
    {
        header('location:index.php?controller=categories');
        exit;
    }

    if(isset($_POST['email']) && isset($_POST['password']))
    {
        if (empty($_POST['email']))
        {
            $_SESSION['messages_ko'][] = 'L\'adresse email est obligatoire';
        }

        if (empty($_POST['password']))
        {
            $_SESSION['messages_ko'][] = 'Le mot de passe est obligatoire';
        }
        else
        {
            include_once 'models/user.php';
            $user = LoginUser($_POST['email'], $_POST['password']);
            if ($user === false)
            {
                $_SESSION['messages_ko'][] = 'Login ou mot de passe incorrectes !';
                $_SESSION['old_inputs'] = $_POST;
            }
            else if ($user['is_admin'] == 0)
            {
                $_SESSION['messages_ko'][] = 'Merci d\'utiliser un compte administrateur !';
            }
            else
            {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user'] = $user;
                $_SESSION['messages_ok'][] = "Bienvenu dans l'interface d'administration !";
                header('location:index.php?controller=categories');
                exit;
            }
        }

    }

    $view = 'views/index.php';
    $pageTitle = 'Admin';