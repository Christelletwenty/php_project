<?php
    // On inclut les choses communes à tous les fichiers (session start, connexion db etc...)
    include('common.php');
    

    // On check si il y a un utilisateur connecté ($_SESSION)
    // Si c'est pas le cas on le redirige vers login.php
    // Y'a pas de sinon.
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
    Ravi de vous voir <!-- Afficher le nom de l'utilisateur connecté ici --> !
</body>
</html>