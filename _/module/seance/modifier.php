<script language="javascript1.2">

function valid_form(){

document.f_ajout.submit();
return true;
}

</script>

	<?php
  
	if (isset($_POST['code_seance'])){
 
	$code_jours=$_POST['code_jours'];
	$groupe=$_POST['groupe'];
	$code_horaire=$_POST['code_horaire'];
	$code_salle=$_POST['code_salle'];
	$code_seance=(int)$_POST['code_seance'];
	$code_prof=(int)$_POST['code_prof'];
    $code_cours=$_POST['code_cours'];
	
	//vérification
	
	$verif="select count(*) as nbr from $tbl_seance 
	where code_jours='$code_jours'
	and code_jours!=9
	and code_salle='$code_salle'
	and code_salle!=9
	and code_horaire='$code_horaire'
	and code_horaire!=76
	and idSession='$idSession'
	and code_seance!='$code_seance'"; 
	
	
	$req=@mysql_query($verif) or die ('erreur de vérification de la disponibilité de la salle');
	$row=mysql_fetch_assoc($req);
	
	if($row['nbr']){
	?>
	<script language="javascript1.2">
	alert('cette salle n\'est pas disponible');
	window.location.replace('gestion_seance.php?modifier=<?=$code_seance?>');
	</script>
	<?php
	}
	else{

	$sql="UPDATE $tbl_seance SET 
	`code_jours` = '$code_jours',
    `code_horaire` = '$code_horaire',
    `code_salle` = '$code_salle',
	`groupe` = '$groupe',
	`code_prof` = '$code_prof'
     WHERE code_seance=$code_seance LIMIT 1 ;";
	
    @mysql_query($sql)or die ("erreur lors de la modification du s&eacute;ance du cours ");
 
 	 ?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('gestion_seance.php');
			//-->
			</script>
              <?php

			  }}

			  else{
			  
			  $code_seance=(int)$_GET['modifier'];
			  $sql4="select s.*, c.titre  from tbl_seance as s, $tbl_cours as c
			   where s.code_cours=c.code_cours and code_seance= $code_seance limit 1";
		      $req=@mysql_query($sql4) or die ("erreur de s&eacute;lection du s&eacute;ance");

			  $row=mysql_fetch_assoc($req);
			  
			 $code_cours=$row['code_cours'];
			 $code_jours=$row['code_jours'];
			 $code_horaire=$row['code_horaire'];
			 $code_salle=$row['code_salle'];
			 $code_prof=$row['code_prof'];
			 $idSession=$row['idSession'];
			 $nbr_inscrit=$row['nbr_inscrit'];
			 $titre=$row['titre'];
			  			  ?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td><img src="images/icone/filieres.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES SEANCES DES COURS 
	<span class="task">[modifier]</span></td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="javascript:valid_form();"> <div class="save"></div>Valider</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_seance.php"><div class="cancel"></div>Annuler</a>
		  </td>
		</tr>
	  </table>	
	  </td> 
  </tr>
</table>
 <form method="post" action="gestion_seance.php?modifier=oui" name="f_ajout">
 <input type="hidden" name="code_seance" value="<?=$code_seance?>" />
  <input type="hidden" name="code_cours" value="<?=$code_cours?>" />
	 <table border="0" cellpadding="0" cellspacing="2" width="100%" style="padding-left:10px" class="cellule_table">
	   <tr>
		  <td width="25%" class="gras">Nombre d'inscrits : </td>
		  <td width="25%"> <?=$nbr_inscrit?></td>
		  <td width="25%"></td>
		  <td width="25%"></td>
	   </tr>
		  <tr><td colspan="4" height="3px"></td>
		  </tr>
		  <tr>
			<td width="25%" class="gras">Titre du cours : </td>
			<td colspan="3"><?=$titre?></td> 
		  </tr>
		  <tr>
		      <td colspan="4" height="3px"></td>
		  </tr>
          <tr>
 		   <td width="25%" class="gras">Enseignant du cours : </td>
 		  <td width="25%">
 		  <select name="code_prof" id="code_prof" style="width:250px" class="input">
		  	<option value="0">-</option>
 		   		  <?php
 		  $sql2="select code_prof, nom_prenom from $tbl_professeur where archive=0";
 		  $req=mysql_query($sql2);
 		  while ($row=mysql_fetch_assoc($req)){
		  $cp=$row['code_prof'];
		  $np=htmlentities($row['nom_prenom']);
 		  ?>
		  <option value="<?=$cp?>" <?=($code_prof==$cp) ? $selected : ''?>><?=$np?></option>
		 <?php
		  } 
		  ?>
		 </select>

		 </td>

		   <td></td>

		   <td>

			 </td>

		  </tr>

	<tr><td colspan="4" height="3px"></td></tr>

		   <tr>

		  <td class="gras">Jours : </td>
		  <td colspan="3" align="left">
		  <select name="code_jours" id="code_jours" class="input" style="width:250px">
        		<option value="" >S&eacute;lectionner</option>
		  <?php 
		  $sql3="select code_jours, nom_jours from $tbl_jours order by nom_jours";
		  $req=@mysql_query($sql3);
		  while($row=mysql_fetch_assoc($req)){
		  $cj=$row['code_jours'];
		  $nj=$row['nom_jours'];
		  ?>
		<option value="<?=$cj?>" <?=($code_jours==$cj) ? $selected : ''?>><?=$nj?></option>
		  <?php

		  }

		  ?>

		  </select>&nbsp;&nbsp;<a href="gestion_jours.php" class="lien_msj">[ajouter un jour]</a>
		  </td></tr>
		  <tr><td colspan="4" height="3px"></td></tr>
		  <tr>
		   <td class="gras">Horaire : </td>
		   
		  <td colspan="3" align="left">
		 
		        <select name="code_horaire" id="code_horaire" class="input" style="width:250px">
        		<option value="" >S&eacute;lectionner</option>
		  <?php 
		  $sql3="select code_horaire, nom_horaire from $tbl_horaire order by nom_horaire";
		  $req=@mysql_query($sql3);
		  while($row=mysql_fetch_assoc($req)){
		  $ch=$row['code_horaire'];
		  $nh=$row['nom_horaire'];
		  ?>
		<option value="<?=$ch?>" <?=($code_horaire==$ch) ? $selected : ''?>><?=$nh?></option>
		  <?php

		  }

		  ?>

		  </select>&nbsp;&nbsp;<a href="gestion_horaires.php" class="lien_msj">[ajouter un horaire]</a>
		  </td>
		  </tr>
		  <tr><td colspan="4" height="3px"></td></tr>
		  <tr>
		   <td class="gras">Salle : </td>
		  <td colspan="3" align="left">
			  <select name="code_salle" id="code_salle" class="input" style="width:250px">
                    <option value="" >S&eacute;lectionner</option>
					  <?php 
					  $sql5="select code_salle, nom_salle  from tbl_salle";
					  $req=@mysql_query($sql5);
					  while($row=mysql_fetch_assoc($req)){
					  $cs=$row['code_salle'];
					  $ns=$row['nom_salle'];
					  ?>
			<option value="<?=$cs?>" <?=($code_salle==$cs) ? $selected : ''?>><?=$ns?></option>
					  <?php
					  }
					  ?>
		  </select>&nbsp;&nbsp;<a href="gestion_salles.php" class="lien_msj">[ajouter une salle]</a>
		  </td>
</tr>
		  
 <tr>
		  
		  <td class="gras">groupe : </td>
		  <td colspan="3" align="left">
		  <select name="groupe" class=" input input_size"  style="width:250px">
		  <option value="2">Français</option>
		  <option value="3">Anglais</option>
         
		  </select>
		  </td>
		  
		  </tr>
		  

	  </table>
</form>
<?php
}
?>