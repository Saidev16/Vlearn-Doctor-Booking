<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td>&nbsp;<img src="images/icone/filieres.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES DES OFFRES D'EMPLOI </td>

	<td width="22%">

	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >

	    <tr>

		 <td valign="top" align="center">

		   <a href="gestion_offre_emploi.php?new=oui">

		  <div class="ajouter"></div>Nouveau</a>

		  </td>

		  <td valign="top" align="center" >

		  <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionner une offre dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_offre_emploi.php?modifier='+chemin;

				     window.location.replace(chemin);

				   }

				   "  >

		   

		  <div class="modifier"></div>

	      Modifier</a>

		  </td>

		  <td valign="top" align="center">

		   <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionner une offre dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_offre_emploi.php?archiver='+chemin;

				     window.location.replace(chemin);

				   }

				   ">

		   <div class="supprimer"></div>Supprimer</a>

		   

		  </td>

		 

		   <td valign="top" align="center" >

		  <a href="#" onclick="window.print()"  id="lien_msj" title="Imprimer">

		  <div class="imprimer"></div>Imprimer</a>

		  </td>

		</tr>

	  </table>

	</td> 

  </tr>

</table>
<form action="#" method="post" name="adminMenu">
<input type="hidden" name="boxchecked" value="0" />
<table width="100%" align="center" cellspacing="1"  class="adminlist">
  <tr>
     <th width="25" align="center">#</th>
	 <th width="25"></th>
  	 <th>Titre</th>
     <th>Date</th>
     <th>Description</th>
  </tr>

  <?php

     $sql="SELECT * FROM $tbl_offre_emploi";

     $i=0;

     $total = @mysql_query($sql) or die($sql);

	 $url = $_SERVER['PHP_SELF']."?limit=";

     $nblignes = mysql_num_rows($total);

	 $parpage=25;

     $nbpages = ceil($nblignes/$parpage);

     $result = validlimit($nblignes,$parpage,$sql);

     $req=@mysql_query($sql) or die ("erreur lors de la sélection des offres d'emploi");

 	 while ($ligne = mysql_fetch_array($result)) {

     $i++;

?>

<tr>

     <td align="center"><?=$i?></td>

	 <td align="center" valign="top"><input type="radio" id="<?=$ligne["id"]?>" name="id" value="<?=$ligne["id"]?>" onClick="document.adminMenu.boxchecked.value=<?=$ligne["id"];?>" /></td>

 	 <td align="left" valign="top">&nbsp;<?=$ligne["title"];?></td>
     <td align="left" valign="top">&nbsp;<?=$ligne["created_on"];?></td>
     <td align="left">&nbsp;<?=$ligne["body"];?></td>
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