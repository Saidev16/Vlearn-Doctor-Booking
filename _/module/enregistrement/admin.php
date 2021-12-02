<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td><img src="images/icone/livres.gif" border="0" style="margin:1px 0 0 2px"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES ENREGISTREMENTS </td>

	<td width="22%">

	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >

	    <tr>

		 <td valign="top" align="center">
		   <a href="gestion_enregistrement.php?new=oui"><div class="ajouter"></div>Nouveau</a>
		  </td>
		  <td valign="top" align="center" >
		  <a href="#" onclick="javascript:if(document.adminMenu.boxchecked.value==0) 		   
			       {
				    alert('Veuillez sélectionnez un document ??');
				   }
				   else
				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_enregistrement.php?modifier='+chemin;

				     window.location.replace(chemin);

				   } ">
		  <div class="modifier"></div>Modifier</a>
		  </td>

		  <td valign="top" align="center">

		   <a href="gestion_enregistrement.php?archive=<?=$_SESSION['parametre']?>">
		   <div class="archive"></div>Archive</a>
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

					 chemin='gestion_enregistrement.php?archiver='+chemin;

				     window.location.replace(chemin);

				   }

				   ">

		   <div class="supprimer"></div>Archiver</a>
		  

		  </td>

		 

		</tr>

	  </table>

	</td> 

</table>

<?php if(isset($_GET['option']) ){

$_SESSION['parametre'] = strtoupper($_GET['option']);

$processus = 'PRC/'.strtoupper($_GET['option']);
 ?>

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

	      $link='http://'.$_SERVER['HTTP_HOST'].'/ilcs/module/document/docs/';

          $i=0;

          $sql = "SELECT * from  $tbl_document where  processus = '$processus' 
		  and groupe='enregistrement'";

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

	 <td align="center">&nbsp;<?=$ligne["processus"]?></td>

   </tr>

<?php

      }

	  ?>

</form> 

</table>

<?php

}

?>