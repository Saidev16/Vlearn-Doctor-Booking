<?php
	if (isset($_POST['prefixe']) && isset($_POST['type']) && isset($_POST['id']) && isset($_POST['value'])) {
		$prefixe = $_POST['prefixe'];
		$type = $_POST['type'];
		$id = $_POST['id'];  /* code d'inscription  */
		$value = $_POST['value']; // non(0) ou oui (1) */
		if($prefixe=='MOR')
	{$table='tbl_etudiant_morocco';}
	else  if($prefixe=='AG')
	{$table='tbl_etudiant_algeria';}
	else if($prefixe=='ORL')
	{$table='tbl_etudiant_usa';}
	else if($prefixe=='BN')
	{$table='tbl_etudiant_benin';}
	else if($prefixe=='BF')
	{$table='tbl_etudiant_burkina';}
else if($prefixe=='CAM')
	{$table='tbl_etudiant_cameroun';}
else if($prefixe=='GS')
	{$table='tbl_etudiant_GUES';}

	if($type=='onsite')
		{ 	
		$sql = "UPDATE $table SET `onsite`= $value WHERE `code_inscription` = \"$id\" and `prefixe` = \"$prefixe\" ";
		var_dump($sql);
		@mysql_query($sql)or die ("Failure to update student data_all");
		$sql2 = "UPDATE tbl_etudiant_all SET `onsite`= $value WHERE `code_inscription` = \"$id\" and `prefixe` = \"$prefixe\" ";
		var_dump($sql2);
		@mysql_query($sql2)or die ("Failure to update student data_all");
		}
	if($type=='files')
		{ 	
		$sql = "UPDATE $table SET `files`= $value WHERE `code_inscription` = \"$id\" and `prefixe` = \"$prefixe\" ";
		@mysql_query($sql)or die ("Failure to update student data_all");

		$sql2 = "UPDATE tbl_etudiant_all SET `files`= $value WHERE `code_inscription` = \"$id\" and `prefixe` = \"$prefixe\" ";
		@mysql_query($sql2)or die ("Failure to update student data_all");
		}
	else if($type=='finance' || $type=='onsite')
		{
		
			if ($prefixe != "" && $type != "" && $id != "") {

				if ($value == 1){

					 $sql= "INSERT INTO `tbl_etudiant_all`(`prefixe` ,code_inscription,`nom` , `prenom` , `date_naissance` , `nationalite` , `adresse` , `sexe` , `code_bac` , `serie_bac` ,
						`date_inscription` , `tel` , `email` , `annee` , `semestre` , `filiere` , `lieu_naissance` , `cin` , `cinq_photo` , `original_bac` ,
						`copie_bac` , `english_bac` , `trois_lettre` , `trois_enveloppe` , `buletin` , `reglement` , `copie_cin` ,
						`extrait_naissance` , `test_etudesoc` , `test_fr` , `test_sciences` , `test_math` , `aquise_academique` , `login` , `mot_pass` ,
						`acces` , `groupe` , `activite` , `annee_inscription`, `niveau` , `ville` , `elearning`, `piimt`, `aul`, `umt`,`graduation_date`,`archive`
						) SELECT `prefixe` ,code_inscription,`nom` , `prenom` , `date_naissance` , `nationalite` , `adresse` , `sexe` , `code_bac` , `serie_bac` ,
						`date_inscription` , `tel` , `email` , `annee` , `semestre` , `filiere` , `lieu_naissance` , `cin` , `cinq_photo` , `original_bac` ,
						`copie_bac` , `english_bac` , `trois_lettre` , `trois_enveloppe` , `buletin` , `reglement` , `copie_cin` ,
						`extrait_naissance` , `test_etudesoc` , `test_fr` , `test_sciences` , `test_math` , `aquise_academique` , `login` , `mot_pass` ,
						`acces` , `groupe` , `activite` , `annee_inscription`, `niveau` , `ville` , `elearning`, `piimt`, `aul`, `umt`, `graduation_date`, `archive`
						 FROM $table  WHERE `code_inscription` = \"$id\" and `prefixe` = \"$prefixe\" ";



						var_dump($sql);
				
						@mysql_query($sql)or die ("Failure to update student data");

						$sql = "UPDATE $table SET `sacs`=1 WHERE `code_inscription` = \"$id\" and `prefixe` = \"$prefixe\" and `sacs` = 0";
						@mysql_query($sql)or die ("Failure to update student data_all");
				}
				if ($value == 0) {
						$sql = "DELETE FROM `tbl_etudiant_all` WHERE `code_inscription` = \"$id\" and `prefixe` = \"$prefixe\" ";
						@mysql_query($sql)or die ("Failure to update student data_all");
						
				}

		}

	}
}

 ?>