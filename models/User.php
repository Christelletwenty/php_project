<?php 

class User{
    private $id;
    private $login;
    private $password;

    public function getId() {
        return $this->id;
    }
    
    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = strtolower($login);
    }
    
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
}
?>