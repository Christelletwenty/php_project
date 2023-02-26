<?php
    // import class
    require_once 'models/User.php';
    require_once 'controllers/UserController.php';
    // On inclut les choses communes a tous les fichiers
    include('common.php');

    // On regarde si on a un formulaire qui a été envoyé sur cette page. Si c'est le cas, on le traite.
    if (!empty($_POST["login"]) && !empty($_POST["password"])){        
        $userController = new UserController($db);

        $user = new User();
        $user->setLogin($_POST["login"]);
        $user->setPassword($_POST["password"]);

        $userController->addUser($user);

    } else { // Si notre formulaire est pas rempli on affiche un message d'erreur. Ca serait mieux de le gérer avec $_REQUEST et $_SERVER
        // On va mettre un message d'erreur
        echo('Vous devez remplir tous les champs');
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CREATE_USER</title>
</head>
<body>
    <h1>Créer un compte</h1>

    <!-- Notre p'tit formulaire qui pointe ici même, pour créer un User -->
    <form method="POST" action="create_user.php">
        <input type="text" name="login" placeholder="Entrez votre nom d'utilisateur">
        <input type="password" name="password" placeholder="Entrez votre mot de passe">
        <button type="submit">Valider</button>
    </form>
</body>
</html>
