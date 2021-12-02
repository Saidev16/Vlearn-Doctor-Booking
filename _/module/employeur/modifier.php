 <style type="text/css">

input{

width:300px;

}

</style>

<script language="javascript1.2">

function valid_form(){



if ($F('nom')==""){

alert('veuillez taper le nom ');

$('nom').focus();

return false;

}



else {

document.f_ajout.submit();

return true;

}

}

</script>

<?php

if (isset($_POST['nom'])){

				$nom=addslashes($_POST['nom']);
				$prenom=$_POST['prenom'];
				$email=$_POST['email'];
				$tel=$_POST['tel'];
				$adresse=addslashes($_POST['adresse']);
				$commentaire=addslashes($_POST['commentaire']);
                $email=$_POST['email'];
				$type_emp=$_POST['type_emp'];
				$id=$_POST['id'];

			$sql="UPDATE  $tbl_employeur SET `nom`='$nom',
            `prenom`='$prenom' ,
            `tel`='$tel' ,
            `email`='$email' ,
            `commentaire`='$commentaire',
            `adresse`='$adresse',
			`type_emp`='$type_emp'
             where idEmployeur='$id' ";

               @mysql_query($sql)or die ("erreur lors de la mise à jour de cet employeur ");

			?>

			<script type="text/javascript" language="JavaScript1.2">

			<!--	

					window.location.replace('gestion_employeur.php');

			//-->

			</script>

              <?php

			  }

			  else{

			  $id=$_GET["modifier"];
 			  $sql2="select * from $tbl_employeur where idEmployeur=$id";
 			  $req2=@mysql_query($sql2) or die("erreur dans la sélection de cet employeur ");
 			  $row=mysql_fetch_assoc($req2);
 			  ?>

			   



<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td><img src="images/icone/filieres.gif" border="0"/></td>

    <td width="78%" class="titre">Modification d' un employeur </td>

	<td width="22%">

	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		   <a href="#" 
 		   onclick="javascript:valid_form();"><div class="save"></div>Valider</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_employeur.php"><div class="cancel"></div>Annuler</a>
		  </td>
		</tr>
	  </table>

	</td> 

  </tr>

 </table>

<form method="post"  action="gestion_employeur.php?modifier=oui" name="f_ajout">
 <input type="hidden" value="<?=$row['idEmployeur'];?>" name="id" />
	       <table border="0" cellpadding="0" cellspacing="2" width="100%" class="cellule_table">
		  <tr>
    		  <td width="25%">Nom : </td>
    		  <td width="25%"><input type="text" name="nom" id="nom" 
			  value="<?=$row['nom']?>" class="input" /></td>
    		  <td width="25%"> </td>
    		  <td width="25%"></td>
		  </tr>
          <tr>
              <td height="5px"></td>
          </tr>
          <tr>
    		  <td width="25%">Prénom : </td>
    		  <td width="25%"><input type="text" name="prenom" value="<?=$row['prenom']?>" class="input" /></td>
    		  <td width="25%"> </td>
    		  <td width="25%"></td>
		  </tr>
		  <tr>
              <td height="5px"></td>
          </tr>
           <tr>

    		  <td width="25%">Adresse : </td>

    		  <td width="25%">
			  <input type="text" name="adresse" value="<?=$row['adresse']?>" class="input" /></td>
    		  <td width="25%"> </td>
    		  <td width="25%"></td>
		  </tr>
          <tr>
              <td height="5px"></td>
          </tr>
          <tr>
    		  <td width="25%">Téléphone : </td>
    		  <td width="25%"><input type="text" name="tel" value="<?=$row['tel']?>" class="input" /></td>
    		  <td width="25%"> </td>
    		  <td width="25%"></td>
		  </tr>
		  <tr>
              <td height="5px"></td>
          </tr>
          <tr>
    		  <td width="25%">Email : </td>
    		  <td width="25%"><input type="text" name="email" value="<?=$row['email']?>" id="email" class="input" /></td>
    		  <td width="25%"> </td>
    		  <td width="25%"></td>
		  </tr>
          <tr>
              <td height="5px"></td>
          </tr>
          <tr>

    		  <td width="25%" valign="top">Type : </td>

    		  <td width="25%">
				  <select name="type_emp" class="input">
					  <option value="0" 
					  <?=($row['type_emp']==0) ? $selected : ''?>>Employeur</option>
					  <option value="1" 
					  <?=($row['type_emp']==1) ? $selected : ''?>>Employeur potentiel</option>
				  </select>
			  </td>
    		  <td width="25%"> </td>
    		  <td width="25%"></td>
		  </tr>
            <tr>
              <td height="5px"></td>
          </tr>
            <tr>
    		  <td width="25%" valign="top">Commentaire : </td>
    		  <td width="25%">
			  <textarea style="width:300px; height:60px;" name="commentaire" ><?=$row['commentaire']?></textarea></td>
    		  <td width="25%"> </td>
    		  <td width="25%"></td>
		  </tr>
          <tr>
              <td height="5px"></td>
          </tr>
	  </table>
     </form>
<?php
}
?>