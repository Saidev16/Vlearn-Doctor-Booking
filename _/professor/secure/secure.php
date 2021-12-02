<?php
         session_start(); 
		 
    if ( isset($_SESSION['code_prof']) && !empty($_SESSION['code_prof']) && isset($_SESSION['token']) && $_SESSION['browser']==md5($_SERVER['HTTP_USER_AGENT']) ){ 
	 
                  require 'administrator/config/config.php';
											                                                                         }
     else {
              header("Location: http://". $_SERVER['HTTP_HOST']."/piimt");
          }
?>