<?php

function dbConnect()
{
    try{
        $db = new PDO('mysql:host=localhost:3306;dbname=eatwell;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch (Exception $exception) //$e contiendra les éventuels messages d’erreur
    {
        die( 'Erreur : ' . $exception->getMessage() );
    }

    return $db;
}

function getVarOutput($var)
{
    ob_start();
    var_dump($var);
    $result = ob_get_clean();
    $_SESSION['messages_ko'][] = $result;
}

//la fonction die arrête le script et peut afficher un message
//le catch n’est appelé que si une erreur survient au try