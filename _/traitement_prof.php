<?php 
session_start();

require 'administrator/config/config.php';

if (isset($_POST['login_prof'])){

$login=mysql_escape_string($_POST['login_prof']);
if( (isset($_POST['md5'])) && ($_POST['md5']=='no') ){
$pass=$_POST['pass_prof'];
}
else{
$pass=md5($_POST['pass_prof']);
}

$sql="select code_prof, login, nom_prenom 
from $tbl_professeur 
where login='$login' 
and mot_pass='$pass' 
and archive=0 limit 1 "; 

$req=@mysql_query($sql) or die("erreur d'authentification");
 

	if (mysql_num_rows($req)){

	$row=mysql_fetch_assoc($req);
	$_SESSION['prof_login']=$row['login']; 
	$_SESSION['code_prof']=$code_prof=$row['code_prof'];
	$_SESSION['name']=$row['nom_prenom']; 
	$_SESSION['browser']=md5($_SERVER['HTTP_USER_AGENT']);
	$_SESSION['token']= md5(uniqid(rand(), true));
	
	$adresse_ip=$_SERVER['REMOTE_ADDR'];
	$date_heure=date('Y-m-d').' '.date('H:m:s');
	$sql2="insert into $tbl_log  (id_user, session, date, ip) 
	values('$code_prof', '$login', '$date_heure', '$adresse_ip')";
	@mysql_query($sql2) or die ("erreur mise à jour de la date du de connection");
	?>
	<script language="javascript1.2">
	<!--
	window.location.replace("professeur.php?task=info");
	-->
	</script>
	<?php
	//header("location:professeur.php");
	}
	else{
	?>
	<script language="javascript1.2">
	<!--
	window.location.replace('http://<?=$_SERVER['HTTP_HOST']?>');
	-->
	</script>
	<?php
	//header("location:index.php");
	}
	}
	?>
	
