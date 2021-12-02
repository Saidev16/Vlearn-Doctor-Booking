<span id="titre_page">Ajouter un document</span>
<?php echo isset($msg) && $msg != '' ? $msg : '' ?>
<fieldset>
	<legend>Ajouter un document</legend>
<form name="demande" action="" method="post" enctype="multipart/form-data">
<table width="100%" style="padding-right:15px">
	<tr>
		<td><label for="titre">Titre: </label></td>
		<td><input type="text" name="titre" id="titre" class="input" size="60"></td>
    </tr>
	<tr>
		<td><label for="fichier">Document: </label></td>
		<td> <input type="file" name="fichier" id="fichier" /></td>
    </tr>
	<tr>
		<td><label for="fichier">Session: </label></td>
		<td><select name="idSession" class="select">
	<option value="">Sélectionner une session</option>
	<?php 
	$session = $titre = '';
	$sql = "select * from $tbl_session";
	$req = @mysql_query($sql);
	while($row = mysql_fetch_assoc($req)){
	?>
	<option value="<?=$row['idSession']?>" <?=$row['idSession']==$session ? $selected : '' ?>><?=$row['session']?>&nbsp;<?=$row['annee_academique']?></option>
	<?php
	}
	?>
</select></td>
    </tr>
	<tr>
		<td colspan="2" align="right"><input type="submit" name="envoyer" value="Envoyer" class="bouton">
		&nbsp;<input type="reset" name="annuler" value="Annuler" class="bouton"></td>
    </tr>
</table>
 <br />

</form>
</fieldset>
<?php

       //     begin upload
	  if(isset($_FILES['fichier']) && ($_FILES['fichier']['size']!=0) ){ 
	  	//print_r($_FILES['fichier']);die();
 
      //$MAX_FILE_SIZE = 500000;
	  $MAX_FILE_SIZE = 1000000;
      $msg='';
	  $folder='module/demande/fichier/'; 
	  
       // Dossier de destination du fichier

      // Tableau array des différents types
	  
      $allowed_types = array("application/vnd.ms-excel", "application/msword", "application/pdf", "application/ptt");

      // Variables récupérée par methode POST du formulaires

      $ftype = $_FILES['fichier']['type'];
      $fsize = $_FILES['fichier']['size'];
      $ftmp =  $_FILES['fichier']['tmp_name'];
	  
       // Recuperation de l'extension du fichier
	   
      $extension = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);
      $max="SELECT MAX( id ) as idmax  from tbl_docman ";
		                                 $req=@mysql_query($max);
		                                 $ligne=@mysql_fetch_array($req);
		                                 $idmax=$ligne["idmax"];
										 $idmax=$idmax+1;
		                                 $fname='attachement_'.$idmax.'.'.$extension;
 
      // Diverses test afin de savoir si :
	  
      // Le format de fichier correspond à notre tableau array
      if(!in_array($ftype, $allowed_types)){$error = 1;}

      // La taille du fichier n'est pas dépassée
      if($fsize > $MAX_FILE_SIZE){$error = 2;}



      // Si tout va bien, c'est bien déroulé
      if(copy($ftmp,''.$folder.''.$fname)) {$error = 0;}

      // Switch servant simplement à la gestion des erreures
     switch($error){
      case'0':
      $msg="Fichier correctement envoyé.";
      break;
      case'1':
      $msg= "Format de fichier incorrecte.";
      break;
      case'2':
      $msg = "Fichier trop volumineux.";
      break;
      case'3':
      $msg = "Fichier déjà existant.";
      break;
            }
             
//     end upload
$date = date('Y-m-d');
$titre = addslashes($_POST['titre']);
$code_prof=$_SESSION['code_prof'];
$idSession=$_POST['idSession'];

$sql="INSERT INTO tbl_docman (`code_prof` , `date` , `nom` , `titre`, idSession) 
VALUES ('$code_prof', '$date', '$fname', '$titre', '$idSession' );";  
 
@mysql_query($sql) or die("ERROR :: SAVE DOCUMENT");

$sql="select nom_prenom from tbl_professeur where code_prof = '$code_prof'"; 
 
 $req=@mysql_query($sql) or die("erreur dans la s&eacute;lection de la fiche");
				  $row=mysql_fetch_assoc($req);
				  $n = $row['nom_prenom'];


// end upload

// To
$to = 'ounsa@aulm.us,zineb.zagdouni@piimt.us';

// Subject
$subject = 'Ajout Document PSI';

// Message
$msg = 'Le document'.' '.$titre.' '.'est ajouté par le professeur'.' '.$n;

// Function mail()
mail($to, $subject, $msg);

?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('professeur.php?task=documents');
//-->
</script>
<?php
}
?>