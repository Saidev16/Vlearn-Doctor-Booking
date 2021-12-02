<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td>&nbsp;<img src="images/icone/livres.gif" border="0"/></td>

    <td width="78%"  class="titre">&nbsp;GESTION DES DOCUMENTS 

	<span class="task">[archive]</span>

	</td>

	<td width="8%">

	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >

	    <tr>
  <td valign="top" align="center">

		   <a href="#"

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionnez un élement??');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_document.php?unarchive='+chemin;

				     window.location.replace(chemin);

				   }

				   " >

		  <div class="desarchiver"></div>D&eacute;sarchiver</a>

		  

		  </td>
            <td valign="top" align="center">

		   <a href="#"

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionnez un élement??');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_document.php?supprimer='+chemin;

				     window.location.replace(chemin);

				   }

				   " >

		  <div class="supprimer"></div>Supprimer</a>

		  

		  </td>

		  <td valign="top" align="center">

		   <a href="gestion_document.php?option=<?=$_SESSION['parametre']?>">

		  <div class="retour"></div>Retour</a>

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

	 <th width="25"></th>

	 <th width="750" align="center" nowrap="nowrap">Titre du document</th>

	 <th width="100" align="center" >Processus</th>

   </tr>

      <?php

          $i=0;

		  $processus='PRC/'.$_SESSION['parametre'];

          $sql = "SELECT * from  tbl_document where groupe='archive' and processus= '$processus'";

          $req=@mysql_query($sql) or die ("erreur lors de la selection des documents archivé");

 	      while ($ligne = mysql_fetch_array($req)) {

	    $i++;

         ?>

<tr>

     <td align="center"><?=$i?></td>

	 <td align="center"><input type="radio" id="<?=$ligne["id"];?>" name="id" value="<?=$ligne["id"];?>" 

	 onClick="document.adminMenu.boxchecked.value=<?=$ligne["id"];?>" /></td>

	 <td align="left">&nbsp;<a href="http://<?=$_SERVER['HTTP_HOST']?>/ilcs/module/document/docs/<?=$ligne['nom']?>" id="lien_msj"><?=$ligne["titre"]?></a></td>

	 <td align="center">&nbsp;<?=$ligne["processus"]?></td>

   </tr>

<?php

      }

	  ?>

</form> 

</table>