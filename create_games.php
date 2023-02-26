<?php
    // On inclut les choses communes a tous les fichiers
    include('common.php');

    // On regarde si on a un formulaire qui a été envoyé sur cette page. Si c'est le cas, on le traite.
    if (!empty($_POST["name"]) && !empty($_POST["description"])) {
        // On créé la requête
        $newGameRequest = 'INSERT INTO games (name, description) VALUES (:name, :description)';
        
        $newGameStatement = $db->prepare($newGameRequest);
        $newGameStatement->execute([
            "name" => $_POST["name"],
            "description" => $_POST["description"]
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
    <title>CREATE_GAMES</title>
</head>
<body>
    <h1>Créer un avis sur un jeu</h1>

    <!-- Notre p'tit formulaire qui pointe ici même, pour créer un avis jeu -->
    <form method="POST" action="create_games.php">
        <input type="text" name="name" placeholder="Nom du jeu">
        <!-- <label for="" > Votre avis sur le jeu</label> -->
        <textarea name="description" cols="5" rows="5" placeholder="description"></textarea>
        <!-- <input type="range" name="note" min="0" max="5">
        <label for="volume">Note</label> -->
        <button type="submit">Publier</button>
    </form>

    
</body>
</html>