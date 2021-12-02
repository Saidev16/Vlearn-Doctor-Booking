<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/livres.gif" border="0"/></td>
    <td width="78%"  class="titre">&nbsp;GESTION DES EMPRUNTS  <span style="font-size:12px">[archive]</span></td>
	<td width="22%">
	  <table border="0" align="right" width="20%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		 <td valign="top" align="center">
		   <a href="gestion_livres.php"><div class="retour"></div>Retour</a>
		  
		  </td>
		</tr>
	  </table>
	</td> 
</table>
<table width="100%" align="center" cellspacing="1"  class="adminlist">
<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
  <tr>
     <th width="25" align="center">#</th>
	 <th width="25"></th>
	 <th>Titre du livre</th>
	 <th>Date d'emprunt</th>
	 <th>Date de retour</th>
	 <th>Etudiant</th>
	 <th>Enseignant</th>
  </tr>
  <?php
$i=0;
$sql = "SELECT distinct em.code_emprunt, l.titre_livre, em.date_empreint,em.date_retour, em.code_inscription, em.code_prof
FROM  tbl_empreinte AS em, tbl_livre AS l
WHERE em.code_livre = l.code_livre and retourne= 0";
     $total = @mysql_query($sql) or die($sql); 
	 $url = $_SERVER['PHP_SELF']."?limit=";
     $nblignes = mysql_num_rows($total);
	 $parpage=25;
     $nbpages = ceil($nblignes/$parpage);
     $result = validlimit($nblignes,$parpage,$sql);
 	  while ($ligne = mysql_fetch_array($result)) {
	   $i++;
?>
<tr>
     <td align="center"><?=$i?></td>
	 <td align="center"><input type="radio" id="<?=$ligne["code_empreinte"];?>" name="id" value="<?=$ligne["code_empreinte"];?>" onClick="document.adminMenu.boxchecked.value=<?=$ligne["code_empreinte"];?>" /></td>
	 <td align="center"><?=$ligne["titre_livre"]?></td>
	 <td align="center"><?=$ligne["date_empreint"]?></td>
	  <td align="center"><?=$ligne["date_retour"]?></td>
	  <td align="center">&nbsp;<?=$ligne["code_inscription"]?></td>
	 <td align="center">&nbsp;<?=$ligne["code_prof"]?></td>
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

