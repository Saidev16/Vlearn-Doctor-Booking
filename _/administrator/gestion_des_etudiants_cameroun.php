<?php 
include("secure.php");
include("../include/fonctions.inc.php");
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
		include("../module/etudiantcameroun/modifier.php");
								 }
      else  if(isset($_GET["new"])) {
	  	include("../module/etudiantcameroun/ajouter.php");
	  								}
	      else  if(isset($_GET["detail"]))  {
		  	include("../module/etudiantcameroun/detail.php");
		  									}
											  else  if(isset($_GET["printb"]))  {
		  	include("../module/etudiantcameroun/printb.php");
		  									}
		  									else  if(isset($_GET["printO"]))  {
		  	include("../module/etudiantcameroun/printO.php");
		  									}
		  									else  if(isset($_GET["ajaxmod"])) {
	  	include("../module/etudiantcameroun/ajaxmod.php");
	  }
		   else  if(isset($_GET["journal"]))  {
		  	include("../module/etudiantcameroun/accesLog.php");
		  									  }
		  	else  if(isset($_GET["supprimer"]))  {
		  	include("../module/etudiantcameroun/supprimer.php");
		  									   }
			  else  if(isset($_GET["archiver"]))  {
		  	   include("../module/etudiantcameroun/archiver.php");
		  									   }
				else  if(isset($_GET["desarchiver"]))  {
		  	   include("../module/etudiantcameroun/desarchiver.php");
		  									   }
				else  if(isset($_GET["buletin"]))  {
		  			include("../module/etudiantcameroun/buletin.php");
		  									   }
 else  if(isset($_GET["buletinBachelor"]))  {
		  			include("../module/etudiantcameroun/buletinBachelor.php");
		  									   }					
					else  if(isset($_GET["buletinMaster"]))  {
		  			include("../module/etudiantcameroun/buletinMaster.php");
		  									   }
				    else  if(isset($_GET["acces"]))  {
		  			include("../module/etudiantcameroun/acces.php");
		  									   }
		  									    else  if(isset($_GET["laureat"]))  {
		  			include("../module/etudiantcameroun/laureat.php");
		  									   }
											    else  if(isset($_GET["archive"]))  {
		  			include("../module/etudiantcameroun/archive.php");
		  									   }
					else {                                
				  	include("../module/etudiantcameroun/admin.php");
				     }
  ?>
                 </td>
                      </tr>
                           </table>
 			</div>
</div>

</body>
</html>