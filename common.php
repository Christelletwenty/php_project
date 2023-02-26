<?php
    // Premier truc avant toute instruction HTML
    session_start();

    // Ensuite on se coinnecte a la DB (On préfère PDO mais MySQLI c'est ok)
    $db = new PDO('mysql:host=localhost;dbname=chris;charset=utf8', 'root', '');
?>