<?php 
if (isset($_SESSION['code_etudiant'])){
//$date=$_POST['date'].' '.date('H:m:s');
$date=$_POST['year_i'].'-'.$_POST['month_i'].'-'.$_POST['day_i'];    

$nom=$_POST['nom'];
$code_inscription=$_SESSION['code_etudiant'];
 $prefixe=$_SESSION['prefixe'];

if( (empty($_POST['objet'])) && (empty($_POST['autre'])) ){
?>
<script language="javascript1.2">
alert('veuillez sélection l\'objet de votre requette');
window.location.replace('student.php?task=demande');
</script>
<?php
}
else {
if(empty($_POST['objet'])){
$objet=addslashes($_POST['autre']);
}
else {
$objet=addslashes($_POST['objet']);
}

$explication=addslashes($_POST['explication']);

 $sql="INSERT INTO $tbl_demande ( `nom_prenom` , `date_requette` , `objet` , `explication`, `code_inscription`, `prefixe` ) 
VALUES ('$nom', '$date', '$objet', '$explication', '$code_inscription', '$prefixe');";

$req=@mysql_query($sql) or die("erreur lors de l'envoi de votre requette");


// archivage des ancien demande

$sql1='update $tbl_demande set archive=1 where code_demande > 50 ';

$req=@mysql_query($sql1);
//mail("zineb@aulm.us,ounsa@americanhigh.us", 'HIS Request:'.$nom,$objet);
?>
<script language="javascript1.2">
alert("Votre requête a été envoyé avec succes ");
window.location.replace("student.php?task=reponse");
</script>
<?php
}}
?>

