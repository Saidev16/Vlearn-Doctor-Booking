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
		include("../module/etudiantalgeria/modifier.php");
								 }
      else  if(isset($_GET["new"])) {
	  	include("../module/etudiantalgeria/ajouter.php");
	  								}
	      else  if(isset($_GET["detail"]))  {
		  	include("../module/etudiantalgeria/detail.php");
		  									}
											  else  if(isset($_GET["printb"]))  {
		  	include("../module/etudiantalgeria/printb.php");
		  									}
		  									else  if(isset($_GET["printO"]))  {
		  	include("../module/etudiantalgeria/printO.php");
		  									}
		  									else  if(isset($_GET["ajaxmod"])) {
	  	include("../module/etudiantalgeria/ajaxmod.php");
	  }
		   else  if(isset($_GET["journal"]))  {
		  	include("../module/etudiantalgeria/accesLog.php");
		  									  }
		  	else  if(isset($_GET["supprimer"]))  {
		  	include("../module/etudiantalgeria/supprimer.php");
		  									   }
			  else  if(isset($_GET["archiver"]))  {
		  	   include("../module/etudiantalgeria/archiver.php");
		  									   }
				else  if(isset($_GET["desarchiver"]))  {
		  	   include("../module/etudiantalgeria/desarchiver.php");
		  									   }
				else  if(isset($_GET["buletin"]))  {
		  			include("../module/etudiantalgeria/buletin.php");
		  									   }
 else  if(isset($_GET["buletinBachelor"]))  {
		  			include("../module/etudiantalgeria/buletinBachelor.php");
		  									   }					
					else  if(isset($_GET["buletinMaster"]))  {
		  			include("../module/etudiantalgeria/buletinMaster.php");
		  									   }
				    else  if(isset($_GET["laureat"]))  {
		  			include("../module/etudiantalgeria/laureat.php");
		  									   }
											    else  if(isset($_GET["archive"]))  {
		  			include("../module/etudiantalgeria/archive.php");
		  									   }
					else {                                
				  	include("../module/etudiantalgeria/admin.php");
				     }
  ?>
                 </td>
                      </tr>
                           </table>
 			</div>
</div>

</body>
</html>