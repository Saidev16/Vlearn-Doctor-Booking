<?php 
 $prefixe = $_GET['foupasf'];
  $code_inscription= addslashes($_GET['buletinMaster']);
	/*if (isset($_POST['ci'])) {
		$code_inscription = $_POST['ci'];
		$prefixe = $_POST['prefixe'];
	}else{
		$code_inscription = $_GET["modifier"];
		$prefixe = $_GET['foupasf'];
	}*/
	/*$sql2="select code_inscription,prefixe from tbl_etudiant_gen
	where code_inscription='$code_inscription' limit 1 ";
	$req2=@mysql_query($sql2) or die("erreur lors du chargements  des données");
	$row=mysql_fetch_assoc($req2);
	echo $prefixe = $row['prefixe'];*/
	// var_dump($prefixe);
	// die();
	
	if ($prefixe == "MOR") {        
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--
				   window.location.replace('gestion_des_etudiants_morocco.php?buletinMaster=<?php echo $code_inscription;?>&gen=1');
			//-->
			</script>
            <?php
	}
	else if ($prefixe == "AG") {        
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--
				    window.location.replace('gestion_des_etudiants_algeria.php?buletinMaster=<?php echo $code_inscription;?>&gen=1');
			//-->
			</script>
            <?php
	}
	else if ($prefixe == "BN") {        
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--
				    window.location.replace('gestion_des_etudiants_benin.php?buletinMaster=<?php echo $code_inscription;?>&gen=1');
			//-->
			</script>
            <?php
	}
	
	else if ($prefixe == "BF") {        
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--
				    window.location.replace('gestion_des_etudiants_burkina.php?buletinMaster=<?php echo $code_inscription;?>&gen=1');
			//-->
			</script>
            <?php
	}
	else if ($prefixe == "ORL") {        
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--
				    window.location.replace('gestion_des_etudiants_usa.php?buletinMaster=<?php echo $code_inscription;?>&gen=1');
			//-->
			</script>
            <?php
	}
	else if ($prefixe == "CAM") {        
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--
				    window.location.replace('gestion_des_etudiants_cameroun.php?buletinMaster=<?php echo $code_inscription;?>&gen=1');
			//-->
			</script>
            <?php
	}
	else if ($prefixe == "GS") {        
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--
				    window.location.replace('gestion_des_etudiants_gues.php?buletinMaster=<?php echo $code_inscription;?>&gen=1');
			//-->
			</script>
            <?php
	}
	
	
	