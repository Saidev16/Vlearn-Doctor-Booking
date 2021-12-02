   <?php
     	unset($_SESSION['prof_login']); 
		unset($_SESSION['code_prof']); 
		unset($_SESSION['name']); 
		unset($_SESSION['browser']);
		unset($_SESSION['token']);
  ?>
  <script language="javascript1.2">
   window.location.replace('http://<?=$_SERVER['HTTP_HOST']?>/piimt');
  </script>
