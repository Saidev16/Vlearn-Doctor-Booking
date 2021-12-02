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

 if(document.add.login.value == "")  {
   alert("Veuillez remplir le champs login!");
   document.add.login.focus();
   return false;
                                     }

 if(document.add.pass.value == "") {
   alert("Veuillez remplir le champs mot de passe!");
   document.add.pass.focus();
   return false;
                                   }

 if(document.add.pass2.value == "")  {
   alert("Veuillez remplir le champs mot de passe 2 !!");
   document.add.pass2.focus();
   return false;
                                      }

 if(document.add.pass2.value != document.add.pass.value ) {
   alert("Vos Mots de passe sont incorrects!");
   document.add.pass2.focus();
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

if(isset($_POST["login"])){

  $t_login=mysql_real_escape_string($_POST["login"]);
  $t_pass=md5(mysql_real_escape_string($_POST["pass"]));
  $t_pass2=$_POST["pass2"];
  $t_nom=$_POST["nom"];
  $t_prenom=$_POST["prenom"];
  $email=$_POST['email'];
  $type=$_POST['type'];
  $description=addslashes($_POST['description']);

  $sql="INSERT INTO $tbl_admin (nom, prenom, email, login, password, usertype, description) 
        VALUES ('$t_nom', '$t_prenom', '$email', '$t_login', '$t_pass', '$type', '$description')";

  @mysql_query($sql)or die ("erreur lors de l'ajout d'un utilisateur");


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
?>
 <form method="post"  action="gestion_compte.php?new=oui" name="add" onsubmit="return verif_formulaire();" >

  <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table" >

  <tr>

    <td><img src="images/icone/compte.gif" border="0"/></td>

    <td width="78%"  class="titre">&nbsp;GESTION DES COMPTES 
	<span class="task">[ajouter]</span></td>

	<td width="22%">

	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >

	    <tr>

		 

		  <td valign="top" align="center">

		  <a href="#" onclick="javascript:verif_formulaire();"><div class="save"></div>Valider</a>

		  </td>

		  <td valign="top" align="center">

		   <a href="gestion_compte.php"><div class="cancel"></div> Annuler</a>

		  </td>

		</tr>

	  </table>

	</td> 

  </tr>

</table>

   <table style="font-size:11px; padding-left:2px; margin-top:25px" cellspacing="1" width="100%" align="left">

    <tr>

      <td>Nom: </td>

      <td><input name="nom" type="text" id="nom" class="input"></td>

    </tr>

    <tr>

      <td>Pr&eacute;nom: </td>

      <td><input name="prenom" type="text" id="prenom" class="input"></td>

    </tr>

    <tr>

      <td>E-mail: </td>

      <td><input name="email" type="text" id="email" class="input"></td>

    </tr>

    <tr>

      <td width="20%">Login: </td>

      <td width="80%"><input name="login" type="text" id="login" class="input"></td>

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

      <td>Type de compte :</td>

      <td><input name="type" type="text" id="type" class="input"></td>

    </tr>
     
    <tr>

      <td valign="top">Description :</td>

      <td><textarea rows="" cols="" name="description" class="input" 
	  style="width:200px; height:120px;"></textarea></td>

    </tr>
  </table>

</form>

<?php

}



?>