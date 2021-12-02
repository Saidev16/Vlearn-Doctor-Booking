<?php require('parent/secure/secure.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Extranet - HIS PARENT SPACE</title>
<style type="text/css">
@import url("css/main.css");
</style>
<script language="javascript1.2" src="script/prototype.js"></script>
<!--<link rel="shortcut icon" href="administrator/images/icone.gif" />-->
</head>
<body>
  <div align="center">
     <div id="container">
         <div id="header_parent">
				<?php
				if (isset($_SESSION['Slogin'])){
				echo '<br><b>Login :&nbsp;</b>'.ucfirst($_SESSION['Slogin']).'&nbsp;&nbsp;&nbsp;';
				}
				?>
				
               <br><a href="parent.php?task=logout" id="deconnection">D&eacute;connexion&nbsp;&nbsp;&nbsp;</a>
         </div>

       <div id="menu">
			<h3>Menu</h3>
            <ul>
				<?php
                $sqlm="select titre, link from $tbl_menu 
				where type='parent'
				and publie = 0 
				and archive=0
				and parent=0
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
	   require('parent/info.php');break;
		case 'fiche' : require 'parent/fiche.php'; break;
		 case 'cours' : require 'parent/cours.php'; break;
		  case 'note' : require 'parent/note.php'; break;
		   case 'absence' : require 'parent/absence.php'; break;
			case 'livre' : require 'include/fonctions.inc.php';
			require('parent/livre.php'); break;
		     case 'emprunt' : require 'parent/emprunt.php'; break;
			  case 'demande' : require 'parent/demande.php'; break;			
			   case 'reponse' :require 'parent/reponse.php'; break;
				case 'buletin' :require 'parent/buletin.php'; break;
				 case 'sondage' : require 'parent/sondage.php'; break;
				  case 'logout' : require 'parent/logout.php'; break;
				   case 'situation' :require 'parent/situation.php';break;
				    case 'reglement' :require 'include/fonctions.inc.php'; 
					require 'parent/reglement.php';break;
					 case 'inscription' :require 'include/fonctions.inc.php';
					  require 'parent/inscription.php'; break;
                      case 'emploi' :require 'parent/emploi_du_temps.php'; break;
        			   case 'contentEmploi' :require 'parent/emploi1.php'; break;
					   case 'documents' :require 'parent/documents.php'; break;
					    case 'offre' ://require 'include/fonctions.inc.php';require 'parent/offre.php'; break;?> <script type="text/javascript" language="JavaScript1.2">
window.open('http://leadjob.ameritechcenter.com/list_public_page.php','_blank','toolbar=0,menubar=0,location=0,scrollbars=0,width=720,height=720');
</script>
<?php 

							
								}	
					          }
							  
	else if((isset($_POST["task"])) && (isset($_POST["token"])) ) {
	     
			                                          
       
        switch ($_POST["task"]) {
									
				case 'descriptif' :require("parent/descriptif.php"); break;
			     case 'syllabus' :require("parent/syllabus.php"); break;
				  case 'inscription' :require("parent/action_inscription.php"); break;
				   case 'desinscription' :require("parent/action_desinscription.php"); break;
				   	case 'inscrit_par_cours' :require("parent/liste_des_inscrit.php"); break;
					 case 'liste_attente' :require 'parent/liste_attente.php'; break;
			 }
								 
								   }
							  
	else if(isset($_POST["action"])) {
       switch ($_POST["action"]) {
        
		    case 'sondage' :require("parent/action_sondage.php");break;
			 case 'requette' :require("parent/action_requette.php");break;
					            }
							        }
									 
  ?>
  </div>
          </div>
		  
      </div>
            
</body>
</html>

