<div align="center">
<div id="header_student">
<?php
if (isset($_SESSION['login'])){
echo '<br><b>Login :&nbsp;</b>'.$_SESSION['login'];
}
?>
<br><a href="student.php?task=logout" id="deconnection">d&eacute;connexion</a>
</div>
</div>