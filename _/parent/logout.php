   <?php
     if (session_is_registered('etudiant')){ 
                 session_destroy(); 
  ?>
  <script language="javascript1.2">
   window.location.replace('http://<?=$_SERVER['HTTP_HOST']?>/');
  </script>
  <?php
                                           }
   else{
  ?>
  <script language="javascript1.2">
   window.location.replace('http://<?=$_SERVER['HTTP_HOST']?>/');
  </script>
  <?php
        }
  ?>
