<?php


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
// get courses

$sql_courses = 'SELECT * FROM `tbl_cours` where ordering >= 0 and `module` != "" order by `ordering`';

$req_courses = mysql_query($sql_courses);

$courses = array();
$i = 0;
while ($row = mysql_fetch_assoc($req_courses)) {
  $courses[$i]['code_cours'] = $row['code_cours'];
  $i++;
}

//initialise table_note
$tbl_note = "tbl_note_burkina";
$tbl_inscription = "tbl_inscription_cours_burkina";
$prefixe = "BF";
die("verify all request");

$sql = "UPDATE $tbl_inscription SET `idSession`= 0";

$req = mysql_query($sql);

$sql = "UPDATE $tbl_note SET `idSession`= 0";

$req = mysql_query($sql);

// get students
$sql = "SELECT * FROM `tbl_etudiant_all` WHERE `date_inscription` >= '2016-07-01' and prefixe = '$prefixe'";
var_dump($sql);
$req = mysql_query($sql);

$s = 0;
while ($row = mysql_fetch_assoc($req)) {
    $code_inscription = $row['code_inscription'];
    $date_inscription = $row['date_inscription'];
    $tab=split('[/.-]',$date_inscription);
    $y = $tab[0];
    if ($date_inscription >= $y."-07-01" && $date_inscription <= $y."-12-30") {
      $session = "Fall";

    }
    if ($date_inscription >= $y."-01-01" && $date_inscription <= $y."-06-30") {
       $session = "Spring";
    }

    //GET SESSION
    $sql_session = "SELECT * FROM `tbl_session` WHERE `annee_academique` = '$y' and `session` = '$session'";
    //var_dump($sql_session);
    $req_session = mysql_query($sql_session);
    $row_session = mysql_fetch_assoc($req_session);
    $first_session_id = $row_session['idSession'];
    // var_dump($first_session_id);
    // die();
    $ordering = $row_session['ordering'];

    //UPDATE COURSES
    $count = 1;
    $prenom = $row['prenom'];
    $nom = $row['nom'];
    $prefixe = $row['prefixe'];
    echo "Student : ".$prenom." ".$nom."</br>";
    echo "Session : ".$session." ".$y."</br>";

    foreach ($courses as $k => $v) {


      $cours = $v['code_cours'];
      if ($count <= 6) {
        // verify if a transfer course or not
        $sql_v = "SELECT * FROM $tbl_note WHERE `code_inscription` = '$code_inscription' and `code_cours` ='$cours' and archive = 0";
        //echo "$sql_v";
        //echo "</br>";
        $req_v = mysql_query($sql_v);
        $row_v = mysql_fetch_assoc($req_v);
        $letter_grade = $row_v['letter_grade'];
        //echo $letter_grade;
        //echo "</br>";
      /*  if ($letter_grade != "T" and $letter_grade != "") {*/
          echo $count."</br>";
          //update tbl Note
         $sql_update = "UPDATE $tbl_note SET `idSession`= $first_session_id WHERE
          `code_inscription` = '$code_inscription' and `code_cours` ='$cours' and letter_grade != 'T'  and archive = 0";
           /* $sql_update = "UPDATE $tbl_note SET `idSession`= $first_session_id WHERE
          `code_inscription` = '$code_inscription' and `code_cours` ='$cours'   and archive = 0";*/
          var_dump($sql_update);
          echo "<br>";
          mysql_query($sql_update);

          //update tbl inscription
          $sql_update = "UPDATE $tbl_inscription SET `idSession`= $first_session_id WHERE
          `code_inscription` = '$code_inscription' and `code_cours` ='$cours'  and archive = 0";
          mysql_query($sql_update);
          var_dump($sql_update);
          echo "<br>";
          $count++;
        //}

      }



      // init count and session
      if ($count > 6) {

        $count = 1;
        //GET SESSION
        $ordering++;
        $sql_session = "SELECT * FROM `tbl_session` WHERE ordering = $ordering";
        $req_session = mysql_query($sql_session);
        $row_session = mysql_fetch_assoc($req_session);
        $first_session_id = $row_session['idSession'];
        $ordering = $row_session['ordering'];
        $session = $row_session['session'];
        $y = $row_session['annee_academique'];
        echo "Session : ".$session." ".$y."</br>";
      }
    }



    //die();




}



















 ?>
