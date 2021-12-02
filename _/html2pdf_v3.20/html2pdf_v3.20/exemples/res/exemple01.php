<?php header('Content-type: application/pdf');?>
<style type="text/css">
<!--
table.morpion
{
	border:		dashed 1px #444444;
}

table.morpion td
{
	font-size:		15pt;
	font-weight:	bold;
	border:			solid 1px #000000;
	padding:		0 15px;
	text-align:		center;
	width:			25px;
}

table.morpion td.j1 { color: #0A0; }
table.morpion td.j2 { color: #A00; }

-->
</style>
<?php
require "../../../administrator/config/config.php";
if (isset($_GET['code_inscription'])){
$code_inscription=addslashes($_GET['code_inscription']);
$sql="SELECT nom, prenom, cin, date_naissance, niveau, sexe, attestation_fr FROM $tbl_etudiant WHERE code_inscription='$code_inscription'";
$req=@mysql_query($sql) or die('Erreur de sélection des informations de cet étudiant');
$row=@mysql_fetch_assoc($req);
if ($row['sexe']=='masculin'){
$civilite='Mr';
}
else{
$civilite='Mlle';
}
$bba='Bachelor of Business Administration';
$mba='Master of Business Administration';
?>
<table>
	<tr>
		<td height="80">&nbsp;</td>
	</tr>
    <tr>
		<td align="right">Rabat, le <?php echo  date('d/m/Y');?></td>
    </tr>
	<tr>
		<td height="50">&nbsp;</td>
	</tr>
	<tr>
		<td align="center"><b>ATTESTATION DE SCOLARITE</b></td>
    </tr>
	<tr>
		<td height="50">&nbsp;</td>
	</tr>
	<tr>
		<td>
		Je soussigné, Président de <b>l’Institut Supérieur « Private International Institute Of Management and Technology » </b>
		</td>
	</tr>
    <tr>
    	<td><b>P.I.I.M.T</b>, atteste que :</td>
    </tr>
	<tr>
		<td><?php echo $civilite ?>. <b><?php echo $row['nom'].' '.$row['prenom']?></b></td>
    </tr>
	<tr>
		<td>CIN N°  <b><?php echo strtoupper($row['cin'])?></b></td>
    </tr>
	<tr>
		<td>Né le  <b><?php echo $row['date_naissance']?></b></td>
    </tr>
	<tr>
		<td><?php if ($row['attestation_fr']!=''){ echo stripslashes($row['attestation_fr']); } else {?>
Est étudiant<?=$row['sexe']=='masculin' ? '' : 'e'?> au programme du <?php echo $row['niveau']?> « <?=$row['niveau']=='BBA' ? $bba : $mba ?> » au sein de  l’Institut Supérieur <br />
 « Private International Institute Of Management and Technology » P.I.I.M.T pour l’année universitaire <?php echo date('Y')-1?>-<?php echo date('Y')?>.<?php }?></td>
    </tr>
    <tr>
		<td>Cette attestation est délivrée pour servir et valoir ce que de droit.</td>
	</tr>
    <tr>
		<td height="50">&nbsp;</td>
	</tr>
	<tr>
		<td align="right"><b>Pr. LAHLOU Anass</b></td>
    </tr>
	<tr>
		<td height="15">&nbsp;</td>
	</tr>
	<tr>
		<td align="right"><b>Président P.I.I.M.T</b></td>
    </tr>
</table>
<?php
}
?>