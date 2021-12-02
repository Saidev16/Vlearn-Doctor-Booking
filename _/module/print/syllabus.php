<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Syllabus du cours</title>
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
<table width="600" border="1" cellspacing="0" cellpadding="0" height="70px" style="text-align:center;">
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
<table width="600" border="1" cellspacing="0" cellpadding="0" style="margin-top:5px;">
   <tr style="font-weight:bold">
    <td width="75px" align="center">Week</td>
    <td width="175" align="center">Contenu</td>
    <td width="350" align="center">Etat d’avancement</td>
  </tr>
  <?php
 if (isset($_GET['code_cours'])){
	$code_cours=$_GET['code_cours'];
  include("../../config.php");
  $sql="select * from $tbl_syllabus where code_cours='$code_cours'";
  $req=mysql_query($sql) or die("erreur lors de la selection des syllabus");
   while ($row=mysql_fetch_assoc($req)){
  ?>
  <tr>
    <td style="text-align:justify">&nbsp;
        <?=htmlentities($row['week'])?></td>
    <td style="text-align:justify">&nbsp;
        <?=htmlentities($row['contenu'])?></td>
    <td style="text-align:justify">&nbsp;
        <?=htmlentities($row['avancement'])?></td>
  </tr>
  <?php
	}
	?>
</table>
<table width="550" border="0" cellspacing="0" cellpadding="0" style="text-align:left; color:#333333; font-size:11px; padding-left:2px; border:#333333 1px solid; margin-top:5px" align="center">
  <tr>
    <td class="souligne" width="10%">Auteur :</td>
    <td width="25%">A.LEMTOUNI</td>
    <td class="souligne" width="10%">Auteur :</td>
    <td width="25%">A.LEMTOUNI</td>
	<td class="souligne" width="10%">Auteur :</td>
    <td width="25%">A.BENHELLAM</td>
  </tr>
  <tr>
     <td class="souligne">Fonction :</td>
	<td>Directrice</td>
	 <td class="souligne">Fonction :</td>
	<td>Res. qualité</td>
	 <td class="souligne">Fonction :</td>
	<td>Président</td>
  
  </tr>
  <tr>
    <td class="souligne">Visa :</td>
    <td>&nbsp;</td>
    <td class="souligne">Visa :</td>
    <td>&nbsp;</td>
	<td class="souligne">Visa :</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
  	<td class="souligne">Date :</td>
	<td><?=date('d/m/Y')?></td>
		<td class="souligne">Date :</td>
	<td><?=date('d/m/Y')?></td>
		<td class="souligne">Date :</td>
	<td><?=date('d/m/Y')?></td>
	</tr>
</table>
<?php
}
?>
</div>
</body>
</html>
