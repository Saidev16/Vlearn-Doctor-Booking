<script language="JavaScript">

function verif_formulaire(){

 if(document.add.nom.value == "") {
    alert("Veuillez remplir le champs nom!");
    document.add.nom.focus();
    return false;
                                    }

 if(document.add.prenom.value == "") {
    alert("Veuillez remplir le champs prenom!");
    document.add.prenom.focus();
    return false;
                                         }

  if(document.add.email.value == "") {
   alert("Veuillez remplir le champs email!");
   document.add.email.focus();
   return false;
  }

  if(document.add.email.value.match(/^[a-z0-9._-]+@[a-z0-9.-]{2,}[.][a-z]{2,3}$/) == null) {
    alert("Veuillez saisir un email valide!");
    document.add.email.focus();
    return false;
  }
  
  

  else
  {
  document.add.submit();
  }

}

</script>

<style type="text/css">

input{

width:200px;

}

</style>

<?php 

if(isset($_POST["nom"])){

  $id=$_POST["id_user"];
  $t_nom=$_POST["nom"];
  $t_prenom=$_POST["prenom"];
  $email=$_POST["email"];
  $description=$_POST["description"];
  $login=$_POST["login"];
  
  if( (isset($_POST['pass']))  && (!empty($_POST['pass'])) ){
  $pass=md5($_POST["pass"]);
  $sql=" UPDATE $tbl_admin SET 
         `nom` = '$t_nom',
		 `prenom` = '$t_prenom',
		 `email` = '$email',
		 `description` = '$description',
		 `login` = '$login',
		 `mot_pass` = '$pass'
          WHERE `id` ='$id' ;";

   @mysql_query($sql)or die ("erreur lors de la modification du compte avec password");
  				}
	else{
	$sql=" UPDATE $tbl_admin SET 
         `nom` = '$t_nom',
		 `prenom` = '$t_prenom',
		 `email` = '$email',
		 `description` = '$description',
		 `login` = '$login' 
          WHERE `id` ='$id' ;";

   @mysql_query($sql)or die ("erreur lors de la modification du compte sans password");
	}
  
  

?>

<script type="text/javascript" language="JavaScript1.2">

<!--

window.location.replace('gestion_compte.php');

//-->

</script>

<?

  }

else

 {

  $id_user=$_GET["processus"];
 
?>

 <form method="post"  action="gestion_compte.php?modifier=oui" name="add" onsubmit="return verif_formulaire();" >

  <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table" >

  <tr>

    <td><img src="images/icone/compte.gif" border="0"/></td>

    <td width="78%" class="titre">&nbsp;GESTION DES COMPTES <span class="task">[modifier]</span></td>

	<td width="22%">

	  <table border="0" align="right" width="40%" cellpadding="10" cellspacing="4" id="link">
 	    <tr>
		  <td valign="top" align="center">
 		   <a href="gestion_compte.php"><div class="retour"></div>Retour</a>
 		  </td>
 		</tr>
 	  </table>

	</td> 

  </tr>

</table>

<input type="hidden" name="id_user" value="<?=$id;?>"  />

<table cellspacing="1" align="center" width="100%" class="adminlist">

     <tr>
      <th>Menu  actif</th>
      <th>Menu  inactif</th>
    </tr>

	<tr>
		<td valign="top">
			<table width="100%" cellpadding="1">
				<tr align="center" class="text_gras">
					<td>Nom du Menu </td>
					<td>Country </td>
					<td>Supprimer</td>
				</tr>
				<?php
 				$sql="select m.id, m.titre ,type
				from $tbl_admin_menu as m, $tbl_menu_acces as ma 
				where ma.id_user='$id_user' 
				and ma.id_menu=m.id";
				$req=@mysql_query($sql) or die ('erreur lors de la s�lection des processus actif');
				while($row=mysql_fetch_assoc($req)){
				?>
				<tr align="center">
					<td><?=$row['titre']?></td>
					<td><?=$row['type']?></td>
					<td>
<a href="gestion_compte.php?dropProcessus=<?=$row['id']?>&id_user=<?=$id_user?>">[Supprimer]</a>
					</td>
				</tr>
				<?php
				}
				?>

			</table>
		</td>
		<td valign="top">
			<table width="100%" cellpadding="1">
				<tr align="center" class="text_gras">
					<td>Nom du Menu </td>
					<td>Country </td>
					<td>Ajouter</td>
 				</tr>
				<?php
 				$sql1="select distinct id, titre ,type
				from $tbl_admin_menu  
				where id not in (select id_menu from $tbl_menu_acces where id_user='$id_user')";
				 
				$req=@mysql_query($sql1) or die 
				('erreur lors de la sélection des processus inactif');
				while($row=mysql_fetch_assoc($req)){
				?>
				<tr align="center">
					<td><?=$row['titre']?></td>
					<td><?=$row['type']?></td>
					<td>
<a href="gestion_compte.php?addProcessus=<?=$row['id']?>&id_user=<?=$id_user?>">[Ajouter]</a>
					</td>
				</tr>
				<?php
				}
				?>
			</table>
		</td>
	</tr>
    
     
  </table>

</form>



<?php

}



?>