<?php

   $id=$_GET["unarchive"];





  $sql="update  $tbl_document set groupe ='document' WHERE id= '$id'";



  @mysql_query($sql)or die ("erreur lors du désarchivage du document");



?>

<script type="text/javascript" language="JavaScript1.2">

<!--

window.location.replace('gestion_document.php?option=<?=$_SESSION['parametre']?>');

//-->

</script>



