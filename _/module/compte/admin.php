
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/compte.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES COMPTES </td>

	<td width="22%">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link">
	    <tr>
		 <td valign="top" align="center">
		   <a href="gestion_compte.php?new=oui"><div class="ajouter"></div>Nouveau</a>
		  </td>
		  <td valign="top" align="center" >
		  <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionner un utilisateur dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_compte.php?modifier='+chemin;

				     window.location.replace(chemin);

				   }

				   " >
		  <div class="modifier"></div>Modifier</a>
		  </td>
		   <td valign="top" align="center">

		   <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionner un utilisateur dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_compte.php?processus='+chemin;

				     window.location.replace(chemin);

				   }

				   ">

		 <div class="detail"></div>Droits</a>
		  </td>

		  <td valign="top" align="center">

		   <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionner un utilisateur dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_compte.php?archiver='+chemin;

				     window.location.replace(chemin);

				   }

				   ">

		 <div class="supprimer"></div>Supprimer</a>
		  </td>

		   
		</tr>
	  </table>
	</td> 
</table>

<table width="100%" align="center" cellspacing="1"  class="adminlist">

<form action="#" method="post" name="adminMenu">

<input type="hidden" name="boxchecked" value="0" />

  <tr>

     <th width="42" align="center">#</th>
	 <th width="22"></th>
	 <th  align="center" nowrap="nowrap">Nom</th>
	 <th>Prénom</th>
	 <th>E-mail</th>
	 <th>Type de compte</th>
	 <th>Description</th>
  </tr>

  <?php
		$i=0;
		 
		$sql = "SELECT id, nom, prenom, email, usertype, description 
		from $tbl_admin 
		where archive=0";
		 
		$req=@mysql_query($sql) or die ("erreur lors de la sélection des utilisateurs");
 	    while ($row = mysql_fetch_array($req)) {
	    $i++;
?>
<tr>
     <td align="center"><?=$i?></td>
	 <td align="center">
	 <input type="radio" id="<?=$row["id"]?>" name="id" value="<?=$row["id"];?>" 
	 onClick="document.adminMenu.boxchecked.value=<?=$row["id"]?>" /></td>
	 <td align="center">&nbsp;<?=$row["nom"]?></td>
	 <td align="center">&nbsp;<?=$row["prenom"]?></td>
	 <td align="center">&nbsp;<?=$row["email"]?></td>
     <td align="center">&nbsp;<?=$row["usertype"]?></td>
	 <td align="center">&nbsp;<?=$row["description"]?></td>
  </tr>
<?php
      }	  
?>
</form>
 </table>

