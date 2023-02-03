<?php 

// Les require

require './logic/rooter.php';
require './templates/layout.phtml';
require './logic/database.php';


// Check de page dans l'url

if(isset($_GET['route']))
{
    
    checkRoute($_GET['route']);
    
}else{
    
    checkRoute('');
    
}

// Création d'un nouvel utilisateur

$error_message = '';

if(isset($_POST['firstName']) && !empty($_POST['firstName']) 
&& isset($_POST['lastName']) && !empty($_POST['lastName']) 
&& isset($_POST['email']) && !empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) 
&& isset($_POST['password']) && !empty($_POST['password']) 
&& isset($_POST['confirmPassword']) && !empty($_POST['confirmPassword']))
{
    
    if($_POST['password'] === $_POST['confirmPassword'])
    {
        $hash_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $newUSer = new User($_POST['firstName'], $_POST['lastName'], $_POST['email'], $hash_password);
        saveUser($newUser);
        
    }
    
    
    
    if(empty($_POST['firstName']))
    {
        
        $error_message = "Vous n'avez pas donner de prénom !";
        
    }else if(empty($_POST['lastName']))
    {
        
        $error_message = "Vous n'avez pas donner de nom de famille !";
        
    }else if(empty($_POST['email']) && (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)))
    {
        
        $error_message = "Votre email n'est pas valide !";
        
    }else if(empty($_POST['password']))
    {
        
        $error_message = "Vous n'avez pas donner de mot de passe !";
        
    }else if(isset($_POST['password']) !== isset($_POST['confirmPassword']))
    {
        
        $error_message = "Vos mot de passe ne correspondent pas !";
        
    }
}


// Connexion avec un utilisateur


if(isset($_POST['useremail']) && !empty($_POST['useremail']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) 
&& isset($_POST['userpassword']) && !empty($_POST['userpassword']))
{
    
    if(password_verify($_POST['password'], loadUser($_POST['userpassword'])->getPassword()))
    {
        
        require './pages/account.php';
        
    }else
    {
        
        $error_message = "Vos identifiants ne sont pas correct !";
        
    }
    
}



?>