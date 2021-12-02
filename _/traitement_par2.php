<?php
//die('We cannot process your request at this time. Please try again later');
session_start();
	 
	require 'administrator/config/config.php';
	
	if ((isset($_POST['login_parent'])) && (isset($_POST['login_parent']))  && (isset($_POST['prefixe']))){
		if ((!empty($_POST['login_parent'])) && (!empty($_POST['login_parent'])) && (!empty($_POST['prefixe']))){
			 
	echo $login=mysql_escape_string($_POST['login_parent']);
	$pass=md5(strtolower($_POST['pass_etudiant']));
	$prefixe=$_POST['prefixe']; 


	echo  $sql="SELECT code_inscription, login_parent, mot_pass_parent, groupe,prefixe, CONCAT(nom ,' ', prenom) AS name 
	 FROM tbl_etudiant_all
	 WHERE login_parent='$login' 
	 AND mot_pass_parent='$pass' 
	 and prefixe='$prefixe'
	 AND acces = 1 limit 1 ";  
	 
	$req=@mysql_query($sql) or die("erreur dans lors de l'authentification etudiant");
	if ($req){   
	
	while ($row=mysql_fetch_assoc($req)){
 	$_SESSION['code_etudiant'] = $code_inscription = $row['code_inscription'];
	$_SESSION['user_agent']=md5($_SERVER['HTTP_USER_AGENT']);
	$_SESSION['Slogin'] = $row['login'];
	$_SESSION['etat'] =  $row['groupe'];
	$_SESSION['name'] =  $row['name'];
	$_SESSION['prefixe'] =  $row['prefixe'];
	$_SESSION['token'] = md5(uniqid(rand(), true));
										}
					 			
	$adresse_ip=$_SERVER['REMOTE_ADDR'];
	$date_heure=date('Y-m-d').' '.date('H:m:s');
	$sql2="INSERT INTO $tbl_log  (id_user, session, date, ip) VALUES ('$code_inscription', '$login', '$date_heure', '$adresse_ip')";
	@mysql_query($sql2) or die ("Erreur mise à jour de la date du de connection");
	
	
	
	$sql12="SELECT COUNT(*) AS nbre_entrees FROM visites WHERE ip='$adresse_ip'";
	$retour = mysql_query($sql12);
    $donnees = mysql_fetch_array($retour);

if ($donnees['nbre_entrees'] == 0) // L'IP ne se trouve pas dans la table, on va l'ajouter.
{
mysql_query('INSERT INTO visites VALUES(\'' . $_SERVER['REMOTE_ADDR'] . '\', ' . time() . ')');
 
//$sql13="INSERT INTO visites (ip,compteur) VALUES('$adresse_ip',compteur +1)";
  //  @mysql_query($sql13);
}
else // L'IP se trouve déjà dans la table, on met juste à jour le timestamp.
{
    //mysql_query('UPDATE visites SET  timestamp=' . time() . ' WHERE ip=\'' . $_SERVER['REMOTE_ADDR'] . '\'');
	mysql_query('UPDATE visites SET timestamp=' . time() . ' WHERE ip=\'' . $_SERVER['REMOTE_ADDR'] . '\'');

}
$timestamp_5min = time() - (1440 * 60); // 1440 * 60 = nombre de secondes écoulées en 1440 minutes
mysql_query('DELETE FROM visites WHERE timestamp < ' . $timestamp_5min);
							  
	header("location:http://".$_SERVER['HTTP_HOST']."/student.php?task=info");
		}

	else{

 		header("location:http://".$_SERVER['HTTP_HOST']."/index.php");
        }
									}
								}
									      
?>
