<table border="0" width="1000" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/livres.gif" border="0"/></td>
    <td width="78%"  class="titre">&nbsp;GESTION DU SONDAGE </td>
	<td width="22%">
	  <table border="0" align="right" width="40px" cellpadding="10" cellspacing="4" >
	    <tr>
		 <td valign="top" align="center">
		   <a href="gestion_sondage.php?detail=oui" id="lien_msj">
		  <div style="background:top url(images/sylabus.gif) ; width:32; height:34;"></div>Statéstiques</a>
		  </td>
		</tr>
	  </table>
	</td> 
</table>
<table width="999" align="center" cellspacing="1"  class="adminlist">
<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
  <tr>
     <th width="15" align="center">#</th>
	 <th width="15"></th>
	 <th width="150" align="center" nowrap="nowrap">Nom et prénom</th>
	 <th width="100" align="center" >Date de vote</th>
	 <th width="250" align="center">Par quel intermédiaire<br /> vous avez connu ILCS ?</th>
	 <th width="250" align="center">conseil pour faire<br /> connaitre ILCS  </th>
	 <th width="250" align="center">Pourquoi vous avez<br /> choisi ilcs ?</th>

  </tr>
  <?php
$i=0;
$sql = "SELECT s.*, concat(e.nom,' ', e.prenom) as name from tbl_etudiant as e, tbl_sondage as s where s.code_inscription=e.code_inscription";
$req=@mysql_query($sql) or die ("erreur lors de la selection des livres");
 	  while ($ligne = mysql_fetch_array($req)) {
	   $i++;
?>
<tr>
     <td align="center"><?=$i?></td>
	 <td align="center"><input type="radio" id="<?=$ligne["id_sondage"];?>" name="id" value="<?=$ligne["id_sondage"];?>" onClick="document.adminMenu.boxchecked.value=<?=$ligne["id_sondage"];?>" /></td>
	 <td align="center"><?=$ligne["name"]?></td>
	 <td align="center"><?=$ligne["date"]?></td>
	  <td align="center"><?=$ligne["objet"] ? $ligne["objet"] : '-'?></td>
	    <td align="center"><?=($ligne["conseil"]) ? stripslashes($ligne["conseil"]) : '-'?></td>
		 <td align="center"><?=($ligne["choix"]) ? stripslashes($ligne["choix"]) : '-'?></td>
  </tr>
<?php
      }
	  ?>
 </form>
</table>