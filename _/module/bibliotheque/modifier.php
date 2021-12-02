<style type="text/css">

input{

width:200px;

}

</style>

<script language="javascript1.2">

function valid_form(){



if ($F('titre')==""){

alert('veuillez taper le titre');

$('titre').focus();

return false;

}



if ($F('nbr_exemplaire')==""){

alert('veuillez taper le nombre d\'exemplaire');

$('nbr_exemplaire').focus();

return false;

}



if ($F('nbr_exemplaire').match(/^[-]?\d*\.?\d*$/) == null){

alert('veuillez taper un nombre !');

$('nbr_exemplaire').focus();

return false;

}



if ($F('categorie_livre')=="0"){

alert('veuillez sélectionner le categorie du livre ');

$('categorie_livre').focus();

return false;

}



else {

document.f_ajout.submit();

return true;

}

}

</script>

<?php

if (isset($_POST['titre'])){

$titre=$_POST['titre'];

$nbr_exemplaire=$_POST['nbr_exemplaire'];

$categorie_livre=$_POST['categorie_livre'];

$date_insc=$_POST['year_i'].'-'.$_POST['month_i'].'-'.$_POST['day_i'];

$id=$_POST['id'];

	$sql="UPDATE $tbl_livre SET `titre_livre` = '$titre',

	`nbr_exemplaire` = '$nbr_exemplaire',

`categorie_livre` = '$categorie_livre',

  `date_aquisition` = '$date_insc'


 WHERE code_livre =$id ;";

      @mysql_query($sql) or die ("erreur lors de la modification des livres");

			?>

			<script type="text/javascript" language="JavaScript1.2">

			<!--	

		window.location.replace('gestion_bibliotheque.php');

				

			//-->

			</script>

              <?php

			  }

			  else{

			  $id=$_GET["modifier"];

			  $sql2="select code_livre, titre_livre, nbr_exemplaire, categorie_livre, date_aquisition from $tbl_livre where code_livre=$id";

			  $req2=@mysql_query($sql2) or die("erreur dans la selection des livres");

			    $row=mysql_fetch_assoc($req2);

               $cat=$row['categorie_livre'];
			  
               $y=substr($row['date_aquisition'], 0,4);

		       $m=substr($row['date_aquisition'], 5,2);

		       $d=substr($row['date_aquisition'], 8,2);

			  ?>

<table border="0" width="1000" cellpadding="0" cellspacing="0" align="center" class="haut_table">

  <tr>

    <td><img src="images/icone/bibliotheque.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES LIVRES 
	<span class="task">[modifier]</span> </td>

	<td width="22%">

	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >

	    <tr>

		  <td valign="top" align="center">

		   <a href="#"  onclick="javascript:valid_form();"><div class="save"></div>Valider</a>


		  </td>

		  <td valign="top" align="center">

		   <a href="gestion_bibliotheque.php"><div class="cancel"></div>Annuler</a>

		  </td>

		</tr>

	  </table>

	</td> 

  </tr>

 </table>
 <table border="0" cellpadding="0" cellspacing="2" width="100%" height="500" class="cellule_table">
 <form method="post" action="gestion_bibliotheque.php?modifier=oui" name="f_ajout" >
 <input type="hidden" value="<?=htmlentities($row['code_livre'])?>" name="id" />

		  <tr height="20px">
		  <td width="25%">Titre : </td>
		  <td width="25%"><input type="text" name="titre" id="titre" 
		  value="<?=htmlentities($row['titre_livre'])?>" class="input" style="width:500px" /></td>
		  <td width="25%"> </td>
		  <td width="25%"></td>

		  </tr>
		  <tr><td colspan="4" height="3px"></td></tr>

		   <tr  height="20px">

		  <td>Nombre d'exemplaire : </td>

		  <td><select name="nbr_exemplaire" id="nbr_exemplaire">
          <option value="1" <?=($row['nbr_exemplaire']==1) ? $selected : '' ?>>1</option>
           <option value="2" <?=($row['nbr_exemplaire']==2) ? $selected : '' ?>>2</option>
            <option value="3" <?=($row['nbr_exemplaire']==3) ? $selected : '' ?>>3</option>
             <option value="4" <?=($row['nbr_exemplaire']==4) ? $selected : '' ?>>4</option>
             </select> </td>

		   <td>&nbsp;</td>

		   <td>&nbsp;</td>

		   </tr>

		  <tr><td colspan="4" height="3px"></td></tr>

		   <tr height="20px">

		  <td>Catégorie : </td>

		  <td>
            <select name="categorie_livre" id="categorie_livre" class="input" style="width:200px">
               
               <option value="0">Sélectionner</option>
 		  <option value="Management anglophone" <?=($cat=='Management anglophone') ? $selected : '' ?>>Management anglophone</option>
          <option value="Management francophone" <?=($cat=='Management francophone') ? $selected : '' ?>>Management francophone</option>
          
          <option value="Ressources humaines anglophone" <?=($cat=='Ressources humaines anglophone') ? $selected : '' ?>>Ressources humaines anglophone</option>
          <option value="Ressources humaines francophone" <?=($cat=='Ressources humaines francophone') ? $selected : '' ?>>Ressources humaines francophone</option>
          
          <option value="Comptabilité anglophone" <?=($cat=='Comptabilité anglophone') ? $selected : '' ?>>Comptabilité anglophone</option>
          <option value="Comptabilité francophone" <?=($cat=='Comptabilité francophone') ? $selected : '' ?>>Comptabilité francophone</option>
         
          <option value="Droit anglophone" <?=($cat=='Droit anglophone') ? $selected : '' ?>>Droit anglophone</option>
          <option value="Droit francophone" <?=($cat=='Droit francophone') ? $selected : '' ?>>Droit francophone</option>
          
          <option value="Systeme d 'information anglophone" <?=($cat=="Systeme d \'information anglophone") ? $selected : '' ?>>Systeme d 'information anglophone</option>
          <option value="Systeme d 'information francophone" <?=($cat=="Systeme d 'information francophone") ? $selected : '' ?>>Systeme d 'information francophone</option>
          
          
          <option value="Finance,Communication et Economie francophone" <?=($cat=='Finance,Communication et Economie francophone') ? $selected : '' ?>>Finance, Communication et Economie francophone</option>
          <option value="Finance,Communication et Economie anglophone" <?=($cat=='Finance,Communication et Economie anglophone') ? $selected : '' ?>>Finance,Communication et Economie anglophone</option>
          
          <option value="Marketing francophone" <?=($cat=='Marketing francophone') ? $selected : '' ?>>Marketing  francophone</option>
          <option value="Marketing anglophone" <?=($cat=='Marketing anglophone') ? $selected : '' ?>>Marketing  anglophone</option>


		 </select>
          </td>

		   <td>&nbsp;</td>

		   <td>&nbsp;</td>

		   </tr>

		  <tr><td colspan="4" height="3px"></td></tr>

		   <tr>
           <tr><td colspan="4" height="3px"></td></tr>

		   <tr height="20px">

		  <td>Date d'aquisition : </td>

		  <td>
           <select name="year_i" class="input">

		  <?php for ($i=date('Y'); $i>1996; $i--){

		  ?>

		  <option value="<?=$i?>" <?=($y==$i) ? $selected : '' ?>><?=$i?></option>

		  <?php

		  }

		  ?>

		  &nbsp;</select>

		  &nbsp;<select name="month_i" class="input">

		  <?php for ($i=1; $i<13; $i++){

		  ?>

		  <option value="<?=$i?>" <?=($m==$i) ? $selected : '' ?>><?=$i?></option>

		  <?php

		  }

		  ?>

		 </select>

		  &nbsp;<select name="day_i" class="input">

		  <?php for ($i=1; $i<32; $i++){

		  ?>

		  <option value="<?=$i?>" <?=($d==$i) ? $selected : '' ?>><?=$i?></option>

		  <?php

		  }

		  ?>

		  </select>

          </td>

		   <td>&nbsp;</td>

		   <td>&nbsp;</td>

		   </tr>
		   <tr><td height="420" colspan="4"></td></tr>
</form>

	  </table>

     

<?php

}

?>