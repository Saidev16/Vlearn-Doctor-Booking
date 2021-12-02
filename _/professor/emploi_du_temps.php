<span id="titre_page">Emploi du temps</span>
<br>
<?php
$sql="select * from $tbl_titre_emploi where archive= 0";
 
$req=@mysql_query($sql) or die ("erreur lors de la selection des titres");

 	  while ($ligne = mysql_fetch_array($req)) {
	    
           ?>
<span id="list1"><a href="professeur.php?task=contentEmploi&idCleEmploi=<?=$ligne["idCleEmploi"]?>"><?=$ligne["titre"];?></a></span>
	
 <?php
                                                    }
  ?>
		  