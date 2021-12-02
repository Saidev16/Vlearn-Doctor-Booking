<span id="titre_page">R&egrave;glement int&eacute;rieur</span>
<?php
		 $sql="SELECT * from tbl_reglement where type='etudiant'";
         $total=@mysql_query($sql) or die("erreur lors du chargement du règlement intérieur");
  		 $url = "student.php?task=reglement&limit=";
 		 $nblignes = mysql_num_rows($total);
 		 $parpage=1;
 		 $nbpages = ceil($nblignes/$parpage);
 		 $result = validlimit($nblignes,$parpage,$sql);

?>
<table width="575" cellspacing="2" cellpadding="0"  border="0" style="text-align:left; margin-top:10px">
<?php
while($row=mysql_fetch_assoc($result)){
?>
  <tr>
    <td height="15">&nbsp;<?=html_entity_decode(stripslashes($row['reglement']))?></td>
  </tr>
  <?php
  }
  ?>
</table>
<div id="pagination" align="center">
   <?php
      echo pagination($url,$parpage,$nblignes,$nbpages);
      ?>
      </div>