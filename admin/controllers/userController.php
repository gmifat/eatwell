<?php
require_once 'models/user.php';

switch ($_GET['action']) {
    case 'list':
        $users = getAllUsers();
        $pageTitle = 'List des utilisateurs';
        $view = 'views/user/list.php';
        break;

    case 'new':
        $pageTitle = 'Ajouter un utilisateur';
        $view = 'views/user/add.php';
        break;
    case 'add':
        if (isValidUser($_POST, true)) {
            $resultAdd = addUserWithAdmin($_POST);
            if ($resultAdd == true) {
                $_SESSION['messages_ok'][] = 'Utilisateur ajoutée !';
            } else {
                $_SESSION['messages_ko'][] = "Erreur lors de l'ajout de l'utilisateur.";
            }

            header('Location:index.php?controller=users&action=list');
            exit;
        } else {
            $_SESSION['old_inputs'] = $_POST;
            header('Location:index.php?controller=users&action=new');
            exit;
        }
        break;

    case 'edit':
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            if (!isset($_SESSION['old_inputs'])) {
                $user = getUserDataById($_GET['id']);
            } else {
                $user = $_SESSION['old_inputs'];
            }

            if ($user == false) {
                $_SESSION['messages_ko'][] = 'Utilisateur non trouvée !';
                header('Location:index.php?controller=users&action=list');
                exit;
            }

            $pageTitle = 'Modifier une utilisateur';
            $view = 'views/user/edit.php';
        } else if (isset($_POST['id']) && !empty($_POST['id'])) {
            // mise à jour de l'utilisateur
            if (isValidUserForUpdate($_POST)) {
                $update = updateUserWithAdmin($_POST);
                if ($update == true) {
                    $_SESSION['messages_ok'][] = 'Utilisateur modifiée !';
                } else {
                    $_SESSION['messages_ko'][] = "Erreur lors de l'enregistrement de l'utilisateur.";
                }

                header('Location:index.php?controller=users&action=list');
                exit;
            } else {
                $_SESSION['old_inputs'] = $_POST;
                header('Location:index.php?controller=users&action=edit&id=' . $_POST['id']);
                exit;
            }
        } else {
            header('Location:index.php?controller=users&action=list');
            exit;
        }
        break;

    case 'delete':
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $user = getUserDataById($_GET['id']);
            if ($user == false) {
                $_SESSION['messages_ko'][] = 'Utilisateur non trouvée !';
                header('Location:index.php?controller=users&action=list');
                exit;
            }

            $pageTitle = 'Supprimer un utilisateur';
            $view = 'views/user/delete.php';
        } else if (isset($_POST['id']) && !empty($_POST['id'])) {

            if ($_POST['id'] == $_SESSION['user_id'])
            {
                $_SESSION['messages_ko'][] = "Vous ne pouvez pas supprimer votre compte";
                header('Location:index.php?controller=users&action=list');
                exit;
            }

            $delete = deleteUser($_POST);
            if ($delete == true) {
                $_SESSION['messages_ok'][] = 'Utilisateur supprimée !';
            } else {
                $_SESSION['messages_ko'][] = "Erreur lors de la suppression de l'utilisateur.";
            }

            header('Location:index.php?controller=users&action=list');
            exit;
        } else {
            header('Location:index.php?controller=users&action=list');
            exit;
        }
        break;
    default:
        header('Location:index.php?controller=users&action=list');
        exit;
}