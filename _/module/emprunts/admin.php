<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/livres.gif" border="0"/></td>
    <td width="78%"  class="titre">&nbsp;GESTION DES EMPRUNTS </td>
	<td width="22%">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
 			 <td valign="top" align="center">
		   <a href="gestion_livres.php?new=oui"><div class="ajouter"></div>Nouveau</a>
		  </td>
		      <td valign="top" align="center" >
		  <a href="#" 
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionnez un element ??');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_livres.php?retourne='+chemin;

				     window.location.replace(chemin);

				   }

				   " ><div class="modifier"></div>retourn&eacute;</a>
		  </td>
		     <td valign="top" align="center">
		   <a href="gestion_livres.php?archive=oui"><div class="archive"></div>Archive</a>
		  </td>
		</tr>
	  </table>
	</td> 
</table>
<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
<table width="100%" align="center" cellspacing="1"  class="adminlist">
  <tr>
     <th width="25" align="center">#</th>
	 <th width="25"></th>
	 <th>Titre du livre</th>
	 <th>Date d'empreinte</th>
	 <th>Etudiant </th>
	 <th>Enseignant </th>
  </tr>
  <?php
	$i=0;
	$sql = "SELECT distinct em.code_emprunt, l.titre_livre, em.date_empreint, 
		em.code_inscription, em.code_prof
		FROM  $tbl_empreinte AS em, $tbl_livre AS l
		WHERE em.code_livre = l.code_livre and retourne=1";

	  $req=@mysql_query($sql) or die ("erreur lors de la selection des livres");
 	  while ($ligne = mysql_fetch_array($req)) {
	   $i++;
	   $ce=$ligne["code_emprunt"];
?>
<tr>
     <td align="center"><?=$i?></td>
	 <td align="center"><input type="radio" id="<?=$ce?>" name="id" value="<?=$ce?>" 
	 onClick="document.adminMenu.boxchecked.value=<?=$ce?>" /></td>
	  <td align="center">&nbsp;<?=$ligne["titre_livre"]?></td>
	  <td align="center"><?=$ligne["date_empreint"]?></td>
	  <td align="center"><?=$ligne["code_inscription"]?></td>
	 <td align="center"><?=$ligne["code_prof"]?></td>
  </tr>
	  <?php
      }
	  ?>
 </table>
</form>