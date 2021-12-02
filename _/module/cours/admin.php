<?php
        $Cwhere=$Csemestre=$Csession=$Ccredit=$Csearch=$Ctype_cours='';
 		
	      if((isset($_POST['search_par_code'])) && (!empty($_POST['search_par_code'])) ){
			   $Csearch = addslashes(trim($_POST['search_par_code']));
			   $Cwhere ="  and code_cours like '".$Csearch."%'";
	                                                                					}

	    if((isset($_POST['search_par_titre'])) && (!empty($_POST['search_par_titre'])) ){
			   $Csearch = trim($_POST['search_par_titre']);
			   $Cwhere ="  and titre like '".$Csearch."%'";
	                                                                					}

	   else if((isset($_POST['tous'])) && (!empty($_POST['tous']))){
			   $Cwhere=$Csemestre=$Csession=$Ccredit=$Csearch=$Ctype_cours=$Cinsc='';
			   unset($_SESSION['semestre']);
			   unset($_SESSION['session']);
			   unset($_SESSION['credit']);
			   unset($_SESSION['type_cours']);
			   unset($_SESSION['insc']);
	   																}

	   else{

                   //session comme critere 

				  if( (isset($_POST['session'])) && (!empty($_POST['session'])) ){
 					 $Csession = $_SESSION['session'] = $_POST['session'];
  	                 $Cwhere = $Cwhere." and session like '%". $Csession."%'";
					                                                             }

						 else if( (isset($_POST['session'])) && (empty($_POST['session'])) ){
  	                      unset($_SESSION['session']);
 						                                                          			}

																				  

						  else if((isset($_SESSION['session'])) && (!empty($_SESSION['session']))){
							  $Csession = $_SESSION['session'];
  	                      	  $Cwhere = $Cwhere." and session like '%". $Csession."%'";
 						                                                   						  }					   
				              
									//filiere comme critere 
																									  
						if( (isset($_POST['type'])) && (!empty($_POST['type'])) ){
							$Ctype_cours = $_SESSION['type_cours'] = $_POST['type'];
							$Cwhere = $Cwhere." and type like '%". $Ctype_cours."%'";
																				 }

																					   

							else if( (isset($_POST['type'])) && (empty($_POST['type'])) ){
  	                          unset($_SESSION['type_cours']);
 						                                                                       }

																					   

							else if( (isset($_SESSION['type_cours'])) && (!empty($_SESSION['type_cours'])) ){
							   $Ctype_cours = $_SESSION['type_cours'];
  	                           $Cwhere = $Cwhere." and type like '%". $Ctype_cours."%'";
						                                                                         }

									//credit comme critere

							 if( (isset($_POST['credit'])) && (!empty($_POST['credit'])) ){
								$Ccredit = $_SESSION['credit'] = $_POST['credit'];
								$Cwhere =$Cwhere." and  nbr_credit= '".$Ccredit."'";
																						  }



									else if( (isset($_POST['credit'])) && (empty($_POST['credit'])) ){
  	                                                  unset($_SESSION['credit']);
						                                                                            }

																						
						else if( (isset($_SESSION['credit'])) && (!empty($_SESSION['credit'])) ){
										   $Ccredit = $_SESSION['credit'];
										   $Cwhere = $Cwhere." and  nbr_credit= '".$Ccredit."'";
																								}
																								
                                    	 

                                   //semestre come critere

							 if( (isset($_POST['semestre'])) && (!empty($_POST['semestre'])) ){
								$Csemestre = $_SESSION['semestre'] = (int)$_POST['semestre'];
								$Cwhere =$Cwhere." and  semestre like '%".$Csemestre."%'";
																						      }



								else if( (isset($_POST['semestre'])) && ($_POST['semestre']=='') ){
  	                                                  unset($_SESSION['semestre']);
						                                                                            }

																						

									else if( (isset($_SESSION['semestre'])) && ($_SESSION['semestre']!='') ){
									    $Csemestre = $_SESSION['semestre'];
										$Cwhere =$Cwhere." and  semestre like '%".$Csemestre."%'";

																										}

																			

	      }

						$sql="SELECT code_cours, titre, nbr_credit, session, semestre
							 FROM $tbl_cours where  archive = 0 ".$Cwhere."  ORDER BY titre ";

?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/cours.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES COURS</td>
	<td width="22%">
	<!--top menu-->
	  <table border="0" align="right" width="100%" cellpadding="0" cellspacing="12" id="link" >
	    <tr>
		 <td valign="top" align="center">
		   <a href="gestion_cours.php?new=oui"><div class="ajouter"></div>Nouveau</a>
		  </td>
		  <td valign="top" align="center" >
		  <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez s&eacute;lectionner un cours dans la liste ');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_cours.php?modifier='+chemin;

				     window.location.replace(chemin);

				   }

				   " 

		   title="modifier un cours"><div class="modifier"></div>Modifier</a>
		  </td>
 		  <td valign="top" align="center">
		   <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez s&eacute;lectionner un cours dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_cours.php?archiver='+chemin;

				     window.location.replace(chemin);

				   }

				   " title="supprimer un cours"><div class="delete"></div>Supprimer</a>

		  </td>
		  
		   <td valign="top" align="center" >
		  <a href="#" onclick="window.print();" title="Imprimer"><div class="imprimer"></div>Imprimer</a>
		  </td>
		</tr>

	  </table>
	</td> 
</table>

<table width="100%" align="center" cellspacing="1"  class="adminlist" style="margin-top:2px">

<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
<div class="container_search">
  <select name="session" class="search" > 
	<option value="0">&nbsp;SESSION</option>
	<option value="automne" <?=($Csession=='automne') ? $selected : '' ?>>Automne</option>
	<option  value="printemps" <?=($Csession=='printemps') ? $selected : ''?>>Printemps</option>   
	<option value="été" <?=($Csession=='été') ? $selected : '' ?>>été</option>
  </select>
  <select name="type" class="search" >
	<option value="0">&nbsp;GROUPE </option>
	<option value="bachelor" <?=($Ctype_cours=='bachelor') ? $selected : '' ?>>Bachelor</option>
	<option value="master" <?=($Ctype_cours=='master') ? $selected : '' ?>>Master</option>
   
  </select>
		 <select name="credit" class="search" >
			   <option value="0">&nbsp;CREDIT </option>
			   <?php
			   $sql_credit="select distinct nbr_credit from $tbl_cours where nbr_credit!=''";
			   $req=@mysql_query($sql_credit);
			   while($row=mysql_fetch_assoc($req)){
			   $crt=$row['nbr_credit'];
			   ?>
			   <option value="<?=$crt?>" <?=($Ccredit==$crt) ? $selected : '' ?>><?=$crt?></option>
			<?php
			}
			?>
 		</select>
 		<select name="semestre" class="search" >
			 <option value="0">&nbsp;SEMESTRE </option>
			 <option value="1" <?=($Csemestre==1) ? $selected : '' ?>>1</option>
			 <option value="2" <?=($Csemestre==2) ? $selected : '' ?>>2</option>
			 <option value="3" <?=($Csemestre==3) ? $selected : '' ?>>3</option>
			 <option value="4" <?=($Csemestre==4) ? $selected : '' ?>>4</option>
			 <option value="5" <?=($Csemestre==5) ? $selected : '' ?>>5</option>
			 <option value="6" <?=($Csemestre==6) ? $selected : '' ?>>6</option>
			 <option value="7" <?=($Csemestre==7) ? $selected : '' ?>>7</option>
			 <option value="8" <?=($Csemestre==8) ? $selected : '' ?>>8</option>
         </select>
   		  <input type="text" class="input" name="search_par_code" size="10" />&nbsp;
		  <input type="text" class="input" name="search_par_titre" size="30" />&nbsp;
		  <input type="submit" value="valider" name="valider" class="input"  />&nbsp;
		  <input type="submit" value="tous" name="tous" class="input"  />&nbsp;
 </div>

  <tr>
     <th width="15" align="center">#</th>
	 <th width="10">&nbsp;</th>
	 <th width="75" align="center" nowrap="nowrap">Code</th>
	 <th width="725" align="center" >Intitul&eacute; du cours</th>
     <th width="75" align="center">Cr&eacute;dit</th>
	 <th width="75" align="center">Session</th>
 	 <th width="75" align="center">Semestre</th>
   </tr>

  <?php
      $i=0;
     $total = @mysql_query($sql) or die("erreur lors de la s&eacute;lectiob des cours"); 
	 $url = $_SERVER['PHP_SELF']."?limit=";
     $nblignes = mysql_num_rows($total);
     $nbpages = ceil($nblignes/$parpage);
     $result = validlimit($nblignes,$parpage,$sql);
 	 while ($ligne = mysql_fetch_array($result)) {
	 $i++;
	 $cc=str_replace("&",'-and-',$ligne["code_cours"]);
	 
?>

    <tr>
       <td align="center"><?=$i?></td>
 	   <td align="center"><input type="radio" id="<?=$cc?>"  name="id" value="<?=$cc?>" 
	   onClick="document.adminMenu.boxchecked.value='<?=$cc?>'" /></td>
       <td align="left" style="font-weight:bold">&nbsp;<?=$ligne["code_cours"]?></td>
 	   <td align="left">&nbsp;<?=trim(stripslashes($ligne["titre"]))?></td>
       <td align="center">&nbsp;<?=$ligne["nbr_credit"]?></td>
       <td align="center">&nbsp;<?=html_entity_decode($ligne["session"])?></td>
  	   <td align="center">&nbsp;<?=$ligne["semestre"]?></td>
   </tr>
      <?php
      }
      ?>
</form> 
</table>
		<div id='pagination' align='center'>
         <?php
             echo pagination($url,$parpage,$nblignes,$nbpages);
           ?>
	   </div>
	    