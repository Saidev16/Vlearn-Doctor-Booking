<span id="titre_page">Situation finaci&egrave;re</span>
<div id="contenu">
<?php
if (isset($_SESSION['code_etudiant'])){
   $code_etudiant=(int)$_SESSION['code_etudiant'];
   $sql="SELECT * FROM $tbl_finance  WHERE code_inscription = $code_etudiant ";
   $req=mysql_query($sql) or die("erreur lors de la sélection de la situation financière");
  ?>
  <table width="575" border="0" cellspacing="1" cellpadding="0" class="adminlist">
  <tr class="entete">
    <td>&nbsp;Ann&eacute;e</td>
	<td>&nbsp;Frais d'inscription</td>
	<td>&nbsp;Frais de scolarit&eacute;</td>
    <td>&nbsp;Bourse</td>
	<td>&nbsp;Paye&eacute;</td>
    <td>&nbsp;Reste</td>
  </tr>
  <?php
  while ($row=mysql_fetch_assoc($req)){
  ?>
  <tr>
       <td align="center">&nbsp;<?=$row['annee']?></td>
       <td align="center">&nbsp;<?=number_format($row["assurance"])?></td>
       <td align="center">&nbsp;<?=number_format($row["frais_etude"])?></td>
   	   <td align="center">&nbsp;<?=number_format($row["bourse"])?></td>
       <td align="center">&nbsp;<?=number_format($row["payee"])?></td>
   	   <td align="center">&nbsp;<?=number_format($row["reste"])?></td>
  </tr>
  <?php
  }
  ?>
</table>
	<?php
	}
	?>

    