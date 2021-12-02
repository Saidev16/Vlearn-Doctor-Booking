<?php
if (isset($_GET['detail'])){

	 $code_prof=(int)$_GET['detail'];
	 ?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/enseignants.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;Details</span></td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		<td valign="top" align="center" >
		  <a href="gestion_enseignants.php?modifier=<?=$code_prof?>"> 
		    <div class="modifier"></div>Edit</a>
	    </td>
		<td>
			<a href="gestion_enseignants.php?journal=<?=$code_prof?>">
			<div class="ajouter"></div>Journal</a>
		</td>
		<td valign="top" align="center" >
		  <a href="#" onclick="window.print();" title="Imprimer">
		  <div class="imprimer"></div>Print</a>
		  </td>
		 <td align="right">
		 	<a href="gestion_enseignants.php"><div class="retour"></div>Back</a>
		 </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>
	 <table width="100%" border="0" cellspacing="4" cellpadding="0" class="cellule_table">
	 <?php
	 $sql="select * from $tbl_professeur where code_prof='$code_prof'";
	 $req=@mysql_query($sql) or die ("erreur lors de la sélection du professeur");
	 while($row=mysql_fetch_assoc($req)){
	 
	 $code_prof=htmlentities($row['code_prof']);
	 $nom_prenom=htmlentities($row['nom_prenom']);
	 $nationnalite=htmlentities($row['nationnalite']);
	 $diplome=htmlentities($row['diplome']);
	 $matiere=htmlentities($row['matiere']);
	 $mail=htmlentities($row['mail']);
	 $mail1=htmlentities($row['mail1']);
	 $contact=htmlentities($row['contact']);
	 $niveau=htmlentities($row['niveau']);
	 $type=htmlentities($row['type']);
	 $login=htmlentities($row['login']);
	 $commentaire=htmlentities($row['commentaire']);
	 $password=htmlentities($row['mot_pass']);
	 ?>
 <tr>
    <td ><span class="text_gras">Code du professeur</span> :&nbsp;<?=$code_prof?></td>
	<td></td>
  </tr>

  <tr>
    <td><span class="text_gras">Full Name</span> :&nbsp;<?=$nom_prenom?></td>
    <td></td>
  </tr>
  
  <tr>
    <td><span class="text_gras">Nationality</span> :&nbsp;<?=$nationnalite?></td>
    <td></td>
  </tr>
  
  <tr>
    <td ><span class="text_gras">E-mail</span> :&nbsp;<?=$mail?>&nbsp;-&nbsp;<?=$mail1?></td>
    <td></td>
  </tr>

  <tr>
    <td ><span class="text_gras">Phone Number</span> :&nbsp;<?=$contact?></td>
    <td></td>
  </tr>
  <tr>
    <td ><span class="text_gras">Diploma</span>:&nbsp;<ul style="list-style:none">
	<?php
	$tbl = explode(";", $diplome);
	foreach($tbl as $val){
	echo '<li><span class="text_gras">&raquo;&nbsp;</span>'.$val.'</li>';
	}
	?></ul></td>
    <td></td>

  </tr>
  
  <tr>
    <td><span class="text_gras">Major</span> :&nbsp;<?=$niveau?></td>
    <td></td>
  </tr>
  
  <tr>
    <td ><span class="text_gras">Situation</span> :&nbsp;<?=$type?></td>
    <td></td>
  </tr>
  
  <tr>
    <td ><span class="text_gras">Login</span> :&nbsp;<?=$login?></td>
    <td></td>
  </tr>
  
  <tr>
    <td ><span class="text_gras">Commentaire :</span >&nbsp;<?=$commentaire?></td>
    <td></td>
  </tr>
   
   <tr>
	   <td align="center" colspan="2">
		<form name="acces" id="" action="../traitement_prof.php" method="post" target="_blank" >
			<input type="hidden" name="login_prof" id="login_prof" value="<?=$login?>" />
			<input type="hidden" name="pass_prof" id="pass_prof" value="<?=$password?>" />
			<input type="hidden" name="md5" value="no" />
			<input type="hidden" name="token" value="<?=md5(uniqid(rand(), true))?>" />
			<input type="submit" value="Access to his space" name="acces" 
			style="font-family:verdana; font-size:11px" />
			<input type="hidden" name="doUpdate" value="non" />
		</form>
		</td>
  </tr>
  <?php
  }
  }
  ?>
</table>