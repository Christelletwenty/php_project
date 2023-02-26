<?php
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
        var_dump($_POST);

        $crateComRequest = 'INSERT INTO comment (gameId, userId, note, text) VALUES (:gameId, :userId, :note, :text)';
        
        $crateComStatement = $db->prepare($crateComRequest);
        $crateComStatement->execute([
            "gameId" => $_GET["GAME_ID"],
            "userId" => $_SESSION['connectedUserId'],
            "note" => isset($_POST['note']) ? $_POST['note'] : '',
            "text" => isset($_POST['text']) ? $_POST['text'] : '',
        ]);


        //////////////////////////////////////////////
        //////////////// RECUP GAME ND COMMENTS

        $getGameRequest = 'SELECT * FROM games WHERE id = :game_id';
        
        $getGameStatement = $db->prepare($getGameRequest);
        $getGameStatement->execute([
            "game_id" => $_GET["GAME_ID"]
        ]);

       $game = $getGameStatement->fetch();

       if($game == false){
        header("Location:index.php");
        die();
       }

       $getComRequest = 'SELECT * FROM comment WHERE gameId = :game_id ORDER BY id DESC';

       $getComStatement = $db->prepare($getComRequest);
       $getComStatement->execute([
            "game_id" => $game['id']
       ]);

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
    <!-- Affichage du jeu dans les DIV -->
    <h1>Jeux</h1>
    <h2><?php echo $game['name']; ?></h2>
    <p> <?php echo $game['description']; ?></p>

    <h1>Commentaires</h1>
<?php foreach($comments as $comment){ ?>
    <div>
        <p> <?php echo $comment['text']; ?></p>
        <p> <?php echo $comment['note']; ?>/5</p>
    </div> 
<?php } ?>

    <form method="POST" action="game.php?GAME_ID=<?php echo $game['id']; ?>">
        <label for="text" > Votre avis sur le jeu</label>
        <textarea name="text" cols="50" rows="5"></textarea>
        <input type="range" name="note" value="0" min="0" max="5">
        <label for="volume">Note</label>
        <button type="submit">Publier</button>
    </form>
</body>
</html>