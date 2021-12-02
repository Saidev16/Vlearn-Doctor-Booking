<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body>
<?php

   
     $headers .='Content-Type: text/html; charset="iso-8859-1"'."\n";
     $headers .='Content-Transfer-Encoding: 8bit'; 

     $message ='<html><head><title></title></head><body><p align="left">Bienvenue dans votre espace étudiant, veuillez 

utiliser ce système <a href="http://piimt.us/piimt/">www.piimt.us/piimt</a> pour avoir votre emploi du temps, classes, stages et bulletins de notes.</p><p align="left"> Votre 

username est:</p><p align="left"> Votre password est:</p><p align="left"> Veuillez acceder au site a: 

<a href="http://www.piimt.us/">www.piimt.us</a></p><p align="left"> Si vous avez des questions n\'hesitez pas a nous contacter via: 

info@piimt.us</p></body></html>';

     if(mail('zineb.zagdouni@ameritechcenter.com', 'Inscription PSI',$message,$headers))
     {
          echo 'Le message a été envoyé';
     }
     else
     {
          echo 'Le message n\'a pu être envoyé';
     } 
?>
</body>
</html>

