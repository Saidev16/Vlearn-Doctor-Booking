<?php

require 'vars.php';



$bd="hisadm_hisdb"; 



$login="hisadm_hisusr";

 

$mdp="hispass11"; 



$serveur='127.0.0.1'; 

 

function connecter($serveur,$login,$mdp,$bd)

{

$connect = @mysql_connect($serveur,$login,$mdp);
mysql_query("SET NAMES 'utf8'", $connect);

if ( ! $connect ) 

die ('Failed to connect server vnc'); 

@mysql_select_db($bd, $connect) or die ('Database Select Failed');


}

connecter($serveur,$login,$mdp,$bd);

if (isset($_GET['code_cours']) && isset($_GET['B'])){
$_GET['code_cours'] = 'I&B';	
}
elseif(isset($_GET['code_cours']) && isset($_GET['B300'])){
$_GET['code_cours'] = 'I&B300';	
}

?>