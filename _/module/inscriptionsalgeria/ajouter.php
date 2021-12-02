<script language="javascript1.2">

function valid_form(){

if($F('code_inscription')==''){
alert('Veuillez choisir un étudiant que vous voulez inscrire dans ce cours');
$('code_inscription').focus();
return false;
}

else{
document.f_ajout.submit();
return true
}

}
</script>

<?php
			// var stocked in session  
	    
		 $idSession = (int)$_SESSION['NidSession'];
		 $code_cours = $_SESSION['cours'];
		 
	     $sql="SELECT idSession, session, academic_year, annee_academique FROM $tbl_session WHERE idSession = $idSession LIMIT 1";
		 $req=@mysql_query($sql) or die ('erreur de selection de la session');
		 $row=mysql_fetch_assoc($req);
		 $idSession = $row['idSession'];
		 $session = ucfirst($row['session']);
		 $academic_year = $row['academic_year'];
		 $annee = $row['annee_academique'];


 		if (isset($_POST['code_inscription'])){
		 
		 $code_inscription = trim($_POST['code_inscription']);
		 $date = date('Y-m-d H:m:s');
	     $type_cours_id = (int)$_POST['prix_cours'];
		 $section = $_POST['section'];
	    
		//insertion dans la table inscription
		$sql="INSERT INTO $tbl_inscription_cours 
	    (`code_cours`, `code_inscription`, `date_inscription`, `idSession`, `type_cours_id`, `section`)
        VALUES ('$code_cours', '$code_inscription', '$date',  $idSession , '$type_cours_id', '$section');";
	    @mysql_query($sql)or die ("Erreur lors de l'inscription ");
		
		//inscription dans la table notes
		$sql="INSERT INTO $tbl_note(`code_inscription`, `code_cours`, `idSession`, `section`) 
		VALUE('$code_inscription', '$code_cours', $idSession, '$section')";
		@mysql_query($sql) or die ('Erreur lors de creation de la fiche  de notes');
		//vérifiersie ça existe dans tbl_finance
		$sql = "SELECT id FROM tbl_finance WHERE code_inscription = '$code_inscription' AND annee = '$academic_year' LIMIT 1";
		$req = @mysql_query($sql) or die ('Erreur vérification de finance');
		// select prix du cours 
			$sql = "SELECT prix FROM tbl_type_cours WHERE id = $type_cours_id";
			$res = mysql_query($sql);
			$row = mysql_fetch_assoc($res);
			$prix = (int)$row['prix'];
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
			VALUES ('$code_inscription', $prix+3000, '$academic_year')";
			@mysql_query($sql);
		    }
			?>

			<script type="text/javascript" language="JavaScript1.2">
			<!--	
				window.location.replace('gestion_inscription.php?code_inscription=<?=$code_inscription?>&idSession=<?=$idSession?>');
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
		   <a href="#" onclick="javascript:return valid_form();"><div class="save"></div> Ajouter</a> 
		  </td>
		  <td valign="top" align="center">
		   <a href="javascript:window.history.back(-1)">
		  <div class="cancel"></div>Annuler</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
 </table>
 <form method="post" action="gestion_inscription.php?new=oui" name="f_ajout" >
	 <table border="0" cellpadding="0" cellspacing="2" width="100%" style="padding-left:10px" class="cellule_table">
		  <tr><td colspan="4" height="3px"></td>
		  </tr>
		   <tr>
		  <td class="gras">Code du cours : </td>
  		  <td colspan="3"><?=$code_cours?></td>
		   </tr>
		  <tr><td colspan="4" height="3px"></td>
		  </tr>
		  <tr>
		  <td class="gras">Titre du cours : </td>
 		  <?php 
	      $sql2="select titre from $tbl_cours where code_cours='$code_cours' limit 1";
		  $req=@mysql_query($sql2);
		  $row=mysql_fetch_assoc($req);
		  ?>
 		  <td colspan="3"><?=trim(stripslashes($row['titre']))?></td>
		   <input type="hidden" name="code_cours" value="<?=$row['code_cours']?>" />
		   </tr>
		  <tr><td colspan="4" height="3px"></td>
		  </tr>
		 <tr>
		  <td class="gras">Session : </td>
  		  <td colspan="3"><?=$session.' '.$annee?></td>
		   </tr>
		  <tr><td colspan="4" height="3px"></td></tr>
		  <tr>
          	<td class="gras">Prix du cours :</td>
            <td><select name="prix_cours" id="prix_cours" class="input">
                <?php 
	      $sql="SELECT id, titre FROM tbl_type_cours WHERE archive = 0 ";
		  $req=@mysql_query($sql);
		  while ($row=mysql_fetch_assoc($req)){
		  ?>
                <option value="<?=$row['id']?>"><?=$row['titre']?></option>
           <?php
		  }
		  ?>
          </select>
            <td></td>
            <td></td>
          </tr>
		  <tr>
		  <td width="25%" class="gras">Etudiant : </td>
		  <td width="25%"><select name="code_inscription" id="code_inscription" class="input">
		  <option value="">S&eacute;lectionner</option>
		  <?php 
		  $sql1="SELECT code_inscription, nom, prenom FROM $tbl_etudiant   
		  WHERE  archive = 0
 		  and code_inscription not in 
		  (SELECT DISTINCT code_inscription FROM $tbl_inscription_cours WHERE 
		  code_cours = '$code_cours' AND idSession='$idSession') ORDER BY nom, prenom ";
 		  $req=@mysql_query($sql1);
		  while($row=mysql_fetch_assoc($req)){
		  ?>
		  <option value="<?=$row['code_inscription']?>"><?=ucfirst($row['nom']).' '.ucfirst($row['prenom'])?></option>
		  <?php
		  }
		  ?>
		  </select>
		  </td>
		  <td width="25%"></td>
		  <td width="25%"></td>
		  </tr>
             <tr><td colspan="4" height="3px"></td></tr>
		  <tr>
		   <td class="gras">Section : </td>

		   <td>
		<select name="section" id="section" class="input">
		  <option value="BBA">BBA</option>
		  <option value="MBA">MBA</option>
		</select>
		  </td>
		   <td>&nbsp;</td>
		   <td>&nbsp;</td>
		   </tr>
	  </table>

     </form>
 <?php
}
	  
?>