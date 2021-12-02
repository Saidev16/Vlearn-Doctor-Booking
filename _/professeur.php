<?php require 'professor/secure/secure.php';?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Extranet - HIS TEACHER SPACE</title>
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/print.css" media="print">
<link rel="shortcut icon" href="administrator/images/icone.gif" />
<script language="javascript1.2" src="script/prototype.js"></script>
 </head>
<body>
  <div align="center">
     <div id="container">
 		<div id="header_professor">
		<?php
		echo '<br><b>Login :</b>&nbsp;'.ucfirst($_SESSION['prof_login']).'&nbsp;&nbsp;&nbsp;';
		?>
		<br>
	<a href="professeur.php?task=logout" id="deconnection">D&eacute;connexion&nbsp;&nbsp;&nbsp;</a>
		</div>
		 

       <div id="menu">
	 <h3>Menu</h3>
     <ul>
			<?php

                $sqlm="select titre,titre_eng, link from $tbl_menu 
				where type='enseignant'
				and publie = 0 
				and archive=0
				order by ordre";
		                                   
			$req=mysql_query($sqlm) or die('erreur lors de cr�ation du menu');
			while($row=mysql_fetch_assoc($req)){
			?>
			<li><a href="<?=$row['link']?>"><?=$row['titre_eng']?></a></li>
			<?php
			}
			?>
            </ul>
	  </div>
            <div id="contenu">
			<?php
    if(isset($_GET["task"])) {
	
       switch ($_GET["task"]) {
   
		case 'fiche' :require 'professor/fiche.php'; break;
		case 'chat' :require 'professor/chat.php'; break;
		 case 'cours' :require 'professor/cours.php'; break;
		  case 'demande' :require 'professor/demande.php'; break;
		   case 'reponse' :require 'professor/reponse.php'; break;
			case 'password' :require 'professor/mot_pass.php'; break;
			 case 'logout' :require 'professor/logout.php'; break;
			  case 'info' :require 'include/fonctions.inc.php';
			               require 'professor/info.php'; break;
			  case 'reglement' :require 'include/fonctions.inc.php'; 
			                    require 'professor/reglement.php';break;
			    case 'documents' :require 'professor/documents.php'; break;
				 case 'addDoc' :require 'professor/add_documents.php'; break;
				  case 'add_absence' :require 'professor/add_absence.php'; break;
 			  
								}	
					        }
							  
	else if(isset($_POST["task"])) {   
	
       switch ($_POST["task"]) {
        
		case 'etudiant' :require 'professor/etudiant.php'; break;
		 case 'note' :require 'professor/notes.php'; break;
		  case 'absence' :require 'professor/absences.php'; break;
		   case 'descriptif' :require 'professor/descriptif.php'; break;
		    case 'syllabus' :require 'professor/syllabus.php'; break;
		     case 'detail' :require 'professor/detail.php'; break;
			 // case 'add_absencee' :require 'professor/add_absence.php'; break;
				case 'edit_absence' :require 'professor/edit_absence.php'; break;
				 case 'edit_descriptif' :require 'professor/edit_descriptif.php'; break;
				  case 'edit_note' :  require 'professor/edit_note.php'; break;
				    case 'edit_syllabus' :  require 'professor/edit_syllabus.php'; break;
					  case 'fiche_note' :require 'professor/fiche_note.php'; break;
					    case 'fiche_absence' :require 'professor/fiche_absence.php'; break;
								}	
					               }
								   
	else if(isset($_POST["action"])) {
	
       switch ($_POST["action"]) {
        
		case 'update_note' :require 'professor/update_note.php'; break;
		 case 'add_absence' :require 'professor/action_add_absence.php'; break;
		  case 'add_request' :require 'professor/action_add_request.php'; break;
		   case 'change_pass' :require 'professor/action_change_page.php'; break;
		    case 'edit_desriptif' :require 'professor/action_edit_descriptif.php'; break;
			 case 'edit_syllabus' :require 'professor/action_edit_syllabus.php'; break;
			  case 'delete_absence' :require 'professor/action_delete_absence.php'; break;
			   case 'action_edit_absence' :require 'professor/fact_action_edit_absence.php'; break;
			    case 'edit_absence' :require 'professor/action_edit_absence.php'; break;
							   }
							   
							   }
							   
							     
  ?>
  </div>
      </div>
          </div>
         
</body>
</html>
  
