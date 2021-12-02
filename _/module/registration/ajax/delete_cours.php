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
  'IC' => 'tbl_inscription_cours_ivory'
);





/// file excution

$data_list = array();

if ($_POST != array()) {
  $code_note = $_POST['id'];
  $prefixe = $_POST['prefixe'];

  $table_note_sql = $table_note["$prefixe"];
  $table_inscription_sql = $table_inscription["$prefixe"];

  // verification
  $sql = "SELECT * FROM $table_note_sql
  WHERE code_note = $code_note";
  //var_dump($sql);
  $req  =@mysql_query($sql) or die ('Erreur de verification inscription ');
  $row = mysql_fetch_assoc($req);
  $code_inscription = $row['code_inscription'];
  $idSession = $row['idSession'];
  $code_cours = $row['code_cours'];
  // var_dump($code_inscription);
  // var_dump($idSession);
  // var_dump($code_cours);

  if ($code_inscription != null) {
    // delete from note
    $sql = "DELETE FROM $table_note_sql WHERE code_note = $code_note";
    //var_dump($sql);
    $req  =@mysql_query($sql) or die ('Erreur de verification inscription');
    // delete from inscription
    $sql = "DELETE FROM $table_inscription_sql WHERE code_inscription = '$code_inscription' and code_cours = '$code_cours'
    and idSession = $idSession";
    //var_dump($sql);
    $req  =@mysql_query($sql) or die ('Erreur de verification inscription');
    $data_list['status'] = 1;
  }else{
    $data_list['status'] = 0;
  }

  echo json_encode($data_list);

}else{
  $data_list['status'] = 0;
  echo json_encode($data_list);
}









?>
