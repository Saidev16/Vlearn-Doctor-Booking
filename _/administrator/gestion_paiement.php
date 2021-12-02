<?php
include("secure.php");
include("../include/fonctions.inc.php");
?>
<link rel="shortcut icon" href="images/icone.gif" />
<link rel="stylesheet" type="text/css" href="css/global.css">
<link rel="stylesheet" type="text/css" href="css/print.css" media="print">
<script language="javascript1.2" src="script/prototype.js"></script>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>ADMINISTRATION --GESTION DES PAIEMANTS --</title>
<script src="script/student.js" language="javascript"></script>
</head>
<body>

<div id="container">
<?php require 'includes/main_menu.php'; ?>
	<div id="banner">
	Login:
	<?=(isset($_SESSION['login'])) ? $_SESSION['login'] : ''?>&nbsp;&nbsp;&nbsp;&nbsp;
	<br><a href="deconexion.php">Déconnexion</a>&nbsp;&nbsp;&nbsp;
	</div>
 			<div id="content">
				<table  width="100%"  border="0" cellpadding="0" cellspacing="0" height="100%" >
<tr>
  <td valign="top" >
   <?php
    if(isset($_GET["modifier"])){include("../module/finance/modifier.php");}
	      else  if(isset($_GET["new"]))  { include("../module/finance/ajouter.php");	}
           else  if(isset($_GET["supprimer"])){ include("../module/finance/supprimer.php");}
		   else  if(isset($_GET["new_fiche"])){ include("../module/finance/new_fiche.php");}
		   else  if(isset($_GET["delete_from_sheet"])){ include("../module/finance/delete_fiche.php");}
		   else  if(isset($_GET["edit_fiche"])){ include("../module/finance/edit_fiche.php");}
		      else  if(isset($_GET["detail"])){ include("../module/finance/detail.php");}
			  	else  if(isset($_GET["recu"])){ include("../module/finance/recu.php");}
                  else       {   include("../module/finance/admin.php"); }
  ?>
  </td>
</tr>
</table>
			</div>
</div>

</body>
</html>