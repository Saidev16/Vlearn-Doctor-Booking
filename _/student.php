<?php require('student/secure/secure.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Extranet - HIS STUDENT SPACE</title>
<style type="text/css">
@import url("css/main.css");
</style>
<script language="javascript1.2" src="script/prototype.js"></script>
<!--<link rel="shortcut icon" href="administrator/images/icone.gif" />-->
</head>
<body>
  <div align="center">
     <div id="container">
         <div id="header_student">
				<?php
				if (isset($_SESSION['Slogin'])){
				echo '<br><b>Login :&nbsp;</b>'.ucfirst($_SESSION['Slogin']).'&nbsp;&nbsp;&nbsp;';
				}
				?>
				
               <br><a href="student.php?task=logout" id="deconnection">D&eacute;connexion&nbsp;&nbsp;&nbsp;</a>
         </div>

       <div id="menu">
			<h3>Menu</h3>
            <ul>
				<?php
                $sqlm="select titre, link from $tbl_menu 
				where type='etudiant'
				and publie = 0 
				and archive=0
				order by ordre";
				$req=mysql_query($sqlm) or die('erreur lors de création du menu'.$sqlm);
				while($row=mysql_fetch_assoc($req)){
				?>
			<li><a href="<?=htmlentities($row['link'])?>"><?=html_entity_decode($row['titre'])?></a></li>
				<?php
				}
				?>
			</ul>
	  </div>
            <div id="contenu">
			<?php
			 
    if( (isset($_GET["task"])) && (!empty($_GET['task']))   ) {
       switch ($_GET["task"]) {

	   case 'info' : require 'include/fonctions.inc.php';
	   require('student/info.php');break;
		case 'fiche' : require 'student/fiche.php'; break;
		 case 'cours' : require 'student/cours.php'; break;
		  case 'note' : require 'student/note.php'; break;
		   case 'absence' : require 'student/absence.php'; break;
			case 'livre' : require 'include/fonctions.inc.php';
			require('student/livre.php'); break;
		     case 'emprunt' : require 'student/emprunt.php'; break;
			  case 'demande' : require 'student/demande.php'; break;			
			   case 'reponse' :require 'student/reponse.php'; break;
				case 'buletin' :require 'student/buletin.php'; break;
				 case 'sondage' : require 'student/sondage.php'; break;
				  case 'logout' : require 'student/logout.php'; break;
				   case 'situation' :require 'student/situation.php';break;
				    case 'reglement' :require 'include/fonctions.inc.php'; 
					require 'student/reglement.php';break;
					 case 'inscription' :require 'include/fonctions.inc.php';
					  require 'student/inscription.php'; break;
                      case 'emploi' :require 'student/emploi_du_temps.php'; break;
        			   case 'contentEmploi' :require 'student/emploi1.php'; break;
					   case 'documents' :require 'student/documents.php'; break;
					    case 'offre' ://require 'include/fonctions.inc.php';require 'student/offre.php'; break;?> <script type="text/javascript" language="JavaScript1.2">
window.open('http://leadjob.ameritechcenter.com/list_public_page.php','_blank','toolbar=0,menubar=0,location=0,scrollbars=0,width=720,height=720');
</script>
<?php 

							
								}	
					          }
							  
	else if((isset($_POST["task"])) && (isset($_POST["token"])) ) {
	     
			                                          
       
        switch ($_POST["task"]) {
									
				case 'descriptif' :require("student/descriptif.php"); break;
			     case 'syllabus' :require("student/syllabus.php"); break;
				  case 'inscription' :require("student/action_inscription.php"); break;
				   case 'desinscription' :require("student/action_desinscription.php"); break;
				   	case 'inscrit_par_cours' :require("student/liste_des_inscrit.php"); break;
					 case 'liste_attente' :require 'student/liste_attente.php'; break;
			 }
								 
								   }
							  
	else if(isset($_POST["action"])) {
       switch ($_POST["action"]) {
        
		    case 'sondage' :require("student/action_sondage.php");break;
			 case 'requette' :require("student/action_requette.php");break;
					            }
							        }
									 
  ?>
  </div>
          </div>
		  
      </div>
            
</body>
</html>

