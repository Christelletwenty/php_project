<?php
    // import class
    require_once 'models/User.php';
    require_once 'controllers/UserController.php';
    // On inclut les choses communes a tous les fichiers (session start, connexion db etc...)
    include('common.php');    

    // On check si il y a un utilisateur connecté ($_SESSION)
    if(isset($_SESSION['login'])){
        // Si c'est le cas on redirige vers index.php
        header("Location:index.php");
    }   
    // Sinon on reste ici

    // Je check le $_POST. Si y'a un login / pwd alors on regarde dans la base si ça correspond à un user
    if (isset($_POST['login']) && isset($_POST['password'])) {
        $userController = new UserController($db);
        
        $user = $userController->getUserByLogin($_POST['login']);
        
        // Ensuite on check si notre user existe. Puis si le mot de passe récupéré du formulaire correspond a ce qu'on a en base de données
        if($user != false){
            
            $hash = $user->getPassword();
            // Pour ça on utilise la fonction password_verify qui prend 2 paramètres (le pwd tapé par l'utilisateur et le pwd encrypté.
            $valid = password_verify($_POST['password'],$hash);

        // Si le mot de passe est bon, on stock dans $session le login de l'utilisateur et on redirige sur index.php, sinon on affiche un message d'erreur
            if($valid == true){
                $_SESSION['login'] = $user->getLogin();
                // On ajoute l'ID du user connecté pour pouvoir s'en servir plus tard (par exemple dans la créa des commentaires)
                $_SESSION['connectedUserId'] = $user->getId();
                header("Location:index.php");
                die(); //évite d'exectuer du code inutile
            }else {
                echo "Votre mot de passe n'est pas valide";
            }
        }else{
            echo "Votre login n'est pas valide";
        }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login page</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/styles.css">
</head>
<body>
    <section>
        <aside>
            <img src="./assets/mario.png" alt="Mario">
        </aside>
        <article>
            <div>
                <h1>Connexion</h1>
                <form method="POST" action="login.php">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Pseudo</label>
                        <input type="text" name="login" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" aria-describedby="pwdHelp">
                        <div id="pwdHelp" class="form-text">Te gourre pas dans les majuscules hein...</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </article>
    </section>
</html>