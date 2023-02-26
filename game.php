<?php
    // import class
    require_once 'models/Game.php';
    require_once 'models/Comment.php';
    require_once 'models/User.php';
    require_once 'controllers/GameController.php';
    require_once 'controllers/CommentController.php';
    require_once 'controllers/UserController.php';
    /// import du common
    include('common.php');

    if(!isset($_SESSION['login'])){
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
    <title><?php echo $game->getName(); ?></title>
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/styles.css">
</head>
<body>
    <?php include 'menu.php'; ?>

    <article>
        <div>
            <!-- Affichage du jeu dans les DI-->
            <h1>Jeu</h1>
            <h2><?php echo $game->getName(); ?></h2>
            <p> <?php echo $game->getDescription(); ?></p>

            <!--Affichage des commentaires-->
            <h1>Commentaires</h1>

            <div class="list-group">
                <?php foreach($comments as $comment){ ?>
                    <span class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">
                            <?php 
                                $userController = new UserController($db);
                                $user = $userController->getUserById($comment->getUserId());

                                if ($user != false) {
                                    echo $user->getLogin();
                                }
                            ?>
                        </h5>
                        <small><?php echo $comment->getNote(); ?>/5</small>
                        </div>
                        <p class="mb-1"><?php echo $comment->getText(); ?></p>
                    </span>
                <?php } ?>

                <span class="list-group-item list-group-item-action">
                    <form  class="mb-1" method="POST" action="game.php?GAME_ID=<?php echo $game->getId(); ?>">
                        <div class="mb-3">
                            <label for="text" class="form-label">Ajouter un commentaire</label>
                            <textarea class="form-control" name="text" id="text" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label">Votre note</label>
                            <input type="range" name="note" value="0" min="0" max="5" id="note">
                        </div>
                        <button type="submit" class="btn btn-primary">Publier</button>
                    </form>
                </span>
            </div>
        </div>
    </article>
</body>
</html>