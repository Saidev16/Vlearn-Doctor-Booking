<span id="titre_page"></span><br />
<table width="570" border="0" align="center" cellspacing="0" cellpadding="0">
  <?php

         $sql="select titre, contenu, date from $tbl_actualite 
		       where type in('etudiant', 'tous') 
			   and archive=2
			   order by date desc ";

         $total = @mysql_query($sql) or die("erreur lors de s�lection des �tudiants");
		 $url = "student.php?task=info&limit=";
		 $nblignes = mysql_num_rows($total);
		 $parpage=5;
		 $nbpages = ceil($nblignes/$parpage);
		 $result = validlimit($nblignes,$parpage,$sql);

		 while ($row = mysql_fetch_array($result)) {
  ?>
   <tr class="entete">
		<th width="80%" align="left">&nbsp;<?=htmlentities(stripslashes(ucfirst($row['titre'])))?></th>
		<!--<th width="20%"><?=htmlentities($row['date'])?></th>-->
   </tr>
   <tr >
        <td colspan="2" height="3"></td>
  </tr>
  <tr>
       <td colspan="2" align="left"><?=html_entity_decode(stripslashes($row['contenu']))?></td>
  </tr>
  <tr >
       <td colspan="2" height="8"></td>
  </tr>
	<?php
	}
	?>
</table>

     <?php
     echo "<div id=\"pagination\" align=\"center\">";
     echo pagination($url,$parpage,$nblignes,$nbpages);
     echo "</div>";
     ?>
     
