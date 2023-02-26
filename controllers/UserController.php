<?php 

class UserController{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Récupère un utilisateur dans la DB via son login
     * 
     * @param string $login le login a chercher en DB
     * @return User | false le user troucé sinon false
     */
    public function getUserByLogin(string $login){
        //Création d'une requête pour sélectionner tous les champs de la table user là ou le login = à la chaine de caractère login qu'on lui passe. 
        $getUserRequest = 'SELECT * FROM user WHERE login = :login ';
        //:login va être remplacé par une chaine de caractère qu'on va lui fournir lors de l'éxecution de la requête. 
       
        //Préparation de la requête
        $getUserStatment = $this->db->prepare($getUserRequest);
        $getUserStatment->setFetchMode(PDO::FETCH_CLASS, 'User');
        
        //Envoit une requête à la base de donnée en prenant en paramètre un tableau associatif de valeurs nécessaire à la requête (:login)
        $getUserStatment->execute([

            //En dessous, strtolower me retourne une nouvelle variable mais en minuscule.
            'login' => strtolower($login)
        ]); 

        //On récupère et on met le résultat de notre requête dans une variable ($user)
        return $getUserStatment->fetch();
        //reoturnera le User qu'on a demandé ou false si rien n'est retourné par la db. 
    }

    /**
     * Récupère un utilisateur dans la DB via son ID
     * 
     * @param string $id l'id a chercher en DB
     * @return User | false le user troucé sinon false
     */
    public function getUserById(int $id){
        //Création d'une requête pour sélectionner tous les champs de la table user là ou le login = à la chaine de caractère login qu'on lui passe. 
        $getUserRequest = 'SELECT * FROM user WHERE id = :id';
       
        //Préparation de la requête
        $getUserStatment = $this->db->prepare($getUserRequest);
        $getUserStatment->setFetchMode(PDO::FETCH_CLASS, 'User');
        
        //Envoit une requête à la base de donnée en prenant en paramètre un tableau associatif de valeurs nécessaire à la requête (:login)
        $getUserStatment->execute([
            'id' => $id
        ]); 

        return $getUserStatment->fetch();
        //reoturnera le User qu'on a demandé ou false si rien n'est retourné par la db. 
    }

    public function getUsers(){
        return;
    }

    /**
     * Ajoute un nouvel utilisateur dans la DB
     * 
     * @param User $user un objet de type user
     */
    public function addUser(User $user){
        // On se connecte a la DB
        $request = 'INSERT INTO user (login, password) VALUES (:login, :password)';
        
        $statment = $this->db->prepare($request);
        $statment->execute([
            "login" => strtolower($user->getLogin()), // On stock le login tout en minuscule pour que ça soit plus facile a chercher 
            "password" => password_hash($user->getPassword(), PASSWORD_DEFAULT), // On encrypte le PWD avant de le stocker, faudra pas oublier a décrypter pour comparer quand on checkera si le pwd est bon
        ]);
    }
}
?>