<?php  

if($_SESSION['session'] = true)
{
    $template = "account";

    require 'templates/layout.phtml';
}else
{
    require 'homepage.php';
}




?>