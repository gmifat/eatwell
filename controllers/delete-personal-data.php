<?php
$view = "views/deletion-personal-data.php";
if (isset($_POST['last_name']) && !empty($_POST['last_name']))
{
    $view = 'views/ok.php';
}