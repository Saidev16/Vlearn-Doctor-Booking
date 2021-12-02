<?php

   $id=(int)$_GET["supprimer"]; 

  $sql="update $tbl_livre set archive =1 WHERE code_livre = $id";

  @mysql_query($sql)or die ("erreur lors de l'archivage du livre");

?>

<script type="text/javascript" language="JavaScript1.2">

<!--

window.location.replace('gestion_bibliotheque.php');

//-->

</script>

<?php

