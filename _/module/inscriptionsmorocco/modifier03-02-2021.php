
<style type="text/css">

input{

width:200px;

}

</style>

<script language="javascript1.2">

function valid_form(){

document.f_ajout.submit();

}

</script>

<?php

if (isset($_POST['type_cours'])){

		$type_cours = (int)$_POST['type_cours'];
		$id = (int)$_POST['id'];
		$academic_year = $_POST['academic_year'];
		$ex_type_cours_id = $_POST['ex_type_cours_id'];
		$code_inscription = $_POST['code_inscription'];
		$code_cours = $_POST['code_cours'];

        $sql="UPDATE $tbl_inscription_cours SET `type_cours_id` = $type_cours WHERE id = $id LIMIT 1 ;";
		@mysql_query($sql)or die ("erreur lors de la mise à jour de cette inscription ");
		
		$sql = "SELECT SUM(prix) AS frais_etude FROM $tbl_inscription_cours AS i, tbl_type_cours AS t 
		WHERE i.code_inscription = '$code_inscription' 
		AND i.archive = 0
		AND i.idSession in (SELECT DISTINCT idSession FROM $tbl_session WHERE academic_year = '$academic_year')
		AND t.id = i.type_cours_id";
		$req = @mysql_query($sql) or die ('Erreur de seléction du total à payer');
		$row = mysql_fetch_assoc($req);
		$frais_etude  = $row['frais_etude'];
		
		$sql = "UPDATE tbl_finance SET frais_etude = $frais_etude 
		WHERE code_inscription = '$code_inscription' 
		AND annee = '$academic_year' LIMIT 1";
		@mysql_query($sql) or die ('Erreur de mise à jour de la fiche de paiement');

			?>

			<script type="text/javascript" language="JavaScript1.2">

			<!--	

					window.location.replace('gestion_inscription.php?code_cours=<?=$code_cours?>');

			//-->

			</script>

              <?php

			  }

			  else{

			 $code_inscription = $_GET["modifier"]; 
			 $code_cours = $_SESSION['cours'];
			 $idSession = $_SESSION['NidSession'] ;

		echo	 $sql4 = "SELECT i.*, e.nom, e.prenom, s.session, s.annee_academique, s.academic_year, c.titre
			  FROM tbl_inscription_cours_morocco AS i,  tbl_etudiant_morocco AS e, $tbl_session AS s, $tbl_cours AS c
			  WHERE e.code_inscription = i.code_inscription
			  AND i.idSession = s.idSession
			  AND c.code_cours = i.code_cours
			  AND e.code_inscription = '$code_inscription'  
			  AND i.code_cours = '$code_cours' 
			  AND i.idSession = '$idSession' LIMIT 1";

			  $req = @mysql_query($sql4) or die ("Erreur lors de la sélection de cette inscription");

			  while ($row=mysql_fetch_assoc($req)){
			  $type_cours_id = $row['type_cours_id'];
			  $name = ucfirst($row['prenom']).' '.ucfirst($row['nom']);
			  $session = $row['session'];
			  $annee_academique = $row['annee_academique'];
			  $titre = trim(stripslashes($row['titre']));
			  $code_cours = $row['code_cours'];
			  $section = $row['section'];
			  $academic_year = $row['academic_year'];
			  $code_inscription = $row['code_inscription'];
			  $id = $row['id'];
			  }

			  			  ?>

			   



<table border="0" width="1000" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td><img src="images/icone/filieres.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES INSCRIPTIONS <span style="font-size:12px">[modifier]</span></td>

	<td width="22%">

	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link">
	    <tr>
		  <td valign="top" align="center">
          	<a href="#" onclick="javascript:valid_form();"><div class="save"></div>Valider</a>
          </td>
		  <td valign="top" align="center">
          	<a href="gestion_inscription.php"><div class="cancel"></div>Annuler</a>
          </td>
		</tr>
	  </table>	
    </td> 
  </tr>

</table>

 <form method="post"  action="gestion_inscription.php?modifier=oui" name="f_ajout">

 <input type="hidden" name="id" value="<?=$id?>" />

	    <table border="0" cellpadding="0" cellspacing="2" width="100%" style="padding-left:10px" class="cellule_table">
		  <tr>
          	<td colspan="4" height="3px"></td>
		  </tr>
		  <tr>
              <td class="gras">Code du cours : </td>
              <td colspan="3"><?=$code_cours?></td>
		  </tr>
		  	<tr><td colspan="4" height="3px"></td>
		  </tr>
		  <tr>
              <td class="gras">Titre du cours : </td>
              <td colspan="3"><?=$titre?></td> 
		   </tr>
		  <tr>
          	<td colspan="4" height="3px"></td>
		  </tr>
		 <tr>
		    <td class="gras">Session : </td>
  		    <td colspan="3"><?=$session.' '.$annee_academique?></td>
		  </tr>
		  <tr><td colspan="4" height="3px"></td></tr>
		  <tr>
		  <td width="25%" class="gras">Etudiant : </td>
		  <td width="25%"><?=$name?></td>
		  <td width="25%"></td>
		  <td width="25%"></td>
		  </tr>
             <tr><td colspan="4" height="3px"></td></tr>
		  <tr>
		   <td class="gras">Section : </td>

		   <td><?=$section?></td>
		   <td>&nbsp;</td>
		   <td>&nbsp;</td>
		   </tr>
           <tr>
          	<td class="gras"><label for="type_cours">Prix du cours :</label></td>
            <td><select name="type_cours" id="type_cours" class="input">
                <?php 
	      $sql="SELECT id, titre FROM tbl_type_cours WHERE archive = 0 ";
		  $req=@mysql_query($sql);
		  while ($row=mysql_fetch_assoc($req)){
		  ?>
                <option value="<?=$row['id']?>" <?=$row['id']==$type_cours_id ? $selected : ''?>><?=$row['titre']?></option>
           <?php
		  }
		  ?>
          </select>
            <td></td>
            <td></td>
          </tr>
	  </table>

	  <input type="hidden" name="ex_type_cours_id" value="<?=$type_cours_id?>" />
      <input type="hidden" name="academic_year" value="<?=$academic_year?>" />
      <input type="hidden" name="code_inscription" value="<?=$code_inscription?>" />
	  <input type="hidden" name="code_cours" value="<?=$code_cours?>" />
</form>



<?php

}



?>