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
			 FROM $tbl_etudiant as e, $tbl_filiere as f, $tbl_groupe as g 
			 where e.filiere=f.id_filiere and e.groupe=g.id and groupe != 99 AND e.archive = 0" 
			 . $where. $groupeFilter. " GROUP BY e.code_inscription ORDER BY name ";*/
$sql = "SELECT distinct e.code_inscription, concat(e.nom, ' ' ,e.prenom) as name, 
	 		 e.tel,  e.date_inscription, e.annee,e.acces,e.ville,e.groupe
			 FROM $tbl_etudiant as e
			 where  e.archive = 0" 
			 . $where. $groupeFilter. " GROUP BY e.code_inscription ORDER BY name ";

?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;&nbsp;<img src="images/icone/etudiants.gif" border="0"/></td>
    <td class="titre">&nbsp;&nbsp;Listing Students </td>
	<td width="150">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		 <td valign="top" align="center">
		   <a href="gestion_des_etudiants.php?new=oui">
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

					 chemin='gestion_des_etudiants.php?modifier='+chemin;

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

					 chemin='gestion_des_etudiants.php?detail='+chemin;

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
				        
						 chemin='gestion_des_etudiants.php?buletinBachelor='+chemin;

					     window.location.replace(chemin);
                                  
				   }

				   "><div class="buletinbba"></div>Bulletin </a>
		  </td>-->
		  <td valign="top" align="center">
		   <a href="#"
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez s&eacute;lectionner un &eacute;tudiant dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_des_etudiants.php?buletinMaster='+chemin;

				     window.location.replace(chemin);

				   }

				   "><div class="buletin"></div>Bulletin </a>
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

					 chemin='gestion_des_etudiants.php?supprimer='+chemin;

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

					 chemin='gestion_des_etudiants.php?archiver='+chemin;

				     window.location.replace(chemin);

				   }

				   "><div class="archiver"></div>Archiver</a>
		  </td>
          	  <td valign="top" align="center">
		   <a href="gestion_des_etudiants.php?archive=oui"><div class="archive"></div>Archive</a>
		  </td>-->
 		  <td valign="top" align="center" >
		  <a href="#" onclick="window.print()" title="Imprimer">
		  <div class="imprimer"></div>
		  Print
		  </a>
		  </td>
		</tr>
	  </table>

	</td> 

  </tr>

</table>

 <table width="100%" cellspacing="1" border="0"  class="adminlist" >
 <form action="#" method="post" name="adminMenu" >

<input type="hidden" name="boxchecked" value="0" />

<div class="container_search">
<!-- <select name="groupe" class="search"> 
		<option value="0">GROUPE</option>
		<?php
		$sql2="select id, title from $tbl_groupe where archive=0";
		$req=@mysql_query($sql2) or die ('erreur lors de la selection des groupes');
		while($row=mysql_fetch_assoc($req)){
          $st=htmlentities($row['title']);
		  $id=htmlentities($row['id']);
		?>
		<option value="<?=$id?>" <?=($id==$sgroupe) ? $selected : ''?>><?=$st?></option>
		<?php }?>
	  </select>
	  <select name="annee_etude" class="search">
		<option value="">ANNEE</option>
        <option value="1" <?=($annee==1) ? $selected : '' ?>>1.ann&eacute;e</option>
        <option value="2" <?=($annee==2) ? $selected : '' ?>>2.ann&eacute;e</option>
        <option value="3" <?=($annee==3) ? $selected : '' ?>>3.ann&eacute;e</option>
        <option value="4" <?=($annee==4) ? $selected : '' ?>>4.ann&eacute;e</option>
        <option value="5" <?=($annee==5) ? $selected : '' ?>>5.ann&eacute;e</option>
        <option value="master" <?=($annee=='master') ? $selected : '' ?>>MASTER</option>
        <option value="MBA" <?=($annee=='MBA') ? $selected : '' ?>>MBA</option>
	  </select>
		<select name="filiere" class="search"> 
		<option value="0">FILIERES</option>
		<?php
		$sql1="select id_filiere, nom_filiere from $tbl_filiere where archive=0 
		order by nom_filiere desc";
		$req=@mysql_query($sql1) or die ('erreur lors de la selection des filiere');
		while($row=mysql_fetch_assoc($req)){
		$fil=htmlentities($row['nom_filiere']);
		$id=htmlentities($row['id_filiere']);
		?>
		<option value="<?=$id?>" <?=($filiere==$id)  ? $selected : '' ?>><?=$fil?></option>
		<?php
		}
		?>
	  </select>
	 <select name="annee_inscription" class="search">
		<option value="0">ANNEE</option>
		<?php
		for($i=date('Y'); $i > 2005; $i-- ){
		
		?>
		<option value="<?=$i?>"  <?=($annee_inscription==$i)  ? $selected : '' ?>><?=$i?></option>
		<?php
		}
		?>
	  </select>
      <select name="elearning" class="search">
		<option value="">E-LEARNING</option>
		<option value="1" <?=($elearning==1)  ? $selected : '' ?>>oui</option>
        <option value="0" <?=($elearning==0)  ? $selected : '' ?>>non</option>
	  </select>
      <select name="schools" class="search">
		<option value="">SCHOOLS</option>
		<option value="piimt" <?=($school=='piimt') ? $selected : '' ?>>PIIMT</option>
        <option value="aul" <?=($school=='aul') ? $selected : '' ?>>AUL</option>
        <option value="umt" <?=($school=='umt') ? $selected : '' ?>>UMT</option>
	  </select>-->
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
		  <th width="272"><?php echo 'Registration Date'; ?></th>
		 
		 	
		
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
		   ?>

	   <tr height="17px">
	 <td align="center">&nbsp;<?=$i?>
		 <td align="center"><input type="radio" id="<?=$ci?>" name="id" value="<?=$ci?>" 
		 onClick="document.adminMenu.boxchecked.value='<?=$ci?>'" /></td>
		 <td class="gras">&nbsp;<?=$ci?></td>
		 <td>&nbsp;<?=ucfirst(stripslashes($ligne["name"]))?></td>
		  <td>&nbsp;<?php if($ligne['groupe']== '2')
		  { echo 'FH';}
		  else  if($ligne['groupe']== '3')
		  { echo 'FE';} else { echo' ';}?></td>
		 <td>&nbsp;<?php
		$date=$ligne["date_inscription"];
		$tab=split('[/.-]',$date); 
		echo $tab[1].'-'.$tab[2].'-'.$tab[0]; 
		
		?></td>
	
	<!--	 <td>&nbsp;<?=html_entity_decode($ligne["title"])?></td>
		 <td>&nbsp;<?=htmlentities($ligne["annee"])?></td>
		 <td>&nbsp;<?=ucfirst(stripslashes($ligne["nom_filiere"]))?></td>
		 <td>&nbsp;<?=$ligne["date_inscription"]?></td>
		  <td>&nbsp;<?=$ligne["ville"]?></td>
		 <td align="center"> <a href="gestion_des_etudiants.php?acces=<?=$ligne["acces"]==0 ? 1 : 0 ?>&user_id=<?=$ligne["code_inscription"]?>"><?=$ligne["acces"]=='0' ? $non : $oui ?></a></td>-->
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
