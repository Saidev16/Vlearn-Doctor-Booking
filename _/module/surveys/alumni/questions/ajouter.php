<?php
	if (isset($_GET['admin_alumni_add']) && $_GET['admin_alumni_add'] == 'add') {
		//var_dump($_POST);
		// die();

		$message_question_fr = "";
		$message_question_unique_fr = "";
		$message_question_en = "";
		$message_question_unique_en = "";
		$message_session = "";
		$message_session_unique = "";
		$message_statut = "";
		$message_reponse_double_fr = "";
		$message_nb_reponse_fr = "";
		$message_reponse_double_en = "";
		$message_nb_reponse_en = "";
		$message_survey = "";
		$_SESSION['message_question_fr'] = "";
		$_SESSION['message_question_en'] = "";
		$_SESSION['message_question_unique_fr'] = "";
		$_SESSION['message_question_unique_en'] = "";
		$_SESSION['message_session'] = "";
		$_SESSION['message_session_unique'] = "";
		$_SESSION['message_statut'] = "";
		$_SESSION['question_fr'] = "";
		$_SESSION['question_en'] = "";
		$_SESSION['session'] = "";
		$_SESSION['statut'] = "";
		$_SESSION['survey'] = "";
		$q_r = $_POST['q_r'];

		//Verification des champs Q_fr Q_en statut
		if (empty($_POST['question_fr']) || $_POST['question_fr'] == "") {
			$message_question_fr = "1";
		}else{
			$question_fr = $_POST['question_fr'];
			$query_question = mysql_query("SELECT `question_fr` FROM `tbl_questions` WHERE `question_fr` = \"$question_fr\"");

			if(mysql_num_rows($query_question) == 1){
			   $message_question_unique_fr = "1";
			}
		}
		if (empty($_POST['question_en']) || $_POST['question_en'] == "") {
			$message_question_en = "1";
		}else{
			$question_en = $_POST['question_en'];
			$query_question = mysql_query("SELECT `question_en` FROM `tbl_questions` WHERE `question_en` = \"$question_en\"");

			if(mysql_num_rows($query_question) == 1){
			   $message_question_unique_en = "1";
			}
		}
		if (isset($_POST['statut'])) {
			if ($_POST['statut'] <= 0 && $_POST['statut'] >= 1) {
				$message_statut = "1";
			}
		}else{
			$message_statut = "1";
		}

		if ($_POST['survey'] == "" || $_POST['survey'] == "0") {
			$message_survey = "1";

		}

		//condition des champs oblegatoire Qu_fr Qu_en statut
		if ($message_statut == 1 or $message_question_en == 1 or $message_survey == 1) {
			?>

			<script type="text/javascript" language="JavaScript1.2">
				alert("Please specify the question and their status");
				window.location.replace('Surveys.php?admin_alumni_add');
			</script>

			<?php
		}else{
			// question global
			if ($q_r == 0) {
				$question_fr = $_POST['question_fr'];
				$question_en = $_POST['question_en'];
				$statut = $_POST['statut'];
				$type = $_POST['survey'];
				$survey_id = 5;
				// l'insertion du question
				$sql_insert = "INSERT INTO `questions_alumni`(`question`, `id_question`, `active`,`type`,`survey_id`)
								VALUES (\"$question_en\",0,$statut,'$type',$survey_id)";
				//var_dump($sql_insert);
				@mysql_query($sql_insert) or die ('erreur lors de la creation du sondage');
				//die();
				?>
					<script type="text/javascript" language="JavaScript1.2">
						window.location.replace('Surveys.php?admin_alumni');
					</script>

				<?php
			}else{
				//les reponse
				$q_p = $_POST['q_p'];
				if ($_POST["g_r"] == 0) {

					$reponse_fr = array();
					for ($i=1; $i <= 6; $i++) {
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
					for ($i=1; $i <= 6; $i++) {
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
					for ($i=1; $i <= 6 ; $i++) {
						$reponse[$i]['reponse_fr'] = $_POST['reponse_fr_'.$i];
						$reponse[$i]['reponse_en'] = $_POST['reponse_en_'.$i];
					}
					// verification de la compatibilité des reponses
					$message_reponse_fr = array();
					$message_reponse_en = array();
					$message_reponse_fr_equivalence = array();
					$message_reponse_en_equivalence = array();
					// foreach ($reponse as $k => $v) {
					// 	if ($v['reponse_fr'] == "1" && $v['reponse_en'] != "1") {
					// 		$message_reponse_fr["$k"] = "1";
					// 	}elseif ($v['reponse_en'] != "1" && $v['reponse_fr'] == "1" || $v['reponse_en'] != "1" && $v['reponse_fr'] != "1" ){
					// 		$req = "SELECT `rep_fr`,`rep_en` FROM `tbl_reponses` WHERE `rep_fr` = \"$v[reponse_fr]\"";
					// 		@mysql_query($req) or die("erreur de la selection des reponses ");
					// 	    $query = mysql_query($req);
					// 	    $row=mysql_fetch_assoc($query);
					// 		if ($v['reponse_en'] != $row['rep_en']) {
					// 			$message_reponse_fr_equivalence["$k"] = "1";
					// 		}
					// 	}
					// 	if ($v['reponse_en'] == "1" && $v['reponse_fr'] != "1") {
					// 		$message_reponse_en["$k"] = "1";
					// 	}elseif ($v['reponse_en'] == "1" && $v['reponse_fr'] != "1" || $v['reponse_en'] != "1" && $v['reponse_fr'] != "1" ){
					// 		$req = "SELECT `rep_fr`,`rep_en` FROM `tbl_reponses` WHERE `rep_en` = \"$v[reponse_en]\"";
					// 		@mysql_query($req) or die("erreur de la selection des reponses ");
					// 	    $query = mysql_query($req);
					// 	    $row=mysql_fetch_assoc($query);
					// 		if ($v['reponse_fr'] != $row['rep_fr']) {
					// 			$message_reponse_en_equivalence["$k"] = "1";
					// 		}
					// 	}
					// }
					// les champ oblegatoire
					//var_dump($_POST);




					if (
						$message_question_en == "1" || $message_statut == "1"  || $message_reponse_double_en == "1"
						||  $message_nb_reponse_en == "1" || $message_reponse_en != array()
						|| $message_reponse_en_equivalence != array() || $message_question_unique_en == "1"
						) {

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
						$_SESSION['message_question_unique_fr'] = $message_question_unique_fr;
						$_SESSION['message_question_unique_en'] = $message_question_unique_en;
						$_SESSION['message_statut'] = $message_statut;
						$_SESSION['question_fr'] = $_POST['question_fr'];
						$_SESSION['question_en'] = $_POST['question_en'];
						if (isset($_POST['statut'])) {
							$_SESSION['statut'] = $_POST['statut'];
						}

						for ($i=1; $i <=6 ; $i++) {
							$_SESSION["reponse_fr_$i"] = $_POST["reponse_fr_$i"];
						}
						for ($i=1; $i <=6 ; $i++) {
							$_SESSION["reponse_en_$i"] = $_POST["reponse_en_$i"];
						}
						?>

						<script type="text/javascript" language="JavaScript1.2">
							window.location.replace('Surveys.php?admin_alumni_add');
						</script>

						<?php
					}else{
						$question_en = $_POST['question_en'];
						$statut = $_POST['statut'];
						$type = $_POST['survey'];
						$survey_id = 5;
						if ($q_p == '') {
							$q_p = -1;
						}
						// l'insertion du question
						$sql_insert = "INSERT INTO `questions_alumni`(`question`, `id_question`, `active`,`type`,`survey_id`)
										VALUES (\"$question_en\",$q_p,$statut,'$type',$survey_id)";
						//var_dump($sql_insert);
						//die();
						@mysql_query($sql_insert) or die ('erreur lors de la creation du sondage');
						$id = mysql_insert_id();
						foreach ($reponse as $k => $v) {
							//$reponse_fr =  $v['reponse_fr'];
							$reponse_en = $v['reponse_en'];
							if ($reponse_en != 1) {
								$req = "SELECT * FROM `tbl_reponses` WHERE `rep_en` = \"$reponse_en\"";
						        @mysql_query($req) or die("erreur de la selection des reponses ");
						        $query = mysql_query($req);
						        if (mysql_num_rows($query) == 1) {
						        	$row=mysql_fetch_assoc($query);
						        	$porcentage = $row['porcentage'];
						        	$sql_insert_reponse ="INSERT INTO `tbl_reponse_alumni`(`question_id`, `reponse_en`, `statut`,`porcentage`,`type`)
													VALUES ($id,\"$reponse_en\",0,$porcentage,'choix')";
									var_dump($sql_insert_reponse);
									@mysql_query($sql_insert_reponse) or die ("erreur lors de l'insertiont des reponses");
						        }
							}
						}
						//other reponse
						$o_r = $_POST['o_r'];
						if ($o_r == 1) {
							$o_r_t = $_POST['o_r_t'];
							$porcentage = 0;
							if ($o_r_t != '') {
								$sql_insert_reponse ="INSERT INTO `tbl_reponse_alumni`(`question_id`, `reponse_en`, `statut`,`porcentage`,`type`) VALUES ($id,\"$o_r_t\",0,$porcentage,'text')";
									var_dump($sql_insert_reponse);
									@mysql_query($sql_insert_reponse) or die ("erreur lors de l'insertiont des reponses");
							}
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
						unset($_SESSION['message_question_unique_en']);
						unset($_SESSION['message_question_unique_fr']);
						unset($_SESSION['message_reponse_double_fr']);
						unset($_SESSION['message_nb_reponse_fr']);
						unset($_SESSION['message_reponse_double_en']);
						unset($_SESSION['message_nb_reponse_en']);
						for ($i=1; $i <=6 ; $i++) {
							unset($_SESSION["reponse_fr_$i"]);
						}
						for ($i=1; $i <=6 ; $i++) {
							unset($_SESSION["reponse_en_$i"]);
						}
						for ($i=1; $i <=6 ; $i++) {
							unset($_SESSION["message_reponse_fr_equivalence_$i"]);
						}
						for ($i=1; $i <=6 ; $i++) {
							unset($_SESSION["message_reponse_en_equivalence_$i"]);
						}
						for ($i=1; $i <=6 ; $i++) {
							unset($_SESSION["message_reponse_fr_$i"]);
						}
						for ($i=1; $i <=6 ; $i++) {
							unset($_SESSION["message_reponse_en_$i"]);
						}
						?>

							<script type="text/javascript" language="JavaScript1.2">
								window.location.replace('Surveys.php?admin_alumni');
							</script>

						<?php

					}
				}else{
					$question_en = $_POST['question_en'];
					$statut = $_POST['statut'];
					if ($q_p == '') {
						$q_p = -1;
					}
					// l'insertion du question
					$sql_insert = "INSERT INTO `questions_alumni`(`question`, `id_question`, `active`)
									VALUES (\"$question_en\",$q_p,$statut)";
					//var_dump($sql_insert);
					@mysql_query($sql_insert) or die ('erreur lors de la creation du sondage');
					$id = mysql_insert_id();
					$conter = $_POST['conter'];
					//var_dump($conter);
					for ($i=1; $i <= $conter; $i++) {
						$title = $_POST["rep_text_".$i];
						$type = $_POST["type_t_".$i];
						if ($title != "" && $type != "") {
							$porcentage = 0;
				        	$sql_insert_reponse ="INSERT INTO `tbl_reponse_alumni`(`question_id`, `reponse_en`, `statut`,`porcentage`,`type`)
											VALUES ($id,\"$title\",0,$porcentage,\"$type\")";
							//var_dump($sql_insert_reponse);
							@mysql_query($sql_insert_reponse) or die ("erreur lors de l'insertiont des reponses");
						}
					}
					?>

						<script type="text/javascript" language="JavaScript1.2">
							window.location.replace('Surveys.php?admin_alumni_add');
						</script>

					<?php

				}
			}
		}
	}else{
?>
	<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
	  <tr>
	    <td><img src="images/icone/classes.gif" border="0"/></td>
	    <td width="78%" class="titre">&nbsp;GESTION DU SONDAGE <span class="task">[ajouter une question]</span> </td>
		<td width="22%">
		  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
		  <tr>
			  <td valign="top" align="center">
			   <a href="Surveys.php?list_question" ><div class="cancel"></div>Retour</a>
			  </td>
		  </tr>
		  </table>
		</td>
	  </tr>
	</table>
	<form action="Surveys.php?admin_alumni_add=add" method="POST" >

		<div class="form-group <?php if (isset($_SESSION['message_question_fr']) && $_SESSION['message_question_fr'] !=  "" || isset($_SESSION['message_question_unique_fr']) && $_SESSION['message_question_unique_fr'] !=  "" ) {echo 'has-error';} ?>">
      	</div>

      	<div style="text-align: left;" class="form-group <?php if (isset($_SESSION['message_question_en']) && $_SESSION['message_question_en'] !=  "" || isset($_SESSION['message_question_unique_en']) && $_SESSION['message_question_unique_en'] !=  "") {echo 'has-error';} ?>">
	        <label >Question *</label>
	        <input id='input_titre' type="text" value="<?php  if (isset($_SESSION['question_en']) && $_SESSION['question_en'] !=  "") {echo $_SESSION['question_en'];}  ?>" name="question_en" class="form-control" id="exampleInputEmail1">
	        <?php if (isset($_SESSION['message_question_en']) && $_SESSION['message_question_en'] !=  "") {
	           echo "<label id='error_titre' class='control-label' style='width: 100%;padding-top: 6px;' for='inputError1'>Champ obligatoire</label>";
	        } ?>
	        <?php if (isset($_SESSION['message_question_unique_en']) && $_SESSION['message_question_unique_en'] !=  "") {
	           echo "<label id='error_titre' class='control-label' style='width: 100%;padding-top: 6px;' for='inputError1'>cette question déja existe.</label>";
	        } ?>
      	</div>
				<div class="row" style="margin-left: 2px;">
		    	<label style="float: left; margin-top: 7px;margin-right: 16px;color:#000;">Survey type: </label>
				<select class="form-control " name="survey" style="width: 200px;float: left;margin-right: 10px;">
					<option value="0">Choose </option>
					<option value="ALUMNI">Alumni</option>
					<option value="EMPLOYER">Employer</option>
				</select>
		    </div>
				<div class="row" style="margin-left:0">
					<div class="span12">
		    		<div style="margin-top: 0px;" class="form-group <?php if (isset($_SESSION['message_q_r']) && $_SESSION['message_q_r'] !=  "") { echo 'has-error';} ?>">
		        <label for="exampleInputFile" style="float: left;margin-right: 19px;">Question type *</label>
		        <div class="radio" style="float: left;margin: 0px;margin-right: 20px;width: 128px;">
							<input class='input_programme q_r_s' id="" name="q_r"  type="radio" style="font-size: 12px;" <?php
								 if (isset($_SESSION['q_r']) && $_SESSION['q_r'] == "0"){echo "checked=checked";} ?>
								 <?php if (isset($_SESSION['q_r']) && $_SESSION['q_r'] == ""){echo "checked";}else{echo "checked";} ?>
								 value="0" >
		            <label class="radio-inline">
									without answer
		            </label>
		        </div>
		        <div class="radio" style="width: 120px;margin-bottom: 0px;margin-top: 0px;">
								<input  class='input_programme q_r_a' id="" name="q_r" type="radio" style="font-size: 12px;" <?php if (isset($_SESSION['q_r']) && $_SESSION['q_r'] == "1"){echo "checked=checked";} ?> value="1">
		            <label class="radio-inline">
									with answer
		            </label>
		        </div>
		          <?php if (isset($_SESSION['message_q_r']) && $_SESSION['message_q_r'] !=  "") {
		             echo "<label id='error_programme' class='control-label' style='width: 100%;padding-top: 6px;' for='inputError1'>Champ obligatoire</label>";
		          } ?>
		        </div>

					</div>
		    </div>

      	<div class="row" style="margin-left:0">
					<div class="span12">
			    	<div style="float: left;margin: 0px;margin-right: 20px;margin-top: 10px;margin-bottom: 10px;" class="form-group <?php if (isset($_SESSION['message_statut']) && $_SESSION['message_statut'] !=  "") { echo 'has-error';} ?>">
			        <label for="exampleInputFile" style="float: left;margin-right: 19px;">Status *</label>
			        <div class="radio" style="float: left;margin: 0px;margin-right: 20px;width: 79px;">
								<input class='input_programme' id="" name="statut"  type="radio" style="font-size: 12px;" <?php
									 if (isset($_SESSION['statut']) && $_SESSION['statut'] == "0"){echo "checked=checked";} ?>
									 <?php if (isset($_SESSION['statut']) && $_SESSION['statut'] == ""){echo "checked";}else{echo "checked";} ?>
									 value="0" >
									<label class="radio-inline">
			               Active
			            </label>
			        </div>
			        <div class="radio" style="margin-bottom: 0;margin-top: 0;">
			            <label class="radio-inline">
			              <input  class='input_programme' id="" name="statut" type="radio" style="font-size: 12px;" <?php if (isset($_SESSION['statut']) && $_SESSION['statut'] == "1"){echo "checked=checked";} ?> value="1"> disabled
			            </label>
			        </div>
			          <?php if (isset($_SESSION['message_statut']) && $_SESSION['message_statut'] !=  "") {
			             echo "<label id='error_programme' class='control-label' style='width: 100%;padding-top: 6px;' for='inputError1'>Champ obligatoire</label>";
			          } ?>
			        </div>
			    </div>
				</div>


	    <div class="q_reponse" style="margin-bottom: 10px;padding: 20px;display: block;background-color: #d5c98d;">
		    <div class="row" style="margin-left: 2px;">
		    	<label style="float: left; margin-top: 7px;margin-right: 16px;color:#000;">Parent Question "Optional"</label>
				<select class="form-control " name="q_p" style="width: 200px;float: left;margin-right: 10px;">
					<option value="0">Choose a parent question</option>
					<?php
						$sql_question = "SELECT * FROM `questions_alumni` WHERE `id_question` = 0";
						@mysql_query($sql_question) or die("erreur de la selection des qustions ");
          				$query = mysql_query($sql_question);
          				while ($row=mysql_fetch_assoc($query)) {
          					?>
          					<option value="<?php echo $row['id']; ?>">
          						<?php echo $row['question']; ?>
          					</option>
          					<?php
          				}

					 ?>
				</select>
		    </div>
		    <div class="row" style="margin-left: 2px;margin-bottom: 18px;color:#000">
		    	<div style="margin-top: 18px;" class="form-group <?php if (isset($_SESSION['message_q_r']) && $_SESSION['message_g_r'] !=  "") { echo 'has-error';} ?>">
		        <label for="exampleInputFile" style="float: left;margin-right: 19px;color:#000;">genre de reponse *</label>
		        <div class="radio" style="float: left;margin: 0px;width: 90px;margin-right: 20px;">
								<input class='input_programme g_r_c' id="" name="g_r"  type="radio" style="font-size: 12px;margin-left: 0;margin-right: 0px;" <?php
									 if (isset($_SESSION['g_r']) && $_SESSION['g_r'] == "0"){echo "checked=checked";} ?>
									 <?php if (isset($_SESSION['g_r']) && $_SESSION['g_r'] == ""){echo "checked";}
										?>
									 value="0" >
								<label class="radio-inline">
		               Choice
		            </label>
		        </div>
		        <div class="radio" style="margin-top: 0px;margin-bottom: 0px;width: 122px;">
								<input  class='input_programme g_r_t' id="" name="g_r" type="radio" style="font-size: 12px;" <?php if (isset($_SESSION['g_r']) && $_SESSION['g_r'] == "1"){echo "checked=checked";} ?> value="1">
		            <label class="radio-inline">
									Text field
		            </label>
		        </div>
		          <?php if (isset($_SESSION['message_g_r']) && $_SESSION['message_g_r'] !=  "") {
		             echo "<label id='error_programme' class='control-label' style='width: 100%;padding-top: 6px;' for='inputError1'>Champ obligatoire</label>";
		          } ?>
		        </div>

		    </div>



		    <div class="g_r_b_c">

				<div class="row" style="margin-left: 41px;">
					<div class="form-group <?php if (isset($_SESSION['message_reponse_double_en']) && $_SESSION['message_reponse_double_en'] !=  ""
			      								|| isset($_SESSION['message_nb_reponse_en']) && $_SESSION['message_nb_reponse_en'] !=  "" ) {echo 'has-error';} ?>">
				        <label for="exampleInputEmail1" style="color: #000;">Answers *</label>
			      	</div>
			      	<?php if (isset($_SESSION['message_nb_reponse_en']) && $_SESSION['message_nb_reponse_en'] !=  "" ): ?>
						<div id="alert" class="alert alert-danger alert-dismissible fade in" role="alert">
					      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					      <h4>Attention it is necessary to choose two obligatory answers at least.</h4>
						</div>
					<?php endif ?>
					<?php if (isset($_SESSION['message_reponse_double_en']) && $_SESSION['message_reponse_double_en'] !=  "" ): ?>
						<div id="alert" class="alert alert-danger alert-dismissible fade in" role="alert">
					      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					      <h4>Be careful, an answer is duplicated.</h4>
						</div>
					<?php endif ?>
					<?php if (isset($_SESSION['message_reponse_en']) && $_SESSION['message_reponse_en'] !=  array() ): ?>
						<div id="alert" class="alert alert-danger alert-dismissible fade in" role="alert">
					      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					      <h4>Be careful you do not choose an answer.</h4>
						</div>
					<?php endif ?>
					<?php
						for ($i=1; $i <= 6 ; $i++) {
					?>
						<div style="float: left;margin-right: 20px;" class="form-group <?php if ((isset($_SESSION["message_reponse_en_equivalence_$i"]) && $_SESSION["message_reponse_en_equivalence_$i"] !=  "" )|| (isset($_SESSION["message_reponse_en_$i"]) && $_SESSION["message_reponse_en_$i"] !=  "")) { echo 'has-error';} ?>">
				        <label for="exampleInputFile" style="color: #000;">reponse <?php echo $i; ?> <?php if ($i <= 2): ?> * <?php endif ?> </label>
				        <select id='input_repose_en_<?php echo $i; ?>'  name="reponse_en_<?php echo $i; ?>" class="form-control" style="width: 153px;">
				          	<option value="1" >choose an answer</option>
				          	<?php
				          		$req_en = "SELECT `rep_en` FROM `tbl_reponses` WHERE  `statut` = 0 ";
						        @mysql_query($req_en) or die("erreur de la selection des reponses ");
						        $query_en = mysql_query($req_en);
						        while ($row=mysql_fetch_assoc($query_en)){
				          	?>
				           		<option value="<?php echo $row['rep_en']; ?>" <?php if (isset($_SESSION["reponse_en_$i"]) && $_SESSION["reponse_en_$i"] == $row['rep_en']){echo "selected";} ?>><?php echo $row['rep_en']; ?></option>
				           	<?php
				           		}
				           	?>
					    </select>
				      </div>
					<?php
						}
					 ?>
				</div>
				<div style="color: #000;margin: 0;margin-top: 10px;" class="row form-group <?php if (isset($_SESSION['message_o_r']) && $_SESSION['message_o_r'] !=  "") { echo 'has-error';} ?>">
			        <label for="exampleInputFile" style="float: left;margin-right: 19px;">ajouter une reponse "Autre Reponse" *</label>
			        <div class="radio" style="float: left;margin: 0px;margin-left: 0px;margin-right: 53px;">
			            <label class="radio-inline">
			              <input class='input_programme o_r_n' id="" name="o_r"  type="radio" style="font-size: 12px;" <?php echo "checked"; ?>
			              	 value="0" > No
			            </label>
			        </div>
			        <div class="radio" style="margin: 0;">
			            <label class="radio-inline">
			              <input  class='input_programme o_r_o' id="" name="o_r" type="radio" style="font-size: 12px;" value="1" > Yes
			            </label>
			        </div>
		            <div class="form-group o_r_t " style="margin-left: 41px;">
				        <label for="exampleInputEmail1">Enter the text *</label>
				        <input id='input_titre' type="text" value="" name="o_r_t" class="form-control" id="exampleInputEmail1">

			      	</div>
		        </div>

			</div>
			<div class="g_r_b_t">
				<div class="zone_c">
					<div class="row" id="1">
						<input class="conter" type="hidden" name="conter" value="1">
						<div class="form-group" style="margin-left: 41px;">
						        <label for="exampleInputEmail1" style="float: left; margin-top: 7px;margin-right: 16px;">Enter the text 1 *</label>
						        <input id='input_titre' type="text" value="" name="rep_text_1" class="form-control span5" id="exampleInputEmail1" style="width: 400px;float: left;margin-right: 20px;">
								<select class="form-control " name="type_t_1" style="width: 200px;float: left;margin-right: 10px;">
									<option value="0">choose the type of the field</option>
									<option value="text">Text</option>
									<option value="textaerea">Text zone</option>
								</select>
								<p class="btn btn-success add_c" style="float: left;margin-right: 10px;">+</p>
								<p class="btn btn-danger delete_c">--</p>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div style="float: left;margin-right: 150px;" class="form-group <?php if (isset($_SESSION['message_annee']) && $_SESSION['message_annee'] !=  "") { echo 'has-error';} ?>">
	        <input type="submit" style="color: #fff;" class="btn btn-success btn-xs" value="ajouter">
	    </div>

	</form>
	<script type="text/javascript">
		jQuery(".add_c").click(function(){
			var i = $(".zone_c > div").last().attr('id');
			i++;
			$(".zone_c").append("<div style='margin-bottom: 15px;' class='row' id="+i+"><div class='form-group' style='margin-left: 41px;'><label for='exampleInputEmail1' style='float: left; margin-top: 7px;margin-right: 16px;'>Enter the text "+i+" *</label><input id='rep_text_"+i+"' type='text' value='' name='rep_text_"+i+"' class='form-control span5' id='exampleInputEmail1' style='width: 400px;float: left;margin-right: 20px;'><select class='form-control ' name='type_t_"+i+"' style='width: 200px;float: left;margin-right: 10px;'><option value='0'>choose the type of the field</option><option value='text'>Text</option><option value='textaerea'>Text zone</option></select></div></div>");
			jQuery(".conter").attr('value',i);
		});
		jQuery(".delete_c").click(function(){

			var id = $(".zone_c > div").last().attr('id');
			if (id != 1) {
				$(".zone_c > div").last().remove();
			}
		});
		jQuery(".close").click(function(){
	 		jQuery('.close').parent().hide();
	 	});
		jQuery(".q_reponse").hide();

		jQuery(".q_r_a").click(function(){
			var q_r = jQuery(".q_r_a").val();
			if (q_r == 0) {
				jQuery(".q_reponse").slideUp();
			}else{
				jQuery(".q_reponse").slideDown();
			}
		});
		jQuery(".q_r_s").click(function(){
			var q_r = jQuery(".q_r_s").val();
			if (q_r == 0) {
				jQuery(".q_reponse").slideUp();
			}else{
				jQuery(".q_reponse").slideDown();
			}
		});
		jQuery(".g_r_b_c").hide();
		jQuery(".g_r_b_t").hide();
		jQuery(".g_r_c").click(function(){
			var q_r = jQuery(".g_r_c").val();
			if (q_r == 0) {
				jQuery(".g_r_b_c").slideDown();
				jQuery(".g_r_b_t").slideUp();
			}else{
				jQuery(".g_r_b_c").slideUp();
				jQuery(".g_r_b_t").slideDown();
			}
		});
		jQuery(".g_r_t").click(function(){
			var q_r = jQuery(".g_r_c").val();
			if (q_r == 0) {
				jQuery(".g_r_b_t").slideDown();
				jQuery(".g_r_b_c").slideUp();
			}else{
				jQuery(".g_r_b_t").slideUp();
				jQuery(".g_r_b_c").slideDown();
			}
		});
		jQuery(".g_r_t").click(function(){
			var q_r = jQuery(".g_r_c").val();
			if (q_r == 0) {
				jQuery(".g_r_b_t").slideDown();
				jQuery(".g_r_b_c").slideUp();
			}else{
				jQuery(".g_r_b_t").slideUp();
				jQuery(".g_r_b_c").slideDown();
			}
		});
		jQuery(".o_r_t").hide();

		jQuery(".o_r_n").click(function(){
			var q_r = jQuery(".o_r_n").val();
			if (q_r == 0) {
				jQuery(".o_r_t").slideUp();
			}else{
				jQuery(".o_r_t").slideDown();
			}
		});
		jQuery(".o_r_o").click(function(){
			var q_r = jQuery(".o_r_o").val();
			if (q_r == 0) {
				jQuery(".o_r_t").slideUp();
			}else{
				jQuery(".o_r_t").slideDown();
			}
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
	$_SESSION['message_statut'] = "";
	$_SESSION['question_fr'] = "";
	$_SESSION['question_en'] = "";
	$_SESSION['message_question_unique_en'] = "";
	$_SESSION['message_question_unique_fr'] = "";
	$_SESSION['session'] = "";
	$_SESSION['statut'] = "";
	for ($i=1; $i <=6 ; $i++) {
		$_SESSION["reponse_fr_$i"] = "";
	}
	for ($i=1; $i <=6 ; $i++) {
		$_SESSION["reponse_en_$i"] = "";
	}
	for ($i=1; $i <=6 ; $i++) {
		$_SESSION["message_reponse_fr_equivalence_$i"] = "";
	}
	for ($i=1; $i <=6 ; $i++) {
		$_SESSION["message_reponse_en_equivalence_$i"] = "";
	}
	for ($i=1; $i <=6 ; $i++) {
		$_SESSION["message_reponse_fr_$i"] = "";
	}
	for ($i=1; $i <=6 ; $i++) {
		$_SESSION["message_reponse_en_$i"] = "";
	}
	}

?>
