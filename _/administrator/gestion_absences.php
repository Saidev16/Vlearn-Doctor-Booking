<?php include("secure.php");?>
<link rel="shortcut icon" href="images/icone.gif" />
<link rel="stylesheet" type="text/css" href="css/global.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="javascript1.2" src="script/prototype.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>ADMINISTRATION --GESTION DES ABSENCES --</title>
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
				<table  width="100%"  border="0" cellpadding="0" cellspacing="0" height="100%" >
<tr>
  <td valign="top" >
   <?php
    if(isset($_GET["code_inscription"]))    
	{ include("../module/absences/absence_par_etudiant.php"); 	}
       else if(isset($_GET["modifier"]))     
	   {	include("../module/absences/modifier.php");}
		else if(isset($_GET["new"]))     
	   {	include("../module/absences/ajouter.php");}
	   else if(isset($_GET["supprimer"]))     
	   {	include("../module/absences/supprimer.php");}
	     else if(isset($_GET["code_cours"])) 
		 {include("../module/absences/absence_par_cours.php"); 	}
           else                             
		    { include("../module/absences/admin.php"); }
  ?>
  </td>
</tr>
</table>
			</div>
</div>
</body>
</html>