

<?php
echo '1';
 	 $CGPA=$count=$credit=0;
	 if (isset($_GET['buletinBachelor'])){
 echo $code_inscription= addslashes($_GET['buletinBachelor']);
	 // select student information
	 $sql="SELECT nom, prenom, date_inscription, date_naissance, adresse ,lieu_naissance,code_bac
	 FROM tbl_etudiant WHERE code_inscription= '$code_inscription'";
	 $res= @mysql_query($sql) or die('Erreur :: Student information');
	$row = @mysql_fetch_assoc($res) ;
	
	$date=$row['date_naissance'];
$nom=$row['nom'];
	$prenom=$row['prenom'];
	$adresse=$row['adresse'];
	$lieu_naissance=$row['lieu_naissance'];
	$code_bac=$row['code_bac'];
	


	 ?>
