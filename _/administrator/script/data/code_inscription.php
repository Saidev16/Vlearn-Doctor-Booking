<?php
if(isset($_GET['code_inscription'])){
$code_inscription=$_GET['code_inscription'];
include '../../config/config.php';
$sql="select count(*) as nombre from $tbl_etudiant where code_inscription='$code_inscription'";
$req=mysql_query($sql) or die ('erreur lors de la selection des codes inscription');
$row=mysql_fetch_assoc($req);
echo $row['nombre'];
}
?>

