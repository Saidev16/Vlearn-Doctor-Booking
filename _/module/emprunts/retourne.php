<?php
  $id=$_GET["retourne"]; 
  $sql="update $tbl_empreinte set retourne= 0 WHERE code_emprunt= '$id'";
  @mysql_query($sql)or die ("erreur");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_livres.php');
//-->
</script>
