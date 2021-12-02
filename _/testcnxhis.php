<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
$bd="hisadm_hisdb"; 



$login="hisadm_hisusr";

 

$mdp="hispass11"; 



$serveur='127.0.0.1';
function connecter($serveur,$login,$mdp,$bd)

{

$connect = @mysql_connect($serveur,$login,$mdp);

if ( ! $connect ) 

{die ('Failed to connect server vnc'); 

@mysql_select_db($bd, $connect) or die ('Database Select Failed');}
else
{

echo 'ca marche';
}

}

connecter($serveur,$login,$mdp,$bd); 
?>
</body>
</html>
