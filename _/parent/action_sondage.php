<?php 
if (isset($_POST['conseil'])){

$conseil=addslashes($_POST['conseil']);
$choix=addslashes($_POST['choix']);

if(!isset($_POST['objet'])){
$objet=addslashes($_POST['autre']);
}

else{
$objet=addslashes($_POST['objet']);
}

$code_etudiant=$_POST['code'];
$date=date('Y-m-d');
$sql="INSERT INTO tbl_sondage ( `id_sondage` ,`code_inscription` , `objet` , `conseil` , `choix`, `date` ) 
VALUES (NULL, '$code_etudiant', '$objet', '$conseil', '$choix', '$date');";

@mysql_query($sql) or die("erreur lors de l'insertion du vote");
?>
<script language="javascript1.2">
alert("Merci d'avoir participer dans ce sondage");
window.location.replace('student.php?task=info');
</script>
<?php
}
