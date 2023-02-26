<?php
    // import class
    require_once 'models/Game.php';
     require_once 'controllers/GameController.php'; 
    // On inclut les choses communes a tous les fichiers
    include('common.php');

    // On regarde si on a un formulaire qui a été envoyé sur cette page. Si c'est le cas, on le traite.
    if (!empty($_POST["name"]) && !empty($_POST["description"])) {
        $gameController = new GameController($db);
        $game = new Game();
        $game->setName($_POST["name"]);
        $game->setDescripiton($_POST["description"]);

        $gameController->addGame($game);
    
    } else { // Si notre formulaire est pas rempli on affiche un message d'erreur. Ca serait mieux de le gérer avec $_REQUEST et $_SERVER
        // On va mettre un message d'erreur
        // echo('Vous devez remplir tous les champs');
        // TODO : créer une erreur 
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Créer un jeu</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/styles.css">
</head>
<body>
    <?php include 'menu.php'; ?>

    <article>
        <div>
            <h1>Créer un jeu</h1>
            <form method="POST" action="create_games.php">
                <div class="mb-3">
                    <label for="gameName" class="form-label">Nom du jeu</label>
                    <input name="name" type="text" class="form-control" id="gameName">
                </div>
                <div class="mb-3">
                    <label for="textarea-game" class="form-label">Description du jeu</label>
                    <textarea class="form-control" id="textarea-game" rows="3" name="description"></textarea>
                    <div id="textarea-game-label" class="form-text">Soyez originaux, ici on aime les drôleries</div>
                </div>
                <button type="submit" class="btn btn-primary">Publier</button>
            </form>
        </div>
    </article>

    
</body>
</html>