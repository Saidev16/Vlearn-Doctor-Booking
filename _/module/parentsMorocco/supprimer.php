<?php

  $id=$_GET["supprimer"]; 
  $sql="UPDATE tbl_parents SET archive = 1 WHERE code_parent  = '$id' LIMIT 1";
  @mysql_query($sql)or die ("unable to delete student");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('parents.php');
//-->
</script>



