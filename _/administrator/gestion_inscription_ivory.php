<?php
include("secure.php");
?>
<link rel="shortcut icon" href="images/icone.gif" />
<link rel="stylesheet" type="text/css" href="css/global.css">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />-->
<meta http-equiv="Content-Type" content="html/css; charset=utf-8" />

<title>ADMINISTRATION --GESTION DES inscriptionsivory --</title>
<script language="javascript1.2" src="script/prototype.js"></script>
</head>
<body>
<div id="container">
<?php require 'includes/main_menu.php'; ?>
	<div id="banner">
	Login:
	<?=(isset($_SESSION['admin_login'])) ? $_SESSION['admin_login'] : ''?>&nbsp;&nbsp;&nbsp;&nbsp;
	<br><a href="deconexion.php">D�connexion</a>&nbsp;&nbsp;&nbsp;
	</div>
 			<div id="content">
				<table  width="100%"  border="0" cellpadding="0" cellspacing="0" height="100%" >

<tr>
  <td valign="top" >
   <?php
  
    if(isset($_GET["new"]))
    {
	include("../module/inscriptionsivory/ajouter.php");
	}
	else  if(isset($_GET["full_add"]))
    {
	include("../module/inscriptionsivory/full_add.php");
	}
	else  if(isset($_GET["full_addc"]))
    {
	include("../module/inscriptionsivory/full_addc.php");
	}
	else  if(isset($_GET["full_addT"]))
    {
	include("../module/inscriptionsivory/full_addT.php");
	}
    else  if(isset($_GET["supprimer"]))
    {
	include("../module/inscriptionsivory/supprimer.php");
	}
	else  if(isset($_GET["modifier"]))
    {
	include("../module/inscriptionsivory/modifier.php");
	}
    else  if(isset($_GET["code_inscription"]))
    {
	include("../module/inscriptionsivory/etudiant.php");
	}
	else  if(isset($_GET["code_cours"]))
    {
	include("../module/inscriptionsivory/cours.php");
	}
    else
    {	
    include("../module/inscriptionsivory/admin.php");
    }
	
  ?>
  </td>
</tr>
</table>
 </div>

</body>
</html>
  
 