<?php

include "../functions.php";
$bd="sisaulm_aulm";



$login="sisaulm_pti1998";
//$login="root";



$mdp="ilias2010";
//$mdp="root";



$serveur='localhost';



function connecter($serveur,$login,$mdp,$bd)

{

$connect = @mysql_connect($serveur,$login,$mdp);

if ( ! $connect )

die ('Failed to connect server vnc');

@mysql_select_db($bd, $connect) or die ('Database Select Failed');

}

connecter($serveur,$login,$mdp,$bd);


$result = array();

if ($_POST['periode'] != "" && $_POST['year'] != "" && $_POST['type'] == "resultMbaBySession") {



  $periode = $_POST['periode'];
  $year = $_POST['year'];

  //Satisfaction Curriculm
  $id_question = '9,22,21,19,18,17,13';
  $porcentage1 = round(get_global_result_by_session($id_question,$periode,$year),2);
  $result["1"] = $porcentage1;
  //Faculty

  $id_question = '1,2,3,4,5,6,7,8,15,16,23,24,25,26,27,31';
  $porcentage2 = round(get_global_result_by_session($id_question,$periode,$year),2);
  $result["2"] = $porcentage2;
  //Administration

  $id_question = '10,29,28';
  $porcentage3 = round(get_global_result_by_session($id_question,$periode,$year),2);
  $result["3"] = $porcentage3;
  //Library

  $id_question = '12,14,10';
  $porcentage4 = round(get_global_result_by_session($id_question,$periode,$year),2);
  $result["4"] = $porcentage4;
  //Campus Tools

  $id_question = '11,32,30';
  $porcentage5 = round(get_global_result_by_session($id_question,$periode,$year),2);
  $result["5"] = $porcentage5;
  $div = 0;

  if ($porcentage1 != 0) {
    $div++;
    $nb_pr1++;
  }
  if ($porcentage2 != 0) {
    $div++;
    $nb_pr2++;
  }
  if ($porcentage3 != 0) {
    $div++;
    $nb_pr3++;
  }
  if ($porcentage4 != 0) {
    $div++;
    $nb_pr4++;
  }
  if ($porcentage5 != 0) {
    $div++;
    $nb_pr5++;
  }
  // overall
  $porcentage6 = ($porcentage1+$porcentage2+$porcentage3+$porcentage4+$porcentage5)/$div;
  $result["6"] = $porcentage6;

  if ($porcentage6 == false) {
    $result["6"] = 0;
  }


}

echo json_encode($result);













 ?>
