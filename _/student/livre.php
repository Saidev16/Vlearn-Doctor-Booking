<span id="titre_page">Liste des livres</span>
<table width="575" cellspacing="1" cellpadding="0" align="center" class="adminlist">
    <tr class="entete">
	<td align="center" width="15">#</th>
    <td width="425">&nbsp;Titre</td>
    <td width="100">&nbsp;Cat&eacute;gorie</td>
  </tr>
  <?php
	     $i=0;

	     $sql="SELECT  distinct  l.titre_livre, l.categorie_livre
         FROM $tbl_livre as l, $tbl_empreinte as d  
		 where l.disponibilite=0 order by l.categorie_livre";

         $total = @mysql_query($sql) or die("erreur lors de sélection des livres");
		 $url = "student.php?task=livre&limit=";
		 $nblignes = mysql_num_rows($total);
		 $parpage=15;
		 $nbpages = ceil($nblignes/$parpage);
		 $result = validlimit($nblignes,$parpage,$sql);
		 while ($row = mysql_fetch_array($result)) {
	     $i++;
?>
	<tr height="18px">
	<td align="left" class="bold">&nbsp;<?=$i?></td>
	<td align="left">&nbsp;<?=$row['titre_livre']?></td>
	<td align="left">&nbsp;<?=$row['categorie_livre']?></td>
	</tr>
		 <?php
		 }
		 ?>
	</table>
     <?php
     echo "<div id='pagination' align='center'>";
     echo pagination($url,$parpage,$nblignes,$nbpages);
     echo "</div>";
     ?>
     