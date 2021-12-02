<?php require 'secure.php';?>
<link rel="shortcut icon" href="images/icone.gif" />
<link rel="stylesheet" type="text/css" href="css/global.css">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="javascript1.2" src="script/prototype.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>ADMINISTRATION --GESTION DES TYPES DES COURS --</title>
</head>

<body>
<div id="container">
<?php require 'includes/main_menu.php'; ?>
	<div id="banner">
	Login:
	<?=(isset($_type_cours['admin_login'])) ? $_type_cours['admin_login'] : ''?>&nbsp;&nbsp;&nbsp;&nbsp;
	<br><a href="deconexion.php">Déconnexion</a>&nbsp;&nbsp;&nbsp;
	</div>
 			<div id="content">
				<table  width="100%"  border="0" cellpadding="0" cellspacing="0">
<tr>
  <td valign="top" >
   <?php
  if(isset($_GET["new"]))
    {
	include("../module/type_cours/ajouter.php");
	}
  else  if(isset($_GET["modifier"]))
    {
	include("../module/type_cours/modifier.php");
	}
  else  if(isset($_GET["supprimer"]))
    {
	include("../module/type_cours/supprimer.php");
	}
  else
    {	
    include("../module/type_cours/admin.php");
    }
  ?>
  </td>
</tr>
</table>
			</div>
</div>
</body>
</html>