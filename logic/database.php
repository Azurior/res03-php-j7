<?php 

session_start();


require 'models/User.php';

$host = "db.3wa.io";
$port = "3306";
$dbname = "tonygohin_phpj7";
$connexionString = "mysql:host=$host;port=$port;dbname=$dbname";

$user = "tonygohin";
$password = "f80620de30f1b8d1caba3a7e4b950a9a";

$db = new PDO(
    $connexionString,
    $user,
    $password
);

function loadUser(string $email, PDO $db) : User
{
    
        $query = $db->prepare('SELECT * FROM users WHERE email = :email');
        $parameters = [
        'email' => $email
        ];
        $query->execute($parameters);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        $newUser = new User($user['first_name'], $user['last_name'],$user['email'], $user['password']);
        $newUser->setId($user['id']);
        
        return $newUser;
}

function saveUser(User $user, PDO $db) : User
{
    
    $query = $db->prepare('INSERT INTO users (id, first_name, last_name, email, password) VALUES (null, :first_name, :last_name, :email, :password) ');

    $parameters = [
        'first_name' => $user->getFirst_name(),
        'last_name' => $user->getLast_name(),
        'email' => $user->getEmail(),
        'password' => $user->getPassword()
        ];
        
    $query->execute($parameters);
    
    return loadUser($user->getEmail(), $db);
}


?>