<?php
    // Premier truc avant toute instruction HTML
    session_start();
    // Ensuite on se connecte a la DB (On préfère PDO mais MySQLI c'est ok)
    // $servername = "localhost";
    // $dbUsername = "root";
    // $dbPassword = "";
    // $dbName = "my_website";
    //pdo est une classe permettant de gérer une base de données
    $db = new PDO('mysql:host=localhost;dbname=my_website;charset=utf8', 'root', '');
?>