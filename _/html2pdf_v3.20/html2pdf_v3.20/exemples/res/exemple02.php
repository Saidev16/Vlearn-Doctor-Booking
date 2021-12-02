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
	padding:		1px;
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
$sql="SELECT nom, prenom, cin, date_naissance, niveau, sexe, attestation_eng FROM $tbl_etudiant WHERE code_inscription='$code_inscription'";
$req=@mysql_query($sql) or die('Erreur de sélection des informations de cet étudiant');
$row=@mysql_fetch_assoc($req);
if ($row['sexe']=='masculin'){
$civilite='Mr';
}
else{
$civilite='Ms';
}
$bba='Bachelor of Business Administration';
$mba='Master of Business Administration';
?>
<table>
	<tr>
		<td align="right">Date, <?php echo  date('d/m/Y');?></td>
    </tr>
	<tr>
		<td height="50">&nbsp;</td>
	</tr>
	<tr>
		<td align="center"><b>Scholarship Certificate</b></td>
    </tr>
	<tr>
		<td height="50">&nbsp;</td>
	</tr>
	<tr>
		<td>
		To Whom it may concern:
		</td>
	</tr>
	<tr>
		<td>Private international Institute of Management and technology certifies that <?php echo $civilite ?>. <b><?php echo $row['nom'].' '.$row['prenom']?></b></td>
    </tr>
	<tr>
		<td>ID  <b><?php echo strtoupper($row['cin'])?></b>, Born in  <b><?php echo $row['date_naissance']?></b></td>
    </tr>
	<tr>
		<td><?php if ($row['attestation_eng']!=''){ echo stripslashes($row['attestation_eng']); } else {?>
Is  following the   <?php echo $row['niveau']?> <?=$row['niveau']=='BBA' ? $bba : $mba ?> » for the year <?php echo date('Y')-1?>-<?php echo date('Y')}?>.
		</td>
    </tr>
	<tr>
		<td height="50">&nbsp;</td>
	</tr>
	<tr>
		<td>This certificate is delivered to serve and be worth what of right.</td>
    </tr>
	<tr>
		<td height="50">&nbsp;</td>
	</tr>
	<tr>
		<td align="right"><b>Dr.Abdelmoula El Hamdouchi</b></td>
    </tr>
	<tr>
		<td height="15">&nbsp;</td>
	</tr>
	<tr>
		<td align="right"><b>Pedagogic Director of PIIMT</b></td>
    </tr>
</table>
<?php
}
?>