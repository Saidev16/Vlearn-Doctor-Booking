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
<title>ADMINISTRATION --GESTION DES SITUATIONS FINANCIERES --</title>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" width="140"><?php include("header1.php");?></td>
 <td valign="top">

<table  width="100%"  border="0" cellpadding="0" cellspacing="0" height="100%" >
<tr>
	<td><?php include("banner.php");?></td>
</tr>
<tr>
  <td valign="top" >
   <?php
    if(isset($_GET["modifier"]))
    {
	include("../module/situation/modifier.php");
	}
  else  if(isset($_GET["code_inscription"]))
    {
	include("../module/situation/paiement.php");
	}
  else
    {	
    include("../module/situation/admin.php");
    }
  ?>
  </td>
</tr>
</table>
</td></tr>
<tr><td colspan="2" align="center"><?php include("copyright.php"); ?></td></tr>
</table>
</body>
</html>