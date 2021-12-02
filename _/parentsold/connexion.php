<?php

//require 'vars.php';



$bd="sisaulm_aulm"; 



$login="sisaulm_admin";

 

$mdp="1836wl!L"; 



//$serveur='localhost';
$serveur='60.84.9.12'; 

 

function connecter($serveur,$login,$mdp,$bd)

{

$connect = @mysql_connect($serveur,$login,$mdp);

if ( ! $connect ) 

die ('Failed to connect server vnc'); 

@mysql_select_db($bd, $connect) or die ('Database Select Failed');

}

connecter($serveur,$login,$mdp,$bd);

?>