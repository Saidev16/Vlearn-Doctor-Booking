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



$year = 2017;
$students = array(
  1	=> array('AG',14),
2	=> array('AG',15),
3	=> array('AG',16),
4	=> array('AG',17),
5	=> array('AG',18),
6 => array('BF',212),
7 => array('BF',213),
8 => array('BF',214),
9 => array('BF',216),
10 => array('BF',217),
11 => array('BF',218),
12 => array('BF',219),
13 => array('BF',220),
14 => array('BF',383),
15 => array('MOR',119),
16 => array('MOR',124),
17 => array('MOR',235),
18 => array('MOR',236),
19 => array('MOR',239),
20 => array('MOR',241),
21 => array('MOR',243),
22 => array('MOR',244),
23 => array('MOR',245),
24 => array('MOR',247),
25 => array('MOR',248),
26 => array('MOR',252),
27 => array('MOR',257),
28 => array('MOR',260),
29 => array('MOR',262),
30 => array('MOR',269),
31 => array('MOR',272),
32 => array('MOR',278),
33 => array('MOR',280),
34 => array('MOR',98),
35 => array('ORL',233)
);


foreach ($students as $v) {
  $prefixe = $v['0'];
  $code_inscription = $v['1'];
  echo "<br>";
  echo "------------";
  echo "<br>";
  echo $code_inscription;
  echo "<br>";
  echo $prefixe;
  echo "<br>";
  $date_random = randomDate("$year-07-01","$year-09-30");
  // if ($prefixe == 'MOR' && in_array($code_inscription,array(296,267))) {
  //   $date_random = randomDate("2021-01-01","2021-01-30");
  // }
  // if ($prefixe == 'GS' && in_array($code_inscription,array(1))) {
  //   $date_random = randomDate("2021-01-01","2021-01-30");
  // }


  echo $date_random;
  echo "<br>";


	 $sql_udpate_s = "UPDATE `tbl_etudiant_all` SET date_inscription = '$date_random' WHERE  code_inscription = '$code_inscription' and prefixe = '$prefixe' and new_transcript = 1";
	 var_dump($sql_udpate_s);
   //die();
	 //mysql_query($sql_udpate_s);

}



function randomDate($sStartDate, $sEndDate, $sFormat = 'Y-m-d') {
    // Convert the supplied date to timestamp
    $fMin = strtotime($sStartDate);
    $fMax = strtotime($sEndDate);
    // Generate a random number from the start and end dates
    $fVal = mt_rand($fMin, $fMax);
    // Convert back to the specified date format
    return date($sFormat, $fVal);
}
