<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/filieres.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES TYPES DES COURS</td>
	<td width="22%">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		 <td valign="top" align="center">
		   <a href="gestion_type_cours.php?new=oui">
		  <div class="ajouter"></div>Nouveau</a>
		  </td>
		  <td valign="top" align="center" >
		  <a href="#"

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez s&eacute;lectionner un type dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_type_cours.php?modifier='+chemin;

				     window.location.replace(chemin);

				   }"> <div class="modifier"></div> Modifier</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="#" 
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)
			       {
				    alert('Veuillez sélectionnez un titre??');
				   }
				   else
				   {
				     chemin=document.adminMenu.boxchecked.value;
					 chemin='gestion_type_cours.php?supprimer='+chemin;
				     window.location.replace(chemin);
				   }
				   "><div class="supprimer"></div>Supprimer</a>
		  </td>
		   <td valign="top" align="center" >
		  <a href="#" onclick="window.print()"> <div class="imprimer"></div>Imprimer</a>
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
     <th width="25" align="center">#</th>
	 <th width="25"></th>
 	 <th width="300">Titre</th>
     <th width="330">Prix</th>
  </tr>
  <?php
 		 $sql="SELECT * FROM tbl_type_cours WHERE archive = 0 ORDER BY titre";
		 $i=0;
		 $req=@mysql_query($sql) or die ("erreur lors de la selection des types des cours");
		 while ($row = mysql_fetch_array($req)) {
		 $i++;
		 $id=$row['id'];
?>
   <tr>
     <td align="center"><b><?=$i?></b></td>
	 <td align="center"><input type="radio" name="id" value="<?=$id?>" onClick="document.adminMenu.boxchecked.value=<?=$id?>" /></td>
 	 <td align="left">&nbsp;<?=htmlentities($row["titre"])?></td>
     <td align="left">&nbsp;<?=$row['prix']?></td>
   </tr>
<?php
      }   
?>
</form>
  </table>