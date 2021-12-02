			<?php
			if(isset($_GET['publie'])){
			$publie=$_GET['publie'];
			$type=$_SESSION['type_menu'];
			$id=$_GET['menuid'];
   	                        
       
			if($publie==0){
 			$sql="update $tbl_menu set publie=1 where id='$id'";
			$sql1="update $tbl_menu_statistic set publie=publie-1, 
			depublie=depublie+1 
			where type='$type'";
			}
			else if ($publie==1){
 			$sql="update $tbl_menu set publie=0 where id='$id'";
			$sql1="update $tbl_menu_statistic 
			set publie=publie+1, 
			depublie=depublie-1 
			where type='$type'";
			}

  
			@mysql_query($sql) or die('erreur lors de la mise à jour du menu');
			@mysql_query($sql1) or die("erreur lors de la mise à jour du nombre de menu publie");
			
			?>
			<script language="javascript1.2">
			window.location.replace('gestion_menu.php?type=<?=$type?>');
			</script>
			<?php
			}
			?>