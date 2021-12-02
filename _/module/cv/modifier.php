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
				$email=$_POST['email'];
				$tel=$_POST['tel'];
				$diplome=addslashes($_POST['diplome']);
				$commentaire=addslashes($_POST['commentaire']);
                $matiere=$_POST['matiere'];
				$id=$_POST['id'];

			$sql="UPDATE  $tbl_cv SET `nom`='$nom',
            `email`='$email' ,
            `tel`='$tel' ,
            `diplome`='$diplome' ,
            `commentaire`='$commentaire',
            `matiere`='$matiere'
             where id='$id' ";

               @mysql_query($sql)or die ("erreur lors de la mise à jour du cv ");

			?>

			<script type="text/javascript" language="JavaScript1.2">

			<!--	

					window.location.replace('gestion_cv.php');

			//-->

			</script>

              <?php

			  }

			  else{

			   $id=$_GET["modifier"];

			  $sql2="select * from $tbl_cv where id=$id";

			  $req2=@mysql_query($sql2) or die("erreur dans la sélection du cv ");

			  $row=mysql_fetch_assoc($req2);

			  ?>

			   



<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td><img src="images/icone/filieres.gif" border="0"/></td>

    <td width="78%" class="titre">Modification d' un cv </td>

	<td width="22%">

	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >

	    <tr>

		  <td valign="top" align="center">

		   <a href="#" 

		   onclick="javascript:valid_form();">

		   <div class="save"></div>

		   Valider</a>

		  </td>

		  <td valign="top" align="center">

		   <a href="gestion_cv.php">

		  <div class="cancel"></div>

		  Annuler</a>

		  </td>

		</tr>

	  </table>

	</td> 

  </tr>

 </table>

 <form method="post" action="gestion_cv.php?modifier=oui" name="f_ajout" onsubmit="return valid_form();" >

 <input type="hidden" value="<?=$row['id'];?>" name="id" />

	 

	       <table border="0" cellpadding="0" cellspacing="2" width="100%" style="padding-left:10px" class="cellule_table">

		  

		  <tr>

		  <td width="25%">Nom : </td>

		  <td width="25%">

	<input type="text" name="nom" id="nom" class="input" value="<?=htmlspecialchars($row['nom']); ?>" />

	</td>

		  <td width="25%"> </td>

		  <td width="25%"></td>

		  </tr>
             <tr>

              <td height="5px"></td>

          </tr>
           <tr>

    		  <td width="25%">Email : </td>

    		  <td width="25%"><input type="text" name="email" value="<?=$row['email'];?>" id="email" class="input" /></td>

    		  <td width="25%"> </td>

    		  <td width="25%"></td>

		  </tr>
          <tr>

              <td height="5px"></td>

          </tr>
          <tr>

    		  <td width="25%">Téléphone : </td>

    		  <td width="25%"><input type="text" name="tel" id="tel" value="<?=$row['tel'];?>" class="input" /></td>

    		  <td width="25%"> </td>

    		  <td width="25%"></td>

		  </tr>
          <tr>

              <td height="5px"></td>

          </tr>

          <tr>

              <td height="5px"></td>

          </tr>
          <tr>

    		  <td width="25%" valign="top">Matière : </td>

    		  <td width="25%">
			  <select name="matiere" class="input">
                  <option value="Espagnole" <?=($row['matiere']=='Espagnole') ?  $selected :'' ?>>Espagnole</option>
                  <option value="Français" <?=($row['matiere']=='Français') ?  $selected :'' ?>>Français</option>
                  <option value="Communication and marketing" <?=($row['matiere']=='Communication and marketing') ?  $selected :'' ?>>Communication and marketing</option>
                  <option value="Littérature anglaise" <?=($row['matiere']=='Littérature anglaise') ?  $selected :'' ?>>Littérature anglaise</option>
                  <option value="Traduction et interprétation" <?=($row['matiere']=='Traduction et interprétation') ?  $selected :'' ?>>Traduction et interprétation</option>
                  <option value="Téchnicien informatique" <?=($row['matiere']=='Téchnicien informatique') ?  $selected :'' ?>>Téchnicien informatique </option>
                  <option value="Auditeur" <?=($row['matiere']=='Auditeur') ?  $selected :'' ?>>Auditeur</option>
                  <option value="infographie" <?=($row['matiere']=='infographie') ?  $selected :'' ?>>infographie</option>
			  </select></td>
    		  <td width="25%"> </td>

    		  <td width="25%"></td>

		  </tr>
          <tr>

    		  <td width="25%" valign="top">Diplômes : </td>

    		  <td width="25%"><textarea style="width:300px; height:60" name="diplome"><?=stripslashes($row['diplome']);?></textarea></td>

    		  <td width="25%"> </td>

    		  <td width="25%"></td>

		  </tr>
          <tr>

              <td height="5px"></td>

          </tr>
            <tr>

    		  <td width="25%" valign="top">Commentaire : </td>

    		  <td width="25%">
			  <textarea style="width:300px; height:60px;"  name="commentaire" ><?=stripslashes($row['commentaire']);?></textarea>
			  </td>

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