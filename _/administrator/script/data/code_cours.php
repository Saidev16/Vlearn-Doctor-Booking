<?php
if(isset($_GET['code_cours'])){
$code_cours=$_GET['code_cours'];
include '../../config/config.php';
$sql="select count(*) as nombre from $tbl_cours where code_cours='$code_cours'";
$req=mysql_query($sql) or die ('erreur lors de la selection des codes cours');
$row=mysql_fetch_assoc($req);
echo $row['nombre'];
}
?>

