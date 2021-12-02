<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td>&nbsp;<img src="images/icone/livres.gif" border="0"/></td>
    <td width="78%"  class="titre">&nbsp;GESTION DES DOCUMENTS </td>
	<td width="22%">
	  <table border="0" align="right" width="50%" cellpadding="10" cellspacing="4" id="link" >

	    <tr>

		 <td valign="top" align="center">

		   <a href="gestion_document.php?new=oui" >

		  <div class="ajouter"></div>Nouveau</a>

		  </td>  

		  <td valign="top" align="center">

		   <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionner un document');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_document.php?archiver='+chemin;

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
     <th width="25" align="center">#</th>
	 <th width="25">&nbsp;</th>
	 <th align="center" nowrap="nowrap">Titre du document</th>
	 <th width="100" align="center">Date</th>
	  <th width="100" align="center">Session</th>
   </tr>
      <?php
	      $link='http://'.$_SERVER['HTTP_HOST'].'/piimt/module/demande/fichier/';
          $i=0;
          $sql = "SELECT d.*, s.session, s.annee_academique from tbl_docman as d, tbl_session as s WHERE d.archive = 0 and d.idSession =s.idSession order by d.titre";   
		   
          $req=@mysql_query($sql) or die ("erreur lors de la selection des documents");
 	      while ($ligne = mysql_fetch_array($req)) {
	      $i++;
		  $id=$ligne["id"];
         ?>
  <tr>
     <td align="center"><?=$i?></td>
	 <td align="center"><input type="radio" id="<?=$id?>" name="id" value="<?=$id?>" 
	 onClick="document.adminMenu.boxchecked.value=<?=$id?>" /></td>
	 <td align="left">&nbsp;<a href="<?=$link.$ligne['nom']?>" ><?=$ligne["titre"]?></a></td>
	 <td align="center">&nbsp;<?=$ligne["date"]?></td>
	 <td align="center">&nbsp;<?=$ligne["session"]?>&nbsp;<?=$ligne["annee_academique"]?></td>
   </tr>
<?php
      }
	  ?>
</form> 
</table>
 