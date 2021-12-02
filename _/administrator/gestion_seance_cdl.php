<?php
include("secure.php");
?>
<link rel="shortcut icon" href="images/icone.gif" />
<link rel="stylesheet" type="text/css" href="css/global.css">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="javascript1.2" src="script/prototype.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>ADMINISTRATION --GESTION DES SEANCES --</title>
</head>
<body>
<div id="container">
	<div id="banner">
	Login:
	<?=(isset($_SESSION['login'])) ? $_SESSION['login'] : ''?>&nbsp;&nbsp;&nbsp;&nbsp;
	<br><a href="deconexion.php">Déconnexion</a>&nbsp;&nbsp;&nbsp;
	</div>
		<div id="navigation"><?php require 'header1.php' ?></div>
			<div id="content">
				<table  width="100%"  border="0" cellpadding="0" cellspacing="0" height="100%" >
<tr>
  <td valign="top" >
   <?php
    if(isset($_GET["modifier"]))
    {
	include("../module/seance_cdl/modifier.php");
	}
        else  if(isset($_GET["new"]))
    {
	include("../module/seance_cdl/ajouter.php");
	}
          else  if(isset($_GET["archiver"]))
    {
	include("../module/seance_cdl/archiver.php");
	}
	 else  if(isset($_GET["archive"]))
    {
	include("../module/seance_cdl/archive.php");
	}
	 else  if(isset($_GET["desarchiver"]))
    {
	include("../module/seance_cdl/desarchiver.php");
	}
    else  if(isset($_GET["descriptif"]))  {
      include("../module/seance_cdl/descriptif.php");
      }
	  else  if(isset($_GET["syllabus"])){
	     include("../module/seance_cdl/syllabus.php");
                  }
     else
    {	
    include("../module/seance_cdl/admin.php");
    }
  ?>
  </td>
</tr>
</table>
			</div>
</div>
</body>
</html>