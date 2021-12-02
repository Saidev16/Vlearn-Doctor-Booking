<?php

  $id=$_GET["desarchiver"]; 
  $sql="update $tbl_cv set archive= 0 WHERE id= '$id'";
  @mysql_query($sql)or die ("erreur lors du désarchivage du cv");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_cv.php');
//-->
</script>
