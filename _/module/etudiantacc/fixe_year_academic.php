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

$years = array(2017,2018,2019,2020);
$student = array();
$student[0] = array(
  1 => array('AG',14,7),
  2 => array('AG',15,7),
  3 => array('AG',16,6),
  4 => array('AG',17,6),
  5 => array('AG',18,7),
  6 => array('BF',212,6),
  7 => array('BF',213,6),
  8 => array('BF',214,7),
  9 => array('BF',216,7),
  10 => array('BF',217,6),
  11 => array('BF',218,6),
  12 => array('BF',219,6),
  13 => array('BF',220,7),
  14 => array('BF',383,8),
  15 => array('MOR',119,10),
  16 => array('MOR',124,7),
  17 => array('MOR',235,7),
  18 => array('MOR',236,6),
  19 => array('MOR',239,6),
  20 => array('MOR',241,6),
  21 => array('MOR',243,12),
  22 => array('MOR',244,11),
  23 => array('MOR',245,10),
  24 => array('MOR',247,14),
  25 => array('MOR',248,13),
  26 => array('MOR',252,10),
  27 => array('MOR',257,11),
  28 => array('MOR',260,13),
  29 => array('MOR',262,10),
  30 => array('MOR',269,6),
  31 => array('MOR',272,11),
  32 => array('MOR',278,12),
  33 => array('MOR',280,11),
  34 => array('MOR',98,12),
  35 => array('ORL',233,11)
);

$student[1] = array(
  1 => array('AG',26,6),
  2 => array('AG',28,6),
  3 => array('AG',30,6),
  4 => array('MOR',279,6),
  5 => array('AG',29,6),
  6 => array('AG',24,7),
  7 => array('AG',27,7),
  8 => array('MOR',261,7),
  9 => array('MOR',282,7),
  10 => array('MOR',274,6),
  11 => array('MOR',275,6),
  12 => array('MOR',281,10),
  13 => array('MOR',284,10),
  14 => array('MOR',231,10),
  15 => array('MOR',256,10),
  16 => array('MOR',250,11),
  17 => array('MOR',264,11),
  18 => array('MOR',253,11),
  19 => array('MOR',271,11),
  20 => array('MOR',232,12),
  21 => array('MOR',259,12),
  22 => array('MOR',298,12),
  23 => array('MOR',104,14),
  24 => array('MOR',246,14),
  25 => array('MOR',255,14),
  26 => array('MOR',263,14),
  27 => array('MOR',119,10),
  28 => array('MOR',252,10),
  29 => array('MOR',262,10),
  30 => array('MOR',245,10),
  31 => array('MOR',244,11),
  32 => array('MOR',272,11),
  33 => array('MOR',280,11),
  34 => array('ORL',233,11),
  35 => array('MOR',257,11),
  36 => array('MOR',243,12),
  37 => array('MOR',278,12),
  38 => array('MOR',98,12),
  39 => array('MOR',248,13),
  40 => array('MOR',260,13),
  41 => array('MOR',247,14)
);

$student[2] = array(
  1 => array('AG',32,14),
  2 => array('MOR',287,12),
  3 => array('MOR',289,11),
  4 => array('BF',340,14),
  5 => array('BF',343,13),
  6 => array('BF',346,14),
  7 => array('BF',351,11),
  8 => array('BF',352,10),
  9 => array('BF',353,14),
  10 => array('BF',354,13),
  11 => array('BF',355,14),
  12 => array('BF',356,12),
  13 => array('BF',358,12),
  14 => array('BF',359,13),
  15 => array('BF',361,10),
  16 => array('MOR',286,12),
  17 => array('MOR',104,14),
  18 => array('MOR',231,10),
  19 => array('MOR',232,12),
  20 => array('MOR',246,14),
  21 => array('MOR',250,11),
  22 => array('MOR',253,11),
  23 => array('MOR',255,14),
  24 => array('MOR',256,10),
  25 => array('MOR',259,12),
  26 => array('MOR',263,14),
  27 => array('MOR',264,11),
  28 => array('MOR',271,11),
  29 => array('MOR',274,6),
  30 => array('MOR',275,6),
  31 => array('MOR',281,10),
  32 => array('MOR',284,10),
  33 => array('MOR',273,7),
  34 => array('MOR',290,6),
  35 => array('MOR',291,7),
  36 => array('MOR',254,7),
  37 => array('MOR',268,6),
  38 => array('MOR',295,6),
  39 => array('BF',379,6)
);

$student[3] = array(
  1 => array('AG',32,14),
  2 => array('MOR',287,12),
  3 => array('MOR',289,11),
  4 => array('BF',340,14),
  5 => array('BF',343,13),
  6 => array('BF',346,14),
  7 => array('BF',351,11),
  8 => array('BF',352,10),
  9 => array('BF',353,14),
  10 => array('BF',354,13),
  11 => array('BF',355,14),
  12 => array('BF',356,12),
  13 => array('BF',358,12),
  14 => array('BF',359,13),
  15 => array('BF',361,10),
  16 => array('MOR',286,12),
  17 => array('BF',350,7),
  18 => array('BF',341,6),
  19 => array('AG',33,7),
  20 => array('AG',34,7),
  21 => array('BF',336,6),
  22 => array('BF',337,6),
  23 => array('BF',367,6),
  24 => array('BF',368,6),
  25 => array('BF',369,6),
  26 => array('BF',371,6),
  27 => array('BF',372,7),
  28 => array('BF',376,7),
  29 => array('GS',1,7),
  30 => array('MOR',120,11),
  31 => array('MOR',267,6),
  32 => array('MOR',276,12),
  33 => array('MOR',277,13),
  34 => array('MOR',283,13),
  35 => array('MOR',292,11),
  36 => array('MOR',293,6),
  37 => array('MOR',294,14),
  38 => array('MOR',296,13),
  39 => array('MOR',297,12),
  40 => array('MOR',299,10),
  41 => array('MOR',302,11),
  42 => array('MOR',304,12),
  43 => array('MOR',305,13),
  44 => array('MOR',306,12),
  45 => array('ORL',236,7),
  46 => array('MOR',303,11),
  47 => array('MOR',300,0),
  48 => array('MOR',307,0)
);

foreach ($years as $k_v => $v_y) {
  $year = $v_y;
  echo $year;
  $i = 0;
  foreach ($student[$k_v] as $v) {
    $prefixe = $v['0'];
    $code_inscription = $v['1'];
    $nb_credit = $v['2'];
    echo "<br>";
    echo "------------";
    echo "<br>";
    echo $code_inscription;
    echo "<br>";
    echo $prefixe;
    echo "<br>";
    echo $nb_credit;
    echo "<br>";

    // verfier si date de garduation est vide
    $sql = "SELECT count(*) as nb FROM `tbl_etudiant_all`
     WHERE `prefixe` = '$prefixe' and `code_inscription` = '$code_inscription'";
    $req = mysql_query($sql);
    $row = mysql_fetch_assoc($req);
    $nb = $row['nb'];
    if ($nb == 1) {
      		 $tbl_note = "tbl_note_acc";
					 $conditions_s = " and prefixe = '$prefixe' ";

           //
           $sql10="SELECT sum(nbr_credit) as total FROM $tbl_note as n, tbl_cours as c
					 where n.code_cours = c.code_cours and n.code_inscription= '$code_inscription' and n.archive = 0 and n.letter_grade not in ('X','T') $conditions_s ";
					  //var_dump($sql10);
					 $req2=@mysql_query($sql10) or die("erreur lors du chargements  des données");

					 $row=mysql_fetch_assoc($req2);

					 $total_cr_grade = $row['total'];

           // total_credit
					 $sql10="SELECT sum(nbr_credit) as total FROM $tbl_note as n, tbl_cours as c
					 where n.code_cours = c.code_cours and n.code_inscription= '$code_inscription' and n.archive = 0 and n.letter_grade != 'X' $conditions_s ";
					  //var_dump($sql10);
					 $req2=@mysql_query($sql10) or die("erreur lors du chargements  des données");

					 $row=mysql_fetch_assoc($req2);

					 $total_cr = $row['total'];

					 $status_s = "";
					 $archive = 0;
					if($total_cr < 24)
					{
						$archive = 0;
						$status_s = 'Active';
					}
					if($total_cr >= 24)
					{
						$archive = 1;
						$status_s = 'Alumni';
					}

					if ($prefixe == 'MOR' && in_array($code_inscription,array(268,298,295,300))) {
						$archive = 2;
						$status_s = "Withdrawal";
					}
					if ($prefixe == 'BF' && in_array($code_inscription,array(379,371,383))) {
						$archive = 2;
						$status_s = "Withdrawal";
					}
			   

      echo "<br>";
      echo "Total garde credits : ".$total_cr_grade;
      echo "Total credits : ".$total_cr;
      echo "<br>";
      echo $status_s;
      echo "<br>";

      $sql_insert = "INSERT INTO `registration_academic`(`code_inscription`, `prefixe`, `year`, `alumni`, `nb_credits_taked`)
      VALUES ('$code_inscription','$prefixe',$year,$status_s,$total_cr_grade)";
      echo $sql_insert;
      echo "<br>";
      //$row_insert = mysql_query($sql_insert);

      $i = $i+1;
    }
  }
  echo $i;
  echo "<br>";
}




?>
