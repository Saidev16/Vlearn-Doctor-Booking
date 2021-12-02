
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

if (isset($_POST['idSession'])){

		
		$id = (int)$_POST['id'];
		$academic_year = $_POST['academic_year'];
		//$ex_type_cours_id = $_POST['ex_type_cours_id'];
		$code_inscription = $_POST['code_inscription'];
		$code_cours = $_POST['code_cours'];
		$idSession= $_POST['idSession'];
		$old_idSession = $_POST['old_idSession'];

		//die($old_idSession);
    $sql="UPDATE tbl_inscription_cours_morocco SET  idSession = $idSession WHERE id = $id LIMIT 1 ;";
		@mysql_query($sql)or die ("erreur lors de la mise à jour de cette inscription ");
		$sql="UPDATE tbl_note_morocco SET idSession = $idSession WHERE code_cours='$code_cours' and code_inscription='$code_inscription' LIMIT 1 ;";
		@mysql_query($sql)or die ("erreur lors de la mise à jour de cette inscription ");

		?>
					<script type="text/javascript" language="JavaScript1.2">

			<!--
					setTimeout(function(){window.location.replace('gestion_inscription_morocco.php?code_cours=<?=$code_cours?>')}, 3000);


			//-->

			</script>

              <?php

			  }

			  else{

			 $code_inscription = $_GET["modifier"];
			 $code_cours = $_SESSION['cours'];
			 $idSession = $_SESSION['NidSession'] ;

			 $sql4 = "SELECT i.*, e.nom, e.prenom, s.session, s.annee_academique, s.academic_year, c.titre
			  FROM tbl_inscription_cours_morocco AS i, tbl_etudiant_morocco AS e, $tbl_session AS s, $tbl_cours AS c
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
			  $idSession=$row['idSession'];
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
          	<a href="gestion_inscription_morocco.php"><div class="cancel"></div>Annuler</a>
          </td>
		</tr>
	  </table>
    </td>
  </tr>

</table>

 <form method="post"  action="gestion_inscription_morocco.php?modifier=oui" name="f_ajout">

 <input type="hidden" name="id" value="<?=$id?>" />
 <input type="hidden" name="old_idSession" value="<?=$idSession?>" />

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
			<td>
			<select name="idSession" id="idSession" class="input">
 		  <?php
		  $sql7="select idSession, session, annee_academique from $tbl_session where archive=1  ";
		  $req=@mysql_query($sql7);
		  while($row=mysql_fetch_assoc($req)){
		  $ns=ucfirst($row['session']).' '.$row['annee_academique'];
		  $cs=$row['idSession'];
		  ?>
		  <option value="<?=$cs?>" <?=($cs==$idSession) ? $selected : ''?>><?=$ns?></option>
		  <?php
		  }
		  ?>
		  </select></td>
  		   <!-- <td colspan="3"><?=$session.' '.$annee_academique?></td>-->
		  </tr>
		  <tr><td colspan="4" height="3px"></td></tr>
		  <tr>
		  <td width="25%" class="gras">Etudiant : </td>
		  <td width="25%"><?=$name?></td>
		  <td width="25%"></td>
		  <td width="25%"></td>
		  </tr>
             <!--  <tr><td colspan="4" height="3px"></td></tr>
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
          </tr>-->
	  </table>

	  <input type="hidden" name="ex_type_cours_id" value="<?=$type_cours_id?>" />
      <input type="hidden" name="academic_year" value="<?=$academic_year?>" />
      <input type="hidden" name="code_inscription" value="<?=$code_inscription?>" />
	  <input type="hidden" name="code_cours" value="<?=$code_cours?>" />

</form>



<?php

}



?>
