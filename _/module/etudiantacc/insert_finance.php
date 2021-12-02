<?php


$bd="hisadm_hisdb";

$login="hisadm_hisusr";

$mdp="hispass11";

$serveur='127.0.0.1';

function connecter($serveur,$login,$mdp,$bd)
{

$connect = @mysql_connect($serveur,$login,$mdp);

if ( ! $connect )

die ('Failed to connect server vnc');

@mysql_select_db($bd, $connect) or die ('Database Select Failed');

}

connecter($serveur,$login,$mdp,$bd);
die("error");


$sql = "SELECT * FROM `tbl_etudiant_all` WHERE `new_transcript` = 1";
var_dump($sql);
echo "<br>";

$req = mysql_query($sql);

while ($row = mysql_fetch_assoc($req)){
  $code_inscription = $row['code_inscription'];
  $prefixe = $row['prefixe'];
  $sql_credits = "SELECT SUM(c.nbr_credit) as total_credits FROM tbl_note_acc as n , tbl_cours as c WHERE
   n.code_cours = c.code_cours and n.code_inscription = $code_inscription and n.prefixe = '$prefixe' and n.letter_grade != 'T' GROUP by n.code_inscription,n.prefixe";

   $req_credits = mysql_query($sql_credits);
   $row_credits = mysql_fetch_assoc($req_credits);
   $nb_credits = $row_credits['total_credits'];
   echo "<br>";
   echo "Total credits : ".$nb_credits;
   echo "<br>";

   if ($nb_credits <= 7) {
     $price = 3000;
     $niveau = 1;
   }

   if ($nb_credits >= 8 && $nb_credits <= 14) {
     $price = 5400;
     $niveau = 2;
   }

   echo $price;
   echo "<br>";


   $sql_insert = "INSERT INTO `tbl_finance`(`prefixe`, `code_inscription`, `niveau`, `bourse`, `frais_inscription`, `frais_etude`, `payee`, `annee`)
   VALUES ('$prefixe','$code_inscription',$niveau,0,0,$price,0,null)";
   echo $sql_insert;
   echo "<br>";
   //$row_insert = mysql_query($sql_insert);


}


?>
