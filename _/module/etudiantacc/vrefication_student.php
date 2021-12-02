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

// $pr = "BF";
// $codes = "336";

$sql_student = "SELECT * FROM `tbl_etudiant_all` WHERE `new_transcript` != 1 and `new_transcript` != 0 ";
var_dump($sql_student);
$req_student = mysql_query($sql_student);

while ($row_student = mysql_fetch_assoc($req_student)){

  $prefixe = $row_student['prefixe'];
  $code_inscription = $row_student['code_inscription'];
  //var_dump($code_inscription);
  $table_note = array(
    'CAM' => 'tbl_note_cameroun',
    'ORL' => 'tbl_note_usa',
    'BN' => 'tbl_note_benin',
    'GS' => 'tbl_note_GUES',
    'MOR' => 'tbl_note_morocco',
    'AG' => 'tbl_note_algeria',
    'BF' => 'tbl_note_burkina',
    'IC' => 'tbl_note_ivory'
  );

  $table_note_sql = $table_note["$prefixe"];
  $table_inscription_sql = $table_inscription["$prefixe"];

  $transcript = $row_student['new_transcript'];
  $conditions_gen = "";
  if ($transcript == 1) {
    $conditions_gen = "AND n.prefixe = '$prefixe'";
    $table_note_sql = "tbl_note_acc";
    $table_inscription_sql = "tbl_inscription_cours_acc";
  }
  // $sql = "SELECT n.prefixe,n.code_inscription,SUM(c.nbr_credit) as total_credits FROM tbl_note_acc as n , tbl_cours as c WHERE
  // n.code_cours = c.code_cours and n.code_inscription in (
  //   SELECT `code_inscription` FROM `tbl_etudiant_all` WHERE `new_transcript` = 2 and code_inscription in($codes)
  //   and prefixe = '$pr')  GROUP by n.code_inscription,n.prefixe HAVING total_credits < 24";
  // n.prefixe,
 $sql = "SELECT n.code_inscription,SUM(c.nbr_credit) as total_credits FROM $table_note_sql as n , tbl_cours as c WHERE
n.code_cours = c.code_cours and n.code_inscription = $code_inscription  $conditions_gen  GROUP by n.code_inscription HAVING total_credits < 24";
//var_dump($sql);


$req = mysql_query($sql);

while($row = mysql_fetch_assoc($req)){
  $code_inscription = $row['code_inscription'];
  $credits = $row['total_credits'];
  echo "<br>";
  echo "-------------";
  echo "<br>";
  echo "code_inscription : ".$code_inscription;
  echo "<br>";
  echo "Prefixe : ".$prefixe;
  echo "<br>";

  echo "credits : ".$credits;


  // die();

  }

  // die();
}



// if ($prefixe == $pr) {
//   echo "-------------";
//   echo "<br>";
//   echo "code_inscription : ".$code_inscription;
//   echo "<br>";
//   echo "Prefixe : ".$prefixe;
//   echo "<br>";
//
//   //$d_courses = array(24,18);
//   $d_courses = array(18);
//   $code_cours_i = array_rand($d_courses);
//   $code_cours_d = $d_courses[$code_cours_i];
//   echo $code_cours_d;
//   echo "<br>";
//   $sql_cours = "SELECT * FROM `tbl_note_acc` WHERE `code_inscription` = '$code_cours_d' and `prefixe` = 'AG'";
//
//   $req_cours = mysql_query($sql_cours);
//   $count = 0;
//   $count_need = 0;
//   while ($row_cours = mysql_fetch_assoc($req_cours)){
//
//       $code_cours = $row_cours['code_cours'];
//       $sql_cours_ver = "SELECT count(*) as nb FROM `tbl_note_acc` WHERE `code_inscription` = '$code_inscription'
//        and `prefixe` = '$prefixe' and code_cours = '$code_cours'";
//       $req_cours_ver = mysql_query($sql_cours_ver);
//       $row_cours_ver = mysql_fetch_assoc($req_cours_ver);
//       $nb_ver = $row_cours_ver['nb'];
//
//
//
//   }
//
//   echo $count." Courses";
//   echo "<br>";
//   echo $count_need." Cours needed";
//   echo "<br>";
//
// }

// if ($nb_ver == 1) {
//   $count = $count+1;
// }else{
//   $count_need = $count_need+1;
//   echo $code_cours;
//   echo "<br>";
//   $sql_insert = "INSERT INTO `tbl_note_acc` (`code_inscription`, `code_cours`, `code_cours_testing`, `mid_term`, `project`, `participation`, `final_exam`, `final_grade`, `letter_grade`, `gpa`, `code_note`, `idSession`, `archive`, `section`, `stage`, `stage1`, `stage2`, `stage3`,
//   `prefixe`) VALUES ('$code_inscription', '$code_cours', '9', NULL, NULL, NULL, NULL, NULL, 'T', NULL, NULL, '0', '0', '', NULL, NULL, NULL, NULL, '$prefixe')";
//   echo $sql_insert;
//   //mysql_query($sql_insert);
//   echo "<br>";
// }




// $student = array(
//   1 => array('AG',14,7),
//   2 => array('AG',15,7),
//   3 => array('AG',16,6),
//   4 => array('AG',17,6),
//   5 => array('AG',18,7),
//   6 => array('BF',212,6),
//   7 => array('BF',213,6),
//   8 => array('BF',214,7),
//   9 => array('BF',216,7),
//   10 => array('BF',217,6),
//   11 => array('BF',218,6),
//   12 => array('BF',219,6),
//   13 => array('BF',220,7),
//   14 => array('BF',383,8),
//   15 => array('MOR',119,10),
//   16 => array('MOR',124,7),
//   17 => array('MOR',235,7),
//   18 => array('MOR',236,6),
//   19 => array('MOR',239,6),
//   20 => array('MOR',241,6),
//   21 => array('MOR',243,12),
//   22 => array('MOR',244,11),
//   23 => array('MOR',245,10),
//   24 => array('MOR',247,14),
//   25 => array('MOR',248,13),
//   26 => array('MOR',252,10),
//   27 => array('MOR',257,11),
//   28 => array('MOR',260,13),
//   29 => array('MOR',262,10),
//   30 => array('MOR',269,6),
//   31 => array('MOR',272,11),
//   32 => array('MOR',278,12),
//   33 => array('MOR',280,11),
//   34 => array('MOR',98,12),
//   35 => array('ORL',233,11),
//   36 => array('MOR',104,14),
//   37 => array('MOR',231,10),
//   38 => array('MOR',232,12),
//   39 => array('MOR',246,14),
//   40 => array('MOR',250,11),
//   41 => array('MOR',253,11),
//   42 => array('MOR',255,14),
//   43 => array('MOR',256,10),
//   44 => array('MOR',259,12),
//   45 => array('MOR',263,14),
//   46 => array('MOR',264,11),
//   47 => array('MOR',271,11),
//   48 => array('MOR',274,6),
//   49 => array('MOR',275,6),
//   50 => array('MOR',281,10),
//   51 => array('MOR',284,10),
//   52 => array('MOR',298,12),
//   53 => array('MOR',282,7),
//   54 => array('AG',26,6),
//   55 => array('AG',27,7),
//   56 => array('AG',28,6),
//   57 => array('AG',29,6),
//   58 => array('AG',30,6),
//   59 => array('AG',24,7),
//   60 => array('MOR',261,7),
//   61 => array('MOR',279,6),
//   62 => array('AG',32,14),
//   63 => array('MOR',287,12),
//   64 => array('MOR',289,11),
//   65 => array('BF',340,14),
//   66 => array('BF',343,13),
//   67 => array('BF',346,14),
//   68 => array('BF',351,11),
//   69 => array('BF',352,10),
//   70 => array('BF',353,14),
//   71 => array('BF',354,13),
//   72 => array('BF',355,14),
//   73 => array('BF',356,12),
//   74 => array('BF',358,12),
//   75 => array('BF',359,13),
//   76 => array('BF',361,10),
//   77 => array('MOR',286,12),
//   78 => array('MOR',273,7),
//   79 => array('MOR',290,6),
//   80 => array('MOR',291,7),
//   81 => array('MOR',254,7),
//   82 => array('MOR',268,6),
//   83 => array('MOR',295,6),
//   84 => array('BF',379,6),
//   85 => array('BF',350,7),
//   86 => array('BF',341,6),
//   87 => array('AG',33,7),
//   88 => array('AG',34,7),
//   89 => array('BF',336,6),
//   90 => array('BF',337,6),
//   91 => array('BF',367,6),
//   92 => array('BF',368,6),
//   93 => array('BF',369,6),
//   94 => array('BF',371,6),
//   95 => array('BF',372,7),
//   96 => array('BF',376,7),
//   97 => array('GS',1,7),
//   98 => array('MOR',120,11),
//   99 => array('MOR',267,6),
//   100 => array('MOR',276,12),
//   101 => array('MOR',277,13),
//   102 => array('MOR',282,12),
//   103 => array('MOR',283,13),
//   104 => array('MOR',292,11),
//   105 => array('MOR',293,6),
//   106 => array('MOR',294,14),
//   107 => array('MOR',296,13),
//   108 => array('MOR',297,12),
//   109 => array('MOR',299,10),
//   110 => array('MOR',302,11),
//   111 => array('MOR',304,12),
//   112 => array('MOR',305,13),
//   113 => array('MOR',306,12),
//   114 => array('ORL',236,7),
//   115 => array('MOR',303,11),
//   116 => array('MOR',300,0)
// );
//
//
//
// $count = 0;
// foreach ($student as $v) {
//   $prefixe = $v['0'];
//   $code_inscription = $v['1'];
//   $nb_credit = $v['2'];
//
//
//   $sql = "SELECT count(*) as nb FROM `tbl_etudiant_all` WHERE `code_inscription` in ($code_inscription) and `prefixe` = '$prefixe' and new_transcript = 1";
//
//   $req = mysql_query($sql);
//   $row = mysql_fetch_assoc($req);
//
//   $nb = $row['nb'];
//
//   if ($nb == 0) {
//     echo "<br>";
//     echo "------------";
//     echo "<br>";
//     echo $code_inscription;
//     echo "<br>";
//     echo $prefixe;
//     echo "<br>";
//     echo $nb_credit;
//     echo "<br>";
//     $sql_ver = "SELECT count(*) as nb FROM `tbl_etudiant_all` WHERE `code_inscription` in ($code_inscription) and `prefixe` = '$prefixe'";
//
//     $req_ver = mysql_query($sql_ver);
//     $row_ver = mysql_fetch_assoc($req_ver);
//
//     $nb_ver = $row['nb'];
//     if ($nb_ver == 0) {
//       echo "exist";
//       echo "<br>";
//     }
//     // // update student
//     $sql_update = "UPDATE `tbl_etudiant_all` SET `new_transcript` = 1 WHERE `prefixe` = '$prefixe' and `code_inscription` = '$code_inscription'";
//     var_dump($sql_update);
//     $req_update = mysql_query($sql_update);
//     $count = $count+1;
//   }
//
//
//
//
//
// }
//
//   echo "count = ".$count;
