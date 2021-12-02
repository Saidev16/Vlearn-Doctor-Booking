<?php
		$niveau=$filiere=$annee=$where=$code=$search=$sgroupe=$annee_inscription=$elearning=$search_student=$school='';
		$groupeFilter=" ";
	     
																	
																				   
	     if((isset($_POST['tous'])) && (!empty($_POST['tous']))){
	    	$niveau=$filiere=$annee=$where=$code=$search=$annee_inscription=$sgroupe='';
			unset($_SESSION['niveau']);
			unset($_SESSION['filiere']);
			unset($_SESSION['annee_etude']);
			unset($_SESSION['annee_inscription']);
			unset($_SESSION['search_student']);
			unset($_SESSION['elearning']);
			unset($_SESSION['school']);
	   																}
																	
		

	   else{
	   
	     //nom ou prenom comme crit&eacute;re 
							  
					 if((isset($_POST['search_student'])) && (!empty($_POST['search_student'])) ){
						$search_student = $_SESSION['search_student'] = addslashes(trim($_POST['search_student']));
						$groupeFilter="";
						$where = $where." and e.nom like '%".$search_student."%' or e.prenom like '%".$search_student."%'";
																				  }
					  else if( (isset($_POST['search_student'])) && (empty($_POST['search_student'])) ){
  	                            unset($_SESSION['search_student']);
 						                                                          }

						else if( (isset($_SESSION['search_student']))&& (!empty($_SESSION['search_student'])) ){ 
								 $groupeFilter="";
								 $search_student=$_SESSION['search_student'];
								 $where = $where." and e.nom like '%".$search_student."%' or e.prenom like '%".$search_student."%'";							                                                                  }
                   				   
				              //groupe comme crit&eacute;re 
							  
					 if((isset($_POST['groupe'])) && (!empty($_POST['groupe'])) ){
						$sgroupe = $_SESSION['sgroupe'] = $_POST['groupe'];
						$groupeFilter="";
						$where = $where." and e.groupe=".$sgroupe;
																				  }
					  else if( (isset($_POST['groupe'])) && (empty($_POST['groupe'])) ){
  	                            unset($_SESSION['sgroupe']);
 						                                                          }

						else if( (isset($_SESSION['sgroupe']))&& (!empty($_SESSION['sgroupe'])) ){ 
								 $groupeFilter="";
								 $sgroupe=$_SESSION['sgroupe'];
								 $where = $where." and e.groupe=".$sgroupe;									                                                                  }
									//fili&eacute;re comme critere 																  

																		   

						if( (isset($_POST['filiere'])) && (!empty($_POST['filiere'])) ){
							$filiere = $_SESSION['filiere'] = $_POST['filiere'];
							$where = $where." and e.filiere='". $filiere."'";
																					   }
							else if((isset($_POST['filiere'])) && (empty($_POST['filiere']))){
  	                          unset($_SESSION['filiere']);
 						                                                                       }
					            else if( (isset($_SESSION['filiere'])) && (!empty($_SESSION['filiere'])) ){
								 $filiere=$_SESSION['filiere'];
  	                          	 $where = $where." and e.filiere='". $filiere."'";
						                                                                                  }
									//ann&eacute;e d'&eacute;tude  comme crit&egrave;re

							 if( (isset($_POST['annee_etude'])) && (!empty($_POST['annee_etude'])) ){
								$annee = $_SESSION['annee_etude'] = $_POST['annee_etude'];
								$where =$where." and  e.annee = '".$annee."'";
																									}

									else if( (isset($_POST['annee_etude'])) && (empty($_POST['annee_etude'])) ){
  	                                                  unset($_SESSION['annee_etude']);
						                                                                            }
																									
								else if( (isset($_SESSION['annee_etude'])) && (!empty($_SESSION['annee_etude'])) ){
								   $annee=$_SESSION['annee_etude'];
  	                               $where = $where." and  e.annee = '".$annee."'";
						                                                                            }

                       	//ann&eacute;e d'inscription  comme crit&eacute;re

							 if( (isset($_POST['annee_inscription'])) && (!empty($_POST['annee_inscription'])) ){
								$annee_inscription = $_SESSION['annee_inscription'] = $_POST['annee_inscription'];
								$where =$where." and  e.annee_inscription = '".$annee_inscription."'";
																												}

									else if( (isset($_POST['annee_inscription'])) && (empty($_POST['annee_inscription'])) ){
  	                                                  unset($_SESSION['annee_inscription']);
						                                                                           						   }

								else if( (isset($_SESSION['annee_inscription'])) && (!empty($_SESSION['annee_inscription'])) ){
								   $annee_inscription = $_SESSION['annee_inscription'];
  	                               $where = $where." and  e.annee_inscription = '".$annee_inscription."'";
						                                                                            						  }
																															  
								  //Elearning  comme crit&eacute;re

							 if( (isset($_POST['elearning'])) && ($_POST['elearning']!='') ){
								$elearning = $_SESSION['elearning'] = $_POST['elearning'];
								$where =$where." and  e.elearning = '".$elearning."'";
																												}

									else if( (isset($_POST['elearning'])) && ($_POST['elearning']=='') ){
  	                                                  unset($_SESSION['elearning']);
						                                                                           						   }

								else if( (isset($_SESSION['elearning'])) && ($_SESSION['elearning']!='') ){
								   $elearning = $_SESSION['elearning'];
  	                               $where = $where." and  e.elearning = '".$elearning."'";
						                                                                            						  }

							//school  comme crit&eacute;re

							 if( (isset($_POST['school'])) && ($_POST['school']!='') ){
								$school = $_SESSION['school'] = $_POST['school'];
								if ($school== 'piimt'){$where =$where." and  e.piimt = 1";} 
								elseif($school== 'aul'){$where =$where." and  e.aul = 1";}
								elseif($school== 'umt'){$where =$where." and  e.umt = 1";}
								
																												}

									else if( (isset($_POST['school'])) && ($_POST['school']=='') ){
  	                                                  unset($_SESSION['school']);
						                                                                           						   }

								else if( (isset($_SESSION['school'])) && ($_SESSION['school']!='') ){
								   $school = $_SESSION['school'];
  	                               if ($school== 'piimt'){$where =$where." and  e.piimt = 1";} 
								   elseif($school== 'aul'){$where =$where." and  e.aul = 1";}
								   elseif($school== 'umt'){$where =$where." and  e.umt = 1";}
										
									
						                                                                            						  }



	      }
	/* $sql = "SELECT distinct e.code_inscription, concat(e.nom, ' ' ,e.prenom) as name, 
	 		 e.tel, f.nom_filiere, e.date_inscription, g.title, e.annee,e.acces,e.ville
			 FROM $tbl_etudiant_burkina as e, $tbl_filiere as f, $tbl_groupe as g 
			 where e.filiere=f.id_filiere and e.groupe=g.id and groupe != 99 AND e.archive = 0" 
			 . $where. $groupeFilter. " GROUP BY e.code_inscription ORDER BY name ";*/
$sql = "SELECT distinct e.code_inscription, concat(e.nom, ' ' ,e.prenom) as name, 
	 		 e.tel,  e.date_inscription, e.annee,e.acces,e.ville,e.groupe,e.prefixe,e.archive,e.graduation_date
			 FROM tbl_etudiant_GUES as e
			 where  e.archive = 1" 
			 . $where. $groupeFilter. " GROUP BY e.code_inscription ORDER BY e.code_inscription ";

?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;&nbsp;<img src="images/icone/etudiants.gif" border="0"/></td>
    <td class="titre">&nbsp;&nbsp;Listing Students </td>
	<td width="150">
	  <td align="right">
		 <a href="gestion_des_etudiants_gues.php"><div class="retour"></div>Back</a>
		 </td>
	 <!-- <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		 <td valign="top" align="center">
		   <a href="gestion_des_etudiants_burkina.php?new=oui">
		  <div class="ajouter"></div>
		  New</a>
		  </td>
		  <td valign="top" align="center">
		  <a href="#"

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez s&eacute;lectionner un &eacute;tudiant dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_des_etudiants_burkina.php?modifier='+chemin;

				     window.location.replace(chemin);

				   }"> <div class="modifier"></div> 
		  Edit</a>
		  </td>
		   <td valign="top" align="center">
		   <a href="#"

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez s&eacute;lectionner un &eacute;tudiant dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_des_etudiants_burkina.php?detail='+chemin;

				     window.location.replace(chemin);

				   }

				   " ><div class="detail"></div>
		   Details</a>
   		  </td>
     <!--   <td valign="top" align="center">
		   <a href="#"
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez s&eacute;lectionner un &eacute;tudiant dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;
				        
						 chemin='gestion_des_etudiants_burkina.php?buletinBachelor='+chemin;

					     window.location.replace(chemin);
                                  
				   }

				   "><div class="buletinbba"></div>Bulletin </a>
		  </td>
		
		  <td valign="top" align="center">
		   <a href="#"
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez s&eacute;lectionner un &eacute;tudiant dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_des_etudiants_burkina.php?buletinMaster='+chemin;

				     window.location.replace(chemin);

				   }

				   "><div class="buletin"></div>Bulletin </a>
		  </td>

		
		  <td valign="top" align="center" >
		  <a href="gestion_des_etudiants_burkina.php?laureat" title="laureat">
		  <div class="detail"></div><></a>
		  </td> 
           <td valign="top" align="center">
		   <a href="#"
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez s&eacute;lectionnez un &eacute;tudiant dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_des_etudiants_burkina.php?supprimer='+chemin;

				     window.location.replace(chemin);

				   }

				   "><div class="delete"></div>
		   Delete
		   </a>
		  </td>
		  <!-- <td valign="top" align="center">
		   <a href="#"
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)
			       {
				    alert('Veuillez s&eacute;lectionnez un &eacute;tudiant dans la liste');
				   }
				   else
				   {
				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_des_etudiants_burkina.php?archiver='+chemin;

				     window.location.replace(chemin);

				   }

				   "><div class="archiver"></div>Archiver</a>
		  </td>
          	  <td valign="top" align="center">
		   <a href="gestion_des_etudiants_burkina.php?archive=oui"><div class="archive"></div>Archive</a>
		  </td>
 		  <td valign="top" align="center" >
		  <a href="#" onclick="window.print()" title="Imprimer">
		  <div class="imprimer"></div>
		  Print
		  </a>
		  </td>
		</tr>
	  </table>
-->
	</td> 

  </tr>

</table>

 <table width="100%" cellspacing="1" border="0"  class="adminlist" >
 <form action="#" method="post" name="adminMenu" >

<input type="hidden" name="boxchecked" value="0" />

<div class="container_search">

     
     
   		   <input type="text" class="input" name="search_student" style="width:125px" value="<?php echo $search_student?>"  />
		   <input type="submit" vname="valider" value="Submit" class="input"  />
		   <input type="submit" value="All" name="tous" class="input"  />
  </div>

  <tr align="center">
		 <th width="43">#</th>
		 <th width="43">&nbsp;</th>
		 <th width="43"><?php echo 'Code'; ?></th>
		 <th width="272"><?php echo 'Name'; ?></th>
		 <th width="272"><?php echo 'Section'; ?></th>
		  <th width="272"><?php echo 'Graduation Date'; ?></th>
		 
		 	
		
   </tr>


	  <?php
		 $i=0;
		 $total = @mysql_query($sql) or die("erreur lors de s&eacute;lection des &eacute;tudiants"); 
		 $url = $_SERVER['PHP_SELF']."?limit=";
		 $nblignes = mysql_num_rows($total);
		 $nbpages = ceil($nblignes/$parpage);
		 $result = validlimit($nblignes,$parpage,$sql);
		 while ($ligne = mysql_fetch_array($result)) {
		 $i++;
		 $ci=$ligne["code_inscription"];
		 $prefixe=$ligne["prefixe"];
		  $graduation_date=$ligne["graduation_date"];
		   ?>

	   <tr height="17px">
	 <td align="center">&nbsp;<?=$i?>
		 <td align="center"><input type="radio" id="<?=$ci?>" name="id" value="<?=$ci?>" 
		 onClick="document.adminMenu.boxchecked.value='<?=$ci?>'" /></td>
		 <td class="gras">&nbsp;<?=$prefixe.$ci?></td>
		 <td>&nbsp;<?=ucfirst(stripslashes($ligne["name"]))?></td>
		  <td>&nbsp;<?php if($ligne['groupe']== '2')
		  { echo 'FH';}
		  else  if($ligne['groupe']== '3')
		  { echo 'FE';} else { echo' ';}?></td>
		 <td>&nbsp;<?php
		$date=$ligne["graduation_date"];
		$tab=split('[/.-]',$date); 
		echo $tab[1].'-'.$tab[0]; 
		
		?></td>
	
	<!--	 <td>&nbsp;<?=html_entity_decode($ligne["title"])?></td>
		 <td>&nbsp;<?=htmlentities($ligne["annee"])?></td>
		 <td>&nbsp;<?=ucfirst(stripslashes($ligne["nom_filiere"]))?></td>
		 <td>&nbsp;<?=$ligne["date_inscription"]?></td>
		  <td>&nbsp;<?=$ligne["ville"]?></td>
		 <td align="center"> <a href="gestion_des_etudiants_burkina.php?acces=<?=$ligne["acces"]==0 ? 1 : 0 ?>&user_id=<?=$ligne["code_inscription"]?>"><?=$ligne["acces"]=='0' ? $non : $oui ?></a></td>-->
	</tr>
		 <?php
		  }
		 ?>

   </form>

</table>
  <div id='pagination' align='center'> 
         <?php echo pagination($url,$parpage,$nblignes,$nbpages); 
		 ?> 
  </div>
