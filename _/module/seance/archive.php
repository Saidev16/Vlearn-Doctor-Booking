<?php
       
	   $code_jours = $code_salle = $search = $where = $code_prof= '';

	 if((isset($_POST['search_par_code'])) && (!empty($_POST['search_par_code'])) ){
 	    $search = trim($_POST['search_par_code']);
	    $where ="  and c.code_cours like '%".$search."%'";
	                                                                				}

	    if((isset($_POST['search_par_titre'])) && (!empty($_POST['search_par_titre'])) ){
		   $search = trim($_POST['search_par_titre']);
		   $where ="  and c.titre like '%".$search."%'";
	                                                                }

	    else if((isset($_POST['tous'])) && (!empty($_POST['tous']))){
		   $jour = $salle = $search = $where =  '';
		   unset($_SESSION['code_jours']);
		   unset($_SESSION['code_salle']);
		   unset($_SESSION['idSession']);
		   unset($_SESSION['Scode_prof']);
		  
	                                                                }

	   else{

                   //le jour comme critère 
 
			if( (isset($_POST['code_jours'])) && (!empty($_POST['code_jours'])) ){
 					 $code_jours = $_SESSION['code_jours'] = $_POST['code_jours'];
  	                 $where = $where." and s.code_jours='". $code_jours."'";
					                                                        }

				 else if( (isset($_POST['code_jours'])) && (empty($_POST['code_jours'])) ){
  	                      unset($_SESSION['code_jours']);
 						                                                          }


					else if( (isset($_SESSION['code_jours'])) && (!empty($_SESSION['code_jours'])) ){
  	                          $where = $where." and s.code_jours='".$_SESSION['code_jours']."'";

 						                                                   }					   

				              //la salle  comme critère 

							  

			 if((isset($_POST['code_salle'])) && (!empty($_POST['code_salle'])) ){
 						$code_salle = $_SESSION['code_salle'] = $_POST['code_salle'];
						$where = $where." and s.code_salle='". $code_salle."'";
																			   }

			else if( (isset($_POST['code_salle'])) && (empty($_POST['code_salle'])) ){
  	                            unset($_SESSION['code_salle']);
 						                                                          }


				else if( (isset($_SESSION['code_salle'])) && (!empty($_SESSION['code_salle'])) ){
								 $where = $where." and s.code_salle='". $_SESSION['code_salle']."'";
                                                                                                    }

									//la session comme critère 																  
		    if( (isset($_POST['idSession'])) && (!empty($_POST['idSession'])) ){
 				$idSession = $_SESSION['idSession'] = $_POST['idSession'];
				$where = $where." and s.idSession='". $idSession."'";
																	       }

 			else if( (isset($_POST['idSession'])) && (empty($_POST['idSession'])) ){
   	               unset($_SESSION['idSession']);
 						                                                       }

 			else if( (isset($_SESSION['idSession'])) && (!empty($_SESSION['idSession'])) ){
 							   $idSession = $_SESSION['idSession'];
   	                           $where = $where." and s.idSession='". $_SESSION['idSession']."'";
 						                                                              }
									
					else{
					   $where = $where." and s.idSession='".$idSession."'";
				}
 	     
             
									

				 
				  if((isset($_POST['code_prof'])) && (!empty($_POST['code_prof'])) ){
 						$code_prof = $_SESSION['cp'] = $_POST['code_prof'];
						$where = $where." and s.code_prof='". $code_prof."'";
																				    }

						  else if( (isset($_POST['code_prof'])) && (empty($_POST['code_prof'])) ){
  	                            unset($_SESSION['Scode_prof']);
 						                                                         				 }

																				 

							  else if( (isset($_SESSION['cp'])) && (!empty($_SESSION['Scode_prof'])) ){
								 $where = $where." and s.code_prof='". $_SESSION['Scode_prof']."'";
								 															  }
 	      }

		 		 $sql="SELECT  s.code_seance, s.code_cours, 
				 s.idSession, s.nbr_inscrit, c.titre, p.nom_prenom, 
				 sl.nom_salle, h.nom_horaire, j.nom_jours  from 
 				 $tbl_cours as c, $tbl_seance as s, $tbl_professeur as p, $tbl_jours as j,
				 $tbl_horaire as h, $tbl_salle as sl
				 where trim(s.code_cours)=trim(c.code_cours) 
				 and s.code_prof=p.code_prof 
				 and s.code_jours=j.code_jours
				 and s.code_horaire=h.code_horaire
				 and s.code_salle=sl.code_salle
				 and s.archive=1"
 				 .$where." ORDER BY c.titre  ";
				 
 ?>
 <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
   <tr>
     <td>&nbsp;<img src="images/icone/livres.gif" border="0"/></td>
     <td width="78%" class="titre">&nbsp;GESTION DES SEANCES   <span class="task">[archive]</span>
	</td>
	<td width="22%">

	  <table border="0" align="right" width="100%" cellpadding="5" cellspacing="4" id="link" >

	    <tr>
		  <td valign="top" align="center" >

		  <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionnez une séance ??');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_seance.php?modifier='+chemin;

				     window.location.replace(chemin);

				   }

				   "><div class="modifier"></div>Modifier</a> 
		  </td>
		  <td valign="top" align="center">
		   <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionnez une séance??');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_seance.php?desarchiver='+chemin;

				     window.location.replace(chemin);

				   }

				   "

		  ><div class="desarchiver"></div>

		   Désarchiver</a>

		  </td>
                <td valign="top" align="center" >

		  <a href="#"

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionnez un cours ??');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_seance.php?descriptif='+chemin;

				     window.location.replace(chemin);

				   }

				   "

		    title="voir le déscriptif du cours">

		  <div class="descriptif"></div>Déscriptif</a>

	    

		  </td>

		  <td valign="top" align="center" >

		  <a href="#"

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionnez un cours ??');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_seance.php?syllabus='+chemin;

				     window.location.replace(chemin);

				   }

				   "><div class="syllabus"></div> Syllabus</a>
		  </td>
		 
		  <td valign="top" align="center" >
		  	<a href="#" onclick="window.print()"><div class="imprimer"></div>Imprimer</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_seance.php"><div class="retour"></div>Retour</a>
		  </td>
		</tr>
	  </table>
	</td> 
   </tr>
</table>
<table width="100%" align="center" cellspacing="1"  class="adminlist" >
<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
<div class="container_search">
 <select name="code_jours" class="search" >

      <option value="0">JOUR</option>
     <?php 
     $annee="select code_jours, nom_jours from $tbl_jours where archive= 1 ";
	 $req=mysql_query($annee) or die("erreur lors du chargement des jours ");
	 while ($row=mysql_fetch_assoc($req)){
	 $cj=$row['code_jours'];
	 $nj=$row['nom_jours'];
	 ?>
	 <option value="<?=$cj?>" <?=($cj==$code_jours)  ? $selected : ''?>><?=$nj?></option>
    <?php
     }
    ?>
 </select>

  <select name="code_salle" class="search" >

 <option value="0">SALLE</option>

 <?php 
     $sql3="select code_salle, nom_salle from $tbl_salle where archive=1 order by code_salle";
	 $req=mysql_query($sql3) or die("erreur lors de la sélection des salle");
	 while ($row=mysql_fetch_assoc($req)){
	 $cs=$row['code_salle'];
	 $ns=htmlentities($row['nom_salle']);
	 ?>

	 <option  value="<?=$cs?>" <?=($cs==$code_salle) ? $selected : '' ?>><?=$ns?></option>

 <?php

 }

 ?>

 </select>
  
<select name="session" id="session" class="search" >
     <option value="0">SESSION</option>
     <?php 
     $sql5="select idSession, annee_academique, session  from $tbl_session";
	  
	 $req=mysql_query($sql5) or die("erreur lors de la sélection des annees academique");
	 while ($row=mysql_fetch_assoc($req)){
	 $an=htmlentities($row['session']).' '.htmlentities($row['annee_academique']);
	 $is=$row['idSession'];
	 ?>
	 <option  value="<?=$is?>" <?=($idSession==$is) ? $selected : '' ?>><?=$an?></option>
     <?php
 }
 ?>
    </select>
	<select name="code_prof" class="search" style="width:175px" >

<option value="0">&nbsp;PROFESSEUR</option>

 <?php 

     $sql6="select distinct code_prof, nom_prenom  from $tbl_professeur where 
	 code_prof in (select code_prof from $tbl_seance where archive= 1) order by nom_prenom";
	 $req=@mysql_query($sql6) or die("erreur lors de la sélection des professeurs");
	 while ($row = mysql_fetch_assoc($req)){
	 $np=strtoupper($row['nom_prenom']);
	 $cp=$row['code_prof'];
	 ?>
	 <option  value="<?=$cp?>" <?=($code_prof==$cp) ? $selected : '' ?>><?=$np?></option>
 <?php
 }
 ?>
 </select>
 	    <input type="text" class="input" name="search_par_code" size="10" /> 
 		<input type="text" class="input" name="search_par_titre" size="20" /> 
		<input type="submit" name="valider" value="valider" class="input"  /> 
 		<input type="submit" value="tous" name="tous" class="input"  /> 
 </div>
  <tr>
     <th width="10">#</th>
 	 <th width="15"></th>
	 <th width="75">Code</th>
 	 <th width="450">Titre du cours</th>
 	 <th width="40">Inscrit</th>
 	 <th width="75">Jour</th>
 	 <th width="100">Horaire</th>
	 <th width="50">Salle</th>
 	 <th width="175">Enseignant</th>
   </tr>
   <?php
       $i=0;
       $req=@mysql_query($sql) or die ("erreur lors de sélection des séance des cours");
  	   while ($ligne = mysql_fetch_array($req)) {
 	   $i++;
 ?>
 <tr>
      <td align="center"><?=$i?></td>
 	  <td align="center"><input type="radio" id="<?=$ligne["code_seance"];?>" 
	  name="id" value="<?=$ligne["code_seance"];?>" 
	  onClick="document.adminMenu.boxchecked.value=<?=$ligne["code_seance"];?>" />      </td>
	  <td class="gras">&nbsp;<?=htmlentities(trim($ligne["code_cours"]))?></td>
 	  <td>&nbsp;<?=htmlentities(trim($ligne["titre"]))?></td>
	  <td class="gras">&nbsp;<?=htmlentities($ligne["nbr_inscrit"])?></td>
	  <td>&nbsp;<?=htmlentities($ligne["nom_jours"])?></td>
      <td>&nbsp;<?=htmlentities($ligne["nom_horaire"])?></td>
	  <td>&nbsp;<?=htmlentities($ligne["nom_salle"])?></td>
 	  <td>&nbsp;<?=htmlentities($ligne["nom_prenom"])?></td>
 </tr>
      <?php
      }
	  ?>
</form>
</table>