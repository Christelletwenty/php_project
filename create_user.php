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
        // echo('Vous devez remplir tous les champs');
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CREATE_USER</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/styles.css">
</head>
<body>

    <?php include 'menu.php'; ?>
    
    <article>
        <div>
            <h1>Créer un compte</h1>
            <form method="POST" action="create_user.php">
                <div class="mb-3">
                    <label for="login" class="form-label">Login</label>
                    <input name="login" type="text" class="form-control" id="login">
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Mot de passe</label>
                    <input name="password" type="password" class="form-control" id="pwd">
                    <div id="textarea-game" class="form-text">Pensez à mettre un mot de passe compliqué</div>
                </div>
                <button type="submit" class="btn btn-primary">Publier</button>
            </form>
        </div>
    </article>
</body>
</html>
