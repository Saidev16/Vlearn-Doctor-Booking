<?php
  $code_inscription=$_GET["supprimer"]; 
  $sql="select code_inscription, code_cours from tbl_inscription_cours where id='$code_inscription'";
  $req=@mysql_query($sql) or die ("erreur lors de la sélection");
  $row=mysql_fetch_assoc($req);
  $code_inscription=$row['code_inscription'];
  $code_cours=$row['code_cours'];
  $sql1="delete from $tbl_inscription_cours  WHERE code_cours='$code_cours' and code_inscription='$code_inscription'";
  @mysql_query($sql1)or die ("erreur lors de supression de l'inscription");
  $sql2="delete from $tbl_note  WHERE code_cours='$code_cours' and code_inscription='$code_inscription'";
  @mysql_query($sql2) or die ("erreur lors de la supression de la note");
  $sql3="delete from $tbl_absence  WHERE code_cours='$code_cours' and code_inscription='$code_inscription'";
  @mysql_query($sql3) or die ("erreur lors de la supression de de l'absence");
  $s_session=$_SESSION['session'];
  if($s_session=='printemps'){
  $sql4="update $tbl_inscription_session set inscript_printemps=inscript_printemps-1 where code_cours='$code_cours'";
  mysql_query($sql4);
  }
  else if ($s_session=='automne'){
  $sql4="update $tbl_inscription_session set inscrit_automne=inscrit_automne-1 where code_cours='$code_cours'";
  mysql_query($sql4);
  }
  
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_inscription.php');
//-->
</script>


