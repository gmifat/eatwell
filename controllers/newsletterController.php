<?php

if (isset($_POST['email']) && !empty($_POST['email']))
{
    $email = $_POST['email'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        require_once 'models/newsletter.php';
        $result = AddEmailToNewsletter($email);
        if ($result === true)
        {
            $_SESSION['messages_ok'][] = 'Votre inscription à la newsletter est bien prise en compte';
        }
        else
        {
            $_SESSION['messages_ko'][] = $result;
        }
    }
    else
    {
        $_SESSION['messages_ko'][] = 'Merci de renseigner une adresse email valide pour s\'inscrire à la newsletter';
    }

}
else
{
    $_SESSION['messages_ko'][] = 'Merci de renseigner votre adresse email pour s\'inscrire à la newsletter';
}

header('location:index.php');
exit;