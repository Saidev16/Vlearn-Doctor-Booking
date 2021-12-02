<?php
  $code_cours=str_replace('-and-',"&",$_GET["desarchiver"]); 
  $sql="update $tbl_cours set archive= 0 WHERE code_cours = '$code_cours'";
  @mysql_query($sql) or die ("erreur lors du désarchivage du cours ");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_cours.php');
//-->
</script>

