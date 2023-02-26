<?php
    // On inclut les choses communes a tous les fichiers (session start, connexion db etc...)
    include('common.php');    

    // On check si il y a un utilisateur connecté ($_SESSION)
    // Si c'est le cas on redirige vers index.php
    // Sinon on reste ici (donc y'a pas de sinon)



    // Bout de code ou tu checkes le $_POST. Si y'a un login / pwd alors on regarde dans la base si ça correspond à un user
    if (/* c'est la qu'on check le $_POST */) {
        $getUserRequest = 'SELECT * FROM user WHERE ..........'; // Ajouter ici la condition pour trouver le bon user avec le login fourni
        $getUserStatment = $db->prepare($getUserRequest);
        $getUserStatment->execute();

        // Ensuite on check si notre user existe. Puis si le mot de passe récupéré du formulaire correspond a ce qu'on a en base de données
        // Pour ça on utilise la fonction password_verify qui prend 2 paramètres (le pwd tapé par l'utilisateur et le pwd encrypté pour comparer : https://www.php.net/manual/en/function.password-verify.php )
        
        // Si le mot de passe est bon, on redirige sur index.php, sinon on affiche un message d'erreur
    }
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
    Vous devez vous connecter !
    <!-- Ici tu fais un formulaire de connexion avec l'action sur cette page -->
    <!-- Voir l'exemple dans create_user.php -->
</body>
</html>