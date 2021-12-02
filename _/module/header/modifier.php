<script language="javascript1.2">
function valid_form(){
document.f_ajout.submit();
}
</script>
<style  type="text/css">
input {
width:320px;
}
</style>
<?php
if(isset($_POST['titre'])){
$titre=addslashes($_POST['titre']);
$for_esm=addslashes($_POST['for_esm']);
$version=addslashes($_POST['version']);
$page=addslashes($_POST['page']);
$sous_logo=addslashes($_POST['sous_logo']);
$id=$_POST['id'];
// début de l'upload
// Taille maximum
if (isset($_FILES['fichier'])){
$MAX_FILE_SIZE = 150000;

// Dossier de destination du fichier
$uploaddir = "../images/logo/";

// Tableau array des différents types
$allowed_types = array("image/bmp", "image/gif", "image/pjpeg", "image/jpeg", "image/jpg");

// Variables récupérée par methode POST du formulaires
$fname = $_FILES['fichier']['name'];
$ftype = $_FILES['fichier']['type'];
$fsize = $_FILES['fichier']['size'];
$ftmp = $_FILES['fichier']['tmp_name'];
$error="";
// Diverses test afin de savoir si :
// Le format de fichier correspond à notre tableau array
if(!in_array($ftype, $allowed_types)){
$error = 1;
}

// La taille du fichier n'est pas dépassée
if($fsize > $MAX_FILE_SIZE){
$error = 2;
}

// Le fichier n'existe pas déjà
if(file_exists($uploaddir."m_".$fname)){
$error = 3;
}

// Si tout va bien, c'est bien déroulé
$uploadfile = $uploaddir . basename($_FILES['fichier']['name']);
if (move_uploaded_file($_FILES['fichier']['tmp_name'], $uploadfile)) {
$error = 0;
}

// Switch servant simplement à la gestion des erreures
switch($error){
case'0':
$msg="Fichier correctement envoyé.";
break;
case'1':
?>
<script language="javascript1.2">
alert("Format de fichier incorrecte.")
</script>
<?php
break;
case'2':
?>
<script language="javascript1.2">
alert("Fichier trop volumineux.")
</script>
<?php
break;
case'3':
?>
<script language="javascript1.2">
alert("Fichier déjà existant.")
</script>
<?php
break;
}
// fin de l'upload
}
if (!empty($fname)){
$logo=addslashes($fname);
}
else{
$logo=addslashes($_POST['file']);
}
$sql1="UPDATE $tbl_header SET 
`titre` = '$titre',
`for_esm` = '$for_esm',
`version` = '$version',
`page` = '$page',
`sous_logo` = '$sous_logo', 
`logo` = '$logo'
 WHERE  `id_header`='$id' ";

$req1=mysql_query($sql1) or die("erreur lors de la mise à jour du header");
?>
<script language="javascript1.2">
window.location.replace("gestion_header.php");
 </script>
<?php
}
			  else{
			  $id=$_GET["modifier"];
			  $sql2="select * from $tbl_header where  id_header='$id'";
			  $req2=@mysql_query($sql2) or die("erreur dans la requette");
			  $row=mysql_fetch_assoc($req2);
			  ?>
			   

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/notes.gif" border="0"/></td>
    <td width="78%"  class="titre">&nbsp;GESTION DES ENTETES DE PAGE <span class="task">[modifier]</span></td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4"  id="link">
	    <tr>
		 
		  <td valign="top" align="center">
		   <a href="#" onclick="javascript:valid_form();"><div class="save"></div>Valider</a>
		  </td>
		  <td valign="top" align="center">
		   <a href="gestion_header.php"><div class="cancel"></div>Annuler</a>
		  </td>
		</tr>
	  </table>
	</td> 
  </tr>
 </table>
   <table width="550" border="0" cellspacing="0" cellpadding="0" style="font-size:11px; font-family:verdana; margin-top:10px">
 <form method="post" enctype="multipart/form-data"  action="gestion_header.php?modifier=oui" name="f_ajout" >
 <input type="hidden" name="id" value="<?=$id?>" />
 <input type="hidden" name="file" value="<?=$row['logo']?>" />
  <tr>
    <td width="100px">Titre : </td>
    <td><input type="text" name="titre" value="<?=$row['titre']?>" class="input" /></td>
  </tr>
  <tr><td colspan="2" height="5px"></td></tr>
  <tr>
    <td>For esm : </td>
    <td><input type="text" name="for_esm" value="<?=$row['for_esm']?>" class="input"  /></td>
  </tr>
    <tr><td colspan="2" height="5px"></td></tr>
  <tr>
    <td>Version : </td>
    <td><input type="text" name="version" value="<?=$row['version']?>" class="input"  /></td>
  </tr>
    <tr><td colspan="2" height="5px"></td></tr>

  <tr>
    <td>Page : </td>
    <td><input type="text" name="page" value="<?=$row['page']?>" class="input"  /></td>
  </tr>
    <tr><td colspan="2" height="5px"></td></tr>

  <tr>
    <td>Type : </td>
    <td><input type="text" name="type" value="<?=$row['type']?>" class="input"  /></td>
  </tr>
    <tr><td colspan="2" height="5px"></td></tr>
  <tr>
    <td>Sous logo : </td>
    <td><input type="text" name="sous_logo" value="<?=$row['sous_logo']?>" class="input"  /></td>
  </tr>
    <tr><td colspan="2" height="5px"></td></tr>
	<tr>
    <td>Logo : </td>
    <td><input type="file" name="fichier"  /></td>
  </tr>
    <tr><td colspan="2" height="5px"></td></tr>
</form>
</table>
<?php
}?>
