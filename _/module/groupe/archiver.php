<?php

  $id=$_GET["archiver"]; 
  
  $sql="update tbl_groupe set archive= 1 WHERE id = '$id'";
  
  
  @mysql_query($sql)or die ("erreur lors d'archivage du groupe");
  
?>
<script type="text/javascript" language="JavaScript1.2">
<!--

window.location.replace('gestion_groupe.php?archive=oui');

//-->
</script>


