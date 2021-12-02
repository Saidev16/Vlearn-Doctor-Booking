<script language="javascript1.2">

function valid_form(){
    if($F('fromH').match(/^[-]?\d*\.?\d*$/) == null){
    alert("Veuillez saisir un nombre");
    $('fromH').focus();
    return false;
}
if($F('fromM').match(/^[-]?\d*\.?\d*$/) == null){
    alert("Veuillez saisir un nombre");
    $('fromM').focus();
    return false;
}
if($F('toH').match(/^[-]?\d*\.?\d*$/) == null){
    alert("Veuillez saisir un nombre");
    $('toH').focus();
    return false;
}
if($F('toM').match(/^[-]?\d*\.?\d*$/) == null){
    alert("Veuillez saisir un nombre");
    $('toM').focus();
    return false;
}
else{
document.f_ajout.submit();
return true;
   }
}

</script>

	<?php
  
	if (isset($_POST['code_cours'])){
 

	$code_cours=$_POST['code_cours']; 
	$horaire=$_POST['fromH'].'H'.$_POST['fromM'].'-'.$_POST['toH'].'H'.$_POST['toM'];
	$idEmploiItem=$_POST['idEmploiItem'];
	 


	$sql="UPDATE tbl_emploi_items SET 
	`code_cours` = '$code_cours',`horaire` = '$horaire'
        WHERE idEmploiItem='$idEmploiItem' LIMIT 1 ;";
        
       @mysql_query($sql)or die ("erreur lors de la modification de l'emploi du temps");


            $sql1="select code_prof from tbl_seance where code_cours='$code_cours' limit 1";
			
            $req=@mysql_query($sql1) or ('erreur lors de la selection du code du professeur');
			
            $row=mysql_fetch_assoc($req);
			
            if(mysql_num_rows($req)){
			
                $code_prof=$row['code_prof'];
				
                $sql2="update tbl_emploi_items set code_prof='$code_prof' where idEmploiItem = '$idEmploiItem' limit 1 ";
				
               @mysql_query($sql2) or die ('erreur lors de la mise à jour du professeur');
            }
            else{
                $sql2="update tbl_emploi_items set code_prof=0 where idEmploiItem = '$idEmploiItem' limit 1 ";
				
                @mysql_query($sql2) or die ('erreur lors de la mise à jour du professeur');; 
            }

             
	 ?>

			<script type="text/javascript" language="JavaScript1.2">

			<!--	

		     window.location.replace('gestion_emploi.php?idCleEmploi=<?=(isset($_SESSION['idCleEmploi'])) ? $_SESSION['idCleEmploi'] : ''?>');

			//-->

			</script>

              <?php

			  }

			  else{
			  $idEmploiItem=(int)$_GET['modifier'];

			  $sql1="SELECT e.code_cours, e.salle, e.horaire, e.jour, e.code_prof, e.idCleEmploi, e.idEmploiItem, p.nom_prenom
                                FROM tbl_emploi_items AS e, $tbl_professeur AS p
                                WHERE e.idEmploiItem = '$idEmploiItem'
                                AND p.code_prof = e.code_prof limit 1";
                                
			   

			  $req=@mysql_query($sql1) or die ("erreur lors de la s&eacute;lection");

			  $row=mysql_fetch_assoc($req);
			  
			  $thecode_cours=$row['code_cours'];
			  $nom_prenom=$row['nom_prenom'];
                          $idEmploiItem=$row['idEmploiItem'];
			  $salle=$row['salle'];
                          $horaire=$row['horaire'];
                          $fromH=substr($horaire,0,2);
                          $fromM=substr($horaire,3,2);
                          $toH=substr($horaire,6,2);
                          $toM=substr($horaire,9,2);
			 
			 
			  			  ?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td><img src="images/icone/filieres.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION D'EMPLOI DU TEMPS 
	<span class="task">[modifier]</span></td>

	<td width="22%">

	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >

	    <tr>

		  <td valign="top" align="center">

		   <a href="#" onclick="javascript:valid_form();"> <div class="save"></div>Valider</a>

		   </td>

		  <td valign="top" align="center">

		   <a href="gestion_emploi.php?idCleEmploi=<?=(isset($_SESSION['idCleEmploi'])) ? $_SESSION['idCleEmploi'] : ''?>"><div class="cancel"></div>Annuler</a>

		  		  </td>

		</tr>

	  </table>	</td> 

  </tr>

</table>

 <form method="post" action="gestion_emploi.php?modifier=oui" name="f_ajout">

 <input type="hidden" name="idEmploiItem" value="<?=$idEmploiItem?>" />

	 <table border="0" cellpadding="0" cellspacing="2" width="100%" style="margin-left:10px" class="cellule_table">
          
		  <tr><td colspan="4" height="3px"></td>
		  </tr>
		     <tr>
		  <td width="25%" class="gras">Titre:</td>
		  <td colspan="3"> <?=(isset($_SESSION['titreCleEmploi'])) ? $_SESSION['$titreCleEmploi'] : ''?></td>
		   
	   </tr>
	   <tr>
		  <td width="25%" class="gras">Intitul&eacute; du cours : </td>
		  <td colspan="2">
                  <select name="code_cours" id="code_cours" style="width:500px" class="input">
 		   <?php
 		  $sql2="select code_cours, titre_eng from $tbl_cours where archive=0";
 		  $req=mysql_query($sql2);
 		  while ($row=mysql_fetch_assoc($req)){
 		  ?>
		  <option value="<?=$row['code_cours']?>" <?=($thecode_cours==$row['code_cours']) ? $selected : ''?>><?=htmlentities($row['titre_eng'])?></option>

		 <?php } ?>

		 </select></td>
 		  <td width="25%"></td>
	   </tr>
            <tr><td colspan="4" height="3px"></td>
		  </tr>
		     <tr>
		  <td width="25%" class="gras">Horaire :</td>
		  <td width="25%"> 
                    <input type="text" name="fromH" id="fromH" value="<?=$fromH?>" class="horaire" maxlength="2">
                    &nbsp;H&nbsp;<input type="text" name="fromM" id="fromM" value="<?=$fromM?>" class="horaire" maxlength="2">
                    &nbsp;-&nbsp;<input type="text" name="toH" id="toH" value="<?=$toH?>" class="horaire" maxlength="2">
                    &nbsp;H&nbsp;<input type="text" name="toM" id="toM" value="<?=$toM?>" class="horaire" maxlength="2">
                  </td>
		  <td width="25%"> </td>
		  <td width="25%"></td>
	   </tr>
		  <tr><td colspan="4" height="3px"></td>
		  </tr>
		     <tr>
		  <td width="25%" class="gras">Enseignant :</td>
		  <td width="25%"> <?=$nom_prenom?></td>
		  <td width="25%"> </td>
		  <td width="25%"></td>
	   </tr>
		  <tr><td colspan="4" height="3px"></td>
		  </tr>
		  <tr>
			<td width="25%" class="gras">Salle : </td>
		
			<td colspan="3"><?=$salle?></td> 
			
		  </tr>
 
	  </table>
</form>
<?php
}
?>