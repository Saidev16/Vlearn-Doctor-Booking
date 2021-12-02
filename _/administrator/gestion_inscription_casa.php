<?php
include("secure.php");

?>
<link rel="shortcut icon" href="images/icone.gif" />
<link rel="stylesheet" type="text/css" href="css/global.css">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>ADMINISTRATION --GESTION DES inscriptions Burkina --</title>
<script language="javascript1.2" src="script/prototype.js"></script>
</head>
<link rel="shortcut icon" href="images/icone.gif" />
<link rel="stylesheet" type="text/css" href="css/global.css">
<link rel="stylesheet" type="text/css" href="css/print.css" media="print">
<!-- <link rel="stylesheet" href="../js/stu-prof/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
<link rel="stylesheet" href="../css/stu-prof/font-icons/entypo/css/entypo.css"> -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
<!-- <link rel="stylesheet" href="../css/stu-prof/bootstrap.css">
<link rel="stylesheet" href="../css/stu-prof/neon-core.css">
<link rel="stylesheet" href="../css/stu-prof/neon-theme.css">
<link rel="stylesheet" href="../css/stu-prof/neon-forms.css">
<link rel="stylesheet" href="../css/stu-prof/custom.css">
<link rel="stylesheet" href="../css/stu-prof/blue.css">
<link rel="stylesheet" href="../js/stu-prof/vertical-timeline/css/component.css">
<link rel="stylesheet" href="../js/stu-prof/jvectormap/jquery-jvectormap-1.2.2.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">

<script src="../js/stu-prof/jquery-1.11.0.min.js"></script>
<body>
<div id="container">
<?php require 'includes/main_menu.php'; ?>
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

    if(isset($_GET["new"]))
    {
	include("../module/inscriptionscasa/ajouter.php");
	}
	else  if(isset($_GET["full_add"]))
    {
	include("../module/inscriptionscasa/full_add.php");
	}
	else  if(isset($_GET["full_addc"]))
    {
	include("../module/inscriptionscasa/full_addc.php");
	}
	else  if(isset($_GET["full_addT"]))
    {
	include("../module/inscriptionscasa/full_addT.php");
	}
    else  if(isset($_GET["supprimer"]))
    {
	include("../module/inscriptionscasa/supprimer.php");
	}
	else  if(isset($_GET["modifier"]))
    {
	include("../module/inscriptionscasa/modifier.php");
	}
    else  if(isset($_GET["code_inscription"]))
    {
	include("../module/inscriptionscasa/etudiant.php");
	}
	else  if(isset($_GET["code_cours"]))
    {
	include("../module/inscriptionscasa/cours.php");
	}else  if(isset($_GET["transfer_courses"]))
    {
	include("../module/inscriptionscasa/transfer_courses.php");
	}
	else  if(isset($_GET["transfer_courses_by_student"]))
    {
	include("../module/inscriptionscasa/transfer_courses_by_student.php");
	}else  if(isset($_GET["add_transfer_course"]))
    {
	include("../module/inscriptionscasa/add_transfer_course.php");
	}else  if(isset($_GET["transfer_detail"]))
    {
	include("../module/inscriptionscasa/transfer_detail.php");
	}else  if(isset($_GET["course_inscription"])){
	include("../module/inscriptionscasa/course_inscription.php");
	}else
    {
    include("../module/inscriptionscasa/admin.php");
    }

  ?>
  </td>
</tr>
</table>
 </div>

</body>

<!-- <script src="../js/stu-prof/gsap/main-gsap.js"></script>
<script src="../js/stu-prof/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="../js/stu-prof/bootstrap.js"></script>
<script src="../js/stu-prof/joinable.js"></script>
<script src="../js/stu-prof/resizeable.js"></script>
<script src="../js/stu-prof/neon-api.js"></script>
<script src="../js/stu-prof/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../js/stu-prof/jquery.sparkline.min.js"></script>

<script src="../js/stu-prof/raphael-min.js"></script>

<script src="../js/stu-prof/toastr.js"></script>

<script src="../js/stu-prof/jquery.bootstrap.wizard.min.js"></script>
<script src="../js/stu-prof/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>
<script src="../js/stu-prof/neon-chat.js"></script>
<script src="../js/stu-prof/neon-custom.js"></script>
 -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>


</html>
