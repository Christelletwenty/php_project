<?php
    // import class
    require_once 'models/Game.php';
    require_once 'models/Comment.php';
    require_once 'controlleurs/GameController.php';
    /// import du common
    include('common.php');

    if(isset($_SESSION['login'])){
        echo "vous êtes connecté";
    }else{
        header("Location: login.php");
        die();
    }
    
    $game = false;
    $comments = false;
    // Regarder si on a un id de jeu dans l'URL
    if(isset($_GET['GAME_ID'])){


        ///////////////////// CREATION COMMENTAIRE
        //Check si l'utilisateur à créer un commentaire 
        if(isset($_POST['note']) || isset($_POST['text'])){

            //Création de requête pour créer  des commentaires
            $createComRequest = 'INSERT INTO comment (gameId, userId, note, text) VALUES (:gameId, :userId, :note, :text)';
            
            //Préparation de la requête
            $createComStatement = $db->prepare($createComRequest);
            //Envoit une requête à la base de donnée en prenant en paramètre un tableau associatif de valeurs nécessaire à la requête 
            $createComStatement->execute([
                "gameId" => $_GET["GAME_ID"],
                "userId" => $_SESSION['connectedUserId'],
                "note" => isset($_POST['note']) ? $_POST['note'] : '',
                "text" => isset($_POST['text']) ? $_POST['text'] : '',
            ]);
        }

        //////////////////////////////////////////////
        //////////////// RECUP GAME ND COMMENTS

        $gameController = new GameController($db);
        $game = $gameController->getGameById($_GET['GAME_ID']);

        //est-ce que le jeu existe?
       if($game == false){
        header("Location:index.php");
        die();
       }

       //création de la requête pour sélectionner tous les champs de ma table "comment"
       $getComRequest = 'SELECT * FROM comment WHERE gameId = :game_id ORDER BY id DESC';

       //prép de la requête 
       $getComStatement = $db->prepare($getComRequest);
       $getComStatement->setFetchMode(PDO::FETCH_CLASS, 'Comment');

       ////Envoit une requête à la base de donnée en prenant en paramètre un tableau associatif de valeurs nécessaire à la requête 
       $getComStatement->execute([
            "game_id" => $game->getId()
       ]);

       ////On récupère et on met le résultat de notre requête dans une variable ($comment)
       $comments = $getComStatement->fetchAll();
    }else{
        header("Location:index.php");
        die();
    }


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game</title>
</head>
<body>
    <!-- Affichage du jeu dans les DI-->
    <h1>Jeux</h1>
    <h2><?php echo $game->getName(); ?></h2>
    <p> <?php echo $game->getDescription(); ?></p>

    <!--Affichage des commentaires-->
    <h1>Commentaires</h1>
    <?php foreach($comments as $comment){ ?>
        <div>
            <p> <?php echo $comment->getText(); ?></p>
            <p> <?php echo $comment->getNote(); ?>/5</p>
        </div> 
    <?php } ?>

    <form method="POST" action="game.php?GAME_ID=<?php echo $game->getId(); ?>">
        <label for="text" > Votre avis sur le jeu</label>
        <textarea name="text" cols="50" rows="5"></textarea>
        <input type="range" name="note" value="0" min="0" max="5">
        <label for="volume">Note</label>
        <button type="submit">Publier</button>
    </form>
</body>
</html>