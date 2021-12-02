

<span id="titre_page">Liste des &eacute;tudiants </span>
<?php
$code_prof=(int)$_SESSION['code_prof'];
$code_cours=$_POST['boxchecked'];
$query="select code_cours, titre from $tbl_cours where code_cours='$code_cours' limit 1"; 

$req=@mysql_query($query) or die("erreur lors de la sélection du titre du cours");
$row=mysql_fetch_assoc($req);
echo '<div><b>Titre du cours </b>: '.$row['titre'].'</div>';
echo '<div><b>Code du cours </b>: '.$row['code_cours'].'</div>';

$sql="select  concat(e.nom,' ', e.prenom) as name from $tbl_etudiant as e, $tbl_inscription_cours as i where 
i.code_cours='$code_cours' 
and i.code_inscription=e.code_inscription 
and i.archive = 0 
and i.session='$_current_session'
and i.annee_academique='$_current_year'" ;


$req=@mysql_query($sql) or die("erreur lors de la sélection des étudiants");

$i=0;
