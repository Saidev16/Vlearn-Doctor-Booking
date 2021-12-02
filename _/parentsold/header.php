<div align="center">
<div id="header">
<?php
echo '<br><b>Login :</b>'.$_SESSION['login'].'&nbsp;&nbsp;&nbsp;';
?>
<br><a href="professeur.php?task=logout&token=<?=md5('logout')?>" id="deconnection">d&eacute;connexion&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
</div>
</div>
