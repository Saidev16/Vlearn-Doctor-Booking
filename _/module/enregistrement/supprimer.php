<?php

include("../include/delete.php");

  $id=$_GET["supprimer"];

  $sql1="select * from $tbl_document WHERE id = $id";

  $req=@mysql_query($sql1)or die ("erreur lors de la suppression image");

  $ligne=mysql_fetch_assoc($req) or die("erreur lors du remplissage du reccord set");

  $fichier=$ligne["nom"];

   

  $sql="DELETE FROM $tbl_document WHERE id= '$id'";



  @mysql_query($sql)or die ("erreur lors de la suppression du document");

  if($fichier!="")

    {

	$chemin=$folder.''.$fichier;

	SureRemoveDir($chemin);

	

	}

?>

<script type="text/javascript" language="JavaScript1.2">

<!--

window.location.replace('gestion_enregistrement.php?archive=<?=$_SESSION['parametre']?>');

//-->

</script>

