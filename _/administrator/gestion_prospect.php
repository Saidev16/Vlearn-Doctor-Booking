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

<title>ADMINISTRATION --GESTION DES PR0SPECTS--</title>
<script src="script/prototype.js" language="javascript"></script>
<script src="script/student.js" language="javascript"></script>
</head>
<body>
<div id="container">
<?php require_once 'includes/main_menu.php' ?>
	<div id="banner">
	Login:
	<?=(isset($_SESSION['admin_login'])) ? $_SESSION['admin_login'] : ''?>&nbsp;&nbsp;&nbsp;&nbsp;
	<br><a href="deconexion.php">Déconnexion</a>&nbsp;&nbsp;&nbsp;
	</div>
			<div id="content">
 				<table border="0" width="1000" cellpadding="0" cellspacing="0" >
      <tr>
         <td valign="top">
  <?php
    if(isset($_GET["modifier"])) {
		include("../module/prospect/modifier.php");
								 }
      else  if(isset($_GET["new"])) {
	  	include("../module/prospect/ajouter.php");
	  								}
									 else  if(isset($_GET["preinscri"])) {
	  	include("../module/prospect/vers_preinscription.php");
	  								}
									else  if(isset($_GET["detail"]))  {
		  	include("../module/prospect/detail.php");
		  									}
	     
		    
					else {                                
				  	include("../module/prospect/admin.php");
				     }
  ?>
                 </td>
                      </tr>
                           </table>
 			</div>
</div>

</body>
</html>