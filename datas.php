<?php 

$games = [
    ['name' => 'The last of us', 'description' => 'Le Lorem Ipsum est simplement du faux texte', 'année' => 2012, 'played'],
    ['name' => 'Hogwarts Legacy', 'description' => 'Le Lorem Ipsum est simplement du faux texte', 'année' => 2023, 'played'],
    ['name' => 'The Sims 4', 'description' => 'Le Lorem Ipsum est simplement du faux texte', 'année' => 2014, 'played'],
    ['name' => 'Outlast', 'description' => 'Le Lorem Ipsum est simplement du faux texte', 'année' => 2013, 'played'],
    ['name' => 'God of war 3', 'description' => 'Le Lorem Ipsum est simplement du faux texte', 'année' => 2010, 'played']
];

//filtrer le tableau selon les jeux qui ont été joué
function get_games($only_played = true){
    global $games;

    return array_filter($games,function($game){
        return $game['played'];
    });
}
 
$only_played = array_filter($games, function($game){  
});


?>
