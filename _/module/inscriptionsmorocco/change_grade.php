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




/// file excution

$data_list = array();
if ($_POST != array()) {
  $code_cours = $_POST['id'];
  $code_cours = str_replace("_","/",$code_cours);
  $grade = $_POST['grade'];

  $sql = "UPDATE `tbl_cours` SET `grade`= $grade WHERE `code_cours` = '$code_cours'";
  mysql_query($sql);
  $data_list['status'] = 1;
  echo json_encode($data_list);

}else{
  $data_list['status'] = 0;
  echo json_encode($data_list);
}









?>
