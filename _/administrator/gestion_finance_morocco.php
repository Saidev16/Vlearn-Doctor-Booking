
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
<title>ADMINISTRATION --GESTION DES PAIEMANTS --</title>
</head>
<body>

<div id="container">
<?php require 'includes/main_menu.php'; ?>
	<div id="banner">
	Login:
	<?=(isset($_SESSION['admin_login'])) ? $_SESSION['admin_login'] : ''?>&nbsp;&nbsp;&nbsp;&nbsp;
	<br><a href="deconexion.php">D&eacute;connexion</a>&nbsp;&nbsp;&nbsp;
	</div>
 			<div id="content">
				<table  width="100%"  border="0" cellpadding="0" cellspacing="0" height="100%" >
<tr>
  <td valign="top" >
   <?php
    if(isset($_GET["modifier"])){ include("../module/financesmorocco/modifier.php");}
	     elseif(isset($_GET["new"]))  { include("../module/financesmorocco/ajouter.php");}
           elseif(isset($_GET["supprimer"])){ include("../module/financesmorocco/supprimer.php");}
		     elseif(isset($_GET["new_fiche"])){ include("../module/financesmorocco/new_fiche.php");}
		       elseif(isset($_GET["delete_from_sheet"])){ include("../module/financesmorocco/delete_fiche.php");}
		         elseif(isset($_GET["delete_paiement"])){ include("../module/financesmorocco/delete_paiement.php");}
		           elseif(isset($_GET["new_paiement"])){ include("../module/financesmorocco/new_paiement.php");}
				    elseif(isset($_GET["modif_paiement"])){ include("../module/financesmorocco/modifier_paiement.php");}
		             elseif(isset($_GET["modifier"])){ include("../module/financesmorocco/modifier.php");}
		               elseif(isset($_GET["detail"])){ include("../module/financesmorocco/detail.php");}
			  	         elseif(isset($_GET["recu"])){ include("../module/financesmorocco/recu.php");}
                            else{ include("../module/financesmorocco/admin.php");}
  ?>
  </td>
</tr>
</table>
			</div>
</div>

</body>
</html>