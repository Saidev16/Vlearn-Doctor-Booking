<?php
if (isset($_POST['boxchecked'])){
$code_absence=(int)$_POST["boxchecked"];
$code_cours=$_POST["cours"];
 // selectionner nombre d'absence
$sql="update $tbl_absence set n_comptabilise=0, n_incomptabilise=0, jeton='' where idAbsence='$code_absence' LIMIT 1";
@mysql_query($sql) or die ("erreur lors de la suppression des absences");

$sql="select code_inscription from $tbl_absence where idAbsence='$code_absence'";
$res=@mysql_query($sql) or die('erreur de selection du code_inscription');
$row=@mysql_fetch_assoc($res);
$code_inscription=$row['code_inscription'];
?>
    <form name="retour" method="post" action="">
		<input type="hidden" value="edit_absence" name="task" />
 		<input type="hidden" name="boxchecked" value="<?=$code_inscription?>" />
		<input type="hidden" name="cours" value="<?=$code_cours?>" />
		<input type="hidden" name="token" value="<?=$_SESSION['token']?>" />
	 </form>
	
	  <script language="javascript1.2">
	     document.retour.submit();
	  </script>
<?php
 }
?>
