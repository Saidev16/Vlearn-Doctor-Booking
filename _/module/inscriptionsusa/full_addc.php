<script language="javascript1.2">

function valid_form(){

if($F('code_inscription')==''){
alert('Veuillez choisir un étudiante !!!');
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
		$j=0;
		
		$transcript[0] = $_POST['code_cours1'];
		$transcript[1] = $_POST['code_cours2'];
		$transcript[2] = $_POST['code_cours3'];
		$transcript[3] = $_POST['code_cours4'];
		$transcript[4] = $_POST['code_cours5'];
		$transcript[5] = $_POST['code_cours6'];
 		 
		//if(isset($transcript[0]))
		if($transcript[0]!="")
		$j++;
		
		if($transcript[1]!="")
		$j++;
		
		if($transcript[2]!="")
		$j++;
		
		if($transcript[3]!="")
		$j++;
		
		if($transcript[4]!="")
		$j++;
		
		if($transcript[5]!="")
		$j++;
				
  		$date = date('Y-m-d H:m:s');
		$idSession = $_POST['idSession'];
		//$section = $_POST['section'];

		$i = 0;
		 
		 foreach ($transcript as $code_cours) :
		 $i++;
		if ($code_cours != '' ) {
		$type_cours = str_replace('_', ' ', $_POST['special_price'.$i]);
		$sql = "SELECT COUNT(*) AS nbr FROM tbl_inscription_cours_usa WHERE code_inscription='$code_inscription' 
		AND code_cours= '$code_cours' 
		AND idSession= '$idSession'";
		
		$req  =@mysql_query($sql) or die ('Erreur de verification inscription ');
		$row = mysql_fetch_assoc($req);
		$nbr = $row['nbr'];
		
		// select prix du cours 
		/*
			$sql = "SELECT prix FROM tbl_type_cours WHERE id = $type_cours";
			$res = mysql_query($sql);
			$row = mysql_fetch_assoc($res);
			$prix = (int)$row['prix']; */
			
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
				/*$sql = "UPDATE tbl_finance SET `frais_etude` = frais_etude + $prix WHERE id = $id LIMIT 1";
				@mysql_query($sql) or die ('Erreur du mise à jour du paiement ');
				$sql = "UPDATE tbl_finance_bak SET `frais_etude` = frais_etude + $prix WHERE id = $id LIMIT 1";
				@mysql_query($sql) or die ('Erreur du mise à jour du paiement ');*/
									 }
			else{
				//creation de la fiche de paiement de cette année
				$sql = "INSERT INTO tbl_finance (`code_inscription`,  `annee`) 
				VALUES ('$code_inscription', '$annee')";
				@mysql_query($sql);
				
				/*
				$sql = "INSERT INTO tbl_finance_bak (`code_inscription`,  `annee`) 
				VALUES ('$code_inscription',  '$annee')";
				@mysql_query($sql); */
				
				}
		
			// enregistrer inscription
			$sql2014 = "SELECT code_cours_testing FROM tbl_cours WHERE code_cours = $code_cours";
			$res2014 = mysql_query($sql2014);
			$row = mysql_fetch_assoc($res2014);
			$code_cours_testing = $row['code_cours_testing'];
			$sql = "INSERT INTO tbl_inscription_cours_usa (`code_cours`, `code_inscription`, `code_cours_testing`, `date_inscription`, `idSession`)
			VALUES ('$code_cours', '$code_inscription','$code_cours_testing', '$date', '$idSession');";
        	
 	         @mysql_query($sql)or die ('Erreur insert inscr');
			
			
				
				// creation de la fiche de notes
				$sql = "insert into tbl_note_usa(code_inscription, `code_cours`, `code_cours_testing`, `idSession`, `archive`, `section`, `letter_grade`) 
				value('$code_inscription', '$code_cours','$code_cours_testing', '$idSession', 0, '$section','T')"; 
				@mysql_query($sql) or die ('erreur lors de creation de la fiche  de notes');
				
				
			
				 //		
				  // creation de la fiche de paiement
				/*$sql = "insert into $tbl_paiement_data(code_inscription, code_cours,annee) 
				value('$code_inscription', '$code_cours', '$annee')"; 
				@mysql_query($sql) or die ('erreur lors de creation de la fiche  de paiement_data');*/
				 //				
				 	
				
			  
						}
						
			 }
			 
			  if($i==$j){
			  $sql11= "SELECT aul FROM tbl_etudiant_usa WHERE code_inscription= '$code_inscription' ";
		$req11  =@mysql_query($sql11) or die ('Erreur de verification inscription ');
		$row = mysql_fetch_assoc($req11);
		$aul = $row['aul'];
			  
			 if($aul==1)
			  {
			  ?>
						 <script type="text/javascript" language="JavaScript">
			           
						window.open('http://sis.aulm.us/administrator/ajouCours.php?aul=<?$aul?>&code_inscription=<?=$code_inscription?>&transcript0=<?= $transcript[0]?>&transcript1=<?= $transcript[1]?>&transcript2=<?= $transcript[2]?>&transcript3=<?= $transcript[3]?>&transcript4=<?= $transcript[4]?>&transcript5=<?=$transcript[5]?>&date=<?= $date?>&idSession=<?= $idSession?>&section=<?= $section?>','_blank','toolbar=0,menubar=0,location=0,scrollbars=0,width=720,height=720'); 
		                  </script>
			 <?php 
			 }}
			 			  endforeach;
						  	
			
			 //vérifiersie ça existe dans tbl_finance
		
				
				
				/*$sql = "SELECT code_inscription FROM tbl_paiement WHERE code_inscription = '$code_inscription' LIMIT 1";
			$req = @mysql_query($sql) or die ('Erreur vérification de finance');
			if (mysql_num_rows($req)){
				//mise à jour du reste et de la somme payée
				/*$row = mysql_fetch_assoc($req);
				$id = $row['id'];
				$sql = "UPDATE tbl_finance SET `frais_etude` = frais_etude + $prix WHERE id = $id LIMIT 1";
				@mysql_query($sql) or die ('Erreur du mise à jour du paiement ');*/
				/*return 1;
									 }
			else
				{
 				$sql = "insert into $tbl_paiement(code_inscription,annee) 
				value('$code_inscription','$annee')"; 
				@mysql_query($sql) or die ('erreur lors de creation de la fiche  de paiement');}*/
 			
	
 			  ?>
			  <script type="text/javascript" language="JavaScript1.2">
			<!--	
 			//window.location.replace('gestion_inscription_usa.php?code_inscription=<?=$code_inscription?>&idSession=<?=$idSession?>');
			window.location.replace('gestion_inscription_usa.php');
			//-->
			</script>
			  <?php
 			  }
 			  else{
 			  ?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/classes.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES INSCRIPTIONS <span class="task">[Add]</span> 
    </td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" onclick="javascript:return valid_form();"> <div class="save"></div>Add</a> 
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_inscription_usa.php" ><div class="cancel"></div>Cancel</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>

 </table>

 <form method="post" action="gestion_inscription_usa.php?full_addc=oui" name="f_ajout">

	  	       <table border="0" cellpadding="0" cellspacing="2" width="100%" 
			   style="margin-left:10px" class="cellule_table">
 			   
 		  <tr><td><label for="code_cours1">Titre du cours 1:</label> </td>
 		  <td colspan="3">
 		 <select name="code_cours1" id="code_cours1" class="input">
		 	<option value="">Sélectionner</option>
		  <?php 
			$sql5="SELECT  code_cours, titre FROM $tbl_cours  GROUP BY  code_cours";
			$req=@mysql_query($sql5);
			while($row=mysql_fetch_assoc($req)){
			$cc=$row['code_cours'];
			$tc=$row['titre'];
		  ?>
		  <option value="<?=$cc?>"><?=$cc?>:<?=$tc?></option>
		  <?php
		  }
		  ?>
		  </select>
      </td>
    </tr>
 		  <tr><td colspan="4" height="3px"></td></tr>
 		  
           <tr><td><label for="code_cours2">Titre du cours 2:</label> </td>
 		  <td colspan="3">
 		 <select name="code_cours2" id="code_cours2" class="input">
		 	<option value="">Sélectionner</option>
		  <?php 
			$sql5="SELECT  code_cours,  titre FROM $tbl_cours  GROUP BY  code_cours";
			$req=@mysql_query($sql5);
			while($row=mysql_fetch_assoc($req)){
			$cc=$row['code_cours'];
			$tc=$row['titre'];
		  ?>
		  <option value="<?=$cc?>"><?=$cc?>:<?=$tc?></option>
		  <?php
		  }
		  ?>
		  </select>
          
 		  </td></tr>
 		  <tr><td colspan="4" height="3px"></td></tr>
           <tr><td><label for="code_cours3">Titre du cours 3:</label> </td>
 		  <td colspan="3">
 		 <select name="code_cours3" id="code_cours3" class="input">
		 	<option value="">Sélectionner</option>
		  <?php 
			$sql5="SELECT  code_cours,  titre FROM $tbl_cours  GROUP BY  code_cours";
			$req=@mysql_query($sql5);
			while($row=mysql_fetch_assoc($req)){
			$cc=$row['code_cours'];
			$tc=$row['titre'];
		  ?>
		  <option value="<?=$cc?>"><?=$cc?>:<?=$tc?></option>
		  <?php
		  }
		  ?>
		  </select>
      </td>
    </tr>
 		  <tr><td colspan="4" height="3px"></td></tr>
           <tr><td><label for="code_cours4">Titre du cours 4:</label> </td>
 		  <td colspan="3">
 		 <select name="code_cours4" id="code_cours4" class="input">
		 	<option value="">Sélectionner</option>
		  <?php 
			$sql5="SELECT  code_cours,  titre FROM $tbl_cours  GROUP BY  code_cours";
			$req=@mysql_query($sql5);
			while($row=mysql_fetch_assoc($req)){
			$cc=$row['code_cours'];
			$tc=$row['titre'];
		  ?>
		  <option value="<?=$cc?>"><?=$cc?>:<?=$tc?></option>
		  <?php
		  }
		  ?>
		  </select>
      </td>
    </tr>
 		  <tr><td colspan="4" height="3px"></td></tr>
           <tr><td><label for="code_cours5">Titre du cours 5:</label> </td>
 		  <td colspan="3">
 		 <select name="code_cours5" id="code_cours5" class="input">
		 	<option value="">Sélectionner</option>
		  <?php 
			$sql5="SELECT  code_cours,  titre FROM $tbl_cours  GROUP BY  code_cours";
			$req=@mysql_query($sql5);
			while($row=mysql_fetch_assoc($req)){
			$cc=$row['code_cours'];
			$tc=$row['titre'];
		  ?>
		  <option value="<?=$cc?>"><?=$cc?>:<?=$tc?></option>
		  <?php
		  }
		  ?>
		  </select>
      </td>
    </tr>
 		  <tr><td colspan="4" height="3px"></td></tr>
          <tr><td><label for="code_cours6">Titre du cours 6:</label> </td>
 		  <td colspan="3">
 		 <select name="code_cours6" id="code_cours6" class="input">
		 	<option value="">Sélectionner</option>
		  <?php 
			$sql5="SELECT  code_cours,  titre FROM $tbl_cours  GROUP BY  code_cours";
			$req=@mysql_query($sql5);
			while($row=mysql_fetch_assoc($req)){
			$cc=$row['code_cours'];
			$tc=$row['titre'];
		  ?>
		  <option value="<?=$cc?>"><?=$cc?>:<?=$tc?></option>
		  <?php
		  }
		  ?>
		  </select>
      </td>
    </tr>
 		  <tr><td colspan="4" height="3px"></td></tr>
          <tr>

		  <td width="25%"><label for="code_inscription">Etudiant :</label> </td>

		  <td width="25%">
		  <select name="code_inscription" id="code_inscription" class="input">
				<option value="">Sélectionner</option>
		  <?php 
		   $sql6="select code_inscription, nom, prenom from tbl_etudiant_usa where archive = 0 AND groupe not in (5,7) order by prenom, nom";
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
		   <td><label for="idSession">Academic Year :</label> </td>

		   <td>
		<select name="idSession" id="idSession" class="input">
		<option value="">Sélectionner</option>
 		  <?php 
		  $sql7="select idSession, session, annee_academique,academic_year from $tbl_session  ";
		  $req=@mysql_query($sql7);
		  while($row=mysql_fetch_assoc($req)){
		  $ns=ucfirst($row['session']).' '.$row['annee_academique'];
		  $cs=$row['idSession'];
		  	$cc=$row['academic_year'];
		  ?>
		  <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$cc?></option>
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