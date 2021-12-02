<?php

   $id=$_GET["archiver"];





  $sql="update  tbl_docman set archive ='1' WHERE id= '$id'";



  @mysql_query($sql)or die ("erreur lors de l'archivage du document");



?>

<script type="text/javascript" language="JavaScript1.2">

<!--

window.location.replace('gestion_document.php');

//-->

</script>



