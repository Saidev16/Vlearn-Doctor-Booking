<span id="titre_page">Offres:d'emploi et stage</span><br />

 <table width="570" border="0" align="center" cellspacing="0" cellpadding="0">
  <?php

         $sql="SELECT * FROM $tbl_offre_emploi ORDER BY created_on DESC ";
			   

         $total = @mysql_query($sql) or die("erreur lors de la sélection des offres d'emploi");
		 $url = "student.php?task=offre&limit=";
		 $nblignes = mysql_num_rows($total);
		 $parpage=5;
		 $nbpages = ceil($nblignes/$parpage);
		 $result = validlimit($nblignes,$parpage,$sql);

		 while ($row = mysql_fetch_array($result)) {
  ?>
   <tr class="entete">
		<th width="80%" align="left">&nbsp;<?=htmlentities(stripslashes(ucfirst($row['title'])))?></th>
		<th width="20%"><?=htmlentities($row['created_on'])?></th>
   </tr>
   <tr >
        <td colspan="2" height="3"></td>
  </tr>
  <tr>
       <td colspan="2" align="left"><?=html_entity_decode(stripslashes($row['body']))?></td>
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
     
