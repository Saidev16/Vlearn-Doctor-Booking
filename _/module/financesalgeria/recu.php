<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Aul - Receipt</title>
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
<?php
require '../../administrator/config/config.php';
 $id=$_GET['recu'];
 $sql="SELECT p.*, e.nom, e.prenom, e.cin, e.annee as annee_academique,e.niveau,e.prefixe, f.*,  concat(a.prenom,' ', a.nom) AS reciever_name
FROM tbl_finance_paiement_algeria as p, tbl_finance_algeria as f, tbl_etudiant_algeria as e, $tbl_admin as a
WHERE p.id='$id' 
AND e.code_inscription=f.code_inscription
AND e.code_inscription=p.code_inscription

LIMIT 1";

$res=@mysql_query($sql);
$row=@mysql_fetch_assoc($res);
$code_inscription=$row['code_inscription'];
$id=$row['id'];
$recu=$row['recu'];
$date_paiement=$row['date_paiement'];
$type_paiement=$row['type_paiement'];
 if($type_paiement==1)
	 {$type_paiement='Cash';
	 }
	 else
	 if($type_paiement==2)
	 {$type_paiement='Check';}
	 else 
	 if($type_paiement==3)
	 {$type_paiement='Deposits';}
	 else
	 if($type_paiement==4)
	 {$type_paiement='PayPal';}
	  else
	 if($type_paiement==5	 )
	 {$type_paiement='BankWire';}
	if($type_paiement==6	 )
	 {$type_paiement= 'Credit Card';}
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
$sql="SELECT * FROM tbl_finance_algeria WHERE code_inscription='$code_inscription' AND annee = '$annee'";
$req=mysql_query($sql);
$row=mysql_fetch_assoc($req);
 ?>
<table width="800" align="left" border="0">
	<tr>

    	<td colspan="2" align="left" style="padding-top:25px" valign="top"><img src="../../administrator/images/asl-logo.png" alt="" /></td>
		
    </tr>
   
	<br>
	<tr>
		<td ><span class="bold">Receipt N° : </span><?php echo $recu; ?></td>
		<td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="bold">Student Name: </span><?php echo $name; ?></td>
		
		
    </tr>
	<br/>
    <tr>
		<td colspan="1"><span class="bold">Payment Date: </span><?php  
		$date=$date_paiement;
		$tab=split('[/.-]',$date);
		echo $tab[2].'-'.$tab[1].'-'.$tab[0];//echo $row['date_paiement']; ?></td>
		<td ><span class="bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Payment Type: </span><?php echo $type_paiement; ?></td>
    </tr>
	

	
	<tr height="5">
		<td colspan="1">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4">
		<br />
			<table style="border-collapse:collapse; padding:1px" border="1" cellspacing="1" width="100%">
				<tr>
					<th >Description</th>
				
				
					<th>Amount Paid </th>
				</tr>
				<tr align="center">
					<td align='left'><?php echo $designation;?></td>
					
					<td><?php echo $somme.' '.'US Dollar';?></td>
				</tr>
		  </table>
		</td>
	</tr>
	<tr height="10">
		<td colspan="4">&nbsp;</td>
	</tr>
	
    <tr>
    	<td colspan="4">
		<br /><br /><br />
        	<table width="100%" style="font-size:10px; color:#36C">
              <tr> 
			
			  
                    <td  width="50%" align="center">American School of Leadership,1507 S Hiawassee Rd Suite 114 Orlando, Florida 32835<br />
                                    PH: 407-745-1700    /  
                                    E-MAIL : CONTACT@AMERICANHIGH.US<br />
                                    WEBSITE : WWW.EDU.AMERICANHIGH.US
                    </td>
					  
              </tr>
</table>
	
</div>
</body>
</html>
