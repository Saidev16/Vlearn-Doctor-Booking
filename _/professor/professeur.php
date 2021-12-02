<?php
include("mod_prof/secure.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Espace enseignant</title>
<link rel="stylesheet" type="text/css" href="css/main.css">
 <link rel="shortcut icon" href="administrator/images/icone.gif" />
<script language="javascript1.2" src="script/prototype.js"></script>
</head>
<body>
  <div align="center">
     <div id="container">
 		<div id="header_professor">
		<?php
		echo '<br><b>Login :</b>'.$_SESSION['login'].'&nbsp;&nbsp;&nbsp;';
		?>
		<br>
		<a href="http://ilcs.ac.ma/ilcs/mod_prof/logout.php?<?=md5('login')?>" id="deconnection">déconnexion&nbsp;&nbsp;&nbsp;</a>
		</div>
		 

       <div id="menu">
	  <span id="titre_menu">Menu</span><br /><br />
			<?php
			$sqlm="select title, link from tbl_professor_menu where publie = 0";
			$req=mysql_query($sqlm) or die('erreur lors de création du menu');
			while($row=mysql_fetch_assoc($req)){
			?>
			<span id="list"><a href="<?=$row['link']?>"><?=$row['title']?></a></span>
			<?php
			}
			?>
			<span class="item_menu1"><a href="demande.php"></a></span>
			<span class="item_menu1"><a href="demande.php"></a></span>
	  </div>
            <div id="contenu">
			<?php
			
    if(isset($_GET["task"])) {
                switch ($_GET["task"]) {
   
		case 'fiche' :include("mod_prof/fiche.php"); break;
		 case 'cours' :include("mod_prof/cours.php"); break;
		  case 'demande' :include("mod_prof/demande.php"); break;
		   case 'reponse' :include("mod_prof/reponse.php"); break;
			case 'password' :include("mod_prof/mot_pass.php"); break;
			 case 'logout' :include("mod_prof/logout.php"); break;
			  case 'info' :include("mod_prof/info.php"); break;
								      }	
					        }
							  
	else if(isset($_POST["task"])) {
                     switch ($_POST["task"]) {
        
		case 'etudiant' :include("mod_prof/etudiant.php"); break;
		 case 'note' :include("mod_prof/notes.php"); break;
		  case 'absence' :include("mod_prof/absences.php"); break;
		   case 'descriptif' :include("mod_prof/descriptif.php"); break;
		    case 'syllabus' :include("mod_prof/syllabus.php"); break;
		     case 'detail' :include("mod_prof/detail.php"); break;
			  case 'add_absence' :include("mod_prof/add_absence.php"); break;
				case 'edit_absence' :include("mod_prof/edit_absence.php"); break;
				 case 'edit_descriptif' :include("mod_prof/edit_descriptif.php"); break;
				  case 'edit_note' :  include("mod_prof/edit_note.php"); break;
				    case 'edit_syllabus' :  include("mod_prof/edit_syllabus.php"); break;
								              }	
					               }
								   
	else if(isset($_POST["action"])) {
                   switch ($_POST["action"]) {
        
		case 'update_note' :include("mod_prof/update_note.php"); break;
		 case 'add_absence' :include("mod_prof/action_add_absence.php"); break;
		  case 'add_request' :include("mod_prof/action_add_request.php"); break;
		   case 'change_pass' :include("mod_prof/action_change_page.php"); break;
		    case 'edit_desriptif' :include("mod_prof/action_edit_descriptif.php"); break;
			 case 'edit_syllabus' :include("mod_prof/action_edit_syllabus.php"); break;
			  case 'delete_absence' :include("mod_prof/action_delete_absence.php"); break;
			   case 'action_edit_absence' :include("mod_prof/fact_action_edit_absence.php"); break;
			    case 'edit_absence' :include("mod_prof/action_edit_absence.php"); break;
							                 }
							          }			   
  ?>
  </div>
      </div>
	<!--  <div style="width:780px; height:20px; display:block">&copy;copyright 2008 ILCS</div>-->
          </div>
</body>
</html>
