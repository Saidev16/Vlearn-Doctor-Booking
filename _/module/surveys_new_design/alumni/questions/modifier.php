<?php 
	if (isset($_GET['edit_question']) && $_GET['edit_question'] == 'edit') {
		$message_question_fr = "";
		$message_question_en = "";
		$message_session = "";
		$message_session_unique = "";
		$message_statut = "";
		$message_reponse_double_fr = "";
		$message_nb_reponse_fr = "";
		$message_reponse_double_en = "";
		$message_nb_reponse_en = "";
		$_SESSION['message_question_fr'] = "";
		$_SESSION['message_question_en'] = "";
		$_SESSION['message_session'] = "";
		$_SESSION['message_session_unique'] = "";
		$_SESSION['message_statut'] = "";
		$_SESSION['question_fr'] = "";
		$_SESSION['question_en'] = "";
		$_SESSION['session'] = "";
		$_SESSION['statut'] = "";

		if (isset($_POST['id']) && $_POST['id'] != "" && $_GET['id'] != "" && $_GET['id'] == $_POST['id'] ) {
	        $id = $_POST['id'];
	        if (empty($_POST['question_fr']) || $_POST['question_fr'] == "") {
				$message_question_fr = "1";
			}
			if (empty($_POST['question_en']) || $_POST['question_en'] == "") {
				$message_question_en = "1";
			}
			if ($_POST['statut'] <= 0 && $_POST['statut'] >= 1) {
				$message_statut = "1";
			}
	       	$reponse_fr = array();
			for ($i=1; $i <= 5; $i++) { 
				$reponse_fr["$i"] = $_POST["reponse_fr_$i"];
			}
			// verifier s'il y a du double reponse_fr
			$reponse_fr_unique = array_unique($reponse_fr);
			if (count($reponse_fr) != count($reponse_fr_unique)) {
				$diff = array_diff_key($reponse_fr, $reponse_fr_unique);
				foreach ($diff as $k => $v) {
					if ($v != "1") {
						$message_reponse_double_fr = "1";
					}
				}
				
			}
			//verifier le nbr de reponse confirmer
			$nb_reponse_fr = array_count_values($reponse_fr);
			if (array_key_exists(1, $nb_reponse_fr) && $nb_reponse_fr[1] > 3 ) {
				$message_nb_reponse_fr = "1";
			}
			$reponse_en = array();
			for ($i=1; $i <= 5; $i++) { 
				$reponse_en["$i"] = $_POST["reponse_en_".$i];
			}
			// verifier s'il y a du double reponse_fr
			$diff = array();
			$reponse_en_unique = array_unique($reponse_en);
			if (count($reponse_en) != count($reponse_en_unique)) {
				$diff = array_diff_key($reponse_en, $reponse_en_unique);
				foreach ($diff as $k => $v) {
					if ($v != "1") {
						$message_reponse_double_en = "1";
					}
				}
			}
			//verifier le nbr de reponse confirmer
			$nb_reponse_en = array_count_values($reponse_en);
			if (array_key_exists(1, $nb_reponse_en) && $nb_reponse_en[1] > 3 ) {
				$message_nb_reponse_en = "1";
			}
			$reponse = array();
			for ($i=1; $i <= 5 ; $i++) { 
				$reponse[$i]['reponse_fr'] = $_POST['reponse_fr_'.$i];
				$reponse[$i]['reponse_en'] = $_POST['reponse_en_'.$i];
			}
			// verification de la compatibilité des reponses
			$message_reponse_fr = array();
			$message_reponse_en = array();
			$message_reponse_fr_equivalence = array();
			$message_reponse_en_equivalence = array();
			foreach ($reponse as $k => $v) {
				if ($v['reponse_fr'] == "1" && $v['reponse_en'] != "1") {
					$message_reponse_fr["$k"] = "1"; 
				}elseif ($v['reponse_en'] != "1" && $v['reponse_fr'] == "1" || $v['reponse_en'] != "1" && $v['reponse_fr'] != "1" ){
					$req = "SELECT `rep_fr`,`rep_en` FROM `tbl_reponses` WHERE `rep_fr` = \"$v[reponse_fr]\"";
					@mysql_query($req) or die("erreur de la selection des reponses ");
				    $query = mysql_query($req);
				    $row=mysql_fetch_assoc($query);
					if ($v['reponse_en'] != $row['rep_en']) {
						$message_reponse_fr_equivalence["$k"] = "1";
					}
				}
				if ($v['reponse_en'] == "1" && $v['reponse_fr'] != "1") {
					$message_reponse_en["$k"] = "1";
				}elseif ($v['reponse_en'] == "1" && $v['reponse_fr'] != "1" || $v['reponse_en'] != "1" && $v['reponse_fr'] != "1" ){
					$req = "SELECT `rep_fr`,`rep_en` FROM `tbl_reponses` WHERE `rep_en` = \"$v[reponse_en]\"";
					@mysql_query($req) or die("erreur de la selection des reponses ");
				    $query = mysql_query($req);
				    $row=mysql_fetch_assoc($query);
					if ($v['reponse_fr'] != $row['rep_fr']) {
						$message_reponse_en_equivalence["$k"] = "1";
					}
				}
			}
			// les champ oblegatoire
			if ($message_question_fr == "1" || $message_question_en == "1" || $message_statut == "1" || $message_reponse_double_fr == "1" 
			|| $message_reponse_double_en == "1" || $message_nb_reponse_fr == "1" || $message_nb_reponse_en == "1"
			|| $message_reponse_fr != array() || $message_reponse_en != array() || $message_reponse_fr_equivalence != array() 
			|| $message_reponse_en_equivalence != array() ) {
				foreach ($message_reponse_fr as $k => $v) {
					$_SESSION["message_reponse_fr_$k"] = "1";
				}
				foreach ($message_reponse_en as $k => $v) {
					$_SESSION["message_reponse_en_$k"] = "1";
				}
				foreach ($message_reponse_fr_equivalence as $k => $v) {
					$_SESSION["message_reponse_fr_equivalence_$k"] = "1";
					echo "message_reponse_fr_equivalence_$k";
				}
				foreach ($message_reponse_en_equivalence as $k => $v) {
					$_SESSION["message_reponse_en_equivalence_$k"] = "1";
				}
				$_SESSION['message_reponse_fr'] = $message_reponse_fr;
				$_SESSION['message_reponse_en'] = $message_reponse_en;
				$_SESSION['message_reponse_fr_equivalence'] = $message_reponse_fr_equivalence;
				$_SESSION['message_reponse_en_equivalence'] = $message_reponse_en_equivalence;
				$_SESSION['message_reponse_double_en'] = $message_reponse_double_en;
				$_SESSION['message_reponse_double_fr'] = $message_reponse_double_fr;
				$_SESSION['message_nb_reponse_en'] = $message_nb_reponse_en;
				$_SESSION['message_nb_reponse_fr'] = $message_nb_reponse_fr;
				$_SESSION['message_question_fr'] = $message_question_fr;
				$_SESSION['message_question_en'] = $message_question_en;
				$_SESSION['message_statut'] = $message_statut;
				$_SESSION['question_fr'] = $_POST['question_fr'];
				$_SESSION['question_en'] = $_POST['question_en'];
				$_SESSION['statut'] = $_POST['statut'];
				for ($i=1; $i <=5 ; $i++) { 
					$_SESSION["reponse_fr_$i"] = $_POST["reponse_fr_$i"];
				}
				for ($i=1; $i <=5 ; $i++) { 
					$_SESSION["reponse_en_$i"] = $_POST["reponse_en_$i"];
				}
				?>
				<script type="text/javascript" language="JavaScript1.2">			
					window.location.replace("gestion_sondage.php?edit_question&id=<?php echo $id; ?>");
				</script>

				<?php
			}else{
				$id = $_POST['id'];
				$message_question_unique_fr = "";
				$message_question_unique_en = "";
				$req = "SELECT * FROM `tbl_questions` WHERE `id` = $id";
		        @mysql_query($req) or die("erreur de la selection des questions");
		        $query = mysql_query($req);
		        if (mysql_num_rows($query) == 1) {
		        	$row=mysql_fetch_assoc($query);
		        }else{
		        	$_SESSION['message_error'] = "Cette questions n'existe pas";
		        	?>
						<script type="text/javascript" language="JavaScript1.2">			
							window.location.replace('gestion_sondage.php?list_question');
						</script>
					<?php
		        }
		        $question_fr = $_POST['question_fr'];
				$question_en = $_POST['question_en'];
				$statut = $_POST['statut'];
		        if ($id == $row['id'] && $_POST['question_fr'] != $row['question_fr'] ||  $_POST['question_en'] != $row['question_en'] || $_POST['statut'] != $row['statut'] ) {
		        	if ($question_fr != $row['question_fr']) {
		        		$query_question = mysql_query("SELECT `question_fr` FROM `tbl_questions` WHERE `question_fr` = \"$question_fr\"");
						if(mysql_num_rows($query_question) == 1){
						   $message_question_unique_fr = "1";
						}
		        	}

		        	if ($question_en != $row['question_en']) {
		        		$query_question = mysql_query("SELECT `question_en` FROM `tbl_questions` WHERE `question_en` = \"$question_en\"");
						if(mysql_num_rows($query_question) == 1){
						   $message_question_unique_en = "1";
						}
		        	}
		        	if ($message_question_unique_fr == "1" || $message_question_unique_en == "1") {
		        		$_SESSION['message_question_unique_fr'] = $message_question_unique_fr;
		        		$_SESSION['message_question_unique_en'] = $message_question_unique_en;
		        		?>
							<script type="text/javascript" language="JavaScript1.2">			
								window.location.replace("gestion_sondage.php?edit_question&id=<?php echo $id; ?>");
							</script>
						<?php
		        	}else{
		        		$sql_insert = "UPDATE `tbl_questions` SET `question_fr`= \"$question_fr\",`question_en`=\"$question_en\",`statut`=$statut WHERE `id`= $id";
						@mysql_query($sql_insert) or die ('erreur lors de la modification du question');

		        	}
		        }
		        $req_reponse = "SELECT * FROM `tbl_reponse` WHERE `question_id` = $id and `statut` = 0 ";
		        @mysql_query($req_reponse) or die("erreur de la selection des questions");
		        $query_reponse = mysql_query($req_reponse);
		        
		        $reponse_db = array();
		        $r = 1;
		        while ($row=mysql_fetch_assoc($query_reponse)) {
		        	$reponse_db["$r"]["reponse_id"] = $row['id'];
		        	$reponse_db["$r"]["reponse_fr"] = $row['reponse_fr'];
		        	$reponse_db["$r"]["reponse_en"] = $row['reponse_en'];
		        	$r++;
		        }
		        $error = 0;
	        	foreach ($reponse_db as $k_db => $v_db) {
	        		if ($v_db['reponse_id'] != trim($_POST["reponse_id_$k_db"])) {
	        			$error++;
	        		}
	        	}
		        $new_reponse = 0;
		        if ($error == 0) {
		        	foreach ($reponse as $k => $v) {
		        		$reponse["$k"]['id'] = trim($_POST["reponse_id_$k"]);
		        		$id_reponse = $reponse["$k"]['id'];
		        		$reponse_fr = $reponse["$k"]['reponse_fr'];
		        		$reponse_en = $reponse["$k"]['reponse_en'];
		        		$req = "SELECT * FROM `tbl_reponses` WHERE `rep_fr` = \"$reponse_fr\" and `rep_en` = \"$reponse_en\"";
				        @mysql_query($req) or die("erreur de la selection des reponses ");
				        $query = mysql_query($req);
				        if (mysql_num_rows($query) == 1) {
				        	$row=mysql_fetch_assoc($query);
				        	$porcentage = $row['porcentage'];
				        	if ($reponse["$k"]['id'] != "none" && $reponse_fr != "1" && $reponse_en != "1") {
			        			$update_reponse = "UPDATE `tbl_reponse` SET `reponse_fr`=\"$reponse_fr\",`reponse_en`=\"$reponse_en\",`porcentage`=$porcentage WHERE `id`= $id_reponse";
			        			@mysql_query($update_reponse) or die ("erreur lors de la modifacation des reponses");
			        		}
			        		if ($reponse["$k"]['id'] == "none" && $reponse_fr != "1" && $reponse_en != "1") {
			        			$sql_insert_reponse ="INSERT INTO `tbl_reponse`(`reponse_fr`, `question_id`, `reponse_en`, `statut`,`porcentage`) 
											VALUES (\"$reponse_fr\",$id,\"$reponse_en\",0,$porcentage)";
								@mysql_query($sql_insert_reponse) or die ("erreur lors de l'insertion des reponses");
			        		}
				        }
				        if ($reponse["$k"]['id'] != "none" && $reponse_fr == "1" && $reponse_en == "1") {
			        			$sql_insert_reponse ="UPDATE `tbl_reponse` SET `statut`=1 WHERE `id`= $id_reponse";
								@mysql_query($sql_insert_reponse) or die ("erreur lors de la desactivation de la reponse");
			        		}
		        		

		        		
		        	}
		        }else{
		        	?>
						<script type="text/javascript" language="JavaScript1.2">			
							window.location.replace("gestion_sondage.php?edit_question&id=<?php echo $id; ?>");
						</script>
					<?php
		        }
				unset($_SESSION['message_question_fr']);
				unset($_SESSION['message_question_en']);
				unset($_SESSION['message_session']);
				unset($_SESSION['message_session_unique']);
				unset($_SESSION['message_statut']);
				unset($_SESSION['question_fr']);
				unset($_SESSION['question_en']);
				unset($_SESSION['statut']);
				unset($_SESSION['message_reponse_en_equivalence']);
				unset($_SESSION['message_reponse_fr_equivalence']);
				unset($_SESSION['message_reponse_en']);
				unset($_SESSION['message_reponse_fr']);
				unset($_SESSION['message_reponse_double_fr']);
				unset($_SESSION['message_nb_reponse_fr']); 
				unset($_SESSION['message_reponse_double_en']);
				unset($_SESSION['message_nb_reponse_en']); 
				for ($i=1; $i <=5 ; $i++) { 
					unset($_SESSION["reponse_fr_$i"]);
				}
				for ($i=1; $i <=5 ; $i++) { 
					unset($_SESSION["reponse_en_$i"]);
				}
				for ($i=1; $i <=5 ; $i++) { 
					unset($_SESSION["message_reponse_fr_equivalence_$i"]);
				}
				for ($i=1; $i <=5 ; $i++) { 
					unset($_SESSION["message_reponse_en_equivalence_$i"]);
				}
				for ($i=1; $i <=5 ; $i++) { 
					unset($_SESSION["message_reponse_fr_$i"]);
				}
				for ($i=1; $i <=5 ; $i++) { 
					unset($_SESSION["message_reponse_en_$i"]);
				}
				$_SESSION['message_success'] = "La question avec ses réponses ont été modifier avec succès";
				?>
				<script type="text/javascript" language="JavaScript1.2">			
					window.location.replace('gestion_sondage.php?list_question');
				</script>

				<?php
			}
		}else{
			
			$_SESSION['message_error'] = "error pendant la modification merci de ressayer";
			?>
			<script type="text/javascript" language="JavaScript1.2">			
				window.location.replace('gestion_sondage.php?list_question');
			</script>

			<?php
		}


		

		
	}else{
?>
	<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
	  <tr>
	    <td><img src="images/icone/classes.gif" border="0"/></td>
	    <td width="78%" class="titre">&nbsp;GESTION DU SONDAGE <span class="task">[modifier la question]</span> </td>
		<td width="22%">
		  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
		  <tr>
			  
			  <td valign="top" align="center">
			   <a href="gestion_sondage.php?list_question" ><div class="cancel"></div>Retour</a>
			  </td>
		  </tr>
		  </table>
		</td> 
	  </tr>
	</table>
	<?php 
			$id = $_GET['id'];
			if ($id != "") {
				$req = "SELECT * FROM `tbl_questions` WHERE `id` = $id";
		        @mysql_query($req) or die("erreur de la selection des questions ");
		        $query = mysql_query($req);
		        if (mysql_num_rows($query) == 1) {
		        	$row=mysql_fetch_assoc($query);
		        }else{
		        	$_SESSION['message_error'] = "Cette reponse n'existe pas";
		        	?>
						<script type="text/javascript" language="JavaScript1.2">			
							window.location.replace('gestion_sondage.php?list_question');
						</script>
					<?php
		        }
		        
			}else{
				$_SESSION['message_error'] = "Cette reponse n'existe pas";
				?>
				<script type="text/javascript" language="JavaScript1.2">			
					window.location.replace('gestion_sondage.php?list_question');
				</script>

				<?php
			}
	?>
	<form action="gestion_sondage.php?edit_question=edit&id=<?php echo $id; ?>" method="POST" >
		
		<input name="id" value="<?php echo $id;  ?>" type ="hidden">
		<div class="form-group <?php if (isset($_SESSION['message_question_fr']) && $_SESSION['message_question_fr'] !=  "" || isset($_SESSION['message_question_unique_fr']) && $_SESSION['message_question_unique_fr'] !=  "") {echo 'has-error';} ?>">
	        <label for="exampleInputEmail1">La question en français *</label>
	        <input id='input_titre' type="text" value="<?php  if (isset($_SESSION['question_fr']) && $_SESSION['question_fr'] !=  "") {echo $_SESSION['question_fr'];}else{echo $row['question_fr'];}  ?>" name="question_fr" class="form-control" id="exampleInputEmail1" >
			<?php if (isset($_SESSION['message_question_unique_fr']) && $_SESSION['message_question_unique_fr'] !=  "") {
	           echo "<label id='error_titre' class='control-label' style='width: 100%;padding-top: 6px;' for='inputError1'>Vous avez entrer une question deja existe.</label>";
	        } ?>
	        <?php if (isset($_SESSION['message_question_fr']) && $_SESSION['message_question_fr'] !=  "") {
	           echo "<label id='error_titre' class='control-label' style='width: 100%;padding-top: 6px;' for='inputError1'>Champ obligatoire</label>";
	        } ?> 
      	</div>

      	<div class="form-group <?php if (isset($_SESSION['message_question_en']) && $_SESSION['message_question_en'] !=  "" || isset($_SESSION['message_question_unique_en']) && $_SESSION['message_question_unique_en'] !=  "") {echo 'has-error';} ?>">
	        <label for="exampleInputEmail1">La question en anglais *</label>
	        <input id='input_titre' type="text" value="<?php  if (isset($_SESSION['question_en']) && $_SESSION['question_en'] !=  "") {echo $_SESSION['question_en'];}else{echo $row['question_en'];}  ?>" name="question_en" class="form-control" id="exampleInputEmail1" >
	        <?php if (isset($_SESSION['message_question_en']) && $_SESSION['message_question_en'] !=  "") {
	           echo "<label id='error_titre' class='control-label' style='width: 100%;padding-top: 6px;' for='inputError1'>Champ obligatoire</label>";
	        } ?> 
	        <?php if (isset($_SESSION['message_question_unique_en']) && $_SESSION['message_question_unique_en'] !=  "") {
	           echo "<label id='error_titre' class='control-label' style='width: 100%;padding-top: 6px;' for='inputError1'>Vous avez entrer une question deja existe.</label>";
	        } ?>
      	</div>
      	<div class="span12">
	    	<div style="margin-top: 25px;margin-right: 165px;" class="form-group <?php if (isset($_SESSION['message_statut']) && $_SESSION['message_statut'] !=  "") { echo 'has-error';} ?>">
	        <label for="exampleInputFile" style="float: left;margin-right: 19px;">Statut *</label>
	        <div class="radio" style="float: left;margin: 0px;margin-left: 20px;margin-right: 38px;">
	            <label class="radio-inline">
	              <input class='input_programme' id="" name="statut"  type="radio" style="font-size: 12px;" <?php if (isset($_SESSION['statut']) && $_SESSION['statut'] == "0"){echo "checked=checked";} ?> <?php if (isset($_SESSION['statut']) && $_SESSION['statut'] == ""){echo "checked";} ?> <?php if (!isset($_SESSION['statut'])){ if ($row['statut']== 0) { echo "checked";}} ?> value="0" > Activer
	            </label>
	        </div>
	        <div class="radio">
	            <label class="radio-inline">
	              <input  class='input_programme' id="" name="statut" type="radio" style="font-size: 12px;" <?php if (isset($_SESSION['statut']) && $_SESSION['statut'] == "1"){echo "checked=checked";}  ?> <?php  if ($row['statut']== 1) { echo "checked";} ?> value="1"> desactiver 
	            </label>
	        </div>
	          <?php if (isset($_SESSION['message_statut']) && $_SESSION['message_statut'] !=  "") {
	             echo "<label id='error_programme' class='control-label' style='width: 100%;padding-top: 6px;' for='inputError1'>Champ obligatoire</label>";
	          } ?>
	        </div>
	    </div>	
	    <?php 
	    	$req = "SELECT * FROM `tbl_reponse` WHERE `question_id` = $id AND `statut` = 0 order by `id`";
		        @mysql_query($req) or die("erreur de la selection des reponses");
		        $query = mysql_query($req);
		        $reponse=array();
		        $r = 1;
		        while ($row=mysql_fetch_assoc($query)) {
		        	$reponse_id = $row['id'];
		        	$rep_fr = $row['reponse_fr'];
		        	$rep_en = $row['reponse_en'];
		        	$reponse["$r"]['reponse_id'] = $reponse_id;
		        	$reponse["$r"]['reponse_fr'] = "$rep_fr";
		        	$reponse["$r"]['reponse_en'] = "$rep_en";
		        	$r++;
		        }
	    ?>


      	<div class="form-group <?php if (isset($_SESSION['message_reponse_double_fr']) && $_SESSION['message_reponse_double_fr'] !=  "" 
      								|| isset($_SESSION['message_nb_reponse_fr']) && $_SESSION['message_nb_reponse_fr'] !=  "" ) {echo 'has-error';} ?>">
	        <label for="exampleInputEmail1">La réponses en français *</label>
      	</div>
      	<?php if (isset($_SESSION['message_nb_reponse_fr']) && $_SESSION['message_nb_reponse_fr'] !=  "" ): ?>
			<div id="alert" class="alert alert-danger alert-dismissible fade in" role="alert">
		      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		      <h4>Attention il faut choisir deux reponses obligatoire au minimum .</h4>
			</div>
		<?php endif ?>   
		<?php if (isset($_SESSION['message_reponse_double_fr']) && $_SESSION['message_reponse_double_fr'] !=  "" ): ?>
			<div id="alert" class="alert alert-danger alert-dismissible fade in" role="alert">
		      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		      <h4>Attention une réponse est dupliqué .</h4>
			</div>
		<?php endif ?>   	
		<?php if (isset($_SESSION['message_reponse_fr']) && $_SESSION['message_reponse_fr'] !=  array() ): ?>
			<div id="alert" class="alert alert-danger alert-dismissible fade in" role="alert">
		      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		      <h4>Attention vous n'avez pas choisissez une reponse.</h4>
			</div>
		<?php endif ?>
		<?php if (isset($_SESSION['message_reponse_fr_equivalence']) && $_SESSION['message_reponse_fr_equivalence'] !=  array() ): ?>
			<div id="alert" class="alert alert-danger alert-dismissible fade in" role="alert">
		      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		      <h4>Attention la réponse en français ne correspond pas a la réponse en anglais.</h4>
			</div>
		<?php endif ?>

		<?php 
			for ($i=1; $i <= 5 ; $i++) { 
		?>
			<div style="float: left;margin-right: 20px;" class="form-group <?php if ((isset($_SESSION["message_reponse_fr_equivalence_$i"]) && $_SESSION["message_reponse_fr_equivalence_$i"] !=  "" )|| (isset($_SESSION["message_reponse_fr_$i"]) && $_SESSION["message_reponse_fr_$i"] !=  "")) { echo 'has-error';} ?>">
	        
	        <input name="reponse_id_<?php echo $i; ?>"  type="hidden" value="<?php if ($i <= count($reponse)){ ?>
	        	<?php echo $reponse["$i"]['reponse_id'] ?>
	        <?php }else{ echo "none";} ?>">
	        <label for="exampleInputFile">reponse <?php echo $i; ?> <?php if ($i <= 2): ?> * <?php endif ?> </label>
	        
	        <select id='input_repose_fr_<?php echo $i; ?>'  name="reponse_fr_<?php echo $i; ?>" class="form-control" style="width: 153px;">
	          	<option value="1" >choisissez une réponse</option>
	          	<?php 
	          		$req_fr = "SELECT `rep_fr` FROM `tbl_reponses` WHERE  `statut` = 0 ";
			        @mysql_query($req_fr) or die("erreur de la selection des reponses ");
			        $query_fr = mysql_query($req_fr);
			        while ($row=mysql_fetch_assoc($query_fr)){
	          	?>

	           	<option value="<?php echo $row['rep_fr']; ?>" <?php if (isset($_SESSION["reponse_fr_$i"]) && $_SESSION["reponse_fr_$i"] == $row['rep_fr']){echo "selected";}elseif($i <= count($reponse)) {if ($reponse != array() && $reponse["$i"]['reponse_fr']  == $row['rep_fr'] ) { echo "selected"; }} ?>>
		        	<?php echo $row['rep_fr']; ?></option> 
	           	<?php 
	           		}
	           	?>   
		    </select>   
	      </div>	
		<?php
			}
		 ?>
		<div class="form-group <?php if (isset($_SESSION['message_reponse_double_en']) && $_SESSION['message_reponse_double_en'] !=  "" 
      								|| isset($_SESSION['message_nb_reponse_en']) && $_SESSION['message_nb_reponse_en'] !=  "" ) {echo 'has-error';} ?>">
	        <label for="exampleInputEmail1">La réponses en anglais *</label>
      	</div>
      	<?php if (isset($_SESSION['message_nb_reponse_en']) && $_SESSION['message_nb_reponse_en'] !=  "" ): ?>
			<div id="alert" class="alert alert-danger alert-dismissible fade in" role="alert">
		      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		      <h4>Attention il faut choisir deux reponses obligatoire au minimum .</h4>
			</div>
		<?php endif ?>   
		<?php if (isset($_SESSION['message_reponse_double_en']) && $_SESSION['message_reponse_double_en'] !=  "" ): ?>
			<div id="alert" class="alert alert-danger alert-dismissible fade in" role="alert">
		      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		      <h4>Attention une réponse est dupliqué .</h4>
			</div>
		<?php endif ?>   	
		<?php if (isset($_SESSION['message_reponse_en']) && $_SESSION['message_reponse_en'] !=  array() ): ?>
			<div id="alert" class="alert alert-danger alert-dismissible fade in" role="alert">
		      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		      <h4>Attention vous n'avez pas choisissez une reponse.</h4>
			</div>
		<?php endif ?>
		<?php if (isset($_SESSION['message_reponse_en_equivalence']) && $_SESSION['message_reponse_en_equivalence'] !=  array() ): ?>
			<div id="alert" class="alert alert-danger alert-dismissible fade in" role="alert">
		      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		      <h4>Attention la réponse en français ne correspond pas a la réponse en anglais.</h4>
			</div>
		<?php endif ?>
		<?php 
			for ($i=1; $i <= 5 ; $i++) { 
		?>	
			<div style="float: left;margin-right: 20px;" class="form-group <?php if ((isset($_SESSION["message_reponse_en_equivalence_$i"]) && $_SESSION["message_reponse_en_equivalence_$i"] !=  "" )|| (isset($_SESSION["message_reponse_en_$i"]) && $_SESSION["message_reponse_en_$i"] !=  "")) { echo 'has-error';} ?>">
	        <label for="exampleInputFile">reponse <?php echo $i; ?> <?php if ($i <= 2): ?> * <?php endif ?> </label>
	        <select id='input_repose_en_<?php echo $i; ?>'  name="reponse_en_<?php echo $i; ?>" class="form-control" style="width: 153px;">
	          	<option value="1" >choisissez une réponse</option>
	          	<?php 
	          		$req_en = "SELECT `rep_en` FROM `tbl_reponses` WHERE  `statut` = 0 ";
			        @mysql_query($req_en) or die("erreur de la selection des reponses ");
			        $query_en = mysql_query($req_en);
			        while ($row=mysql_fetch_assoc($query_en)){
	          	?>
	           		<option value="<?php echo $row['rep_en']; ?>" <?php if (isset($_SESSION["reponse_en_$i"]) && $_SESSION["reponse_en_$i"] == $row['rep_en']){echo "selected";}elseif ($i <= count($reponse)) {if ($reponse != array() && $reponse["$i"]['reponse_en']  == $row['rep_en'] ) { echo "selected"; }} ?>><?php echo $row['rep_en']; ?></option> 
	           	<?php 
	           		}
	           	?>   
		    </select>
	      </div>	
		<?php
			}
		 ?>
		<div style="float: left;margin-right: 150px;" class="form-group <?php if (isset($_SESSION['message_annee']) && $_SESSION['message_annee'] !=  "") { echo 'has-error';} ?>">
	        <input type="submit" style="color: #fff;" class="btn btn-success btn-xs"  value="valider">
	    </div>
		
	</form>
	<script type="text/javascript">
		jQuery(".close").click(function(){
	 		jQuery('.close').parent().hide();
	 	});

	</script>
	
<?php
	$_SESSION['message_reponse_en_equivalence'] = array();
	$_SESSION['message_reponse_fr_equivalence'] = array();
	$_SESSION['message_reponse_en'] =  array();
	$_SESSION['message_reponse_fr'] =  array();
	$_SESSION['message_reponse_double_fr'] =  "";
	$_SESSION['message_nb_reponse_fr'] =  ""; 
	$_SESSION['message_reponse_double_en'] =  "";
	$_SESSION['message_nb_reponse_en'] =  ""; 
	$_SESSION['message_question_fr'] = "";
	$_SESSION['message_question_en'] = "";
	$_SESSION['message_question_unique_fr'] = "";
	$_SESSION['message_question_unique_en'] = "";
	$_SESSION['message_statut'] = "";
	$_SESSION['question_fr'] = "";
	$_SESSION['question_en'] = "";
	$_SESSION['session'] = "";
	$_SESSION['statut'] = "";
	for ($i=1; $i <=5 ; $i++) { 
		$_SESSION["reponse_fr_$i"] = "";
	}
	for ($i=1; $i <=5 ; $i++) { 
		$_SESSION["reponse_en_$i"] = "";
	}
	for ($i=1; $i <=5 ; $i++) { 
		$_SESSION["message_reponse_fr_equivalence_$i"] = "";
	}
	for ($i=1; $i <=5 ; $i++) { 
		$_SESSION["message_reponse_en_equivalence_$i"] = "";
	}
	for ($i=1; $i <=5 ; $i++) { 
		$_SESSION["message_reponse_fr_$i"] = "";
	}
	for ($i=1; $i <=5 ; $i++) { 
		$_SESSION["message_reponse_en_$i"] = "";
	}
	}
	
?>