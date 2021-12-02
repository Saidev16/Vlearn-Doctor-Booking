<?php
include("secure.php");
include("../include/fonctions.inc.php");
include("../module/api/export_class.php");
?>
<link rel="shortcut icon" href="images/icone.gif" />
<link rel="stylesheet" type="text/css" href="css/global.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/print.css" media="print">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>ADMINISTRATION --GESTION DES ETUDIANTS--</title>
<script src="script/jquery-1.10.2.min.js"></script>
<script src="script/prototype.js" language="javascript"></script>
<script src="script/student.js" language="javascript"></script>
</head>
<body>
<div id="container">
<?php require_once 'includes/main_menu.php' ?>
	<div id="banner">
	Login:
	<?=(isset($_SESSION['admin_login'])) ? $_SESSION['admin_login'] : ''?>&nbsp;&nbsp;&nbsp;&nbsp;
	<br><a href="deconexion.php">Logout</a>&nbsp;&nbsp;&nbsp;
	</div>
			<div id="content">
 				<table border="0" width="1000" cellpadding="0" cellspacing="0" >
      <tr>
         <td valign="top">
   <?php
    if(isset($_GET["modifier"])) {
		include("../module/etudiantgen/modifier.php");
								 }
      else  if(isset($_GET["new"])) {
	  	include("../module/etudiantgen/ajouter.php");
	  								}
	      else  if(isset($_GET["detail"]))  {
		  	include("../module/etudiantgen/detail.php");
		  									}

											  else  if(isset($_GET["printb"]))  {
		  	include("../module/etudiantgen/printb.php");
		  									}
		  									else  if(isset($_GET["ajaxmod"])) {
	  	include("../module/etudiantgen/ajaxmod.php");
	  }
		  									 else  if(isset($_GET["printilp"]))  {
		  	include("../module/etudiantgen/printilp.php");
		  									}
		   else  if(isset($_GET["journal"]))  {
		  	include("../module/etudiantgen/accesLog.php");
		  									  }
		  	else  if(isset($_GET["supprimer"]))  {
		  	include("../module/etudiantgen/supprimer.php");
		  									   }
			  else  if(isset($_GET["archiver"]))  {
		  	   include("../module/etudiantgen/archiver.php");
		  									   }
				else  if(isset($_GET["desarchiver"]))  {
		  	   include("../module/etudiantgen/desarchiver.php");
		  									   }
				else  if(isset($_GET["buletin"]))  {
		  			include("../module/etudiantgen/buletin.php");
		  									   }
 else  if(isset($_GET["buletinBachelor"]))  {
		  			include("../module/etudiantgen/buletinBachelor.php");
		  									   }
					else  if(isset($_GET["buletinMaster"]))  {
		  			include("../module/etudiantgen/buletinMaster.php");
		  									   }
				    else  if(isset($_GET["laureat"]))  {
		  			include("../module/etudiantgen/laureat.php");
		  									   }
		  									   else  if(isset($_GET["ajaxmod"])) {
	  	include("../module/etudiantgen/ajaxmod.php");
	  }
		  									    else  if(isset($_GET["rejected"]))  {
		  			include("../module/etudiantgen/rejected.php");
		  									   }
											    else  if(isset($_GET["archive"]))  {
		  			include("../module/etudiantgen/archive.php");
		  									   }
					else {
				  	include("../module/etudiantgen/admin.php");
				     }
				      if (isset($_POST['export']) && $_POST['export'] == 1) {
											 $file = "students1.xls";
											 if(file_exists($file)){
												 chmod($file,0606);
											 }else{
												 touch($file,0606);
											 }
											 if(file_exists("students1.xls") ){
												 chmod("students1.xls",0606);
											 }
										 }

  ?>
                 </td>
                      </tr>
                           </table>
 			</div>
</div>

</body>
</html>
