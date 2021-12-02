<?php
include("../include/fonctions.inc.php");
?>
<table border="0" width="1000" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/etudiants.gif" border="0"/></td>
    <td width="78%"  class="titre">&nbsp;GESTION DES SITUATIONS FINANCIERES <span style="font-size:12px">[archive]</span></td>
	<td width="22%">
	  <table border="0" align="right" width="20%" cellpadding="10" cellspacing="4" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="gestion_situation.php" id="lien_msj">
		   <div style="background:top url(images/retour.gif); width:32; height:34;"></div>
		   Retour</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>
<table width="999px" align="center" cellspacing="1" border="0"  class="adminlist">
<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
  <tr style="text-align:center">
     <th>#</th>
	 <th></th>
	 <th>Nom et prénom</th>
	 <th>Réplicat</th>
     <th>Frais E.D</th>
	 <th>Date</th>
	 <th>Frais I</th>
	 <th>Date</th>
	 <th>Chèque</th>
	 <th>Date</th>
	 <th>Espèce</th>
	 <th>Date</th>
	 <th>Reste</th>
  </tr>
  <?php
     $i=0;
	  $sql = "SELECT distinct s.*, concat(e.nom,' ', e.prenom) as name FROM $tbl_situation_financiere as s , $tbl_etudiant as e where s.code_inscription=e.code_inscription and archive= 1"; 
     $total = mysql_query($sql) or die ("erreur lors de la sélection "); 
	 $url = $_SERVER['PHP_SELF']."?limit=";
     $nblignes = mysql_num_rows($total);
	 $parpage=25;
     $nbpages = ceil($nblignes/$parpage);
     $result = validlimit($nblignes,$parpage,$sql);
 	  while ($ligne = mysql_fetch_array($result)) {
	   $i++;
	   ?>
<tr style="vertical-align:top; text-align:center">
     <td><?=$i?></td>
	 <td><input type="radio" id="<?=$ligne["code_inscription"]?>" name="id" value="<?=$ligne["code_inscription"];?>" onClick="document.adminMenu.boxchecked.value=<?=$ligne["code_inscription"];?>" /></td>
	 <td align="left"><?=$ligne["name"]?></td>
	 <td>&nbsp;<?=$ligne["replicat"]?></td>
     <td>&nbsp;<?=$ligne["frais_etude_dossier"]?></td>
     <td>&nbsp;<?=$ligne["f_date"]?></td>
	 <td>&nbsp;<?=$ligne["frais_inscription"]?></td>
     <td>&nbsp;<?=$ligne["f_i_date"]?></td>
	 <td>&nbsp;<?=$ligne["cheque"]?></td>
	 <td>&nbsp;<?=$ligne["cheque_date"]?></td>
     <td>&nbsp;<?=$ligne["espece"]?></td>
	 <td>&nbsp;<?=$ligne["espece_date"]?></td>
	 <td>&nbsp;<?=$ligne["reste"]?></td>
  </tr>
<?php
      }
?>
</form>
 </table>
  <?php
     echo "<div id='pagination' align='center'>";
     echo pagination($url,$parpage,$nblignes,$nbpages);
     echo "</div>";
	 ?>


