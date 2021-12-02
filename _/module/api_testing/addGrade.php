<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");

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

$table = array(
  'CAM' => 'tbl_note_cameroun',
  'ORL' => 'tbl_note_usa',
  'BN' => 'tbl_note_benin',
  'GS' => 'tbl_note_GUES',
  'MOR' => 'tbl_note_morocco',
  'AG' => 'tbl_note_algeria',
  'BF' => 'tbl_note_burkina',
  'IC' => 'tbl_note_ivory'
);

$response = array();
$response['success'] = 0;
if ($_POST != array()) {
   $prefixe = $_POST['prefixe'];
   $code_inscription = $_POST['code_inscription'];
   $final_exam  = $_POST['grade'];
   $course = $_POST['code_cours'];
   $data = get_letter_grade($final_exam);
   //var_dump($data);
   $letter_grade = $data['letter_grade'];
   $gpa = $data['gpa'];
   $table_note = $table["$prefixe"];

   foreach ($course as $k => $v) {
     $sql1="UPDATE $table_note SET
      `final_exam` = '$final_exam',
      `final_grade` = '$final_exam',
      `letter_grade` = '$letter_grade',
      `gpa` = '$gpa'
     WHERE `code_inscription` = '$code_inscription' and `code_cours` = '$v'";
     //var_dump($sql1);
     if(mysql_query($sql1)){
       $response['success'] = 1;
     }else{
       $response['success'] = 0;
     }
   }
}


echo json_encode($response);



function get_letter_grade($final_grade){
  //var_dump($final_grade);
  $return = array();
  if (round($final_grade) <= 59 && $final_grade!=''){
    $letter_grade= 'F';
    $GPA=0;
  }
  if(isset($_POST['withdrawal']) and $_POST['withdrawal']=='withdrawal'){
    $mid_term = $project = $participation =  $final_grade = '';
    $letter_grade= 'W';
    $GPA= 0;
  }
  if ( round($final_grade) <= 63  &&  round($final_grade) >= 60  ){
    $letter_grade= 'D-';
    $GPA=0.67;
  }

  if ( round($final_grade) <= 66  &&  round($final_grade) >= 64 ){
    $letter_grade= 'D';
    $GPA=1;
  }

  if ( round($final_grade) <= 69  &&  round($final_grade) >= 67 ){
    $letter_grade= 'D+';
    $GPA=1.33;
  }

  if ( round($final_grade) <= 73  &&  round($final_grade) >= 70  ){
    $letter_grade= 'C-';
    $GPA=1.67;
  }

  if ( round($final_grade) <= 76  &&  round($final_grade) >= 74  ){
    $letter_grade= 'C';
    $GPA=2;
  }

  if ( round($final_grade) <= 79  &&  round($final_grade) >= 77  ){
    $letter_grade= 'C+';
    $GPA=2.33;
  }

  if (  round($final_grade) <= 83  &&  round($final_grade) >= 80  ){
    $letter_grade= 'B-';
    $GPA=2.67;
  }

  if (  round($final_grade) <= 86  &&  round($final_grade) >= 84  ){
    $letter_grade= 'B';
    $GPA=3;
  }

  if (  round($final_grade) <= 89  &&  round($final_grade) >= 87  ){
    $letter_grade= 'B+';
    $GPA=3.33;
  }

  if ( round($final_grade) <= 93  &&  round($final_grade) >= 90  ){
    $letter_grade= 'A-';
    $GPA=3.67;
  }

  if ( round($final_grade) <= 100  &&  round($final_grade) >= 94  ){
    $letter_grade= 'A';
    $GPA=4;
  }
  $return['letter_grade'] = $letter_grade;
  $return['gpa'] = $GPA;

  return $return;
}


?>
