<?php

  $id=$_GET["supprimer"]; 
  $sql="UPDATE $tbl_professeur SET archive = 1 WHERE code_prof  = '$id' LIMIT 1";
  @mysql_query($sql)or die ("unable to delete student");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_enseignants.php');
//-->
</script>



