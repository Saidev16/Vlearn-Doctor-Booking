<?php

				    $where=$search='';
					
				   if((isset($_POST['search'])) && (!empty($_POST['search'])) ){
				   $search = $_POST['search'];
				   $where =" and  nom_prenom like '".$search."%'";
																				}
 				    

		  $sql="SELECT code_prof, nom_prenom, contact, mail, diplome, niveau 
	   			FROM $tbl_professeur 
				WHERE archive= 0 AND code_prof != 0 ".$where." ORDER BY nom_prenom ";

?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/horraires.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES HEURES</td>
	<td width="22%">
	  <table border="0" align="right" width="100%" cellspacing="10"  id="link" >

	    <tr>

		 <td valign="top" align="center">
			<a onclick="javascript: 
				     chemin=document.adminMenu.boxchecked.value;
					 chemin='gestion_heures.php?new='+chemin;
				     window.location.replace(chemin); "><div class="ajouter"></div>Nouveau</a>
				  
		  </td>

		   
		  <td valign="top" align="center">
		   <a href="#" 
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0){
				    alert('Veuillez sélectionner un enseignant dans la liste');
				   }
				   else
				   {
				     chemin=document.adminMenu.boxchecked.value;
					 chemin='gestion_heures.php?code_prof='+chemin;
				     window.location.replace(chemin);
				   }">
				   <div class="detail"></div>Détail</a>
		   		  </td>
         
		 
 		    <td valign="top" align="center" >
		  <a href="#" onclick="window.print();" title="Imprimer"><div class="imprimer"></div>Imprimer</a>
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
           <input type="text" name="search" class="input" size="33" />
 		  <input type="submit" name="valider" value="valider" class="input"  /> 
 		  <input type="submit" value="Afficher tous" name="tous" class="input"   /> 
  </div>
  <tr>
     <th width="15" align="center">#</th>
	 <th>&nbsp;</th>
	 <th width="350">Nom et prénom</th>
	 <th width="250">Nombre d'heure regl&eacute;</th>
	 <th width="250">Nombre d'heure non regl&eacute;</th>
     <th width="100">Solde</th>
   </tr>
     <?php
       $j=0;
       $req = mysql_query($sql)or die ("erreur lors de la sélection des enseignants");; 
 	   while ($row = mysql_fetch_array($req)) {
	   $j++;
	   $cf=$row["code_prof"];
     ?>

   <tr>
	<td><?=$j?></td>
	 <td align="center">
	 <input type="radio" id="<?=$cf?>" name="id" value="<?=$cf?>" onClick="document.adminMenu.boxchecked.value=<?=$cf?>" />
	 </td>
	 <td>&nbsp;<?=htmlentities($row["nom_prenom"])?></td>
	 <td>&nbsp; </td>
	 <td>&nbsp; </td>
	 <td>&nbsp; </td>
    </tr>
<?php
      }
?>
</form>
 </table> 