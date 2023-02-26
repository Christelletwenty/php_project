<?php
    // import class
    require_once 'models/Game.php';
    require_once 'models/Comment.php';
    require_once 'controllers/GameController.php';
    require_once 'controllers/CommentController.php';
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
        $commentController = new CommentController($db);
        if(isset($_POST['note']) || isset($_POST['text'])){

            $comment = new Comment();
            $comment->setGameId($_GET["GAME_ID"]);
            $comment->setUserId($_SESSION['connectedUserId']);
            $comment->setNote(isset($_POST['note']) ? $_POST['note'] : '');
            $comment->setText(isset($_POST['text']) ? $_POST['text'] : '');
            $commentController->createComment($comment);
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
       $comments = $commentController->getCommentsByGameId($game->getId());
       
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