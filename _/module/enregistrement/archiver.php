<?php

   $id=$_GET["archiver"];





  $sql="update  $tbl_document set groupe ='archive' WHERE id= '$id'";



  @mysql_query($sql)or die ("erreur lors de l'archivage du document");



?>

<script type="text/javascript" language="JavaScript1.2">

<!--

window.location.replace('gestion_enregistrement.php?archive=<?=$_SESSION['parametre']?>');

//-->

</script>



