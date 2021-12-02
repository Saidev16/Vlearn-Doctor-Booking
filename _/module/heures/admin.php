<?php
		  $id = (int)$_GET['code_prof'];
		  $sql="SELECT nom_prenom FROM $tbl_professeur WHERE code_prof = '$id'";
		  $res = @mysql_query($sql) or die('');
		  $row = mysql_fetch_assoc($res);
		  $nom = $row['nom_prenom'];
		  $sql="SELECT * FROM tbl_heure WHERE code_prof = '$id' ORDER BY date";

?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/enseignants.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES HEURES<span class="task">&nbsp;[<?php echo $nom; ?>]</span></td>
	<td width="22%">
	  <table border="0" align="right" width="100%" cellspacing="10"  id="link" >

	    <tr>

		 <td valign="top" align="center">
			<a href="gestion_heures.php?new=<?php echo $id; ?>"><div class="ajouter"></div>Nouveau</a>
		  </td>

		  <td valign="top" align="center" >
		  <a href="#" 
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0){
				    alert('Veuillez sélectionner un enseignant dans la liste ??');}
				   else
				   {
				     chemin=document.adminMenu.boxchecked.value;
					 chemin='gestion_heures.php?modifier='+chemin;
				     window.location.replace(chemin);
				   }"><div class="modifier"></div>Modifier</a>
	      </td>
		  <td valign="top" align="center">
		   <a href="#" 
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)
			       {
				    alert('Veuillez sélectionner une heure dans la liste??');
				   }
				   else
				   {
				     chemin=document.adminMenu.boxchecked.value;
					 chemin='gestion_heures.php?supprimer='+chemin;
				     window.location.replace(chemin);}">
		   <div class="delete"></div>Supprimer</a>	
		   </td>
 		    <td valign="top" align="center" >
		  <a href="#" onclick="window.print();" title="Imprimer"><div class="imprimer"></div>Imprimer</a>
		  </td>
          <td valign="top" align="center" >
		  <a href="gestion_heures.php" title="retour"><div class="retour"></div>Retour</a>
		  </td>
		</tr>
	  </table>	
	</td> 
  </tr>
</table>

<table width="100%" align="center" cellspacing="1"  class="adminlist">
<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
  <tr>
     <th width="15" align="center">#</th>
	 <th>&nbsp;</th>
	 <th width="120">Date</th>
     <th width="120">Nombre</th>
	 <th width="120">Prix par heure</th>
     <th width="120">Somme</th>
     <th width="600">Commentaire</th>
     <th width="75">Statut</th>
  </tr>
     <?php
       $j=0;$sommes =0;
       $req = mysql_query($sql)or die ("erreur :: Select hours");; 
 	   while ($row = mysql_fetch_array($req)) {
	   $j++;
	   
	   if ($row['etat']==0){
	   $sommes +=$row["somme"];
	   }
     ?>

   <tr>
	<td><?=$j?></td>
	 <td align="center">
	 <input type="radio" id="<?=$row['id']?>" name="id" value="<?=$row['id']?>" onClick="document.adminMenu.boxchecked.value=<?=$row['id']?>" />
	 </td>
	 <td>&nbsp;<?=$row["date"]?></td>
 	 <td>&nbsp;<?=$row["nombre"]?></td>
     <td>&nbsp;<?=$row["prix"]?></td>
     <td>&nbsp;<?=$row["somme"]?></td>
     <td>&nbsp;<?=htmlentities($row["commentaire"])?></td>
     <td align="center">&nbsp;<?=$row["etat"]==1 ? $oui : $non?></td>
   </tr>
<?php
      }
?>
 <tr>
 		<td colspan="8" class="gras">&nbsp;Somme impay&eacute;: <?php echo $sommes; ?></td>
  </tr>
</form>
 </table> 