<?php
    // On inclut les choses communes a tous les fichiers
    include('common.php');

    // On regarde si on a un formulaire qui a été envoyé sur cette page. Si c'est le cas, on le traite.
    if (!empty($_POST["login"]) && !empty($_POST["password"])) {
        // On se connecte a la DB
        $request = 'INSERT INTO user (login, password) VALUES (:login, :password);';
        
        $statment = $db->prepare($request);
        $statment->execute([
            "login" => strtolower($_POST["login"]), // On stock le login tout en minuscule pour que ça soit plus facile a chercher -- on fera idem pour rechercher un user
            "password" => password_hash($_POST["password"], PASSWORD_DEFAULT), // On encrypte le PWD avant de le stocker, faudra pas oublier a décrypter pour comparer quand on checkera si le pwd est bon
        ]);

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
    <h1>Créer un user</h1>

    <!-- Notre p'tit formulaire qui pointe ici même, pour créer un User -->
    <form method="POST" action="create_user.php">
        <input type="text" name="login" placeholder="Entrez votre nom d'utilisateur">
        <input type="password" name="password" placeholder="Entrez votre pwd">
        <button type="submit">Valider</button>
    </form>
</body>
</html>