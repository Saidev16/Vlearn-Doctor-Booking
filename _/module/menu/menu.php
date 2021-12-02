<?php
if(isset($_GET['type'])){

$type=$_SESSION['type_menu']=$_GET['type'];

$publish="<img src=\"images/unpublish_f2.png\"  border=\"0\" width=\"16\" height=\"16\" />";

$unpublish="<img src=\"images/cancel_f2.png\" border=\"0\" width=\"16\" height=\"16\" />";

?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td>&nbsp;<img src="images/icone/inscription.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DU MENU <span class="task">[<?=$type?>]</span></td>

	<td width="22%">

	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >

	    <tr>

		 <td valign="top" align="center">

		   <a href="gestion_menu.php?new=<?=$type?>">

		  <div class="ajouter"></div>Nouveau</a>

		  </td>

		  <td valign="top" align="center" >

		  <a href="#" 

		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionner un menu dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_menu.php?modifier='+chemin;

				     window.location.replace(chemin);

				   }

				   " >

		   

		  <div class="modifier"></div> Modifier</a>

	     

		  </td>

		  <td valign="top" align="center">

		   <a href="#" 
 		     onclick="javascript:if(document.adminMenu.boxchecked.value==0)

			       {

				    alert('Veuillez sélectionner un menu dans la liste');

				   }

				   else

				   {

				     chemin=document.adminMenu.boxchecked.value;

					 chemin='gestion_menu.php?archiver='+chemin;

				     window.location.replace(chemin);

				   }

				   ">
 		 <div class="supprimer"></div>Supprimer</a>
  		  </td>
 		   

		 <td valign="top" align="center">
 		   <a href="gestion_menu.php"><div class="retour"></div>Retour</a>
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

	 <th width="650" align="center" nowrap="nowrap">Titre du menu</th>

	 <th width="100" align="center" >Publié</th>

 	 <th width="100" align="center">Ordre</th>

 
  </tr>

      <?php
  
	    $sql="select * from $tbl_menu 
		where type='$type' 
		and parent=0 
		and archive=0
	    order by ordre ";

       $i=0;

       $req=@mysql_query($sql) or die ("erreur lors de la sélection des élements du menu");

 	   while ($ligne = mysql_fetch_array($req)) {

	   $i++;
	   $id=$ligne['id'];

     ?>

<tr>

     <td align="center"><?=$i?></td>
 	 <td align="center"><input type="radio" id="<?=$id?>" name="id" 
	 value="<?=$id?>" onClick="document.adminMenu.boxchecked.value=<?=$id?>" /></td>
 	 <td align="left"><?=$ligne["titre"]?></td>
 	 <td align="center">
	 <a href="gestion_menu.php?publie=<?=$ligne["publie"]?>&menuid=<?=$ligne["id"]?>">
 	 <?=($ligne["publie"]==0) ? $publish : $unpublish ?></a></td>
  	 <td align="center"><?=$ligne["ordre"]?></td>

    </tr>

<?php

      }

?>

</form> 

</table>

<?php

}

?>

