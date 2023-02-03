<?php 

require '../models/User.php';

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

function loadUser(string $email) : User
{
    
        $query = $db->prepare('SELECT * FROM users WHERE email = :email');
        $parameters = [
        'email' => $_POST['email']
        ];
        $query->execute($parameters);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        $newUser = new User($user['first_name'], $user['last_name'], $user['email'], $user['password']));
        $newUser->setId($user['id']);

}

function saveUser(User $user) : User
{
    
    $query = $db->prepare('INSERT INTO users (id, first_name, last_name, email) VALUES (null, :first_name, :last_name, :email) ');

    $parameters = [
        'first_name' => $user->getFirstName(),
        'last_name' => $user->getLastName(),
        'email' => $user->getEmail()
        ];
        
    $query->execute($parameters);
}


?>