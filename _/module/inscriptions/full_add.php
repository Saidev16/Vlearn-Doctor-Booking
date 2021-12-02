<script language="javascript1.2">

function valid_form(){

if($F('code_inscription')==''){
alert('Veuillez choisir un étudiant !!!');
$('code_inscription').focus();
return false;
}

if($F('idSession')==''){
alert('Veuillez choisir une session !!!');
$('idSession').focus();
return false;
}

else{
document.f_ajout.submit();
return true;
}

}
</script>
<?php
		if (isset($_POST['code_inscription'])){
		
		$code_inscription = $_POST['code_inscription'];
		
		$semestre = $_POST['semestre'];
 		/*$transcript[0] = $_POST['code_cours1'];
		$transcript[1] = $_POST['code_cours2'];
		$transcript[2] = $_POST['code_cours3'];
		$transcript[3] = $_POST['code_cours4'];
		$transcript[4] = $_POST['code_cours5'];
		$transcript[5] = $_POST['code_cours6'];*/
  		$date = date('Y-m-d H:m:s');
		$idSession = $_POST['idSession'];
		$section = $_POST['section'];
		//$type_cours = str_replace('_', ' ', $_POST['special_price1'.$i]);
		
		$type_cours =$_POST['special_price1'];
		/*$i = 0;
		 
		 foreach ($transcript as $code_cours) :
		 $i++;*/
		 $a ="select code_cours,code_cours_testing from tbl_cours where `code_cours_testing` != ''";
			$aa = mysql_query($a)or die ('Erreur:: selectionCours');
			while ($ligne= mysql_fetch_assoc($aa))
			{
			$code_cours =$ligne['code_cours'];
			$code_cours_testing =$ligne['code_cours_testing'];
		    if ($code_cours != '' ) 
			{
		     // $type_cours = str_replace('_', ' ', $_POST['special_price'.$i]);
		      $sql = "SELECT COUNT(*) AS nbr FROM tbl_inscription_cours_burkina
		      WHERE code_inscription='$code_inscription' 
		      AND code_cours= '$code_cours' 
		      AND idSession= '$idSession'";
		
		      $req  =@mysql_query($sql) or die ('Erreur de verification inscription ');
		      $row = mysql_fetch_assoc($req);
		      $nbr = $row['nbr'];
		// select prix du cours 
			  $sql = "SELECT prix FROM tbl_type_cours WHERE id = $type_cours";
			  $res = mysql_query($sql);
			  $row = mysql_fetch_assoc($res);
			  $prix = (int)$row['prix'];
			
		//selection de l'annee
			$sql= "SELECT academic_year FROM $tbl_session WHERE idSession = '$idSession' LIMIT 1";
			$req = @mysql_query($sql);
			$row = mysql_fetch_assoc($req);
			$annee = $row['academic_year'];
			
		if ($nbr==0){
		 $sql = "SELECT id FROM tbl_finance WHERE code_inscription = '$code_inscription' AND annee = '$annee' LIMIT 1";
			$req = @mysql_query($sql) or die ('Erreur vérification de finance');
			if (mysql_num_rows($req)){
				//mise à jour du reste et de la somme payée
				$row = mysql_fetch_assoc($req);
				$id = $row['id'];
				//$sql = "UPDATE tbl_finance SET `frais_etude` = frais_etude + $prix WHERE id = $id LIMIT 1";
				//@mysql_query($sql) or die ('Erreur du mise à jour du paiement ');
				//$sql = "UPDATE tbl_finance_bak SET `frais_etude` = frais_etude + $prix WHERE id = $id LIMIT 1";
				//@mysql_query($sql) or die ('Erreur du mise à jour du paiement ');
								 }
			else{
				//creation de la fiche de paiement de cette année
				$sql = "INSERT INTO tbl_finance (`code_inscription`, `annee`) 
				VALUES ('$code_inscription',  '$annee')";
				@mysql_query($sql);
				$sql = "INSERT INTO tbl_finance_bak (`code_inscription`, `annee`) 
				VALUES ('$code_inscription', '$annee')";
				@mysql_query($sql);
				}
		
			 
			// enregistrer inscription
			$sql = "INSERT INTO tbl_inscription_cours_burkina (`code_cours`,code_cours_testing, `code_inscription`, `date_inscription`, `idSession`
					, `type_cours_id`, `section`)
			VALUES ('$code_cours','$code_cours_testing', '$code_inscription', '$date', '$idSession', '$type_cours', '$section' );";
        	
 	         @mysql_query($sql)or die ('Erreur :: inscription ');
			 
			
			
				
				// creation de la fiche de notes
				$sql = "insert into tbl_note_burkina(code_inscription, code_cours,code_cours_testing, idSession, archive, section,letter_grade) 
				value('$code_inscription', '$code_cours','$code_cours_testing', '$idSession', 0, '$section','X')"; 
				@mysql_query($sql) or die ('erreur lors de creation de la fiche  de notes');
				 // creation de la fiche de paiement
				
				 //		
				  // creation de la fiche de paiement
			/*	$sql = "insert into $tbl_paiement_data(code_inscription,code_cours,annee) 
				value('$code_inscription','$code_cours', '$annee')"; 
				@mysql_query($sql) or die ('erreur lors de creation de la fiche  de paiement');*/
				
			  
						}
		  
			  }}
			  //endforeach;
			 
			 // fin si
			 
			 //vérifiersie ça existe dans tbl_finance
		/*	$sql = "SELECT id FROM tbl_finance WHERE code_inscription = '$code_inscription' AND annee = '$annee' LIMIT 1";
			$req = @mysql_query($sql) or die ('Erreur vérification de finance');
			if (mysql_num_rows($req)){
				//mise à jour du reste et de la somme payée
				$row = mysql_fetch_assoc($req);
				$id = $row['id'];
				$sql = "UPDATE tbl_finance SET `frais_etude` = frais_etude + $prix WHERE id = $id LIMIT 1";
				@mysql_query($sql) or die ('Erreur du mise à jour du paiement ');
									 }
			else{
				//creation de la fiche de paiement de cette année
				$sql = "INSERT INTO tbl_finance (code_inscription, frais_etude, annee) 
				VALUES ('$code_inscription', (int)$prix+3000, '$annee')";
				@mysql_query($sql);
				}*/
 				 // creation de la fiche de paiement
				/*$sql = "insert into $tbl_paiement(code_inscription,annee) 
				value('$code_inscription','$annee')"; 
				@mysql_query($sql) or die ('erreur lors de creation de la fiche  de paiement');*/
				 //				
	/*$sql = "insert into $tbl_paiement(code_inscription,annee) 
				value('$code_inscription','$annee')"; */
				//@mysql_query($sql) or die ('erreur lors de creation de la fiche  de paiement');
 			  ?>
			  <script type="text/javascript" language="JavaScript1.2">
			<!--	
 			window.location.replace('gestion_inscription_burkina.php?code_inscription=<?=$code_inscription?>&idSession=<?=$idSession?>');
			//-->
			</script>
			  <?php
 			  }
 			  else{
 			  ?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/classes.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES INSCRIPTIONS <span class="task">[ajouter]</span> </td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="javascript:return valid_form();"> <div class="save"></div>Ajouter</a> 
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_inscription_burkina.php" ><div class="cancel"></div>Annuler</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>

 </table>

 <form method="post" action="gestion_inscription_burkina.php?full_add=oui" name="f_ajout">

	  	       <table border="0" cellpadding="0" cellspacing="2" width="100%" 
			   style="margin-left:10px" class="cellule_table">
 			 
			 <tr><td colspan="4" height="3px"></td></tr>
          <tr>
   
     
 		 </tr>
 		  <tr><td colspan="4" height="3px"></td></tr>
          <tr>

		  <td width="25%"><label for="code_inscription">Etudiant :</label> </td>

		  <td width="25%">
		  <select name="code_inscription" id="code_inscription" class="input">
				<option value="">Sélectionner</option>
		  <?php 
		   $sql6="select code_inscription, nom, prenom from tbl_etudiant_burkina where archive = 0 AND groupe not in (5,7) order by prenom, nom";
		  $req=@mysql_query($sql6);
		  while($row=mysql_fetch_assoc($req)){
		  $name=htmlentities($row['name']);
		  $code_inscription=$row['code_inscription'];

		  ?>
		  <option value="<?=$code_inscription?>"><?=ucfirst($row['prenom']).' '.ucfirst($row['nom'])?></option>
		  <?php
		  }
		  ?>
		  </select>
          
		  </td>
		  <td width="25%"> </td>
		  <td width="25%"></td>
		  </tr>
		  <tr><td colspan="4" height="3px"></td></tr>
		  <tr>
		   <td><label for="idSession">Session :</label> </td>

		   <td>
		<select name="idSession" id="idSession" class="input">
 		  <?php 
		  $sql7="select idSession, session, annee_academique from $tbl_session  ";
		  $req=@mysql_query($sql7);
		  while($row=mysql_fetch_assoc($req)){
		  $ns=ucfirst($row['session']).' '.$row['annee_academique'];
		  $cs=$row['idSession'];
		  ?>
		  <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
		  <?php
		  }
		  ?>
		  </select>
		  </td>
		   <td>&nbsp;</td>
		   <td>&nbsp;</td>
		   </tr>
            <tr><td colspan="4" height="3px"></td></tr>
		 
	  </table>
     </form>
<?php
}
?>