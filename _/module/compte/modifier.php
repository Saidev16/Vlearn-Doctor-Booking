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
		 `password` = '$pass'
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

  $id=$_GET["modifier"];

  $sql="SELECT * FROM $tbl_admin  WHERE id = $id";

  $req=@mysql_query($sql) or die("erreur lors de la selection du compte");

  $ligne=mysql_fetch_assoc($req);

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

	<a href="#" onclick="javascript:verif_formulaire();"><div class="save"></div>Valider</a> 

		  </td>

		  <td valign="top" align="center">

		   <a href="gestion_compte.php"><div class="cancel"></div>Annuler</a>

		  </td>

		</tr>

	  </table>

	</td> 

  </tr>

</table>

<input type="hidden" name="id_user" value="<?=$id;?>"  />

<table style="font-size:11px; padding-left:2px; margin-top:25px" cellspacing="1" width="60%" align="left">

     <tr>

      <td>Nom: </td>

      <td><input name="nom" type="text" id="nom"  value="<?=$ligne["nom"];?>" class="input"></td>

    </tr>

    <tr>

      <td>Pr&eacute;nom: </td>

      <td><input name="prenom" type="text" id="prenom"  value="<?=$ligne["prenom"];?>" class="input"></td>

    </tr>   

    <tr>
	
	  <td>E-mail: </td>
	  <td><input type="text" name="email" id="email" value="<?=$ligne['email']?>" class="input"/></td>
	
	</tr>
	
	</tr>
	
	 <tr>
	
	  <td>Login: </td>
	  <td><input type="text" name="login" id="login" value="<?=$ligne['login']?>" class="input"/></td>
	
	</tr>
	
	</tr>
	
	 <tr>

      <td>Mot de passe :</td>

      <td><input name="pass" type="password" id="pass" class="input"></td>

    </tr>

    <tr>

      <td>Retaper mot de passe :</td>

      <td><input name="pass2" type="password" id="pass2" class="input"></td>

    </tr>
	
	<tr>
	
	</tr>
	
	<tr>

      <td valign="top">Description :</td>

      <td><textarea rows="" cols="" name="description" class="input" 
	  style="width:200px; height:120px;"><?=stripslashes($ligne["description"])?></textarea></td>

    </tr>
     
  </table>

</form>



<?php

}



?>