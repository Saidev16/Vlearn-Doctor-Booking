<?php
if (isset($_GET['detail'])){

	 $code_parent=(int)$_GET['detail'];
	 ?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/enseignants.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;Details</span></td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		<td valign="top" align="center" >
		  <a href="parents.php?modifier=<?=$code_parent?>"> 
		    <div class="modifier"></div>Edit</a>
	    </td>
		<!--<td>
			<a href="parents.php?journal=<?=$code_parent?>">
			<div class="ajouter"></div>Journal</a>
		</td>-->
		<td valign="top" align="center" >
		  <a href="#" onclick="window.print();" title="Imprimer">
		  <div class="imprimer"></div>Print</a>
		  </td>
		 <td align="right">
		 	<a href="parents.php"><div class="retour"></div>Back</a>
		 </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>
	 <table width="100%" border="0" cellspacing="4" cellpadding="0" class="cellule_table">
	 <?php
	 $sql="select * from tbl_parents where code_parent='$code_parent'";
	 $req=@mysql_query($sql) or die ("erreur lors de la sélection du professeur");
	 while($row=mysql_fetch_assoc($req)){
	 
	 $code_parent=htmlentities($row['code_parent']);
	 $nom_prenom=htmlentities($row['nom_prenom']);	 
	 $mail=htmlentities($row['mail']);	
	 $contact=htmlentities($row['contact']);
	 $type=htmlentities($row['type']);
	 $login=htmlentities($row['login']);
	 $password=htmlentities($row['mot_pass']);
	 ?>
 <tr>
    <td ><span class="text_gras">Parent Code</span> :&nbsp;<?=$code_parent?></td>
	<td></td>
  </tr>

  <tr>
    <td><span class="text_gras">Name</span> :&nbsp;<?=$nom_prenom?></td>
    <td></td>
  </tr>
  
  
  
  <tr>
    <td ><span class="text_gras">E-mail</span> :&nbsp;<?=$mail?>&nbsp;-&nbsp;<?=$mail1?></td>
    <td></td>
  </tr>

  <tr>
    <td ><span class="text_gras">Phone Number</span> :&nbsp;<?=$tel?></td>
    <td></td>
  </tr>

  <tr>
    <td ><span class="text_gras">Adress</span> :&nbsp;<?=$contact?></td>
    <td></td>
  </tr>
 
  
  <tr>
    <td ><span class="text_gras">Login</span> :&nbsp;<?=$login?></td>
    <td></td>
  </tr>
  
 
   <tr>
	   <td align="center" colspan="2">
		<form name="acces" id="" action="../traitement_prof.php" method="post" target="_blank" >
			<input type="hidden" name="login_prof" id="login_prof" value="<?=$login?>" />
			<input type="hidden" name="pass_prof" id="pass_prof" value="<?=$password?>" />
			<input type="hidden" name="md5" value="no" />
			<input type="hidden" name="token" value="<?=md5(uniqid(rand(), true))?>" />
			<input type="submit" value="Parent Space" name="acces" 
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