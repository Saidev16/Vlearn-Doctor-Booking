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
// die("error");


$sql = "SELECT e.code_inscription , e.prefixe,e.date_inscription,f.niveau,f.frais_etude FROM
`tbl_etudiant_all` as e, tbl_finance as f WHERE e.prefixe = f.prefixe and e.code_inscription = f.code_inscription";
var_dump($sql);
echo "<br>";

$req = mysql_query($sql);
$recu = 200;
while ($row = mysql_fetch_assoc($req)){
  $code_inscription = $row['code_inscription'];
  $prefixe = $row['prefixe'];
  $year = $row['niveau'];
  $price = $row['frais_etude'];
  $date_inscription = $row['date_inscription'];

  echo "-------------";
  echo "<br>";
  echo "code_inscription : ".$code_inscription;
  echo "<br>";
  echo "Prefixe : ".$prefixe;
  echo "<br>";
  echo "Price : ".$price;
  echo "<br>";
  echo "date_inscription : ".$date_inscription;
  echo "<br>";

  $sql_credits = "SELECT SUM(c.nbr_credit) as total_credits FROM tbl_note_acc as n , tbl_cours as c WHERE n.code_cours = c.code_cours
  and n.code_inscription in (SELECT `code_inscription` FROM `tbl_etudiant_all` WHERE
    `new_transcript` = 1 and code_inscription = '$code_inscription' and prefixe = '$prefixe') and n.letter_grade != 'x'
   GROUP by n.code_inscription,n.prefixe";

  $req_credits = mysql_query($sql_credits);
  $row_credits = mysql_fetch_assoc($req_credits);
  $nb_credits = $row_credits['total_credits'];
  echo "<br>";
  echo "Total credits : ".$nb_credits;
  echo "<br>";
  $alumni = 0;
  if ($nb_credits >= 24) {
    $alumni = 1;
  }



  if ($price == 3000) {
    $price_paiement = $price/2;
    $recu = $recu+1;
    $sql_insert = "INSERT INTO `tbl_finance_paiement`(`code_inscription`, `prefixe`, `designation`, `annee`, `type_paiement`, `date_paiement`, `somme`, `receveur`, `recu`) VALUES
    ($code_inscription,'$prefixe','','',4,'$date_inscription',$price_paiement,'',$recu)";
    echo $sql_insert;
    echo "<br>";
    // $row_insert = mysql_query($sql_insert);

    if ($alumni == 1) {
      $date_inscription = date('Y-m-d', strtotime("+6 months", strtotime($date_inscription)));

      $recu = $recu+1;
      $sql_insert = "INSERT INTO `tbl_finance_paiement`(`code_inscription`, `prefixe`, `designation`, `annee`, `type_paiement`, `date_paiement`, `somme`, `receveur`, `recu`) VALUES
      ($code_inscription,'$prefixe','','',4,'$date_inscription',$price_paiement,'',$recu)";
      echo $sql_insert;
      echo "<br>";
      // $row_insert = mysql_query($sql_insert);
    }
  }
  if ($price == 5400) {
    $price_paiement = $price/4;
    $recu = $recu+1;
    $sql_insert = "INSERT INTO `tbl_finance_paiement`(`code_inscription`, `prefixe`, `designation`, `annee`, `type_paiement`, `date_paiement`, `somme`, `receveur`, `recu`) VALUES
    ($code_inscription,'$prefixe','','',4,'$date_inscription',$price_paiement,'',$recu)";
    echo $sql_insert;
    echo "<br>";
    // $row_insert = mysql_query($sql_insert);

    if ($alumni == 1) {
      $i = 0;
      for ($i=0; $i <= 2; $i++) {
        $date_inscription = date('Y-m-d', strtotime("+6 months", strtotime($date_inscription)));

        $recu = $recu+1;
        $sql_insert = "INSERT INTO `tbl_finance_paiement`(`code_inscription`, `prefixe`, `designation`, `annee`, `type_paiement`, `date_paiement`, `somme`, `receveur`, `recu`) VALUES
        ($code_inscription,'$prefixe','','',4,'$date_inscription',$price_paiement,'',$recu)";
        echo $sql_insert;
        echo "<br>";
        // $row_insert = mysql_query($sql_insert);
      }

    }
  }
  //die();
}


?>
