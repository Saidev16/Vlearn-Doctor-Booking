             <style type="text/css">
			.parent{
			display:none;
			}
			</style>
			<script language="javascript1.2">

		function valid_form(){
		
		  if($F('titre')==""){
		
		  alert('veuillez taper le titre');
		
		  $('titre').focus();
		
		  return false;
		
		  }
		
		  if($F('adresse')==""){
		
		  alert('veuillez taper l\'adresse');
		
		  $('adresse').focus();
		
		  return false;
		
		  }
		
		  else{
		
		document.f_ajout.submit();
		
		return true;
		
		}
		
		}
 

</script>

			<?php

			if (isset($_GET['new'])){

			$type=$_GET['new'];

			if (isset($_POST['titre'])){

			$titre=addslashes($_POST['titre']);

			$adresse=$_POST['adresse'];
			
 	       if($type=='staf') { 
		            $parent=$_POST['parent'];
		                     } 
						else{
				    $parent=0 ;
					        } 
 
 			$sql2="select max(ordre) as max from $tbl_menu where type='$type'";
			$req=mysql_query($sql2);
			$row=mysql_fetch_assoc($req);
			$max=$row['max']+1;
			
	  	    $sql="INSERT INTO  $tbl_menu (`titre`, `link`, `type`, `parent` , `ordre`) 
 		  	    VALUES ('$titre', '$adresse', '$type', '$parent', '$max');";

             @mysql_query($sql)or die ("erreur lors de l'ajout du menu");

 			$sql1="update $tbl_menu_statistic set publie = publie+1 where type = '$type'";

			 @mysql_query($sql1);



			?>

			<script type="text/javascript" language="JavaScript1.2">

			<!--	

				window.location.replace('gestion_menu.php?type=<?=$type?>');

			//-->

			</script>

              <?php

			  }

			  else{

			  ?>

	<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

	  <tr>

		<td><img src="images/icone/inscription.gif" border="0"/></td>

		<td width="78%" class="titre">GESTION DU MENU <span class="task">[ajouter]</span> </td>

		<td width="22%">

		  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >

			<tr>
			  <td valign="top" align="center">
			   <a href="#" onclick="javascript:valid_form();" ><div class="save"></div> Ajouter</a>
			  </td>
			  <td valign="top" align="center">
			   <a href="gestion_menu.php?type=<?=$type?>"><div class="cancel"></div> Annuler</a>
			  </td>
			</tr>
			
		  </table>

		</td> 

	  </tr>

	 </table>

	 <form method="post"  action="gestion_menu.php?new=<?=$type?>" name="f_ajout" >

		<table border="0" cellpadding="0" cellspacing="2" width="100%" class="cellule_table">

			  <tr>
				  <td width="25%">Nom :  </td>
				  <td width="25%">
				  <input type="text" name="titre" id="titre" style="width:200px" class="input"/>
				  </td>
				  <td width="25%"></td>
				  <td width="25%"></td>
			  </tr>

			  <tr><td colspan="4" height="3px"></td></tr>
			  <tr>
			  <td width="25%">Lien : </td>
			  <td width="25%">
			  <input type="text" name="adresse" id="adresse" style="width:200px" class="input" />
			  </td>
			  <td width="25%"></td>
			  <td width="25%"></td>
			  </tr>
			  
			  <tr><td colspan="4" height="3px"></td></tr>
			  
			  <tr  class="<?=($type=='staf') ? '' : 'parent'?>">
			  <td width="25%">Lien Parent : </td>
			  <td width="25%">
			  <select name="parent">
			  	<option value="0">Sélectionner</option>
			  <?php
			  $sql3="select id, titre 
			  from $tbl_menu 
			  where parent=0
			  and id not in(1, 90) 
			  and type='staf'";
			  $req=@mysql_query($sql3) or die('erreur lors de la sélection du menu');
			  while($row=mysql_fetch_assoc($req)){
			
			  ?>
			  <option value="<?=$row['id']?>"><?=$row['titre']?></option>
			  <?php
			  }
			  ?>
			  </select>
			  </td>
			  <td width="25%"></td>
			  <td width="25%"></td>
			  </tr>
			  <tr><td colspan="4" height="3px"></td></tr>


		  </table>

		  </form>

	<?php

	}
	}
	?>