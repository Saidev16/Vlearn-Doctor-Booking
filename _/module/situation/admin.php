<?php
include("../include/fonctions.inc.php");
?>
<table border="0" width="1000" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/etudiants.gif" border="0"/></td>
    <td width="78%"  class="titre">&nbsp;GESTION DES SITUATIONS FINANCIERES </td>
	<td width="22%">
	</td> 
  </tr>
</table>
 
 <table width="999px" align="center" cellspacing="1" border="0"  class="adminlist">
<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
   
  <tr style="text-align:center">
     <th>#</th>
	 <th>Nom et prénom</th>
	 <th>Filière</th>
     <th>Année</th>
	 <th>Droit exigible</th>
  </tr>
  <?php
     $i=0;
	 $sql = "SELECT  c.code_inscription, c.droit_exigible, concat(e.nom,' ', e.prenom) as name, e.annee, e.filiere 
	 FROM tbl_compta as c , $tbl_etudiant as e 
	 where  c.code_inscription = e.code_inscription "; 
     $total = mysql_query($sql) or die ("erreur lors de la sélection des situations financère "); 
	 $url = $_SERVER['PHP_SELF']."?limit=";
     $nblignes = mysql_num_rows($total);
	 $parpage=25;
     $nbpages = ceil($nblignes/$parpage);
     $result = validlimit($nblignes,$parpage,$sql);
 	  while ($ligne = mysql_fetch_array($result)) {
	   $i++;
	   ?>
  <tr style="vertical-align:middle; text-align:center">
     <td><?=$i?></td>
	 <td align="left"><a href="gestion_situation?code_inscription=<?=$ligne['code_inscription']?>" id="lien_msj">
	 <?=$ligne["name"]?></a></td>
	 <td align="left">&nbsp;<?=htmlentities($ligne["filiere"])?></td>
     <td align="left">&nbsp;<?=htmlentities($ligne["annee"])?></td>
	 <td align="left">&nbsp;<?=htmlentities($ligne['droit_exigible'])?></td>
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

