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
<!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />-->
<meta http-equiv="Content-Type" content="html/css; charset=utf-8" />

<title>ADMINISTRATION --GESTION DES ETUDIANTS--</title>

<?php if (!isset($_POST['export'])){ ?>
	<script src="script/prototype.js" language="javascript"></script>
	<script src="script/student.js" language="javascript"></script>
<?php }else{ ?>
	<script src="script/jquery-1.10.2.min.js" language="javascript"></script>
<?php } ?>
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
		include("../module/etudiantacc/modifier.php");
								 }
      else  if(isset($_GET["new"])) {
	  	include("../module/etudiantacc/ajouter.php");
	  								}
	      else  if(isset($_GET["detail"]))  {
		  	include("../module/etudiantacc/detail.php");
		  									}
		  									  else  if(isset($_GET["ild"]))  {
		  	include("../module/etudiantacc/ild.php");
		  									}
		  									else  if(isset($_GET["CLSC"]))  {
		  	include("../module/etudiantacc/CLSC.php");
		  									}
											  else  if(isset($_GET["printb"]))  {
		  	include("../module/etudiantacc/printb.php");
		  									}
		  									 else  if(isset($_GET["printilp"]))  {
		  	include("../module/etudiantacc/printilp.php");
		  									}
		   else  if(isset($_GET["journal"]))  {
		  	include("../module/etudiantacc/accesLog.php");
		  									  }
		  	else  if(isset($_GET["supprimer"]))  {
		  	include("../module/etudiantacc/supprimer.php");
		  									   }
			  else  if(isset($_GET["archiver"]))  {
		  	   include("../module/etudiantacc/archiver.php");
		  									   }
				else  if(isset($_GET["desarchiver"]))  {
		  	   include("../module/etudiantacc/desarchiver.php");
		  									   }
				else  if(isset($_GET["buletin"]))  {
		  			include("../module/etudiantacc/buletin.php");
		  									   }
 else  if(isset($_GET["buletinBachelor"]))  {
		  			include("../module/etudiantacc/buletinBachelor.php");
		  									   }
					else  if(isset($_GET["buletinMaster"]))  {
		  			include("../module/etudiantacc/buletinMaster.php");
		  									   }
				    else  if(isset($_GET["laureat"]))  {
		  			include("../module/etudiantacc/laureat.php");
		  									   }
		  									    else  if(isset($_GET["rejected"]))  {
		  			include("../module/etudiantacc/rejected.php");
		  									   }
											    else  if(isset($_GET["archive"]))  {
		  			include("../module/etudiantacc/archive.php");
		  									   }
					else {
				  	include("../module/etudiantacc/admin.php");
				     }

						 if (isset($_POST['export']) && $_POST['export'] == 1) {
							 			  $file = "students.xls";
											 if(file_exists($file)){
												 chmod($file,0666);
											 }else{
												 touch($file,0666);
											 }
											 // if(file_exists("students.xls") ){
												//  chmod("students.xls",0666);
											 // }
										 }
  ?>
                 </td>
                      </tr>
                           </table>
 			</div>
</div>

</body>
<script src="script/jquery-1.10.2.min.js" language="javascript"></script>
</html>
