<?php
if(isset($_GET['cin'])){
$cin=$_GET['cin'];
include '../../config/config.php';
$sql="select count(*) as nombre from $tbl_etudiant where cin='$cin'";
$req=mysql_query($sql) or die ('erreur lors de la selection des CIN');
while ($row=mysql_fetch_assoc($req)){
echo $row['nombre'];
}
}
?>
