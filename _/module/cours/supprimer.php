<?php
  $code_cours=str_replace('-and-',"&",$_GET["archiver"]);
  $sql="select * from $tbl_inscription_cours where code_cours='$code_cours' ";
  $req=@mysql_query($sql) or die("erreur lors de la vérification des inscription dans ce cours");
       if(mysql_num_rows($req)){
            ?>
           <script type="text/javascript" language="JavaScript1.2">
			<!--
                    alert("vous ne pouvez pas supprimer ce cours car il a des inscrits");
					window.location.replace('gestion_cours.php');
			//-->
			</script>
            <?php
     }
      else{
  $sql1="update $tbl_cours set archive= 1 WHERE code_cours = '$code_cours'";
  @mysql_query($sql1)or die ("erreur lors de l'archivage du cours");
?>
<script type="text/javascript" language="JavaScript1.2">
<!--
window.location.replace('gestion_cours.php?archive=oui');
//-->
</script>
     <?php
     }
     ?>