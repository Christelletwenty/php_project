<?php 

class Comment{
    private $id;
    private $gameId;
    private $userId;
    private $note;
    private $text;

    public function getId() {
        return $this->id;
    }

    public function getGameId() {
        return $this->gameId;
    }

    public function setGameId($gameId) {
        $this->gameId = $gameId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getNote() {
        return $this->note;
    }

    public function setNote($note) {
        if($note >= 0 && $note <= 5){
            $this->note = $note;
        }else{
            throw new Exception('La note doit être comprise entre 0 et 5');
        }
    }

    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
    }
}
?>