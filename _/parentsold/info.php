<span id="titre_page">Actualit&eacute;s</span>
<table width="575" border="0"  cellspacing="0" cellpadding="0" align="center" style="margin-top:10px">
<?php
         $sql="select * from $tbl_actualite where archive=0 
		 and  type in('professeur', 'tous') order by date DESC ";
         $total = @mysql_query($sql) or die("erreur lors de sélection des infos");
 		 $url = "professeur.php?task=info&limit=";
 		 $nblignes = mysql_num_rows($total);
 		 $parpage=5;
 		 $nbpages = ceil($nblignes/$parpage);
 		 $result = validlimit($nblignes,$parpage,$sql);
 		 while ($row = mysql_fetch_array($result)) {

?>
 <tr class="entete">
    <th width="80%" align="left">&nbsp;<?=htmlentities(stripslashes(ucfirst($row['titre'])))?></th>
    <th width="20%"><?=htmlentities($row['date'])?></th>
  </tr>
  <tr><td colspan="2" height="3"></td></tr>
  <tr>
    <td colspan="2" align="left"><?=html_entity_decode(stripslashes($row['contenu']))?></td>
  </tr>
<tr ><td colspan="2" height="3"></td></tr>
<?php
}
?>
</table>
  <?php
      echo "<div id='pagination' align='center'>";
      echo pagination($url,$parpage,$nblignes,$nbpages);
      echo "</div>";
  ?>
       
