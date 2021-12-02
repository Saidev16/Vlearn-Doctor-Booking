<?php

  $id=$_GET["desarchiver"]; 
  $sql="update $tbl_employeur set archive= 0 WHERE idEmployeur= '$id'";
  @mysql_query($sql)or die ("erreur lors du désarchivage de cet employeur ");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_employeur.php');
//-->
</script>
