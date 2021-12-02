<?php
 
  $id=$_GET["supprimer"]; 
  $sql="UPDATE $tbl_absence SET n_comptabilise=0 , n_incomptabilise= 0 WHERE idAbsence = '$id' LIMIT 1";
  @mysql_query($sql)or die ("absence error in delete action");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.history.go(-1);
//-->
</script>


