<?php
				   $niveau=$type=$where=$search='';
				   if((isset($_POST['search'])) && (!empty($_POST['search'])) ){
				   $search = $_POST['search'];
				   $where =" and  nom_prenom like '%".$search."%'";
																				}

				   else if((isset($_POST['tous'])) && (!empty($_POST['tous']))){
				  $niveau=$type=$where=$search='';
				   unset($_SESSION['type']);
				   unset($_SESSION['niveau']);
				   }
				   else{
				              //niveau comme critère 
					 if((isset($_POST['niveau'])) && (!empty($_POST['niveau'])) ){
 						$niveau = $_POST['niveau'];
						$_SESSION['niveau']=$niveau;
						$where = $where." and niveau='". $niveau."'";

																				 }

					   else if( (isset($_POST['niveau'])) && (empty($_POST['niveau'])) ){
  	                            unset($_SESSION['niveau']);
 						                                                          }

																				 

					    else if( (isset($_SESSION['niveau'])) && (!empty($_SESSION['niveau'])) ){
							      $pre_where=' where 1=1';
								  $niveau = $_SESSION['niveau'];
								  $where = $where." and niveau='". $_SESSION['niveau']."'";									                                                                  }

									//type comme critère 																  
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
	      }

       $sql="select code_prof, nom_prenom, contact, matiere, mail, diplome, niveau
	   from $tbl_professeur 
	   where archive= 1 and code_prof!=0 ".$where."order by nom_prenom ";
?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/enseignants.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES ENSEIGNANTS 
	<span class="task">[archive]</span></td>
	<td width="22%">
	  <table border="0" align="right" width="50%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		 <td valign="top" align="center" >
		  <a href="#" 
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)
			       {
				    alert('Veuillez sélectionnez un enseignant ??');
				   }
				   else
				   {
				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_enseignants.php?desarchiver='+chemin;

				     window.location.replace(chemin);

				   }" > 
		  <div class="desarchiver"></div> Désarchiver</a>
	     		  </td>
		<td valign="top" align="center" >
		  <a href="#" 
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionner un enseignant ??');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_enseignants.php?modifier='+chemin;

				     window.location.replace(chemin);

				   }">
		  <div class="modifier"></div> Modifier</a>
	     		  </td>

		<td valign="top" align="center">
		   <a href="#" 
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionnez un enseignant??');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_enseignants.php?detail='+chemin;

				     window.location.replace(chemin);

				   } "> <div class="detail"></div>Détail</a>
		  
		   		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_enseignants.php"><div class="retour"></div>Retour</a>	
		  </td>

		</tr>

	  </table>	</td> 

</table>

<table width="100%" align="center" cellspacing="1"  class="adminlist">
<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
<div class="container_search">
     <select name="type" class="search"> 
		<option value="0">type</option>
		<option value="vacataire" <?=($type=='vacataire')  ? $selected : ''?>>vacataire</option>
		<option value="permanent" <?=($type=='permanent')  ? $selected : ''?>>permanent</option>
		<option value="potentiel" <?=($type=='potentiel')  ? $selected : ''?>>potentiel</option>
	 </select>
	 <select name="niveau" class="search"> 
		<option value="0">niveau enseigné</option>
		<option value="master" <?=($niveau=='master') ? $selected : '' ?>>master</option>
		<option value="bachelor" <?=($niveau=='') ? $selected : 'bachelor' ?>>bachelor</option>
		<option value="master et bachelor" <?=($niveau=='master et bachelor') ? $selected : ''?>>master et bachelor</option>

	  </select>
	      &nbsp;&nbsp;&nbsp;
  		  <input type="text" class="input" name="search" />&nbsp;&nbsp; 
		  <input type="submit" name="valider" value="valider" class="input" />&nbsp;&nbsp; 
		  <input type="submit" value="Afficher tous" name="tous" class="input" />&nbsp;&nbsp; 
  </div>

<tr>
     <th width="15" align="center">#</th>
	 <th>&nbsp;</th>
	 <th width="180">Nom et prénom</th>
	 <th width="90">Téléphone</th>
	 <th width="135">Email</th>
     <th width="400">Diplômes</th>
	 <th width="125">Niveau enseigné</th>
  </tr>

     <?php

       $j=0;
       $total = mysql_query($sql)or die ("erreur lors de la selection des enseignants"); 
	   $url = $_SERVER['PHP_SELF']."?archive=oui&limit=";
       $nblignes = mysql_num_rows($total);
	   $parpage=25;
       $nbpages = ceil($nblignes/$parpage);
       $result = validlimit($nblignes,$parpage,$sql);
 	   while ($row = mysql_fetch_array($result)) {
	   $j++;
	   $cp=$row["code_prof"];
     ?>

   <tr>
	<td><?=$j?></td>
	 <td align="center">
	 <input type="radio" id="<?=$cp?>" name="id" value="<?=$cp?>" onClick="document.adminMenu.boxchecked.value=<?=$cp?>" />
	 </td>
	 <td>&nbsp;<?=htmlentities($row["nom_prenom"])?></td>
	 <td>&nbsp;<?=substr($row["contact"],0,12)?></td>
	 <td>&nbsp;<?=htmlentities($row["mail"])?></td>
	 <td>&nbsp;<?=htmlentities(substr($row["diplome"], 0, 60))?></td>
     <td>&nbsp;<?=htmlentities($row["niveau"])?></td>
   </tr>

<?php
      }
?>
</form>
 </table>
     <?php
     echo "<div id='pagination' align='center'>";
     echo pagination($url,$parpage,$nblignes,$nbpages);
     echo "</div>";
 	 ?>

