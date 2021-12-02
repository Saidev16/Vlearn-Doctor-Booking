<?php

  $id=$_GET["archiver"];

  $sql="update tbl_admin set archive=1 WHERE id='$id'";

  @mysql_query($sql)or die ("erreur lors de l'archivage1");

?>

<script type="text/javascript" language="JavaScript1.2">



window.location.replace('gestion_compte.php?archive=oui');



</script>

