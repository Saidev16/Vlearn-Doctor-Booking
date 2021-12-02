<table border="0" width="1000" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/filieres.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES GROUPES </td>
	<td width="22%">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		 <td valign="top" align="center">
		   <a href="gestion_groupe.php?new=oui">
		  <div class="ajouter"></div>Nouveau</a>
		  </td>
		  <td valign="top" align="center" >
		  <a href="#" 
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)
			       {
				    alert('Veuillez sélectionnez un étudiant ??');
				   }
				   else
				   {
				     chemin=document.adminMenu.boxchecked.value;
					 chemin='gestion_groupe.php?modifier='+chemin;
				     window.location.replace(chemin);
				   }
				   " 
		    id="lien_msj">
		  <div class="modifier"></div>
	      Modifier</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="#" 
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)
			       {
				    alert('Veuillez sélectionnez un étudiant??');
				   }
				   else
				   {
				     chemin=document.adminMenu.boxchecked.value;
					 chemin='gestion_groupe.php?archiver='+chemin;
				     window.location.replace(chemin);
				   }
				   "
		   ><div class="supprimer"></div>
		   Archiver</a>
		  
		  </td>
		 <td valign="top" align="center">
		   <a href="gestion_groupe.php?archive=oui" id="lien_msj">
		  <div class="archive"></div>Archive</a>
		  </td>
		   <td valign="top" align="center" >
		  <a href="#" onclick="window.print()" title="voir le syllabus du cours">
		  <div class="imprimer"></div>
	      Imprimer</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>
<table width="1000" align="center" cellspacing="1"  class="adminlist">
<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />

  <tr>
     <th width="25" align="center">#</th>
	 <th width="25"></th>
 	 <th align="center" width="250px">Titre</th>
	 <th>&nbsp;</th>
  </tr>
  <?php
		 $sql="select * from tbl_groupe where archive= 0";
		 $i=0;
		 $req=@mysql_query($sql) or die ("erreur lors de la selection des filières");
		 while ($ligne = mysql_fetch_array($req)) {
		 $i++;
?>
<tr>
     <td align="center"><?=$i?></td>
	 <td align="center"><input type="radio" id="<?=$ligne["id"]?>" name="id" value="<?=$ligne["id"]?>" onClick="document.adminMenu.boxchecked.value=<?=$ligne["id"];?>" /></td>
 	 <td align="left">&nbsp;<?=$ligne["title"];?></td>
	 <td>&nbsp;</td>
  </tr>
<?php
      } 
	  
?>
</form>
  </table>