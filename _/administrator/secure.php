<?php
          session_start();
          if ( isset($_SESSION['admin_id_user']) && isset($_SESSION['admin_token']) && $_SESSION['admin_user_acces'] == true 
		  		&& !empty($_SESSION['admin_id_user']) && $_SESSION['admin_browser'] == md5($_SERVER['HTTP_USER_AGENT']) ){
            			
						require_once 'config/config.php';
 	                                                               }
																				  
             else {
               //header("Location:http://piimt.us/piimt/console.php?erreur=intru"); 
			   header("Location:http://his.americanhigh.us/console.php?erreur=intru"); 
			  
			      }
?>
				  