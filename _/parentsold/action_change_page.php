<?php
if ( (isset($_POST['pass'])) && (!empty($_POST['pass'])) ){
	
	    if(($_POST['pass']==$_POST['pass1']) && ($_SESSION['token']==$_POST['token']) ){
 		
		$pass=md5($_POST['pass']);
		$code_prof=$_SESSION['code_prof'];
				
 		$sql="update $tbl_professeur set  mot_pass='$pass' 
		where code_prof = '$code_prof' limit 1"; 
		
		@mysql_query($sql) or die ("Echec de modification, veuillez contactez l'administration");
		
		?>
		<script language="javascript1.2">
			<!--	
			window.location.replace("professor/logout.php");
			-->
		</script>
		<?php
		                                                   }
		                                                                              }
		                                                                              
		
		?>
