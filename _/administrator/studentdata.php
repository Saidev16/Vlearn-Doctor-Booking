<?php
include("secure.php");
include("../include/fonctions.inc.php");
include("../module/api/export_class.php");
?>


<link rel="shortcut icon" href="images/icone.gif" />
<link rel="stylesheet" type="text/css" href="css/global.css">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>ADMINISTRATION --MANAGEMENT OF STATISTICS--</title>
<script src="script/jquery-1.10.2.min.js"></script>
<script src="script/prototype.js" language="javascript"></script>
</head>
<body>
<div id="container">
  <?php require 'includes/main_menu.php';?>
	<div id="banner">
	Login:
	<?=(isset($_SESSION['admin_login'])) ? $_SESSION['admin_login'] : ''?>&nbsp;&nbsp;&nbsp;&nbsp;
	<br><a href="deconexion.php">Logout</a>&nbsp;&nbsp;&nbsp;
	</div>
 			<div id="content">
				<table  width="100%"  border="0" cellpadding="0" cellspacing="0" height="100%" >
<tr>
  <td valign="top" >
   <?php
    if(isset($_GET["code_inscription"]))
    {
	include("../module/studentdata/etudiant.php");
	}
  else if(isset($_GET["CGPA"]))
    {
	include("../module/studentdata/cgpa.php");
	}
  else if(isset($_GET["code_cours"]))
    {
	include("../module/studentdata/cours.php");
	}
  else if(isset($_GET["surveys"]))
    {
	include("../module/studentdata/survey.php");
	}
   else if(isset($_GET["sap"]))
    {
  include("../module/studentdata/sap.php");
  }
  else if(isset($_GET["details"]))
    {
  include("../module/studentdata/details.php");
  }
    else if(isset($_GET["withdrawals"]))
    {
  include("../module/studentdata/withdrawals.php");
  }
  else if(isset($_GET["AID"]))
    {
  include("../module/studentdata/AID.php");
  }
  else if(isset($_GET["AIR"]))
    {
  include("../module/studentdata/AIR.php");
  }
   else if(isset($_GET["number"]))
    {
  include("../module/studentdata/number.php");
  }
 else if (isset($_GET["ajaxmod"])) {
  include("../module/studentdata/ajaxmod.php");
                    }
  else
    {
    include("../module/studentdata/admin.php");
    }

    if (isset($_POST['export']) && $_POST['export'] == 1) {
              $file = "students_data.xls";
              if(file_exists($file)){
                chmod($file,0606);
              }else{
                touch($file,0606);
                chmod($file,0606);
              }
            }
  ?>
  </td>
</tr>
</table>
			</div>
</div>
</body>
</html>
