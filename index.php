<?php 

require './logic/rooter.php';


if(isset($_GET['route']))
{
    
    checkRoute($_GET['route']);
    
}else{
    
    checkRoute('');
    
}

// Création d'un nouvel utilisateur

if(isset($_POST['firstName']))
{
    saveUser('firstName');
    
}else if(isset($_POST['lastName']))
{
    
    saveUser('lastName');
    
}else if(isset($_POST['email']))
{
    
    saveUser('email');
    
}else if(isset($_POST['password']) === isset($_POST['confirmPassword']))
{
    
    password_hach(saveUser('password'));
    
}







?>