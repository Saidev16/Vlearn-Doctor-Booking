<?php



       $where=$categorie=$disponibilite=$search='';

		 

	   if((isset($_POST['search'])) && (!empty($_POST['search'])) ){

 	   $search = $_POST['search'];

	   $where ="  and titre_livre like '%".$search."%'";

	                                                                }

	   else if((isset($_POST['tous'])) && (!empty($_POST['tous']))){

	      $where=$categorie=$disponibilite=$search='';

	   unset($_SESSION['categorie']);

	   unset($_SESSION['disponibilite']);

 	   }

	   else{

                   //session comme critère 

				   

				  if( (isset($_POST['categorie'])) && (!empty($_POST['categorie'])) ){

 					 $categorie = $_POST['categorie'];

					 $_SESSION['categorie'] = $categorie;

  	                $where = $where." and  categorie_livre='". $categorie."'";

					                                                        }

																			

						 else if( (isset($_POST['categorie'])) && (empty($_POST['categorie'])) ){

  	                      unset($_SESSION['categorie']);

 						                                                          }

																				  

							else if( (isset($_SESSION['categorie'])) && (!empty($_SESSION['categorie'])) ){

							  $categorie = $_SESSION['categorie'];

  	                       $where = $where." and  categorie_livre='". $_SESSION['categorie']."'";

 						                                                   }					   

				              //code du professeur  comme critère 

							  

					 if((isset($_POST['disponibilite'])) && (!empty($_POST['disponibilite'])) ){

 						$disponibilite = $_POST['disponibilite'];

						$_SESSION['disponibilite']=$disponibilite;

						$where = $where." and  disponibilite='". $disponibilite."'";

																				 }

						  else if( (isset($_POST['disponibilite'])) && (empty($_POST['disponibilite'])) ){

  	                            unset($_SESSION['disponibilite']);

 						                                                          }

																				 

							  else if( (isset($_SESSION['disponibilite'])) && (!empty($_SESSION['disponibilite'])) ){

 								  $disponibilite = $_SESSION['disponibilite'];

								 $where = $where." and  disponibilite='". $_SESSION['disponibilite']."'";

									                                                                  }

 	                                                                              }

		  

$sql="select code_livre, titre_livre, nbr_exemplaire, date_aquisition, nbr_empreinte  from $tbl_livre where code_livre!=0 ".$where. ' order by titre_livre'; 

 ?>

 <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td>&nbsp;<img src="images/icone/bibliotheque.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES LIVRES </td>

	<td width="22%">

	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >

	    <tr>

		 <td valign="top" align="center">

		   <a href="gestion_bibliotheque.php?new=oui"><div class="ajouter"></div>Nouveau</a>

		  </td>

		  <td valign="top" align="center" >

		  <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionnez un livre ??');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_bibliotheque.php?modifier='+chemin;

				     window.location.replace(chemin);

				   }

				   " > 

		  <div class="modifier"></div>Modifier</a>

	      

		  </td>

		  <td valign="top" align="center">

		   <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionnez un livre??');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_bibliotheque.php?supprimer='+chemin;

				     window.location.replace(chemin);

				   }

				   ">

		  <div class="supprimer"></div>

		   Archiver</a>

		  </td>

		 

		</tr>

	  </table>

	</td> 

  </tr>

</table>

<table width="100%" align="center" cellspacing="1"  class="adminlist">

<form action="#" method="post" name="adminMenu">

<input type="hidden" name="boxchecked" value="0" />

 <div class="container_search">

 <select name="categorie" class="search" onchange="document.adminMenu.submit();">

     <option value="0">CATEGORIE</option>

 <?php 

 $sql2="select distinct categorie_livre from $tbl_livre";

	 $req2=mysql_query($sql2) or die("erreur lors de la sélection des filiere");

	 while ($row=mysql_fetch_assoc($req2)){

	 ?>

	 <option value="<?=htmlentities($row['categorie_livre'])?>"><?=htmlentities(strtoupper($row['categorie_livre']))?></option>

 <?php

 }

 ?>

 </select>

 <select name="disponibilite" class="search" onchange="document.adminMenu.submit();">

     <option value="0">DISPONIBILITE</option>

	 <option value="0">OUI</option> 

	  <option value="1">NON</option>

	  </select>

	  <input type="text" class="input" name="search" size="45" />&nbsp; 

		  <input type="submit" value="Rechercher" class="input"  />&nbsp;

		  <input type="submit" value="afficher tous" name="tous" class="input"  />&nbsp;

	  </div>

  <tr>

     <th width="20px" align="center">#</th>

	 <th width="20px">&nbsp;</th>

	 <th width="550px">Titre</th>

	 <th width="150px">Nombre d'exemplaire</th>

	 <th width="150px">Date d'aquisition</th>

	 <th width="150px">Nombre d'emprunts</th>

	  </tr>

     <?php

      $i=0;

      $req=@mysql_query($sql) or die ("erreur lors de la sélection des livres");

 	  while ($ligne = mysql_fetch_array($req)) {

	  $i++;

     ?>

<tr>

     <td align="center"><?=$i?></td>

	 <td align="center" width="20"><input type="radio" id="<?=$ligne["code_livre"];?>" name="id" value="<?=$ligne["code_livre"];?>" onClick="document.adminMenu.boxchecked.value=<?=$ligne["code_livre"];?>" /></td>

	 <td align="left">&nbsp;<?=$ligne["titre_livre"];?></td>

	 <td align="center"><?=$ligne["nbr_exemplaire"];?></td>

	 <td align="center"><?=$ligne["date_aquisition"];?></td>

	 <td align="center"><?=$ligne["nbr_empreinte"];?></td>



  </tr>

<?php

      }	  

?> 

</form>

 </table>

