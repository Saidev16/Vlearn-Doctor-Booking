<link rel="stylesheet" type="text/css" href="../livres/css/layout.css">
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
if (isset($_POST['code_livre'])){
$code_inscription=$_POST['code_etudiant'];
$code_prof=$_POST['code_prof'];
$date=$_POST['year_i'].'-'.$_POST['month_i'].'-'.$_POST['day_i'];
$retourne=$_POST['retourne'];
$id=$_POST['id'];

											$sql="UPDATE $tbl_empreinte SET `code_inscription` = '$code_inscription',
											`code_prof` = '$code_prof',
											`retourne` = '$retourne' 
											WHERE code_empreinte='$id' LIMIT 1 ;";

                                            @mysql_query($sql)or die ("erreur lors de l'ajout ");
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
					window.location.replace('gestion_livres.php');
			//-->
			</script>
              <?php
			  }
			  else{
			  $id=$_GET['modifier'];
			  $sql4="select em.*, l.titre_livre from $tbl_empreinte as em, $tbl_livre as l where l.code_livre=em.code_livre and  em.code_emprunt='$id' limit 1";
			  $req=@mysql_query($sql4) or die ("erreur lors de la selection des livres ");
			  while ($row=mysql_fetch_assoc($req)){
			  $ex_retourne=$row['retourne'];
			  $ex_code_livre=$row['titre_livre'];
			  $ex_code_inscription=$row['code_inscription'];
			  $ex_code_prof=$row['code_prof'];
			  $ex_date_empreint=$row['date_empreint'];
			  $ex_date_retour=$row['date_retour'];
			  }
			  			  ?>
			   

<table border="0" width="1000" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/filieres.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DES EMPRUNTS <span style="font-size:12px">[modifier]</span> </td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		  <td valign="top" align="center">
		    <a href="#" onclick="javascript:valid_form();"><div class="save"></div>Valider</a> 
		  </td>
		  <td valign="top" align="center">
		    <a href="gestion_livres.php"><div class="cancel"></div> Annuler</a>
		  </td>
		</tr>
	  </table>	</td> 
  </tr>
</table>
 <form method="post"  action="gestion_livres.php?new=oui" name="f_ajout">
 <input type="hidden" name="id" value="<?=$id?>" />
	   <table border="0" cellpadding="0" cellspacing="2" width="100%" style="margin-left:10px" class="cellule_table">
		  
		  <tr>
		  <td width="25%">Etudiant </td>
		  <td width="25%"><select name="code_etudiant" class="input">
		  <option value="0">Sélectionner un étudiant</option>
		  <?php $sql1="select code_inscription, nom, prenom from $tbl_etudiant where etat not in('Laur', 'abandon', 'inscrit_abandon') order by nom";
		  $req=@mysql_query($sql1);
		  while($row=mysql_fetch_assoc($req)){
		  ?>
		  <option value="<?=$row['code_inscription']?> <?php if ($row['code_inscription']==$ex_code_inscription) echo "selected=\"selected\""; ?>"><?=$row['nom']?>&nbsp;<?=$row['prenom']?></option>
		  <?php
		  }
		  ?>
		  </select>
		  </td>
		  <td width="25%"> </td>
		  <td width="25%"></td>
		  </tr>
		  <tr><td colspan="4" height="3px"></td></tr>
		   <tr>
		  <td>Enseignant : </td>
		  <td><select name="code_prof" class="input">
		  <option value="0">Sélectionner un enseignant</option>
		  <?php $sql2="select code_prof, nom_prenom from tbl_professeur where archive!= 1 order by nom_prenom ";
		  $req=@mysql_query($sql2);
		  while($row=mysql_fetch_assoc($req)){
		  ?>
		  <option value="<?=$row['code_prof']?> <?php if ($row['code_prof']==$ex_code_prof) echo "selected=\"selected\""; ?>" ><?=$row['nom_prenom']?></option>
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
		  <td>Titre du livre: </td>
		  <td><input type="text" name="code_livre" value="<?=$ex_code_livre?>" readonly="yes" style="background-color:#FFFFFF; border:#FFFFFF 1px solid" />
		 </td>
		   <td>&nbsp;</td>
		   <td>&nbsp;</td>
		   </tr>
		  <tr><td colspan="4" height="3px"></td></tr>
		   <tr>
		  <td>Date  : </td>
		  <?php
		   $y=substr($ex_date_empreint, 0,4);
		  $m=substr($ex_date_empreint, 5,2);
		  $d=substr($ex_date_empreint, 8,2);
		  ?>
		  <td><select name="year_i" class="input">
		  <option value="<?=date('Y')?>"><?=date('Y')?></option>
		  &nbsp;</select>
		  &nbsp;<select name="month_i" class="input">
		  <?php for ($i=1; $i<13; $i++){
		  ?>
		  <option value="<?=$i?>" <?php if ($i==date('m')) echo "selected=\"selected\""; ?>><?=$i?></option>
		  <?php
		  }
		  ?>
		 </select>
		  &nbsp;<select name="day_i" class="input">
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
		  <td>Retourné: </td>
		  <td><select name="retourne" class="input">
		  <option value="1">non</option>
		  <option value="0">oui</option>
		  </select></td>
		   <td>&nbsp;</td>
		   <td>&nbsp;</td>
		   </tr>
		  <tr><td colspan="4" height="3px"></td></tr>
		 
	  </table>
	  
</form>

<?php
}

?>