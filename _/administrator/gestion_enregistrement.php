<?php
include("secure.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>ADMINISTRATION --GESTION DES ENREGISREMENTS--</title>
<link rel="shortcut icon" href="images/icone.gif" />
<link rel="stylesheet" type="text/css" href="css/global.css">
<script src="script/prototype.js" language="javascript"></script>
</head>
<body>
<div id="container">
			<?php require 'includes/top_menu.php' ?>
	<div id="banner">
	Login:<?=(isset($_SESSION['admin_login'])) ? $_SESSION['admin_login'] : ''?>&nbsp;&nbsp;&nbsp;&nbsp;
	<br><a href="deconexion.php">Déconnexion</a>&nbsp;&nbsp;&nbsp;
	</div>
		<div id="navigation" style="text-align:left"><?php require 'includes/left_menu.php' ?></div>
			<div id="content">
				<table  width="100%"  border="0" cellpadding="0" cellspacing="0" height="100%">
<tr>
  <td valign="top" >
   <?php
  if(isset($_GET["modifier"]))
    {
	include("../module/enregistrement/modifier.php");
	}
  	else  if(isset($_GET["new"]))
		{
		include("../module/enregistrement/ajouter.php");
		}
		  else  if(isset($_GET["supprimer"]))
			{
			include("../module/enregistrement/supprimer.php");
			}
			else  if(isset($_GET["archive"]))
			{
			include("../module/enregistrement/archive.php");
			}
					else  if(isset($_GET["archiver"]))
				{
				include("../module/enregistrement/archiver.php");
				}
				  else
					{
					include("../module/enregistrement/admin.php");
					}
  ?>
  </td>
</tr>
</table>
 			</div>
</div>
</body>
</html>