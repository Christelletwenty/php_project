<?php
    // import class
    require_once 'controllers/GameController.php'; 
    require_once 'models/Game.php';
    // On inclut les choses communes à tous les fichiers (session start, connexion db etc...)
    include('common.php');
    

    // On check si il y a un utilisateur connecté ($_SESSION)
    if(!isset($_SESSION['login'])){
        header("Location: login.php");
        die();
    }
    // Si c'est pas le cas on le redirige vers login.php
    // Y'a pas de sinon.

    $gameController = new GameController($db);
    $games = $gameController->getGames();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INDEX</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/styles.css">
</head>
<body>
    <?php include 'menu.php'; ?>

    <section>
        <article>
            <div>
                <h2>Jeux</h2>
                <div class="list-group">
                    <?php foreach($games as $game){ ?>
                        <a class="list-group-item list-group-item-action" href="game.php?GAME_ID=<?php echo $game->getId(); ?>"><?php echo $game->getName(); ?></a>
                        <?php
                        if(isset($_COOKIE['LastGame']) == true){
                            $lastGame = $_COOKIE['LastGame'];
                            if($lastGame == $game->getId()){
                                echo '<small>Vous venez de consulter ce jeu !</small>';
                            }
                        } 
                        ?> 
                    <?php } ?>
                </div>
            </div>
        </article>
    </section>
</body>
</html>