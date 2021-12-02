<?php
  $id=(int)$_GET["supprimer"]; 
  $sql="select code_cours, idSession from $tbl_cours_inscription where id=$id ";
  $req=@mysql_query($sql) or die("erreur lors de la selection");
  $row=mysql_fetch_assoc($req); 
  $code_cours=$row['code_cours'];
  $idSession=$row['idSession'];
  
  //suppression cours activé
  $sql1="delete from $tbl_cours_inscription where code_cours='$code_cours' and idSession='$idSession' limit 1";
  @mysql_query($sql1) or die('erreur lors de la suppression du cours active');
  //suppression seance
  
  $sql2="delete from $tbl_seance where code_cours='$code_cours' and idSession='$idSession' limit 1";
  @mysql_query($sql2) or die('erreur lors de la suppression du seance');
  //suppression syllabus
  
  $sql3="delete from $tbl_syllabus where code_cours='$code_cours' and idSession='$idSession' limit 13";
  @mysql_query($sql3) or die('erreur lors de la suppression du syllabus');
  //suppression descriptif
  
  $sql4="delete from $tbl_descriptif where code_cours='$code_cours' and idSession='$idSession' limit 1";
  @mysql_query($sql4) or die('erreur lors de la suppression du déscriptif');
              ?>
           <script type="text/javascript" language="JavaScript1.2">
			<!--
					window.location.replace('activation_cours.php');
			//-->
			</script>