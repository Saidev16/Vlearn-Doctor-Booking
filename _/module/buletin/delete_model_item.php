<?php
  $id_buletin=(int)$_GET["delete_model_item"];
  $sql="delete from $tbl_buletin  where id_buletin='$id_buletin' limit 1";
  @mysql_query($sql) or die("erreur lors de l'archivage du cours dans le modèle du buletin");
      
            ?>
           <script type="text/javascript" language="JavaScript1.2">
			<!--
					window.location.replace('gestion_des_buletins.php?buletin_model=default');
			//-->
			</script>
