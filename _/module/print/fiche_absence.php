<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Fiche d'absence</title>
<link rel="stylesheet" type="text/css" href="../../css/print.css" media="screen">
</head>
<body>
<div id="main">
<!--entete-->
  <table width="550px" border="1" cellspacing="0" cellpadding="0" height="70px" style="text-align:center; margin-bottom:10px">
  <tr height="30px">
    <td rowspan="3" width="30%"><img src="../../administrator/images/clip_image002.jpg" border="0" width="168" height="70" />
	<br /><span style="font-weight:bold; color:#999999">PRC/ESM</span></td>
	<td width="30%" ><span style="color:#6666CC; font-weight:bold; text-align:center">Formulaire </span></td>
    <td width="30%"><span style="color:#FF0000; font-weight:bold">FOR/ESM/002</span></td>
     </tr>
 <tr height="15px">
    <td rowspan="2"><span style="color:#339933; font-weight:bold; text-align:center">Fiche semestrielle de Présence des Etudiants													
</span></td>
    <td  rowspan="2" ><span style="color:#666666; font-weight:bold">Version :</span> </td>
  </tr>
  <tr height="10px"></tr>
</table>
<!--  fin entete-->
<div style="width:550px; text-align:left">
<?php
if (isset($_GET['key'])){
$id=$_GET['key'];
}
include("../../config.php");
$sql1="select p.nom_prenom, c.titre, s.salle, c.session from tbl_cours as c, tbl_professeur as p, tbl_seance as s
 where p.code_prof=c.code_prof and s.code_cours=c.code_cours and c.code_cours='$id' ";
$req=mysql_query($sql1) or die ("erreur lors de la sélection du nom du cours et du prof");
while($row=mysql_fetch_assoc($req)){
$nom=$row['nom_prenom'];
$titre=$row['titre'];
$session=$row['session'];
$salle=$row['salle'];
}
?>
<span class="gras">Cours:</span> <?=$titre?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="gras">Salle:</span> <?=$salle?><br />
<span class="gras">Prof:</span> <?=$nom?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="gras">Session: </span><?=$session?>&nbsp;<?=date('Y')?>
</div>
<?php
if (isset($_GET['key'])){
$id=$_GET['key'];
$sql="select   DISTINCT e.code_inscription, e.nom, e.prenom from $tbl_etudiant as e, tbl_inscription_cours as i where i.code_cours='$id' and i.code_inscription=e.code_inscription ";
$req=mysql_query($sql) or die("erreur lors de la sélection des étudiant");
?>
<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="cours" value="<?=$id?>" />
<table width="550" border="0" cellspacing="1" cellpadding="0"  style="border:#333333 1px solid">
  <tr valign="top" style="background:url(../administrator/images/images/article_background.gif) repeat top; font-weight:bold"> 
    <td align="center" width="15px">#</td>
    <td align="left" width="535">&nbsp;Nom et prénom</td>
	<?php
	$sql1="SELECT DISTINCT date
FROM tbl_absence
WHERE code_cours = '$id' order by date";
	$req1=@mysql_query($sql1) or die ("erreur lors de la selection des dates");
	while($row=mysql_fetch_assoc($req1)){
	?>
	<td width="14px"><span style="width:14px;writing-mode:tb-rl; white-space: nowrap;"><?=$row['date']?></span></td>
	<?php
	}
	?>
  </tr>
  <tr><td colspan="30" bgcolor="#333333" height="1px"></td></tr>
<?php
while ($row=mysql_fetch_assoc($req)){
?>
  <tr height="18px">
   <td align="center">
   <input type="radio" id="<?=$row["code_inscription"]?>" name="id" value="<?=$row["code_inscription"]?>" onClick="document.adminMenu.boxchecked.value='<?=$row["code_inscription"]?>'" />
   </td>
    <td align="left" width="">
	&nbsp;<?=htmlentities($row['nom'])?>&nbsp;<?=htmlentities($row['prenom'])?>
	</td>
	<?php 
	$code=$row["code_inscription"];
	$sql2="select jeton from tbl_absence where code_inscription='$code' and code_cours='$id' order by date";
	$req2=mysql_query($sql2) or die("erreur lors de la selection des absences");
	while($row=mysql_fetch_assoc($req2)){
	?>
	<td><span style="border:#333333 1px solid; display:block; width:12px; height:16px"><?=$row['jeton']?></span></td>
	<?php
	}
	?>
  </tr>
   <tr><td colspan="30" bgcolor="#333333" height="1px"></td></tr>
  <?php
  }
  ?>
</table>
</form>

 <?php
    }
?>
<table width="550" border="0" cellspacing="0" cellpadding="0" style="text-align:left; font-size:11px; padding-left:2px; border:#333333 1px solid; margin-top:10px ">
  <tr>
    <td class="souligne" width="10%">Auteur</td>
    <td width="25%">: E.SIMON</td>
    <td class="souligne" width="10%">Auteur</td>
    <td width="25%">: A.LEMTOUNI</td>
	<td class="souligne" width="10%">Auteur</td>
    <td width="25%">: A.BENHELLAM</td>
  </tr>
  <tr>
     <td class="souligne">Fonction</td>
	<td>: Resp.Ens.Sup.</td>
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
	<tr><td colspan="6" height="2px"></td></tr>
</table>
</div>
</body>
</html>
