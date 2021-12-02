<?php
  $id=$_GET["archiver"]; 
  $type=$_SESSION['type_menu'];
        
           $sql="update $tbl_menu set archive= 1 WHERE id = '$id'";
		   $sql1="update $tbl_menu_statistic set archive = archive+1 where type='$type'";
 	                         
	   
   @mysql_query($sql)or die ("erreur lors de l'archivage du menu");
   @mysql_query($sql1)or die ("erreur lors de la mise à jour du nombre de menu archivé");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_menu.php?archive=oui');
//-->
</script>
