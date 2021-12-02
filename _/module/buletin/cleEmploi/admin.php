<table border="0" width="1000" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/filieres.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES TITRES </td>
	<td width="22%">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		 <td valign="top" align="center">
		   <a href="gestionCleEmploi.php?new=oui">
		  <div class="ajouter"></div>Nouveau</a>
		  </td>
		  <td valign="top" align="center" >
		  <a href="#" 
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)
			       {
				    alert('Veuillez selectionnez un titre ??');
				   }
				   else
				   {
				     chemin=document.adminMenu.boxchecked.value;
					 chemin='gestionCleEmploi.php?modifier='+chemin;
				     window.location.replace(chemin);
				   }
				   " >
		    
		  <div class="modifier"></div>
	      Modifier</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="#" 
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)
			       {
				    alert('Veuillez s�lectionnez un titre??');
				   }
				   else
				   {
				     chemin=document.adminMenu.boxchecked.value;
					 chemin='gestionCleEmploi.php?archiver='+chemin;
				     window.location.replace(chemin);
				   }
				   ">
		 <div class="supprimer"></div>Archiver</a>
		  </td>
                  <td valign="top" align="center">
		   <a href="#" 
		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)
			       {
				    alert('Veuillez selectionnez un titre??');
				   }
				   else
				   {
				     chemin=document.adminMenu.boxchecked.value;
					 chemin='gestion_emploi.php?idCleEmploi='+chemin;
				     window.location.replace(chemin);
				   }
				   ">
		 <div class="detail"></div>Emploi</a>
		   
		  
		  </td>
		 <td valign="top" align="center">
		   <a href="gestionCleEmploi.php?archive=oui"><div class="archive"></div>Archive</a>
		 
		  </td>
		   <td valign="top" align="center" >
		  <a href="#" onclick="window.print()"  title="Imprimer"><div class="imprimer"></div>
		  
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

  </tr>
  <?php
 $sql="select * from tbl_cle_emploi where archive= 0";
 $i=0;
$req=@mysql_query($sql) or die ("erreur lors de la selection des titres");
 	  while ($ligne = mysql_fetch_array($req)) {
	   $i++;
?>
<tr>
     <td align="center"><?=$i?></td>
	 <td align="center"><input type="radio" id="<?=$ligne["idCleEmploi"]?>" name="id" value="<?=$ligne["idCleEmploi"]?>" onClick="document.adminMenu.boxchecked.value=<?=$ligne["idCleEmploi"];?>" /></td>
 	 <td align="left">&nbsp;<?=$ligne["titre"];?></td>
	  
  </tr>
<?php
      } 
	  
?>
</form>
  </table>