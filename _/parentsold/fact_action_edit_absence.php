<?php
if (isset($_POST['code_absence'])){
  $code_absence=$_POST['code_absence'];
  $new_nombre=(int)$_POST['nombre'];
  $code_cours=$_POST['code_cours'];
  $code_inscription=$_POST['code_inscription'];
  $n_comptabilise=(int)$_POST['n_comptabilise'];
  $n_incomptabilise=(int)$_POST['n_incomptabilise'];
   $nombre=(int)$_POST['nombre'];
   
   
								   
    $sql3="update $tbl_absence set 
        n_comptabilise = $nombre
        where idAbsence = '$code_absence' limit 1";
    
	@mysql_query($sql3) or die("erreur lors de la mise a jour du nombre d'absences");
	
   //mise à jour du nombre d'absence dans table note
   
   
   
     ?>
		 <form name="retour" method="post">
			<input type="hidden" value="edit_absence" name="task" />
			<input type="hidden" name="cours" value="<?=$code_cours?>" />
			<input type="hidden" name="boxchecked" value="<?=$code_inscription?>" />
			<input type="hidden" name="level" value="<?=$_SESSION['level']?>" />
			<input type="hidden" name="token" value="<?=$_SESSION['token']?>" />
		  </form>
	<script language="javascript1.2">
	   document.retour.submit();
	</script>
<?php
 }
 else{
 ?>
		  <form name="retour" method="post">
			<input type="hidden" value="edit_absence" name="task" />
			<input type="hidden" name="cours" value="<?=$code_cours?>" />
			<input type="hidden" name="boxchecked" value="<?=$code_inscription?>" />
			<input type="hidden" name="level" value="<?=$_SESSION['level']?>" />
			<input type="hidden" name="token" value="<?=$_SESSION['token']?>" />
		  </form>
	<script language="javascript1.2">
	  document.retour.submit();
	</script>
<?php
  }
  
  //fermeture test get
   ?> 
