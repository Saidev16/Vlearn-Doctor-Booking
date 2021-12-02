<script language="javascript1.2">

function valid_form(){
document.f_ajout.submit();
return true;
}

</script>

	<?php
  
	if (isset($_POST['cours'])){
 
	$code_jours=$_POST['code_jours'];
	$groupe=$_POST['groupe'];
	$code_horaire=$_POST['code_horaire'];
	$code_salle=$_POST['code_salle'];
	$ville=$_POST['ville'];
 	$code_prof=(int)$_POST['code_prof'];
    $code_cours=$_POST['cours'];
	$idSession=$_SESSION['idSession']=$_POST['idSession'];  
	
	//nombre d'inscrit
	
	$sql="select nbr_inscrit 
	from $tbl_seance 
	where code_cours='$code_cours'
	and idSession='$idSession' "; 
	$req=@mysql_query($sql) or die ('erreur nbr inscrit');
	while($row=mysql_fetch_assoc($req)){
	$nbr_inscrit=$row['nbr_inscrit'];
										}
	
	
	//vérification
	
	$sql1="select count(*) as nbr from $tbl_seance 
	where code_jours='$code_jours'
	and code_jours!=9
	and code_salle='$code_salle'
	and code_salle!=9
	and code_horaire='$code_horaire'
	and code_horaire!=76
	and idSession='$idSession'
	and code_seance!='$code_seance'";  
	
	$req=@mysql_query($sql1) or die ('erreur de vérification de la disponibilité de la salle');
	
	$row=mysql_fetch_assoc($req);
	
	if($row['nbr']){
	?>
	<script language="javascript1.2">
	alert('cette salle est indisponible');
	window.location.replace('gestion_seance.php?new=oui');
	</script>
	<?php
							}
	else{

	// insertion du seance
	$sql2="insert into $tbl_seance
	(code_cours,code_jours ,code_horaire ,code_salle , idSession,nbr_inscrit, code_prof,ville,groupe) 
		values('$code_cours','$code_jours','$code_horaire','$code_salle','$idSession',
	  '$nbr_inscrit','$code_prof','$ville','$groupe') ";
	    
    @mysql_query($sql2)or die ("erreur lors de l'ajout du s&eacute;ance du cours ");
     
	 //verify if the syllabus exist in the database
	 
	 $sql3="select count(*) as nbr_desc from $tbl_descriptif 
	 		where code_cours='$code_cours' 
	 		and idSession='$idSession'"; 
	 $req=@mysql_query($sql3) or die ('erreur verification du descriptif');
	 $row=mysql_fetch_assoc($req) ;
	 $nbr_desc=$row['nbr_desc'];
	
	
	 if($nbr_desc==0){
	  
	 
	//insertion du syllabys
	   
		    $sql4="insert into $tbl_syllabus (`code_cours` , `idSession` , `week`)
			VALUES ";
            for($j=1; $j<13; $j++){
			$week=$j;
	        $sql4.="('$code_cours', '$idSession', '$week' ),";
								  }
			$sql4.="('$code_cours', '$idSession', '13');"; 
			
		    @mysql_query($sql4) or die("erreur lors de la création des syllabus du cours");
 	
	  		 //insertion du descriptif
	
 	        $sql5="INSERT INTO $tbl_descriptif ( `code_cours`, `idSession` ) 
			VALUES ('$code_cours', '$idSession');"; 
			
            @mysql_query($sql5) or die("erreur lors de la création du descriptif du cours");
			
			}
	
 	 ?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('gestion_seance.php');
			//-->
			</script>
              <?php

			  }
			  
			  }

			  			  ?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td><img src="images/icone/filieres.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES SEANCES DES COURS 
	<span class="task">[ajouter]</span></td>
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
 <form method="post" action="gestion_seance.php?new=oui" name="f_ajout">
	 <table border="0" cellpadding="0" cellspacing="2" width="100%" style="padding-left:10px" class="cellule_table">
	    
		  <tr><td colspan="4" height="3px"></td></tr>
		  <tr>
			<td width="25%" class="gras">Titre du cours : </td>
			<td colspan="3">
			<select name="cours" class="input">
			<?php
			$sql3="select code_cours, titre from $tbl_cours where archive=0 order by code_cours";
			$req=@mysql_query($sql3) or die ('erreur lors de la selection des cours');
			while($row=mysql_fetch_assoc($req)){
			$cc=$row['code_cours'];
			?>
			<option value="<?=$cc?>"><?=$cc.': '.stripslashes(substr($row['titre'],0, 80))?></option>
			<?php
			}
			?>
			</select> 
			
			</td> 
			
		  </tr>
		  
		  <tr>
		  
		     
			  <td colspan="4" height="3px"></td>
		  </tr>
		  
          <tr>
		  
 		   <td width="25%" class="gras">Enseignant du cours : </td>
 		  <td width="25%">
 		  <select name="code_prof" id="code_prof" style="width:250px" class="input">
  		   		  <?php
 		  $sql4="select code_prof, nom_prenom from $tbl_professeur where archive=0 order by nom_prenom";
 		  $req=mysql_query($sql4);
 		  while ($row=mysql_fetch_assoc($req)){
		  $cp=$row['code_prof'];
		  $np=htmlentities($row['nom_prenom']);
 		  ?>
		  <option value="<?=$cp?>"><?=$np?></option>
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

		  <td class="gras">Session : </td>
		  <td colspan="3" align="left">
		  <select name="idSession" id="idSession" class="input" style="width:250px">
 		  <?php 
		  $sql8="select idSession, session, annee_academique from $tbl_session order by idSession desc";
		  $req=@mysql_query($sql8) or die('erreur de selectiob des seance');
		  while($row=mysql_fetch_assoc($req)){
		  $is=$row['idSession'];
		  $ss=$row['session'].' '.$row['annee_academique'];
		  ?>
		<option value="<?=$is?>"><?=$ss?></option>
		  <?php
 		  }
 		  ?>

		  </select> 
		  </td></tr>
		  <tr><td colspan="4" height="3px"></td></tr>
		   <tr>

		  <td class="gras">Jours : </td>
		  <td colspan="3" align="left">
		  <select name="code_jours" id="code_jours" class="input" style="width:250px">
		  <option value="9">S&eacute;lectionner</option>
 		  <?php 
		  $sql5="select code_jours, nom_jours from $tbl_jours where archive=0 order by nom_jours";
		  $req=@mysql_query($sql5);
		  while($row=mysql_fetch_assoc($req)){
		  $cj=$row['code_jours'];
		  $nj=$row['nom_jours'];
		  ?>
		<option value="<?=$cj?>"><?=$nj?></option>
		  <?php
 		  }
 		  ?>

		  </select> 
		  </td></tr>
		  <tr><td colspan="4" height="3px"></td></tr>
		  <tr>
		   <td class="gras">Horaire : </td>
		   
		  <td colspan="3" align="left">
		 
		        <select name="code_horaire" id="code_horaire" class="input" style="width:250px">
				<option value="76">S&eacute;lectionner</option>
 		  <?php 
		  $sql6="select code_horaire, nom_horaire from $tbl_horaire where archive=0 order by nom_horaire";
		  $req=@mysql_query($sql6);
		  while($row=mysql_fetch_assoc($req)){
		  $ch=$row['code_horaire'];
		  $nh=$row['nom_horaire'];
		  ?>
		<option value="<?=$ch?>"><?=$nh?></option>
		  <?php
 		  }
 		  ?>
 		  </select> 
		  </td>
		  </tr>
		  <tr><td colspan="4" height="3px"></td></tr>
		  <tr>
		   <td class="gras">Salle : </td>
		  <td colspan="3" align="left">
			  <select name="code_salle" id="code_salle" class="input" style="width:250px">
                    <option value="9" >S&eacute;lectionner</option>
					  <?php 
					  $sql7="select code_salle, nom_salle  from $tbl_salle where archive=0 order by nom_salle";
					  $req=@mysql_query($sql7);
					  while($row=mysql_fetch_assoc($req)){
					  $cs=$row['code_salle'];
					  $ns=$row['nom_salle'];
					  ?>
					<option value="<?=$cs?>"><?=$ns?></option>
					  <?php
					  }
					  ?>
		  </select> 
		  </td>
		    <tr><td colspan="4" height="3px"></td></tr>
		  <tr>
		  
		  <td class="gras">Ville : </td>
		  <td colspan="3" align="left">
		  <select name="ville" class=" input input_size"  style="width:250px">
		  <option value="rabat">Rabat</option>
		  <option value="marrakech">Marrakech</option>
          <option value="casablanca">Casa Blanca</option>
		  </select>
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
</tr>
		  

		  

	  </table>
</form>
 