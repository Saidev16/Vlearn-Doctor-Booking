<?php

  $id=$_GET["desarchiver"]; 
  $sql="update tbl_groupe set archive= 0 WHERE id = '$id'";
  @mysql_query($sql)or die ("erreur lors du désarchivage du groupe");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_groupe.php');
//-->
</script>
