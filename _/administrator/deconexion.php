<?php
		session_start();
		$_SESSION['admin_user_acces'] = false;
		unset($_SESSION['admin_user_acces']);
        unset($_SESSION['admin_id_user']);
		unset($_SESSION['admin_nom']);
		unset($_SESSION['admin_type']);
		unset($_SESSION['admin_prenom']);
		unset($_SESSION['admin_login']);
        unset($_SESSION['admin_email']);
		unset($_SESSION['admin_admintype']);
		unset($_SESSION['admin_token']);
		unset($_SESSION['admin_browser']);
		unset($_SESSION['pid']);
		unset($_SESSION['admin_timestamp']);
		header("Location:../console.php?action=logout"); 
?>
