<?php

       $where=$semestre=$session=$credit=$search=$type='';


	   if((isset($_POST['search_par_code'])) && (!empty($_POST['search_par_code'])) ){

 	   $search = $_POST['search_par_code'];

	   $where ="  and code_cours like '%".$search."%'";

	                                                                }

	    if((isset($_POST['search_par_titre'])) && (!empty($_POST['search_par_titre'])) ){

 	   $search = $_POST['search_par_titre'];

	   $where ="  and titre like '%".$search."%'";

	                                                                }

	   else if((isset($_POST['tous'])) && (!empty($_POST['tous']))){

	   $where=$semestre=$session=$credit=$search=$type='';

	   unset($_SESSION['semestre']);

	   unset($_SESSION['session']);

	   unset($_SESSION['credit']);

	   unset($_SESSION['type']);

	   }

	   else{

                   //session comme critère 

				   

				  if( (isset($_POST['session'])) && (!empty($_POST['session'])) ){

 					 $session = $_POST['session'];

					 $_SESSION['session'] = $session;

  	                $where = $where." and session='". $session."'";

					                                                        }

																			

						 else if( (isset($_POST['session'])) && (empty($_POST['session'])) ){

  	                      unset($_SESSION['session']);

 						                                                          }

																				  

							else if( (isset($_SESSION['session'])) && (!empty($_SESSION['session'])) ){

							  $session = $_SESSION['session'];

  	                       $where = $where." and session='". $_SESSION['session']."'";

 						                                                   }					   

				            
									//filière comme critère 																  

																		   

						if( (isset($_POST['type'])) && (!empty($_POST['type'])) ){

							$type = $_POST['type'];

							$_SESSION['type']=$type;

							$where = $where." and type='". $type."'";

																					   }

																					   

							else if( (isset($_POST['type'])) && (empty($_POST['type'])) ){

  	                          unset($_SESSION['type']);

 						                                                                       }

																					   

							else if( (isset($_SESSION['type'])) && (!empty($_SESSION['type'])) ){

							   $type = $_SESSION['type'];

  	                           $where = $where." and type='". $_SESSION['type']."'";

						                                                                            }

									//crédit comme critère 

																									

							 if( (isset($_POST['credit'])) && (!empty($_POST['credit'])) ){

								$credit = $_POST['credit'];

								$_SESSION['credit']=$credit;

								$where =$where." and  nbr_credit= '".$credit."'";

																						}

																						

									else if( (isset($_POST['credit'])) && (empty($_POST['credit'])) ){

  	                                                  unset($_SESSION['credit']);

						                                                                            }

																						

										else if( (isset($_SESSION['credit'])) && (!empty($_SESSION['credit'])) ){

										   $credit = $_SESSION['credit'];

										$where =$where." and  nbr_credit= '".$credit."'";

																											}

																									

							 if( (isset($_POST['semestre'])) && (!empty($_POST['semestre'])) ){

								$semestre = $_POST['semestre'];

								$_SESSION['semestre']=$semestre;

								$where =$where." and  semestre= '".$semestre."'";

																						}

																						

								else if( (isset($_POST['semestre'])) && (empty($_POST['semestre'])) ){

  	                                                  unset($_SESSION['semestre']);

						                                                                            }

																						

									else if( (isset($_SESSION['semestre'])) && (!empty($_SESSION['semestre'])) ){

									   $semestre = $_SESSION['semestre'];

									$where =$where." and  semestre= '".$semestre."'";

																										}

																			

	      }

			 $sql="SELECT code_cours, titre, nbr_credit, session, semestre  
		 FROM $tbl_cours where archive = 1 ".$where."  ORDER BY titre ";

	 

?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td>&nbsp;<img src="images/icone/cours.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES COURS <span class="task">[archive]</span></td>

	<td width="22%">

	  <table border="0" align="right" width="40%" cellpadding="10" cellspacing="4" id="link" >

	    <tr>

 		  <td valign="top" align="center" >

		  <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionnez un cours ??');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_cours.php?desarchiver='+chemin;

				     window.location.replace(chemin);

				   }

				   " 

		     title="désarchiver un cours"> <div class="desarchiver"></div>Désarchiver</a>

		  </td>

		   <td valign="top" align="center">

		   <a href="gestion_cours.php" title="précedent"> <div class="retour"></div>Retour</a>
		  

		  </td>

		</tr>

	  </table>

	</td> 

</table>

<table width="100%" align="center" cellspacing="1"  class="adminlist">

<form action="#" method="post" name="adminMenu">

<input type="hidden" name="boxchecked" value="0" />

<div class="container_search">

        <select name="session" class="search" > 

			<option value="0">&nbsp;SESSION</option>

			<option  value="printemps" <?=($session=='printemps') ? $selected : '' ?>>PRINTEMPS</option>

			<option value="automne" <?=($session=='automne') ? $selected : '' ?>>AUTOMNE</option>

      </select>

 

  <select name="type" class="search" >

   <option value="0">&nbsp;GROUPE </option>

   <option value="bachelor" <?=($type=='bachelor') ? $selected : '' ?>>BACHELOR</option>

   <option value="master" <?=($type=='master') ? $selected : '' ?>>MASTER</option>
   
    <option value="bachelor/master" <?=($type=='bachelor/master') ? $selected : '' ?>>BACHELOR/MASTER</option>
 </select>

 <select name="credit" class="search" >

   <option value="0">&nbsp;CREDIT </option>

   <?php

   $sql_credit="select distinct nbr_credit from tbl_cours where nbr_credit!='' and archive= 1";

   $req=@mysql_query($sql_credit);

   while($row=mysql_fetch_assoc($req)){

   ?>

   <option value="<?=$row['nbr_credit']?>" <?=($credit==$row['nbr_credit']) ? $selected : '' ?>><?=$row['nbr_credit']?></option>

<?php

}

?>

 </select>

 

 <select name="semestre" class="search" >

   <option value="0">&nbsp;SEMESTRE </option>

 <option value="1" <?=($semestre==1) ? $selected : '' ?>>1</option>

 <option value="2" <?=($semestre==2) ? $selected : '' ?>>2</option>

 <option value="3" <?=($semestre==3) ? $selected : '' ?>>3</option>

 <option value="4" <?=($semestre==4) ? $selected : '' ?>>4</option>

 <option value="5" <?=($semestre==5) ? $selected : '' ?>>5</option>

 <option value="6" <?=($semestre==6) ? $selected : '' ?>>6</option>

 <option value="7" <?=($semestre==7) ? $selected : '' ?>>7</option>

 <option value="8" <?=($semestre==8) ? $selected : '' ?>>8</option>

 </select>

 

 
  		  <input type="text" class="input" name="search_par_code" size="15" />&nbsp; 

		  <input type="text" class="input" name="search_par_titre" size="30" />&nbsp; 

		  <input type="submit" value="valider" class="input"  />&nbsp;

		  <input type="submit" value="tous" name="tous" class="input"  />&nbsp;
 </div>

 <tr>

     <th width="15" align="center">#</th>

	 <th width="10"></th>

	 <th width="75" align="center" nowrap="nowrap">Code</th>

	 <th width="725" align="center" >Intitulé du cours</th>

     <th width="75" align="center">Crédit</th>

	 <th width="75" align="center">Session</th>

 	 <th width="75" align="center">Semestre</th>

 

  </tr>

  <?php

     $i=0;

     $total = @mysql_query($sql)or die ("erreur lors de la selection des évennement");; 

	 $url = $_SERVER['PHP_SELF']."?limit=";

     $nblignes = mysql_num_rows($total);

	 $parpage=25;

     $nbpages = ceil($nblignes/$parpage);

     $result = validlimit($nblignes,$parpage,$sql);

 	  while ($ligne = mysql_fetch_array($result)) {

	   $i++;

?>

 <tr>
        <td align="center"><?=$i?></td>
 	   <td align="center"><input type="radio" id="<?=htmlentities($ligne["code_cours"])?>" 
	   name="id" value="<?=htmlentities($ligne["code_cours"])?>" 
	   onClick="document.adminMenu.boxchecked.value='<?=htmlentities($ligne["code_cours"])?>'" /></td>
       <td align="left" style="font-weight:bold">&nbsp;<?=htmlentities($ligne["code_cours"])?></td>
 	   <td align="left">&nbsp;<?=htmlentities($ligne["titre"])?></td>
       <td align="center"><?=($ligne["nbr_credit"]) ? $ligne["nbr_credit"] : '-'?></td>
       <td align="center"><?=($ligne["session"]) ? html_entity_decode($ligne["session"]) : '-'?></td>
  	   <td align="center"><?=($ligne["semestre"]) ? $ligne["semestre"] : '-'?></td>
  </tr>

<?php

      }

?>

</form></table>

 <?php

     echo "<div id='pagination' align='center'>";

     echo pagination($url,$parpage,$nblignes,$nbpages);

     echo "</div>";

?>