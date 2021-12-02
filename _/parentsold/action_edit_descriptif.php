<?php 
if(isset($_POST['boxchecked'])){

//get post vars 
	
	$code_cours=$_POST['boxchecked'];
	$competence=addslashes($_POST['competence']);
	$connaissance=addslashes($_POST['connaissance']);
	$attitude=addslashes($_POST['attitude']);
	$methode=addslashes($_POST['methode']);
	$contenu=addslashes($_POST['contenu']);
	$exigence=addslashes($_POST['exigence']);
	$bibliographie=addslashes($_POST['bibliographie']);
	$pourcentage=addslashes($_POST['pourcentage']);
 	
  
 		
	//mettre à  jour la table du déscriptif
	 $sql="UPDATE $tbl_descriptif SET 
	`competence` = '$competence',
	`connaissance` = '$connaissance',
	`contenu` = '$contenu',
	`methode` = '$methode',
	`exigence` = '$exigence',
	`pourcentage` = '$pourcentage',
	`bibliographie` = '$bibliographie',
	`attitude` = '$attitude'
	 WHERE  `code_cours` ='$code_cours'
	 and idSession='$idSession' LIMIT 1 ;";  
	 
     @mysql_query($sql) or die("erreur lors de la mise à jour du déscriptif");

  ?>
 <form name="retour" method="post">
	<input type="hidden" value="descriptif" name="task" />
	<input type="hidden" name="boxchecked" value="<?=$code_cours?>" />
	<input type="hidden" name="token" value="<?=$_SESSION['token']?>" />
 </form>
<script language="javascript1.2">
document.retour.submit();
</script>
<?php
}
?>