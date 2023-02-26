<?php 

class CommentController{
    private $db;

    public function __construct($db) {
        $this->db = $db;      
    }

    /**
     * Création de commentaire
     * @param Comment $comment le commentaire à ajouter à la db 
     * 
     */
    public function createComment(Comment $comment){
        //Création de requête pour créer  des commentaires
        $createComRequest = 'INSERT INTO comment (gameId, userId, note, text) VALUES (:gameId, :userId, :note, :text)';
            
        //Préparation de la requête
        $createComStatement = $this->db->prepare($createComRequest);
        //Envoit une requête à la base de donnée en prenant en paramètre un tableau associatif de valeurs nécessaire à la requête 
        $createComStatement->execute([
            "gameId" => $comment->getGameId(),
            "userId" => $comment->getUserId(),
            "note" => $comment->getNote(),
            "text" => $comment->getText(),
        ]);
    }

    /**
     * Récupération de tous les commentaires selon leur jeu 
     * @param $gameId int les commentaires à selectionner selon l'id dui jeu 
     * @return .... retourne tous les commentaires du jeu
     */
    public function getCommentsByGameId(int $gameId) {
        //création de la requête pour sélectionner tous les champs de ma table "comment"
       $getComRequest = 'SELECT * FROM comment WHERE gameId = :game_id ORDER BY id DESC';

       //prép de la requête 
       $getComStatement = $this->db->prepare($getComRequest);
       $getComStatement->setFetchMode(PDO::FETCH_CLASS, 'Comment');

       ////Envoit une requête à la base de donnée en prenant en paramètre un tableau associatif de valeurs nécessaire à la requête 
       $getComStatement->execute([
            "game_id" => $gameId
       ]);

       ////On récupère et on met le résultat de notre requête dans une variable ($comment)
       return $getComStatement->fetchAll();
    }
}

?>