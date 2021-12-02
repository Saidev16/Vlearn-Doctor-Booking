<?php
  $id=(int)$_GET["archiver"];
  // vérifier si la session a des inscriptions
  $sql = "SELECT * FROM $tbl_inscription_cours WHERE idSession = $id LIMIT 1";
  $req = @mysql_query($sql);
  if (mysql_num_rows($req) == 0){
  $sql="update $tbl_session set archive= 0 WHERE idSession = '$id' LIMIT 1";
  @mysql_query($sql)or die ("erreur lors de la mise en archive de la session ");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_session.php');
//-->
</script>
<?php 
}
else {
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
alert('Impossible de supprimer cette session');
window.location.replace('gestion_session.php');
//-->
</script>
<?php
}
?>


