<?php include("common.php")?>

<?php
foreach (get_games() as $game){
    echo "<li>" .  $game ['name'] . "</li>";
}

/*je check si il y a 'played' dans l'URL, si c'est le cas j'affiche avec echo*/
if(isset($_GET['played'])){
    echo $_GET['played'];
}
?>

</body>
</html>