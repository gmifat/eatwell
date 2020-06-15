<?php
    require_once 'models/newsletter.php';

    switch ($_GET['action'])
    {
        case 'list':
            $newsletters = getAllNewsletters();
            $pageTitle = 'List des inscrit à la newsletter';
            $view = 'views/newsletter/list.php';
            break;

        case 'delete':
            if (isset($_GET['id']) && !empty($_GET['id']))
            {
                $newsletter = getNewsletterById($_GET['id']);
                if($newsletter == false)
                {
                    $_SESSION['messages_ko'][] = 'Utilisateur non trouvée !';
                    header('Location:index.php?controller=newsletters&action=list');
                    exit;
                }
                $pageTitle = 'Supprimer une inscription utilisateur';
                $view = 'views/newsletter/delete.php';
            }
            else if (isset($_POST['id']) && !empty($_POST['id']))
            {
                $deleted = deleteNewsletter($_POST);
                if ($deleted == true)
                {
                    $_SESSION['messages_ok'][] = 'Inscription utilisateur supprimée !';
                }
                else
                {
                    $_SESSION['messages_ko'][] = "Erreur lors de la suppression de l'inscription utilisateur.";
                }

                header('Location:index.php?controller=newsletters&action=list');
                exit;
            }
            else if (isset($_POST['newsletters']) && !empty($_POST['newsletters']))
            {
                $newsletters = getNewslettersByIds($_POST['newsletters']);
                $pageTitle = 'Supprimer plusieurs inscription utilisateur';
                $view = 'views/newsletter/deleteMany.php';
            }
            else
            {
                header('Location:index.php?controller=newsletters&action=list');
                exit;
            }
            break;

        case 'delete_all':
            break;
        default:
            header('Location:index.php?controller=newsletters&action=list');
            exit;
    }