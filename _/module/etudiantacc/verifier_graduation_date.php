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

$student = array(
    array('AG',32),
    array('MOR',287),
    array('MOR',289),
    array('BF',340),
    array('BF',343),
    array('BF',346),
    array('BF',351),
    array('BF',353),
    array('BF',354),
    array('BF',355),
    array('BF',356),
    array('BF',358),
    array('BF',359),
    array('BF',361),
    array('MOR',286),
    array('BF',350),
    array('BF',341),
    array('AG',33),
    array('AG',34),
    array('BF',336),
    array('BF',337),
    array('BF',367),
    array('BF',368),
    array('BF',369),
    array('BF',371),
    array('BF',372),
    array('BF',376),
    array('GS',1),
    array('MOR',120),
    array('MOR',267),
    array('MOR',276),
    array('MOR',277),
    array('MOR',283),
    array('MOR',292),
    array('MOR',293),
    array('MOR',294),
    array('MOR',296),
    array('MOR',297),
    array('MOR',299),
    array('MOR',302),
    array('MOR',304),
    array('MOR',305),
    array('MOR',306),
    array('ORL',236),
    array('MOR',303),
    array('MOR',300)
);

foreach ($student as $v) {
  $prefixe = $v['0'];
  $code_inscription = $v['1'];
  echo "<br>";
  echo "------------";
  echo "<br>";
  echo $code_inscription;
  echo "<br>";
  echo $prefixe;
  echo "<br>";

  $sql_update = "UPDATE `tbl_etudiant_all` SET `graduation_date` = '' WHERE `prefixe` = '$prefixe' and `code_inscription` = '$code_inscription'";
  $req_update = mysql_query($sql_update);
  // verfier si date de garduation est vide
  $sql = "SELECT `prefixe`, `code`, `code_inscription`, `nom`, `prenom`, `date_inscription`, `graduation_date` FROM `tbl_etudiant_all`
   WHERE `prefixe` = '$prefixe' and `code_inscription` = '$code_inscription'";
  $req = mysql_query($sql);

  while ($row = mysql_fetch_assoc($req)) {
    $graduation_date = $row['graduation_date'];
    echo $graduation_date;
    echo "<br>";
    echo "----------";
    echo "<br>";
  }
}



?>
