<?php
    // Premier truc avant toute instruction HTML
    session_start();
    // Ensuite on se connecte a la DB (On préfère PDO mais MySQLI c'est ok)
    // $servername = "localhost";
    // $dbUsername = "root";
    // $dbPassword = "";
    // $dbName = "my_website";
    //pdo est une classe permettant de gérer une base de données
    // Le host est = au nom du service "DB" dans dockercompose https://stackoverflow.com/questions/46508038/docker-cant-connect-to-mariadb-with-php
    $db = new PDO('mysql:host=db;dbname=my_website;charset=utf8', 'root', 'root');
?>