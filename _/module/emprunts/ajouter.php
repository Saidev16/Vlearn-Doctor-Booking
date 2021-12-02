<style type="text/css">
input{
width:200px;
}
</style>
<script language="javascript1.2">
function valid_form(){
document.f_ajout.submit();
return true;
}
</script>
<?php
if (isset($_POST['code_livre'])){
$code_inscription=$_POST['code_etudiant'];
$code_prof=$_POST['code_prof'];
$code_livre=$_POST['code_livre'];
$date=$_POST['year_i'].'-'.$_POST['month_i'].'-'.$_POST['day_i'];
$date_retour= date("Y-m-d", mktime(0, 0, 0, $_POST['month_i'], $_POST['day_i']+15,  $_POST['year_i']));
$sql="INSERT INTO $tbl_empreinte ( `code_emprunt`, `code_livre` , `code_inscription` , `code_prof` , `date_empreint` ,`date_retour` ) VALUES (NULL, '$code_livre' , '$code_inscription', '$code_prof', '$date', '$date_retour');";


         @mysql_query($sql)or die ("erreur lors de l'enregistrement de l'emprunt");
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('gestion_livres.php');
			//-->
			</script>
              <?php
			  }
			  else{
			  ?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/classes.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES EMPRUNTS <span class="task">[ajouter]</span> </td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		 
		  <td valign="top" align="center">
		   <a href="#" onclick="javascript:valid_form();"><div class="save"></div>Valider</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_livres.php"> <div class="cancel"></div>Annuler</a>		  
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
 </table>
          <form method="post"  action="gestion_livres.php?new=oui" name="f_ajout"  >
	  	       <table border="0" cellpadding="0" cellspacing="2" width="100%" class="cellule_table">
		  <tr>
		  <td width="25%">Etudiant</td>
		  <td width="25%"><select name="code_etudiant" class="input">
		  <option value="">Sélectionner</option>
		  <?php $sql1="select code_inscription, nom, prenom from tbl_etudiant order by nom";
		  $req=@mysql_query($sql1);
		  while($row=mysql_fetch_assoc($req)){
		  ?>
		  <option value="<?=$row['code_inscription']?>"><?=$row['nom']?>&nbsp;<?=$row['prenom']?></option>
		  <?php
		  }
		  ?>
		  </select>		  </td>
		  <td width="25%"> </td>
		  <td width="25%"></td>
		  </tr>
		  <tr><td colspan="4" height="3px"></td></tr>
		   <tr>
		  <td>Enseignant : </td>
		  <td><select name="code_prof" class="input">
		  <option value="">Sélectionner</option>
		  <?php $sql2="select code_prof, nom_prenom from tbl_professeur order by nom_prenom ";
		  $req=@mysql_query($sql2);
		  while($row=mysql_fetch_assoc($req)){
		  ?>
		  <option value="<?=$row['code_prof']?>"><?=$row['nom_prenom']?></option>
		  <?php
		  }
		  ?>
		  </select></td>
		   <td>&nbsp;</td>
		   <td>&nbsp;</td>
		   </tr>
		  <tr><td colspan="4" height="3px"></td>
		  </tr>
		  
		   <tr>
		  <td>Livre: </td>
		  <td><select name="code_livre" class="input">
		  <option value="0">Sélectionner</option>
		  <?php $sql3="select code_livre, titre_livre from $tbl_livre  where disponibilite='oui' order by titre_livre";
		  $req=@mysql_query($sql3);
		  while($row=mysql_fetch_assoc($req)){
		  ?>
		  <option value="<?=$row['code_livre']?>"><?=$row['titre_livre']?></option>
		  <?php
		  }
		  ?>
		  </select></td>
		   <td>&nbsp;</td>
		   <td>&nbsp;</td>
		   </tr>
		  <tr><td colspan="4" height="3px"></td></tr>
		   <tr>
		  <td>Date  : </td>
		  <td><select name="year_i" class="input">
		  <option value="<?=date('Y')?>"><?=date('Y')?></option>
		  &nbsp;</select>
&nbsp;
<select name="month_i" class="input">
  <?php for ($i=1; $i<13; $i++){
		  ?>
  <option value="<?=$i?>" <?php if ($i==date('m')) echo "selected=\"selected\""; ?>>
  <?=$i?>
  </option>
  <?php
		  }
		  ?>
</select>		  
&nbsp;
		  <select name="day_i" class="input">
		  <?php for ($i=1; $i<32; $i++){
		  ?>
		  <option  value="<?=$i?>" <?php if ($i==date('d')) echo "selected=\"selected\""; ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		  </select></td>
		   <td>&nbsp;</td>
		   <td>&nbsp;</td>
		   </tr>
		  <tr><td colspan="4" height="3px"></td></tr>
		   <tr>
	  </table>
	  
</form>

<?php
}

?>