<?php
    // import class
    require_once 'controllers/GameController.php'; 
    require_once 'models/Game.php';
    // On inclut les choses communes à tous les fichiers (session start, connexion db etc...)
    include('common.php');
    

    // On check si il y a un utilisateur connecté ($_SESSION)
    if(isset($_SESSION['login'])){
        echo "vous êtes connecté";
    }else{
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
</head>
<body>
    Ravis de vous voir <!-- Afficher le nom de l'utilisateur connecté ici --> !
    <div>
        <nav>
            <ul>
                <a href="disconnect.php">Déconnexion</a>
            </ul>
        </nav>
    </div>

    <form action="" method="get" name="recherche">
        <input type="text" name="keywords" placeholder="Jeux">
        <input type="submit" name="Valider" value="rechercher">
    </form>

    <section>

        <article>
            <h2>Derniers avis publiés</h2>
            <p>Retrouvez les derniers avis publiés par nos utilisateurs.</p>
            <a href="#">Voir plus</a>
        </article>

        <article>
            <h2>Vos avis</h2>
            <p>Publier ou relire vos avis sur les jeux auxquels vous avez joué</p>
            <a href="#">Voir plus</a>
        </article>

        <article>
            <h2>Jeux</h2>
            <ul>
                <?php foreach($games as $game){ ?>
                    <li>
                        <a href="game.php?GAME_ID=<?php echo $game->getId(); ?>"><?php echo $game->getName(); ?></a>
                    </li> 
                <?php } ?>
            </ul>
        </article>
    </section>
</body>
</html>