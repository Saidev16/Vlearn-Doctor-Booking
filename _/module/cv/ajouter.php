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

$nom=$_POST['nom'];
$email=$_POST['email'];
$tel=$_POST['tel'];
$diplome=$_POST['diplome'];
$matiere=$_POST['matiere'];
$commentaire=$_POST['commentaire'];

				$sql="INSERT INTO $tbl_cv
				( `id` , `nom`, `email`, `tel`, `diplome`, `commentaire`, `matiere` )
                 VALUES (NULL , '$nom', '$email', '$tel', '$diplome', '$commentaire',
				  '$matiere');";
 

                @mysql_query($sql)or die ("erreur lors de l'ajout du cv ");

			?>

			<script type="text/javascript" language="JavaScript1.2">

			<!--	

					window.location.replace('gestion_cv.php');

			//-->

			</script>

              <?php

			  }

			  else{

			  ?>


<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td><img src="images/icone/filieres.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;Ajout  d' un cv </td>

	<td width="22%">

	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >

	    <tr>

		  <td valign="top" align="center">

		   <a href="#" 

		   onclick="javascript:valid_form();"><div class="ajouter"></div>Ajouter</a>
		  </td>

		  <td valign="top" align="center">

		   <a href="gestion_cv.php"><div class="cancel"></div>  Annuler</a>
		
		  </td>

		</tr>

	  </table>

	</td> 

  </tr>

 </table>

 <form method="post"  action="gestion_cv.php?new=oui" name="f_ajout">
	       <table border="0" cellpadding="0" cellspacing="2" width="100%" class="cellule_table">

		  

		  <tr>

    		  <td width="25%">Nom : </td>

    		  <td width="25%"><input type="text" name="nom" id="nom" class="input" /></td>

    		  <td width="25%"> </td>

    		  <td width="25%"></td>

		  </tr>
          <tr>

              <td height="5px"></td>

          </tr>
           <tr>

    		  <td width="25%">Email : </td>

    		  <td width="25%"><input type="text" name="email" id="email" class="input" /></td>

    		  <td width="25%"> </td>

    		  <td width="25%"></td>

		  </tr>
          <tr>

              <td height="5px"></td>

          </tr>
          <tr>

    		  <td width="25%">Téléphone : </td>

    		  <td width="25%"><input type="text" name="tel" id="tel" class="input" /></td>

    		  <td width="25%"> </td>

    		  <td width="25%"></td>

		  </tr>
          <tr>

              <td height="5px"></td>

          </tr>
          <tr>

    		  <td width="25%" valign="top">Matière : </td>

    		  <td width="25%">
			  <select name="matiere" class="input">
                  <option value="Espagnole">Espagnole</option>
                  <option value="Français">Français</option>
                  <option value="Anglais">Anglais</option>
                  <option value="Communication and marketing">Communication and marketing</option>
                  <option value="Littérature anglaise">Littérature anglaise</option>
                  <option value="Traduction et interprétation">Traduction et interprétation</option>
                  <option value="Téchnicien informatique">Téchnicien informatique </option>
                  <option value="Auditeur">Auditeur</option>
                  <option value="infographie">infographie</option>
			  </select></td>
    		  <td width="25%"> </td>

    		  <td width="25%"></td>

		  </tr>

            <tr>

              <td height="5px"></td>

          </tr>
          <tr>

    		  <td width="25%" valign="top">Diplômes : </td>

    		  <td width="25%"><textarea style="width:300px; height:60" name="diplome"></textarea></td>

    		  <td width="25%"> </td>

    		  <td width="25%"></td>

		  </tr>
          <tr>

              <td height="5px"></td>

          </tr>
            <tr>

    		  <td width="25%" valign="top">Commentaire : </td>

    		  <td width="25%"><textarea style="width:300px; height:60px;" name="commentaire" ></textarea></td>

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