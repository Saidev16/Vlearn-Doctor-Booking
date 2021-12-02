<?php

	echo '1';
	if (isset($_POST['prefixe']) && isset($_POST['type']) && isset($_POST['id']) && isset($_POST['value']) && isset($_POST['idSession']) && isset($_POST['code_cours'])) {
		$prefixe = $_POST['prefixe'];
		$type = $_POST['type'];
		$id = $_POST['id'];
		$value = $_POST['value'];
		$idSession = $_POST['idSession'];
		$code_cours = $_POST['code_cours'];
		echo'2';
		if ($id != "") {
			if ($prefixe == "MOR") {
				$tbl = "tbl_note_piimt";
			}
			if ($prefixe == "AUL") {
				$tbl = "tbl_note";
			}
			if ($prefixe == "AUPBN") {
				$tbl = "tbl_note_benin";
			}
			if ($prefixe == "AUPL") {
				$tbl = "tbl_note_Libya";
			}
			if ($prefixe == "AUPA") {
				$tbl = "tbl_note_Algeria";
			}
			if ($prefixe != "" && $type != "" && $id != "") {
			  	 $sql="UPDATE $tbl  SET
						$type = \"$value\"
						WHERE `code_inscription` =\"$id\"  and `code_cours`='$code_cours' and `idSession`='$idSession'";
				@mysql_query($sql)or die ("Failure to update student data");
				var_dump($sql);

			}

		}

	}

 ?>
