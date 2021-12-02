<?php

  $id=(int)$_GET["desarchiver"]; 
  $sql="update tbl_jours set archive= 0 WHERE code_jours = '$id'";
  @mysql_query($sql)or die ("erreur lors du désarchivage du jours");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_jours.php');
//-->
</script>
