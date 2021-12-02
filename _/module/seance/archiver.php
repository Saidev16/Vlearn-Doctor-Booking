<?php
  $code_seance=(int)$_GET["archiver"]; 
  
  $sql="select code_cours, idSession from $tbl_seance where code_seance=$code_seance limit 1";
  $req=@mysql_query($sql)or die ("erreur lors de la sélection du code cours");
  $row=mysql_fetch_assoc($req);
  
  $code_cours=$row['code_cours'];
  $idSession=$row['idSession'];
  
  $sql1="update $tbl_seance set archive= 1 WHERE code_seance= '$code_seance'  limit 1";
  @mysql_query($sql1)or die ("erreur lors de l'archivage du séance  du cours");
  
  $sql2="update $tbl_syllabus set archive= 1 WHERE code_cours= '$code_cours' 
  and idSession='$idSession' limit 13";
  @mysql_query($sql2)or die ("erreur lors de l'archivage du syllabus  du cours");
  
  $sql3="update $tbl_descriptif set archive= 1 WHERE code_cours= '$code_cours'
  and idSession='$idSession' limit 1";
  @mysql_query($sql3)or die ("erreur lors de l'archivage du déscriptif  du cours");
  
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_seance.php?archive=oui');
//-->
</script>


