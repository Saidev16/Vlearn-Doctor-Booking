<?php
// database
include("../../administrator/secure.php");


/// file excution

$data_list = array();
if ($_POST != array()) {
  $code_note = $_POST['id'];
  $table_sql = $_POST['table'];
  $val = $_POST['val'];


  $sql = "UPDATE $table_sql SET `assig8` = '$val' WHERE `code_note` = '$code_note'";
  //var_dump($sql);
  @mysql_query($sql) or die ('erreur lors de la modification de la note');


  $data_list['status'] = 1;
  echo json_encode($data_list);

}else{
  $data_list['status'] = 0;
  echo json_encode($data_list);
}









?>
