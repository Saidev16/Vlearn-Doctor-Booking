<?php
         session_start(); 	 
    if ( isset($_SESSION['code_etudiant']) && !empty($_SESSION['code_etudiant']) && isset($_SESSION['token']) && $_SESSION['user_agent']==md5($_SERVER['HTTP_USER_AGENT']) ){ 
	 
                  require 'administrator/config/config.php';
											                                                                         }
     else {
              header("Location: http://". $_SERVER['HTTP_HOST']."/"); 
          }
?>