<?php
	//initialisation de session
	session_start();
	
	//inclusion du fichier config une seul fois      
	//require_once 'administrator/config/config.php';
	require_once 'administrator/config/config.php';
        
        //teste coté serveur sur login et mot de passe si vide
	if ( isset($_POST['usrname']) && isset($_POST['pass']) && !empty($_POST['usrname']) && !empty($_POST['pass']) ){ 
 
    // execution apres envoi du formulaire
   
   // mise en variable du nom d'utilisateur
	$login = mysql_escape_string($_POST['usrname']); 
	
	// mise en variable du mot de passe crypté
	$pass = md5($_POST['pass']); 
	
	// requette sur la table administrateurs
	$sql=sprintf("SELECT id, nom, prenom, email, login, usertype
	FROM $tbl_admin 
	WHERE login='$login' and password='$pass' and archive=0"); 
	
	$_SESSION['admin_user_acces'] = false;
	$req = @mysql_query($sql) or die ("Erreur lors de la vérification du login et du mot de passe");
	$row = mysql_fetch_assoc($req);
	if (mysql_num_rows($req)) {
		
		// save user data in session array
		$_SESSION['admin_user_acces'] = true;  
		$_SESSION['admin_id_user'] = $row['id']; //son id
		$_SESSION['admin_nom'] =  $row['nom']; // Son nom
		$_SESSION['admin_prenom'] = $row['prenom']; // Son pre©nom
		$_SESSION['admin_login'] =  $row['login']; // Son Login
        $_SESSION['admin_email'] =  $row['email']; // Son Email
		$_SESSION['admin_type'] = $row['usertype']; // user type
		$_SESSION['admin_timestamp'] = time();
		$_SESSION['admin_token'] =  md5(uniqid(rand(), true)); // token
		$_SESSION['admin_browser'] = md5($_SERVER['HTTP_USER_AGENT']);  // user agent
		

                $id_user = $_SESSION['admin_id_user'] ;
                $adresse_ip = $_SERVER['REMOTE_ADDR'];
                $date_heure = date('Y-m-d H:m:s');
                $nom = $_SESSION['admin_nom'];

        $sql2="insert into $tbl_log (id_user, session, date, ip) values('$id_user', '$nom', '$date_heure', '$adresse_ip')";
        @mysql_query($sql2) or die ("erreur save log");
        
        $sql3="update $tbl_admin set lastvisitd='$date_heure' where id='$id_user'";
        @mysql_query($sql3) or die ("erreur mise à jour de la date time de connection");
		
			header("Location:administrator/index.php");

						}

						else {
	 $_SESSION['admin_user_acces'] = false;
							   // redirection si utilisateur non reconnu
							
								header("Location:console.php?erreur=login"); 
						
							}
	
	}
			

				if(isset($_GET['action']) && $_GET['action'] == 'logout'){ 
				              
					header("Location:console.php?erreur=delog");
				}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Accès à la console d'administration</title>
<style type="text/css">
@import url("administrator/css/admin_login.css");
</style>
<script language="javascript" type="text/javascript">
	function setFocus() {
		document.loginForm.usrname.select();
		document.loginForm.usrname.focus();
	}
	function verification(){
	if(document.loginForm.usrname.value == "") 
   {
    alert("Veuillez remplir le champ : identifiant!");
    document.loginForm.usrname.focus();
   return false;
  }
  if(document.loginForm.pass.value == "") 
   {
      alert("Veuillez remplir le champ : mot de passs!");
      document.loginForm.pass.focus();
   return false;
  }
   else
  {
      document.loginForm.submit();
      return true;
  }
  
}
</script>
<link rel="shortcut icon" href="administrator/images/icone.gif" />
</head>
<body onLoad="setFocus();">
<div id="wrapper">
	
</div>
<div id="ctr" align="center">
<div class="message" id="msgerreur">
		
		<?php 
		if(isset($_GET['erreur']) && ($_GET['erreur'] == "login")) {   
    	 	echo "Echec d'authentification !!! login ou mot de passe incorrect"; 
																	}
	    if(isset($_GET['erreur']) && ($_GET['erreur'] == "delog")) { 
     	    echo "D&eacute;connexion r&eacute;ussie... A bient&ocirc;t !";
	 															 }
	    if(isset($_GET['erreur']) && ($_GET['erreur'] == "intru")) {
      	 echo stripslashes(" Aucune session n\'est ouverte
      		ou vous n\'avez pas les droits pour afficher cette page"); 
       															 } 
	   	if(!isset($_GET['erreur'])) {
	   		echo"Veuillez saisir votre identifiant et votre mot de passe"; 
									}
		?>
			</div>
			<div style="color:#FF0000; font-weight:bold; text-align:center">
<noscript>
!Warning! Javascript must be enabled for proper operation of the Administrator
</noscript>
</div>
		<div class="login">
		<div class="login-form">
			<img src="administrator/images/login.gif" alt="identification" />
				<form action="#" method="post" name="loginForm" onSubmit="return verification();" id="loginForm">
				<input type="hidden" name="token" value="<?=md5(uniqid(rand(), true))?>" />
			<div class="form-block">
				<div class="inputlabel"><label for="usrname">Identifiant</label></div>
				<div><input name="usrname" id="usrname" type="text" class="inputbox" size="15" /></div>
				<div class="inputlabel"><label for="password">Mot de passe</label></div>
				<div><input name="pass" id="pass" type="password" class="inputbox" size="15" /></div>
				<div class="inputlabel"><label for="lang">Langue</label></div>
				<select class="inputbox" id="lang" name="lang">
					<option selected="selected" value="">Défaut</option>
					<option value="en-GB">English (United Kingdom)</option>
					<option value="fr-FR">French (FR)</option>
				</select>
				
				<div align="left"><input type="submit" name="submit" class="button" value="Valider" /></div>
			</div>
			</form>
		</div>
		<div class="login-text">

			<div class="ctr"><img src="administrator/images/j_login_lock.jpg" width="94" height="94" alt="security" /></div>
				<p>
					Utilisez un identifiant et un mot de passe corrects pour accéder à l'interface d'administration de votre site.
				</p>
		</div>
		<div class="clr"></div>
	</div>
</div>
<div id="break"></div>
<div class="footer" align="center">
	<!-- <div align="center">copyright 2008, Tous droits resérvés</div>-->
<div align="center">R2010-2021 Full Trademark Reserved </div>
</div>
</body>
</html>
