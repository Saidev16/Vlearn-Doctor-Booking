<?php
include("secure.php");
include("../include/fonctions.inc.php");
?>
<link rel="shortcut icon" href="images/icone.gif" />
<link rel="stylesheet" type="text/css" href="css/global.css">
<script language="javascript1.2" src="script/prototype.js"></script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>ADMINISTRATION --GESTION DES COURS ACTIVATION --</title>
</head>
<body>

<div id="container">
<?php require 'includes/top_menu.php'; ?>
	<div id="banner">
	Login:
	<?=(isset($_SESSION['login'])) ? $_SESSION['login'] : ''?>&nbsp;&nbsp;&nbsp;&nbsp;
	<br><a href="deconexion.php">Déconnexion</a>&nbsp;&nbsp;&nbsp;
	</div>
		<div id="navigation"><?php require 'includes/left_menu.php' ?></div>
			<div id="content">
				<table  width="100%"  border="0" cellpadding="0" cellspacing="0" height="100%" >
<tr>
  <td valign="top" >
   <?php
    if(isset($_GET["modifier"])){include("../module/activation/modifier.php");}
	      else  if(isset($_GET["ajouter"]))  { include("../module/activation/ajouter.php");	}
           else  if(isset($_GET["supprimer"])){ include("../module/activation/supprimer.php");}
                 else       {   include("../module/activation/admin.php"); }
  ?>
  </td>
</tr>
</table>
			</div>
</div>

</body>
</html>