<?php

  $id=$_GET["desarchiver"];

  $sql="update $tbl_admin set archive=0 WHERE id_user='$id'";

  @mysql_query($sql)or die ("erreur lors du désarchivage");

?>

<script type="text/javascript" language="JavaScript1.2">

<!--

window.location.replace('gestion_compte.php');

//-->

</script>