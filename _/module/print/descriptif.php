<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Déscriptif du cours </title>
<link rel="stylesheet" type="text/css" href="../../css/print.css">
<script language="javascript1.2">
function imprimer(){
window.print();
window.back();
}
</script>
</head>
<body onload="imprimer()">
<div id="main">
<table width="600px" border="0" cellspacing="1" cellpadding="0" align="center"  >
 <?php
	if (isset($_GET['code_cours'])){
	$code_cours=$_GET['code_cours'];
	$sql=" SELECT d. * , c.titre, c.semestre, p.nom_prenom
FROM tbl_descriptif AS d, tbl_cours AS c, tbl_professeur AS p
WHERE d.code_cours = '$code_cours'
AND c.code_cours = d.code_cours
AND c.code_prof = p.code_prof
  LIMIT 0 , 1";
  include("../../config.php");
	$req=mysql_query($sql) or die('erreur lors de la sélection du cours');
	while($row=mysql_fetch_assoc($req)){
		?>
		<tr>
		<td colspan="2" height="70px">
		<table width="600" border="1" cellspacing="0" cellpadding="0" height="70px" style="text-align:center">
  <tr height="30px">
    <td rowspan="3" width="30%"><img src="../../administrator/images/clip_image002.jpg" border="0" width="168" height="70" />
	<br /><span style="font-weight:bold; color:#999999">PRC/ESM</span></td>
	<td width="30%" ><span style="color:#6666CC; font-weight:bold; text-align:center">Formulaire </span></td>
    <td width="30%"><span style="color:#FF0000; font-weight:bold">FOR/ESM/002</span></td>
     </tr>
 <tr height="15px">
    <td rowspan="2"><span style="color:#339933; font-weight:bold; text-align:center">Fiche d&eacute;scriptif du cours</span></td>
    <td  rowspan="2" ><span style="color:#666666; font-weight:bold">Version :</span> </td>
  </tr>
  <tr height="10px"></tr>
</table>
</td>
		</tr>
   <tr>
    <td colspan="2" height="10px"></td>
  </tr>
   <tr>
    <td colspan="2" height="180px"  valign="top">
	<table width="100%" border="1" cellspacing="3" cellpadding="0" style="text-align:left; padding-left:2px">
  <tr>
    <td colspan="2">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:left; padding-left:2px">
  <tr>
       <td width="75%"><span class="gras">Intitulé du cours</span> :&nbsp;<?=$row['titre']?></td>
	    <td width="25%"><span class="gras">Code </span> :&nbsp;<?=$code_cours?></td>
	</tr>
	<tr>
    <td><span class="gras">Enseignant</span>:&nbsp;<?=$row['nom_prenom']?>&nbsp;</td>
	 <td ><span class="gras">Année</span> :<?=date('Y')?></td>
      </tr>
	   <tr>
       <td>&nbsp;</td>
	    <td><span class="gras">Semestre</span> :<?=$row['semestre']; ?></td>
	</tr>
</table>
	</td>
  </tr>
   
  <tr>
    <td colspan="2" class="gras">OBJECTIFS COGNITIFS ET COMPORTEMENTAUX DU COURS : </td>
  </tr>
   <td colspan="2" height="2px"></td>
  <tr>
    <td colspan="2" class="gras" >A la fin du semestre, les etudiants auront acquis les  competences suivantes:</td>
  </tr>
  <tr>
    <td colspan="2" height="50px" class="descriptif">
	<?=$row['competence1']; ?><br />
	<?=$row['competence2']; ?><br />
	<?=$row['competence3']; ?>
	</td>
  </tr>
  <tr>
    <td colspan="2" class="gras">A la fin du semestre, les etudiants auront acquis les connaissances suivantes:</td>
  </tr>
  <tr>
    <td colspan="2" height="50px" class="descriptif">
	<?=$row['connaissance1']; ?><br />
	<?=$row['connaissance2']; ?><br />
	<?=$row['connaissance3']; ?>
	</td>
   
  </tr>
  <tr>
        <td colspan="2" class="gras">A la fin du semestre, les etudiants auront acquis les attitudes suivantes:</td>
  </tr>
  <tr>
    <td colspan="2" height="50px" class="descriptif">
	<?=$row['attitude1']; ?><br />
	<?=$row['attitude2']; ?><br />
	<?=$row['attitude3']; ?>
	</td>
  </tr>
  <tr>
    <td colspan="2" class="gras">CONTENU ACADEMIQUE DU COURS : </td>
  </tr>
  <tr>
    <td colspan="2" height="50px" class="descriptif"><?=$row['contenu']; ?></td>
  </tr>
  <tr>
    <td colspan="2" class="gras">METHODE D’ENSEIGNEMENT ET MOYENS PEDAGOGIQUES PREVUS,
IMPLICATION DES ETUDIANTS, ET APPLICATIONS DU CONTENU
ACADEMIQUE

:</td>
  </tr>
  <tr>
    <td colspan="2" height="50px" class="descriptif"><?=$row['methode']; ?></td>
  </tr>
  <tr>
    <td colspan="2" class="gras">EXIGENCES DU COURS ET MODALITES D’EVALUATIONS (CONTROLE CONTINU, EXAMENS, EXPOSES, RAPPORTS, PROJETS PRATIQUES, TRAVAIL DE TERRAIN, RECHERCHE SUR INTERNET) 

:</td>
  </tr>
  <tr>
  <td colspan="2" height="50px" style="vertical-align:top; text-align:justify; padding:2px"><?=$row['exigence']; ?></td>
  </tr>
  <tr>
   <td colspan="2" class="gras" >POURCENTAGE POUR CHAQUE COMPOSANTE DE LA NOTE FINALE (y compris la note de participation et des examens de mi-semestre et de fin de semestre) : </td>
  </tr>
  <tr>
   <td colspan="2" height="50px" class="descriptif">
   <?=$row['pourcentage1']; ?><br />
   <?=$row['pourcentage2']; ?><br />
   <?=$row['pourcentage3']; ?><br />
   <?=$row['pourcentage4']; ?><br />
   <?=$row['pourcentage5']; ?><br />
   <?=$row['pourcentage6']; ?>
   </td>
  </tr>
  <tr>
  <td colspan="2" class="gras">BIBLIOGRAPHIE : </td>
  </tr>
  <tr>
   <td colspan="2" height="50px" valign="top" class="descriptif"><?=$row['bibliographie']; ?></td>
  </tr>
   </table>
	<!--fin detail-->
	</td>
  
  </tr>
  <tr>
    <td colspan="2" height="5px"></td>
  </tr>
  </table>
  
  <table width="550" border="0" cellspacing="0" align="center" cellpadding="0" style="text-align:left; font-size:11px; padding-left:2px; border:#333333 1px solid; ">
  <tr>
    <td class="souligne" width="10%">Auteur</td>
    <td width="25%">: A.LEMTOUNI</td>
    <td class="souligne" width="10%">Auteur</td>
    <td width="25%">: A.LEMTOUNI</td>
	<td class="souligne" width="10%">Auteur</td>
    <td width="25%">: A.BENHELLAM</td>
  </tr>
  <tr>
     <td class="souligne">Fonction</td>
	<td>: Directrice</td>
	 <td class="souligne">Fonction</td>
	<td>: Res. qualité</td>
	 <td class="souligne">Fonction</td>
	<td>: Président</td>
  
  </tr>
  <tr>
    <td class="souligne">Visa</td>
    <td>: &nbsp;</td>
    <td class="souligne">Visa</td>
    <td>: &nbsp;</td>
	<td class="souligne">Visa</td>
    <td>: &nbsp;</td>
  </tr>
  <tr>
  	<td class="souligne">Date</td>
	<td>: <?=date('d/m/Y')?></td>
		<td class="souligne">Date</td>
	<td>: <?=date('d/m/Y')?></td>
		<td class="souligne">Date</td>
	<td>: <?=date('d/m/Y')?></td>
	</tr>
</table>
<?php
  }}
  ?>
  </div>
</body>
</html>
