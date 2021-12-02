<?php
if (isset($_GET["acces"]) && isset($_GET["user_id"]) ){
  $code_inscription=addslashes($_GET["user_id"]); 
  $acces=(int)$_GET["acces"]; 
  $sql="UPDATE $tbl_etudiant SET acces = $acces WHERE code_inscription = '$code_inscription' LIMIT 1";
  @mysql_query($sql)or die ("Failure to update acces ");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_des_etudiants.php');
//-->
</script>
<?php
}
?>