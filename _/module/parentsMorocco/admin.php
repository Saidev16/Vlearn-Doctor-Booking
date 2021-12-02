<?php

				    $niveau=$type=$where=$search='';
					
				   if((isset($_POST['search'])) && (!empty($_POST['search'])) ){
				   $search = $_POST['search'];
				   $where =" and  nom_prenom like '".$search."%'";
																				}
 
				   else if((isset($_POST['tous'])) && (!empty($_POST['tous']))){
					   $niveau=$type=$where=$search='';
					   unset($_SESSION['type']);
					   unset($_SESSION['niveau_enseigne']);
				   }

				   else{

				              //niveau comme critère 

					 if((isset($_POST['niveau'])) && (!empty($_POST['niveau'])) ){
 						$niveau = $_SESSION['niveau_enseigne'] = $_POST['niveau'];
						$where = $where." and niveau='". $niveau."'";
																				 }

						  else if( (isset($_POST['niveau'])) && (empty($_POST['niveau'])) ){
  	                            unset($_SESSION['niveau_enseigne']);
 						                                                          }

																				 

							  else if( (isset($_SESSION['niveau_enseigne'])) && (!empty($_SESSION['niveau_enseigne'])) ){
							      $pre_where=' where 1=1';
								  $where = $where." and niveau='". $_SESSION['niveau_enseigne']."'";
									                                                                  }

									//type comme critère 																  

																		   

						if( (isset($_POST['type'])) && (!empty($_POST['type'])) ){
							$type = $_SESSION['type'] = $_POST['type'];
							$where = $where." and type='". $type."'";
																				 }

																					   

							else if( (isset($_POST['type'])) && (empty($_POST['type'])) ){
  	                          unset($_SESSION['type']);
 						                                                                 }

																					   

							else if( (isset($_SESSION['type'])) && (!empty($_SESSION['type'])) ){
  	                           $where = $where." and type='". $_SESSION['type']."'";
						                                                                        }

									

	      }

		  $sql="select code_parent, nom_prenom, tel, mail, contact
	   			from tbl_parents 
				where archive= 0 and code_parent!=0 ".$where." order by nom_prenom ";

?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/enseignants.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;Parents</td>
	<td width="22%">
	  <table border="0" align="right" width="100%" cellspacing="10"  id="link" >

	    <tr>

		 <td valign="top" align="center">
			<a href="parents.php?new=oui"><div class="ajouter"></div>Add</a>
		  </td>

		  <td valign="top" align="center" >
		  <a href="#" 
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0){
				    alert('Veuillez sélectionner un enseignant dans la liste ??');}
				   else
				   {
				     chemin=document.adminMenu.boxchecked.value;
					 chemin='parents.php?modifier='+chemin;
				     window.location.replace(chemin);
				   }"><div class="modifier"></div>Edit</a>
	      </td>
		  <td valign="top" align="center">
		   <a href="#" 
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0){
				    alert('Veuillez sélectionner un enseignant dans la liste');
				   }
				   else
				   {
				     chemin=document.adminMenu.boxchecked.value;
					 chemin='parents.php?detail='+chemin;
				     window.location.replace(chemin);
				   }">
				   <div class="detail"></div>Details</a>
		   		  </td>
         
		  <td valign="top" align="center">
		   <a href="#" 
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)
			       {
				    alert('Veuillez sélectionner un enseignant dans la liste');
				   }
				   else
				   {
				     chemin=document.adminMenu.boxchecked.value;
					 chemin='parents.php?supprimer='+chemin;
				     window.location.replace(chemin);}">
		   <div class="delete"></div>Delete</a>	
		   </td>
 		    <td valign="top" align="center" >
		  <a href="#" onclick="window.print();" title="Imprimer"><div class="imprimer"></div>Print</a>
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
     
	 
 	 <!--<select name="niveau" class="search"> 
 		<option value="0">Grade</option>
		<option value="9" <?=($niveau=='9') ? $selected : '' ?>>9th Grade</option>
		<option value="10" <?=($niveau=='10') ? $selected : 'bachelor' ?>>10th Grade</option>
        <option value="11" <?=($niveau=='11') ? $selected : 'MBA' ?>>11th Grade</option>
        <option value="12" <?=($niveau=='12') ? $selected : 'MBA' ?>>12th Grade</option>
 	 </select>-->
          <input type="text" name="search" class="input" />
 		  <input type="submit" name="valider" value="Submit" class="input"  /> 
 		  <input type="submit" value="ALL" name="tous" class="input"   /> 
  </div>
  <tr>
     <th width="15" align="center">#</th>
	 <th>&nbsp;</th>
	 <th width="180">Name</th>
	 <th width="90">Phone</th>
	 <th width="135">Email</th>
	  <th width="135">Adress</th>
	 <!-- <th width="90">City</th>
     <th width="400">Degrees</th>
	 <th width="125">Grade</th>-->
  </tr>
     <?php
       $j=0;
       $req = mysql_query($sql)or die ("erreur lors de la sélection des enseignants");; 
 	   while ($row = mysql_fetch_array($req)) {
	   $j++;
	   $cf=$row["code_parent"];
     ?>

   <tr>
	<td><?=$j?></td>
	 <td align="center">
	 <input type="radio" id="<?=$cf?>" name="id" value="<?=$cf?>" onClick="document.adminMenu.boxchecked.value=<?=$cf?>" />
	 </td>
	 <td>&nbsp;<?=htmlentities($row["nom_prenom"])?></td>
	 <td>&nbsp;<?=htmlentities($row["tel"])?></td>
	  <td>&nbsp;<?=htmlentities($row["mail"])?></td>
	 <td>&nbsp;<?=substr($cont=$row["contact"],0,12)?></td>
	
	 <!--<td>&nbsp;<?=htmlentities($row["ville"])?></td>
	 <td>&nbsp;<?php $diplomes = explode(";", $row["diplome"]); 
	 foreach ($diplomes as $diplome):
	 if ($diplome!='')  echo '&nbsp;&raquo;&nbsp;'.stripslashes(ucfirst($diplome)).'<br>'; 
	 endforeach
	 ?></td>
     <td>&nbsp;<?=htmlentities($row["niveau"])?></td>-->
   </tr>
<?php
      }
?>
</form>
 </table> 