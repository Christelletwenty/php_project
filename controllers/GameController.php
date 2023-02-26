<?php 

class GameController{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Récupère tous les jeux triés par ordre alphabétique 
     * @return array<Game>
     */
    public function getGames(){

        $getGamesRequest = 'SELECT * FROM game ORDER BY name ASC';

        $getGamesStatement = $this->db->prepare($getGamesRequest);
        $getGamesStatement->setFetchMode(PDO::FETCH_CLASS, 'Game');
        $getGamesStatement->execute();
        return $getGamesStatement->fetchAll();
    }

    /**
     * récup un jeu en fonction de l'id
     * @param $id string id du jeu à chercher en db 
     * @return Game | false le jeu trouvé ou false
     */
    public function getGameById($id){
        //Création d'une requête pour sélectionner tous les champs de la table game là ou l'id du jeu = id URL
        $getGameRequest = 'SELECT * FROM game WHERE id = :game_id';
        
        //préparation de la requête
        $getGameStatement = $this->db->prepare($getGameRequest);
        $getGameStatement->setFetchMode(PDO::FETCH_CLASS, 'Game');

        //Envoit une requête à la base de donnée en prenant en paramètre un tableau associatif de valeurs nécessaire à la requête 
        $getGameStatement->execute([
            "game_id" => $id
        ]);

        //récuperation de la requête et résultat, dans une variable ($game)
       return $getGameStatement->fetch();
    }

    /**
     * Ajoute un jeu dans la db
     * @param $game Game le jeu à ajouter
     * 
     */
    public function addGame($game){
        $newGameRequest = 'INSERT INTO game (name, description) VALUES (:name, :description)';
        
        $newGameStatement = $this->db->prepare($newGameRequest);
        $newGameStatement->execute([
            "name" => $game->getName(),
            "description" => $game->getDescription()
        ]);

    }
}
?>