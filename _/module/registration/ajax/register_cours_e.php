<?php
// database
$bd="hisadm_hisdb";
$login="hisadm_hisusr";
$mdp="hispass11";
$serveur='127.0.0.1';
function connecter($serveur,$login,$mdp,$bd){

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


$table_note = array(
  'CAM' => 'tbl_note_cameroun',
  'ORL' => 'tbl_note_usa',
  'BN' => 'tbl_note_benin',
  'GS' => 'tbl_note_GUES',
  'MOR' => 'tbl_note_morocco',
  'AG' => 'tbl_note_algeria',
  'BF' => 'tbl_note_burkina',
     'CB' => 'tbl_note_casa',
    'RB' => 'tbl_note_rabat',
  'IC' => 'tbl_note_ivory'
);

$table_inscription = array(
  'CAM' => 'tbl_inscription_cours_cameroun',
  'ORL' => 'tbl_inscription_cours_usa',
  'BN' => 'tbl_inscription_cours_benin',
  'GS' => 'tbl_inscription_cours_GUES',
  'MOR' => 'tbl_inscription_cours_morocco',
  'AG' => 'tbl_inscription_cours_algeria',
  'BF' => 'tbl_inscription_cours_burkina',
    'CB' => 'tbl_inscription_cours_casa',
    'RB' => 'tbl_inscription_cours_rabat',
  'IC' => 'tbl_inscription_cours_ivory'
);





/// file excution

$data_list = array();
if ($_POST != array()) {
  $code_cours = $_POST['id'];
  $code_cours = str_replace("_","/",$code_cours);
  $code_inscription = $_POST['code_inscription'];
  $prefixe = $_POST['prefixe'];
  $idSession = $_POST['val'];
  $table_note_sql = $table_note["$prefixe"];
  $table_inscription_sql = $table_inscription["$prefixe"];
  $method = $_POST['method'];
  $grade = $_POST['grade'];
  $date = date('Y-m-d H:m:s');
  $section = "";
  $data_list['choose_other'] = 0;

  // get course information
  $sql = "SELECT * FROM `tbl_cours` WHERE `code_cours` = '$code_cours'";
  //var_dump($sql);
  $req  =@mysql_query($sql) or die ('Erreur de verification inscription 1');
  $row = mysql_fetch_assoc($req);
  $title = $row['titre_eng'];
  $nb_credit = $row['nbr_credit'];


  // verification
  $sql = "SELECT COUNT(*) AS nbr FROM $table_note_sql
  WHERE code_inscription='$code_inscription'
  AND code_cours= '$code_cours'
  ";
  //AND idSession= '$idSession'
  //var_dump($sql);
  $req  =@mysql_query($sql) or die ('Erreur de verification inscription 2');
  $row = mysql_fetch_assoc($req);
  $nbr = $row['nbr'];




  if ($nbr == 0 or $method == "edit") {

    // session info

    $sql7="select idSession, session, annee_academique,academic_year from tbl_session where idSession = $idSession and archive=1";
    $req7=@mysql_query($sql7);
    $row7=mysql_fetch_assoc($req7);
    $ns=ucfirst($row7['session']).' '.$row7['annee_academique'];


    $sql2014 = "SELECT code_cours_testing FROM tbl_cours WHERE code_cours = '$code_cours'";
    $res2014 = mysql_query($sql2014);
    $row = mysql_fetch_assoc($res2014);
    $code_cours_testing = $row['code_cours_testing'];

    $sql = "SELECT COUNT(*) AS nbr FROM $table_inscription_sql
    WHERE code_inscription='$code_inscription'
    AND code_cours= '$code_cours'
    ";
    //AND idSession= '$idSession'
    //var_dump($sql);
    $req  =@mysql_query($sql) or die ('Erreur de verification inscription ');
    $row = mysql_fetch_assoc($req);
    $nbr = $row['nbr'];

    if($nbr == 0){
      if ($method == "add") {
        $sql = "INSERT INTO $table_inscription_sql (`code_cours`, `code_inscription`, code_cours_testing, `date_inscription`, `idSession`)
        VALUES ('$code_cours', '$code_inscription','$code_cours_testing', '$date', $idSession);";
        //var_dump($sql);
        @mysql_query($sql)or die ('Erreur :: inscription11');
      }
      if ($method == "edit") {
        $sql = "UPDATE $table_inscription_sql SET `idSession`= $idSession WHERE `code_inscription` = '$code_inscription'
        and `code_cours` = $code_cours";
        @mysql_query($sql) or die ('erreur lors de la modification de la note');
      }
    }

    if ($method == "add") {
      // creation de la fiche de notes
      $sql = "insert into $table_note_sql (code_inscription, `code_cours`, code_cours_testing, idSession, archive, section,letter_grade,stage)
      value('$code_inscription', '$code_cours','$code_cours_testing', '$idSession', 0, '$section','X',$grade)";
      //var_dump($sql);
      @mysql_query($sql) or die ('erreur lors de creation de la fiche  de notes');
    }
    if ($method == "edit") {
      $sql = "UPDATE $table_note_sql SET `idSession`= $idSession , letter_grade = 'X' WHERE `code_inscription` = '$code_inscription'
      and `code_cours` = $code_cours";
      @mysql_query($sql) or die ('erreur lors de la modification de la note');
    }

  }else{
    $data_list['choose_other'] = 1;
  }
  $data_list['title'] = $title;
  $data_list['cr'] = $nb_credit;
  $data_list['status'] = 1;
  $data_list['session'] = $ns;
  echo json_encode($data_list);

}else{
  $data_list['status'] = 0;
  echo json_encode($data_list);
}









?>
