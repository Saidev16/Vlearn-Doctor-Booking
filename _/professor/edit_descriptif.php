<style type="text/css">
textarea{
width:550px;
height:220px;
padding:0;
}
</style>
   <!-- tinyMCE -->
<script language="javascript" type="text/javascript" src="module/editeur/tinymce/jscripts/tiny_mce/tiny_mce_src.js" ></script>
<script language="javascript" type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>
<span id="titre_page" >Editer le déscriptif du cours </span>
<?php
if (isset($_POST['boxchecked'])){

$code_cours=$_POST['boxchecked'];

$_SESSION['current_cours']=$code_cours;

$sql="SELECT d.* , c.titre, c.code_cours, p.nom_prenom, c.semestre, 
ss.session, ss.annee_academique
FROM $tbl_descriptif AS d, $tbl_cours AS c, $tbl_professeur as p, $tbl_seance as s, 
$tbl_session as ss
WHERE d.idSession='$idSession'
and s.idSession=d.idSession
and ss.idSession='$idSession'
and d.code_cours ='$code_cours'
and d.code_cours = s.code_cours
and s.code_prof=p.code_prof
and d.code_cours = c.code_cours limit 1"; 
 
$req=@mysql_query($sql) or die("erreur lors de la sélection du descriptif du cours");

 $row=mysql_fetch_assoc($req) ; 
 
 $pourcentage=explode(';', $row['pourcentage']);
 $selected="selected=\"selected\"";  
?>
<table width="550" border="0" cellspacing="1" cellpadding="0" align="center" id="lien_msj">
  <tr>
	  <td width="510"></td>
	  <td align="center">
		<a href="#" onclick="javascript:document.retour.submit();">
		<div class="back"></div>retour</a>
	  </td>
  </tr>
	</table>
<form action="" method="post" name="adminMenu">
<input type="hidden" value="edit_desriptif" name="action" />
<input type="hidden" name="boxchecked" value="<?=$code_cours?>" />
<input type="hidden" name="token" value="<?=$_SESSION['token']?>" />
 
<table width="575" border="0" cellspacing="0" cellpadding="0">
  <tr align="left">
    <td colspan="2" ><span class="bold">Intitulé du cours</span> :<?=stripslashes($row['titre'])?></td>
  </tr>
  <tr align="left">
    <td><span class="bold">Code</span> :<?=$row['code_cours']?></td>
  </tr>
  <tr align="left">
    <td width="80%"><span class="bold">Enseignant</span> :<?=ucfirst($row['nom_prenom'])?></td></tr>
  <tr align="left">
	<td><span class="bold">Semestre</span> :<?=$row['semestre']?></td>
  </tr>
  <tr align="left">
    <td><span class="bold">Session</span>:<?=$row['session']?>&nbsp;<?=$row['annee_academique']?></td>
      </tr>
  <tr height="10px"><td colspan="6"></td></tr>
</table>
<table width="575" border="0" cellspacing="0" cellpadding="0">
  <tr align="left">
    <th>OBJECTIFS COGNITIFS ET COMPORTEMENTAUX DU COURS</th>
  </tr>
  <tr height="2px"><td></td></tr>
  <tr align="left">
    <td>A la fin du semestre, les étudiants auront acquis les  compétences suivantes:</td>
  </tr>
   <tr height="2px"><td></td></tr>
  <tr height="15px" align="left">
    <td><textarea cols="60" rows="6" name="competence" ><?=$row['competence']; ?></textarea></td>
  </tr>
   <tr height="2px"><td></td></tr>
    <tr align="left">
    <td>A la fin du semestre, les étudiants auront acquis les connaissances suivantes:</td>
  </tr>
  <tr align="left">
    <td><textarea cols="60" rows="6" name="connaissance"><?=$row['connaissance']; ?></textarea></td>
  </tr>
   <tr height="2px"><td></td></tr>
   <tr align="left">
    <td>A la fin du semestre, les étudiants auront acquis les attitudes suivantes:
</td>
  </tr>
  <tr height="2px"><td></td></tr>
  <tr align="left">
    <td><textarea cols="60" rows="3" name="attitude" ><?=$row['attitude']; ?></textarea></td>
  </tr>
   <tr height="2px"><td></td></tr>
</table>
<table width="575" border="0" cellspacing="0" cellpadding="0">
  <tr align="left">
    <th>CONTENU ACADEMIQUE DU COURS</th>
  </tr>
  <tr height="2px"><td></td></tr>
  <tr align="left">
    <td><textarea cols="60" rows="3" name="contenu" ><?=$row['contenu'];?></textarea></td>

  <tr height="10px"><td></td></tr>
</table>
<table width="575" border="0" cellspacing="0" cellpadding="0">
  <tr align="left">
    <th align="left">METHODE D’ENSEIGNEMENT ET MOYENS PEDAGOGIQUES PREVUS,
IMPLICATION DES <br />ETUDIANTS, ET APPLICATIONS DU CONTENU
ACADEMIQUE
</th>
  </tr>
 <tr>
    <td align="left"><textarea cols="60" rows="3" name="methode" ><?=$row['methode']; ?></textarea></td>

  </tr>

</table>
<table width="575" border="0" cellspacing="0" cellpadding="0">
  <tr align="left">
    <th>EXIGENCES DU COURS ET MODALITES D’EVALUATIONS (CONTROLE CONTINU, EXAMENS,<br /> EXPOSES, RAPPORTS, PROJETS PRATIQUES, TRAVAIL DE TERRAIN, RECHERCHE SUR<br /> INTERNET) </th>
  </tr>
  <tr>
    <td align="left"><textarea cols="60" rows="3" name="exigence" ><?=$row['exigence']; ?></textarea></td>

  </tr>
   </table>
<table width="575" border="0" cellspacing="0" cellpadding="0">
  <tr align="left">
    <th>POURCENTAGE POUR CHAQUE COMPOSANTE DE LA NOTE FINALE (y compris la note de<br /> participation et des examens de mi-semestre et de fin de semestre)

</th>
  </tr>
  <tr>
    <td align="left">
    <textarea cols="60" rows="3" name="pourcentage" ><?=$row['pourcentage']; ?></textarea>
     </td>
   </tr>
   <tr height="2px"><td></td></tr>
  </table>
<table width="575" border="0" cellspacing="0" cellpadding="0">
  <tr align="left">
    <th>BIBLIOGRAPHIE</th>
  </tr>
  <tr>
    <td valign="top" align="left"><textarea cols="60" rows="3" name="bibliographie" 
	id="bibliographie" ><?=$row['bibliographie'];?></textarea></td>

  </tr>
  <tr height="3px">
    <td></td>
	</tr>
  <tr>
    <td align="right"><input type="submit" value="valider" class="bouton" />&nbsp;
	<input type="reset" value="annuler" class="bouton" />&nbsp;
	</td>
	</tr>
</table>
<input type="hidden" value="<?php echo $row['pourcentage']?>" name="ex_pourcentage" />
</form>
<?php
}
?>
<form name="retour" action="professeur.php" method="post">
<input type="hidden" name="task" value="desriptif" />
<input type="hidden" name="boxchecked" value="<?=$code_cours?>" />
<input type="hidden" name="token" value="<?=$_SESSION['token']?>" />
</form>
