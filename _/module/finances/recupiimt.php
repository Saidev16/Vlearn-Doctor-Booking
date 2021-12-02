<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PIIMT - Re&ccedil;u de paiement</title>
</head>
<style type="text/css">
table{
font-family:verdana;
font-size:11px;
}
.bold{
font-weight:bold;
}
</style>
<style type="text/css" media="print">
.hide{
display:none;
}
</style>
<body>
<br /><br /> 
<?php
require '../../administrator/config/config.php';
$id=$_GET['recu'];
$sql="SELECT p.*, e.nom, e.prenom, e.cin, e.annee as annee_academique,e.niveau, f.*, concat(a.prenom,' ', a.nom) AS reciever_name
FROM tbl_finance_paiement as p, $tbl_finance as f, $tbl_etudiant as e, $tbl_admin as a
WHERE p.id='$id' 
AND p.annee=f.annee 
AND e.code_inscription=f.code_inscription
AND e.code_inscription=p.code_inscription
AND a.id=p.receveur LIMIT 1";

$res=@mysql_query($sql);
$row=@mysql_fetch_assoc($res);
$code_inscription=$row['code_inscription'];
$id=$row['id'];
$recu=$row['recu'];
$date_paiement=$row['date_paiement'];
$type_paiement=$row['type_paiement'];
 if($type_paiement==0)
	 {$type_paiement='Espèce';
	 }
	 else
	 if($type_paiement==1)
	 {$type_paiement='Chèque';}
	 else 
	 if($type_paiement==2)
	 {$type_paiement='Chèque de Garantie';}
	 else
	 if($type_paiement==3)
	 {$type_paiement='Chèque Daté';}
//$type_paiement=$row['type_paiement']==1 ? 'Espèce' : 'Chèque ';
$payee=$row['payee'];
$reste=($row['frais_inscription']+$row['frais_etude'])-($row['payee']+$row['bourse']);
$annee=$row['annee'];
$annee_academique=$row['annee_academique'];
$somme=$row['somme'];
$niveau=$row['niveau'];
$cin=strtoupper($row['cin']);
$designation=stripslashes($row['designation']);
$name=ucfirst($row['prenom']).' '.ucfirst($row['nom']);
$receveur=ucfirst($row['reciever_name']);
$frais_etude=$row['frais_etude'];
$reliquat=$row['reliquat'];
$frais_inscription=$row['frais_inscription'];
$sql="SELECT * FROM $tbl_finance WHERE code_inscription='$code_inscription' AND annee = '$annee'";
$req=mysql_query($sql);
$row=mysql_fetch_assoc($req);
 ?>
<table width="800" align="center" border="0">
	<tr>
    <!--	<td colspan="2" align="left" style="padding-top:25px"><img src="../../administrator/images/aul.jpg" alt="" /></td>-->
        <td colspan="1" align="LEFT" valign="top"><img src="../../administrator/images/piimt.jpg" alt="" /></td>
    </tr>
     <tr>
    	<td colspan="4" height="10">&nbsp;</td>
    </tr>
	<tr>
		<td colspan="4" align="right"><b><br />  </b></td>
	</tr>
	<tr>
		<td colspan="4"><span class="bold">N° de Reçu: </span><?php echo $recu; ?></td>
    </tr><tr>
		<td colspan="4"><span class="bold">Date de Règlement: </span><?php echo $date_paiement; ?></td>
    </tr>
	<tr>
		<td colspan="4"><span class="bold">Mode de Règlement: </span><?php echo $type_paiement; ?></td>
    </tr>
	<tr>
		<!--<td colspan="4"><span class="bold">Nom de Receveur: </span><?php echo //$receveur; ?></td>-->
    </tr>
	<tr height="30">
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td width="150">&nbsp;</td>
		<td colspan="3"><span class="bold">NOM DE L'ETUDIANT: </span><?php echo $name; ?></td>
    </tr>
	<tr>
		<td width="150">&nbsp;</td>
		<td colspan="3"><span class="bold">CIN N&deg;: </span><?php echo $cin; ?></td>
    </tr>
	<tr height="30">
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4">
			<table style="border-collapse:collapse; padding:1px" border="1" cellspacing="1" width="100%">
				<tr>
					<th>Désignation</th>
					<!--<th>Ann&eacute;e</th>-->
					<th>Niveau d'études</th>
					<th>Montant pay&eacute; </th>
				</tr>
				<tr align="center">
					<td><?php echo $designation;?></td>
					<!--<td><?php echo //$annee;?></td>-->
					<td><?php echo $niveau;//$annee_academique;?> <?php //echo is_numeric($annee_academique) ? 'année' : ''?></td>
					<td><?php echo $somme.''.'DHS';?></td>
				</tr>
			 </table>
		</td>
	</tr>
	<tr height="50">
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<!--<td colspan="4"><span class="bold">Montant total</span>: -->
		<?php //echo ((int)$row['frais_inscription']+(int)$row['frais_etude'])-(int)$row['bourse']; ?></td>
	</tr>
	<tr>
		<!--<td colspan="4"><span class="bold">Montant payée</span>: <?php echo $row['payee'];?></td>-->
	</tr>
	<tr>
		<td colspan="4"><span class="bold"></span><?php //echo ((int)$row['frais_inscription']+(int)$row['frais_etude']+(int)$row['reliquat'])-((int)$row['bourse']+(int)$row['payee']);?></td>
	</tr>
    <tr>
    	<td colspan="4" height="10">&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="4">
        	<table width="100%" style="font-size:10px; color:#36C">
                <tr>
                   
                    <td width="45%" >
                   MOROCCO : 45, AVENUE OULED SAID, BIR KACEM – SOUISSI – RABAT
TEL : 05 37 75 67 11/88    FAX : 05 37 75 67 88   E-MAIL : ADMIN@PIIMT.US    WEBSITE : WWW.PIIMT.US
¦   CNSS N° 7304900       ¦   PATENTE N° 25982176        ¦   IF N° 3316840       ¦   RC N° 64281                    </td>
					 <td width="55%" >
                    MOROCCO : 45, AVENUE OULED SAID, BIR KACEM – SOUISSI – RABAT
                    TEL : 0537 75 67 11/0537 75 98 59    FAX : 0537 75 67 88
                    E-MAIL : ADMIN@PIIMT.US    WEBSITE : WWW.PIIMT.US
                    CNSS N° 7304900       ¦   PATENTE N° 25982176        ¦   IF N° 3316840       ¦   RC N° 64281                    </td>
                </tr>
            </table>
       </td>
    </tr>
</table>
<div style="text-align:center; margin-top:30px;">
<a href="javascript:window.print()" class="hide">Imprimer</a>&nbsp;&nbsp;<a href="javascript:self.close()" class="hide">Fermer</a>
</div>
</body>
</html>
