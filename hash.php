<?php 

$mdp = 'azer1234';

$hash_mdp = password_hash($mdp, PASSWORD_DEFAULT);

echo($hash_mdp);

$dehash_mdp = password_verify('azer1234', $hash_mdp);

if($dehash_mdp === true)
{
    echo 'Bon mot de passe';
}else 
{
    echo 'mauvais mot de passe';
}





?>