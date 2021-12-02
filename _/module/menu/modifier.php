 <style type="text/css">

input{

width:200px;

}

</style>

<script language="javascript1.2">

function valid_form(){

document.f_ajout.submit();

}

</script>

<?php

$type=$_SESSION['type_menu'];

if (isset($_POST['titre'])){

$titre=addslashes($_POST['titre']);

$adresse=$_POST['adresse'];


$id=$_POST['id'];

 
 		         $sql="UPDATE  $tbl_menu SET

				                               `titre` = '$titre',

												`link` = '$adresse'

												 WHERE id ='$id' limit 1"; 



 	                       

											





            @mysql_query($sql)or die ("erreur lors de la mise à jour du menu");

			?>

			<script type="text/javascript" language="JavaScript1.2">

			<!--	

					window.location.replace('gestion_menu.php?type=<?=$type?>');

			//-->

			</script>

              <?php

			  }

			  else{

		   $id=$_GET["modifier"];
 
	       $type = $_SESSION['type_menu'];

	  	   $sql2="select * from $tbl_menu where id='$id' limit 1";

  			  $req2=@mysql_query($sql2) or die("erreur dans la selection du menu");

			  $row=mysql_fetch_assoc($req2);

 			  ?>

			   



<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td><img src="images/icone/inscription.gif" border="0"/></td>

    <td width="78%" class="titre">GESTION DU MENU <span class="task">[modifier]</span> </td>

	<td width="22%">

	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >

	    <tr>

 		  <td valign="top" align="center">
 		   <a href="#" onclick="javascript:valid_form();"><div class="save"></div>Valider</a> 
 		  </td>

		  <td valign="top" align="center">
 		   <a href="gestion_menu.php?type=<?=$type?>"><div class="cancel"></div>Annuler</a>
 		  </td>

		</tr>

	  </table>

	</td> 

  </tr>

 </table>

 <form method="post"  action="gestion_menu.php?modifier=oui" name="f_ajout" >

	  <input type="hidden" name="id" value="<?=$row['id']?>" />

	       <table border="0" cellpadding="0" cellspacing="2" width="100%" class="cellule_table">
		  <tr>

		  <td width="25%">Titre : </td>
 		  <td width="25%">
		  <input type="text" name="titre" id="titre" value="<?=$row['titre']?>" class="input" />
		  </td>
 		  <td width="25%"> </td>
 		  <td width="25%"></td>
 		  </tr>

		  <tr><td colspan="4" height="3px"></td></tr>

		   <tr>
 		  <td width="25%">Adresse :</td>
 		  <td width="25%">
		<input type="text" name="adresse" id="adresse" value="<?=$row['link']?>" class="input" />
		  </td>
 		  <td width="25%"> </td>
 		  <td width="25%"></td>
 		  </tr>

		    <tr><td colspan="4" height="3px"></td></tr>

			   

	  </table>

     </form>

<?php

}

?>