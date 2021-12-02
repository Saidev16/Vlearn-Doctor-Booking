<?php

$bd="hisadm_hisdb";



$login="hisadm_hisusr";



$mdp="hispass11";



$serveur='127.0.0.1';



function connecter($serveur,$login,$mdp,$bd)

{

$connect = @mysql_connect($serveur,$login,$mdp);
mysql_query("SET NAMES 'utf8'", $connect);

if ( ! $connect )

die ('Failed to connect server vnc');

@mysql_select_db($bd, $connect) or die ('Database Select Failed');


}

connecter($serveur,$login,$mdp,$bd);




$sql_courses = 'SELECT * FROM `tbl_cours` WHERE `code_cours` like "%-S1/2%"';
$req_courses = mysql_query($sql_courses);

while($row = mysql_fetch_assoc($req_courses)){
  $code_cours = $row['code_cours'];
  $code_cours_new = str_replace('-S1/2','12',$code_cours);
  echo $row['code_cours']." / ".$code_cours_new;
  echo "<br>";
  echo $row['titre'];
  echo "<br>";
  echo "----------------------------------------";
  echo "<br>";


  $sql3="update tbl_cours set code_cours='$code_cours_new' where code_cours='$code_cours'";

  @mysql_query($sql3) or die("erreur lors de la mise a jours de la table inscription cours");



  // inscription
  $sql3="update tbl_inscription_cours set code_cours='$code_cours_new' where code_cours='$code_cours'";
    @mysql_query($sql3) or die("erreur lors de la mise a jours de la table inscription cours");

  $sql3="update tbl_inscription_cours_algeria set code_cours='$code_cours_new' where code_cours='$code_cours'";
    @mysql_query($sql3) or die("erreur lors de la mise a jours de la table inscription cours");

  $sql3="update tbl_inscription_cours_benin set code_cours='$code_cours_new' where code_cours='$code_cours'";
    @mysql_query($sql3) or die("erreur lors de la mise a jours de la table inscription cours");

  $sql3="update tbl_inscription_cours_burkina set code_cours='$code_cours_new' where code_cours='$code_cours'";
    @mysql_query($sql3) or die("erreur lors de la mise a jours de la table inscription cours");

  $sql3="update tbl_inscription_cours_cameroun set code_cours='$code_cours_new' where code_cours='$code_cours'";
    @mysql_query($sql3) or die("erreur lors de la mise a jours de la table inscription cours");

  $sql3="update tbl_inscription_cours_GUES set code_cours='$code_cours_new' where code_cours='$code_cours'";
    @mysql_query($sql3) or die("erreur lors de la mise a jours de la table inscription cours");

  $sql3="update tbl_inscription_cours_ivory set code_cours='$code_cours_new' where code_cours='$code_cours'";
  @mysql_query($sql3) or die("erreur lors de la mise a jours de la table inscription cours");

  $sql3="update tbl_inscription_cours_morocco set code_cours='$code_cours_new' where code_cours='$code_cours'";
  @mysql_query($sql3) or die("erreur lors de la mise a jours de la table inscription cours");

  $sql3="update tbl_inscription_cours_usa set code_cours='$code_cours_new' where code_cours='$code_cours'";
  @mysql_query($sql3) or die("erreur lors de la mise a jours de la table inscription cours");

  $sql3="update tbl_inscription_cours_all set code_cours='$code_cours_new' where code_cours='$code_cours'";
  @mysql_query($sql3) or die("erreur lors de la mise a jours de la table inscription cours");


 	//mise a jour table note

	$sql4="update tbl_note set code_cours='$code_cours_new' where code_cours='$code_cours'";
	@mysql_query($sql4) or die("erreur lors de la mise a jours de la table note");

  $sql3="update tbl_note_algeria set code_cours='$code_cours_new' where code_cours='$code_cours'";
  @mysql_query($sql3) or die("erreur lors de la mise a jours de la table inscription cours");

  $sql3="update tbl_note_benin set code_cours='$code_cours_new' where code_cours='$code_cours'";
  @mysql_query($sql3) or die("erreur lors de la mise a jours de la table inscription cours");

  $sql3="update tbl_note_burkina set code_cours='$code_cours_new' where code_cours='$code_cours'";
  @mysql_query($sql3) or die("erreur lors de la mise a jours de la table inscription cours");

  $sql3="update tbl_note_cameroun set code_cours='$code_cours_new' where code_cours='$code_cours'";
  @mysql_query($sql3) or die("erreur lors de la mise a jours de la table inscription cours");

  $sql3="update tbl_note_GUES set code_cours='$code_cours_new' where code_cours='$code_cours'";
  @mysql_query($sql3) or die("erreur lors de la mise a jours de la table inscription cours");

  $sql3="update tbl_note_ivory set code_cours='$code_cours_new' where code_cours='$code_cours'";
  @mysql_query($sql3) or die("erreur lors de la mise a jours de la table inscription cours");

  $sql3="update tbl_note_morocco set code_cours='$code_cours_new' where code_cours='$code_cours'";
  @mysql_query($sql3) or die("erreur lors de la mise a jours de la table inscription cours");

  $sql3="update tbl_note_usa set code_cours='$code_cours_new' where code_cours='$code_cours'";
  @mysql_query($sql3) or die("erreur lors de la mise a jours de la table inscription cours"); 	//mise a jour table absence

  $sql3="update tbl_note_all set code_cours='$code_cours_new' where code_cours='$code_cours'";
  @mysql_query($sql3) or die("erreur lors de la mise a jours de la table inscription cours");








}
