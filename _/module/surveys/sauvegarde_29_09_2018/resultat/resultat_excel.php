<?php if (isset($_GET['resultat_excel']) && isset($_GET['id'])): ?>

	<?php if (isset($_GET['code_prof'])){ ?>
		<?php 
				$id_sondage =$_GET['id'];
				$code_prof = $_GET['code_prof'];
				$sql_sondage = "SELECT * FROM `tbl_sondage` WHERE `id`= $id_sondage";
		        $res_sondage=@mysql_query($sql_sondage) or die ('erreur de selection des sessions');
		        $row_sondage=mysql_fetch_assoc($res_sondage);
		        $sondage_title = $row_sondage['titre_fr'];
		        $id_session = $row_sondage['id_session'];
		        $sqlsession="select idSession, session, annee_academique from $tbl_session WHERE `idSession`= $id_session";
		        $res=@mysql_query($sqlsession) or die ('erreur de selection des sessions');
		        $row=mysql_fetch_assoc($res);
		        $idSession=$row['idSession'];
		        $session=$row['session'];
		        $annee=$row['annee_academique'];
				$sql_cour_affectation= "SELECT a.* FROM `tbl_sondage_affectation` as a ,  `tbl_professeur` as p WHERE 
					a.`groupe` = 3 AND   
					a.`session` = \"$id_session\" AND 
					a.`code_prof` = \"$code_prof\" and 
					a.`code_prof` = p.`code_prof` and 
					p.`archive`= 0 and 
					`campus` = 'e-learning'";
	        	$req_cour_affectation = @mysql_query($sql_cour_affectation);
	        	$sql_prof = "SELECT * FROM `tbl_professeur` WHERE `code_prof` = \"$code_prof\" and archive=0";
	        	$req_prof = @mysql_query($sql_prof);
	        	$row_prof = mysql_fetch_assoc($req_prof);
	        	$nom_prof = $row_prof['nom_prenom'];
	        	// les etudiants

	        	$sql_nb_etudiant_r = "SELECT count(distinct r.`code_etudiant`) FROM 
	        		`tbl_resultat_sondage` as r , `tbl_etudiant_deac` as e WHERE 
	        		r.`id_sondage` = $id_sondage and 
	        		r.`code_etudiant` = e.`code_inscription`";
	        	$req_nb_etudiant_r = @mysql_query($sql_nb_etudiant_r);
	            $row_nb_etudiant_r = mysql_fetch_array($req_nb_etudiant_r);
	        	$sql_nb_etudiant_tt = "SELECT count(distinct n.`code_inscription`) FROM `tbl_note_piimt` as n , `tbl_etudiant_deac` as e WHERE `idSession` = $id_session and `archive` = 0 and r.`code_etudiant` = e.`code_inscription`";
	        	$req_nb_etudiant_tt = @mysql_query($sql_nb_etudiant_tt);
	            $row_nb_etudiant_tt = mysql_fetch_array($req_nb_etudiant_tt);
	            $nb_etudiant_r = $row_nb_etudiant_r['0'];
	            $nb_etudiant_tt = $row_nb_etudiant_tt['0'];
		?>
		<h1 class="text-info"><?php echo $sondage_title; ?></h1>
		<h2 class="text-info">Session <?php  echo $session.' '.$annee; ?></h2>
		<h3 class="text-info"><?php echo $nom_prof; ?></h3>	
		<h4 class="text-info">the number of students who responded to the survey <?php echo $nb_etudiant_r." / ".$nb_etudiant_tt; ?> </h4>

		<div class="row">
			<div class=" col-sm-offset-2 col-md-8">	
				<?php 

	        	while ($row_cour_affectation = mysql_fetch_array($req_cour_affectation)){
	        		$code_cour = $row_cour_affectation['code_cours'];
	        		$type = $row_cour_affectation['type'];
	        		$campus = $row_cour_affectation['campus'];
	        		$groupe = $row_cour_affectation['groupe'];
	        		$sql_cour = "SELECT * FROM `tbl_cours` WHERE `code_cours` = \"$code_cour\"";
	        		$req_cour = @mysql_query($sql_cour);
	        		$row_cour = mysql_fetch_assoc($req_cour);
	        		$cour = $row_cour['titre'];
	        		$cour_eng = $row_cour['titre_eng'];
	        		$id_affectation = $row_cour_affectation['id'];
	        		$sql_nb_etudiant = "SELECT  COUNT( Distinct r.`code_etudiant`) FROM `tbl_resultat_sondage` as r , `tbl_etudiant_deac` as e  WHERE   `id_affectation` = \"$id_affectation\" 
					AND `id_sondage` = \"$id_sondage\" and r.`code_etudiant` = e.`code_inscription`";
					//var_dump($sql_nb_etudiant);
					$req_nb_etudiant = @mysql_query($sql_nb_etudiant);
					$row_nb_etudiant = mysql_fetch_array($req_nb_etudiant);
					$nb_etudiants = $row_nb_etudiant['0'];
					$t = 0;
					if ($type == 0) {
						$t = 1;
					}
					if ($type == 1) {
						$t = 6;
					}
					$sql_nb_etudiant_cour = "SELECT count(*) FROM `tbl_note_piimt`as n , `tbl_etudiant_deac`as e , `tbl_inscription_cours_piimt` as i WHERE 
							n.`code_inscription` = e.`code_inscription` and
							e.groupe=3 and 
							n.`code_cours` = i.`code_cours` and 
							n.`code_inscription` = i.`code_inscription` and 
							n.`idSession` = i.`idSession` and
							i.`archive` != 1 and
							i.`idSession` = \"$id_session\" and
							n.`code_cours` = \"$code_cour\" and 
							n.`letter_grade` != \"T\" and 
							n.`archive` != 1 and ";
						if ($campus != "e-learning") {
							$sql_nb_etudiant_cour .= "e.`ville` = \"$campus\" and ";
						}

					$sql_nb_etudiant_cour .= "e.`groupe` = $groupe and i.`type_cours_id` = $t";
					//var_dump($sql_nb_etudiant_cour);
					$req_nb_etudiant_cour = @mysql_query($sql_nb_etudiant_cour);
					$row_nb_etudiant_cour = mysql_fetch_array($req_nb_etudiant_cour);
					$nb_etudiants_cour = $row_nb_etudiant_cour['0'];
	        	?>
				<div style="text-align:left;" class="panel-group" id="accordion-test">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title text-info">
								<a style="font-size: 12px;" class="collapsed" href="?resultat_sondage&id=<?php echo $id_sondage; ?>&affectation=<?php echo $id_affectation; ?>">
									<?php echo $code_cour." : "; ?>
									<?php if ($groupe == 3) {echo $cour_eng." - ".$campus." - Anglophone";}?><?php if ($groupe == 2) {echo $cour." - ".$campus." - Francophone";} if ($type == 0) {echo " - Présentiel";} ?> 
									<span class="badge badge-success" style="float: right;"><?php if ($nb_etudiants == 0){echo "aucun etudiant";}
									elseif ($nb_etudiants == 1) { echo $nb_etudiants."/".$nb_etudiants_cour." un etudiant";}else{echo $nb_etudiants."/".$nb_etudiants_cour." etudiants";}
									 ?>
									<i class="entypo-plus-circled"></i></span> 
								</a>
							</h4>
						</div>
						<?php 
							
							$nb_q_ver = 0;
							$sql_resultat = "SELECT Distinct r.`code_etudiant` FROM `tbl_resultat_sondage` as r , `tbl_etudiant_deac` as e where  `id_affectation` = $id_affectation  and `id_sondage` = $id_sondage  and r.`code_etudiant` = e.`code_inscription`";
							//var_dump($sql_resultat);
							$req_resultat = @mysql_query($sql_resultat);
							$very_sat = 0;
							$sat = 0;
							$slightly_sat = 0;
							$unsatisfied = 0;
							$ttl_etudiant = 0;
							$sql_new = "SELECT r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage,count(r.`id_reponse`) as nb_porcentage FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_reponse` as rep , `tbl_etudiant_deac` as e WHERE  a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and r.`id_sondage` = $id_sondage  and a.`campus`= 'e-learning' and r.`code_etudiant` = e.`code_inscription`  group by rep.`porcentage`";
							//var_dump($sql_new);
							$req_new = @mysql_query($sql_new);

							while ($row_new = mysql_fetch_array($req_new)) {
								if ($row_new['porcentage'] == 100) {
									$very_sat = $row_new['nb_porcentage'];
									$ttl_etudiant = $ttl_etudiant + $very_sat;
								}
								if ($row_new['porcentage'] == 90) {
									$sat = $row_new['nb_porcentage'];
									$ttl_etudiant = $ttl_etudiant + $sat;
								}
								if ($row_new['porcentage'] == 80) {
									$slightly_sat = $row_new['nb_porcentage'];
									$ttl_etudiant = $ttl_etudiant + $slightly_sat;
								}
								if ($row_new['porcentage'] == 70) {
									$unsatisfied = $row_new['nb_porcentage'];
									$ttl_etudiant = $ttl_etudiant + $unsatisfied;
								}

							}
						?>
						<div class="panel-body with-table">
									<table class="table table-bordered table-responsive">
										<thead>
											<tr class="col-md-12">
												<th class="col-md-3" style="text-align: center;">Total percentage of satisfaction</th>
												
											</tr>
										</thead>
										<tbody>		
											<tr>
												<td> Very Satisfied <?php echo $very_sat."/".$nb_etudiants; ?> </td>
												<td>
												<?php $pr_very = ($very_sat/$nb_etudiants)*100; ?>
													<div class="col-md-2"><?php echo round($pr_very)." %"; ?></div>
													<div class="col-md-10">
														<div class="progress progress-striped active">
															<div class="progress-bar 
																<?php 
																	if($pr_very<=20){
																		echo "progress-bar-danger";
																	}elseif($pr_very>20 && $pr_very<50){
																		echo "progress-bar-warning";
																	}else{
																		echo "progress-bar-success";
																	} 
																?>"
																role="progressbar" 
																aria-valuenow="<?php echo $pr_very; ?>" 
																aria-valuemin="0" 
																aria-valuemax="100" 
																style="width: 
																	<?php echo $pr_very;
																	?>%">
															</div>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td> Satisfied <?php echo $sat."/".$nb_etudiants; ?> </td>
												<td>
												<?php $pr_sat = ($sat/$nb_etudiants)*100; ?>
													<div class="col-md-2"><?php echo round($pr_sat)." %"; ?></div>
													<div class="col-md-10">
														<div class="progress progress-striped active">
															<div class="progress-bar 
																<?php 
																	if($pr_sat<=20){
																		echo "progress-bar-danger";
																	}elseif($pr_sat>20 && $pr_sat<50){
																		echo "progress-bar-warning";
																	}else{
																		echo "progress-bar-success";
																	} 
																?>"
																role="progressbar" 
																aria-valuenow="<?php echo $pr_sat; ?>" 
																aria-valuemin="0" 
																aria-valuemax="100" 
																style="width: 
																	<?php echo $pr_sat;
																	?>%">
															</div>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td> Slightly Satisfied <?php echo $slightly_sat."/".$nb_etudiants; ?></td>
												<td>
												<?php $pr_slightly = ($slightly_sat/$nb_etudiants)*100; ?>
													<div class="col-md-2"><?php echo round($pr_slightly)." %"; ?></div>
													<div class="col-md-10">
														<div class="progress progress-striped active">
															<div class="progress-bar 
																<?php 
																	if($pr_slightly<=20){
																		echo "progress-bar-danger";
																	}elseif($pr_slightly>20 && $pr_slightly<50){
																		echo "progress-bar-warning";
																	}else{
																		echo "progress-bar-success";
																	} 
																?>"
																role="progressbar" 
																aria-valuenow="<?php echo $pr_slightly; ?>" 
																aria-valuemin="0" 
																aria-valuemax="100" 
																style="width: 
																	<?php echo $pr_slightly;
																	?>%">
															</div>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td> Unsatisfied   <?php echo $unsatisfied."/".$nb_etudiants ?> </td>
												<td>
												<?php $pr_unsatisfied = ($unsatisfied/$nb_etudiants)*100; ?>
													<div class="col-md-2"><?php echo round($pr_unsatisfied)." %"; ?></div>
													<div class="col-md-10">
														<div class="progress progress-striped active">
															<div class="progress-bar 
																<?php 
																	if($pr_unsatisfied<=20){
																		echo "progress-bar-danger";
																	}elseif($pr_unsatisfied>20 && $pr_unsatisfied<50){
																		echo "progress-bar-warning";
																	}else{
																		echo "progress-bar-success";
																	} 
																?>"
																role="progressbar" 
																aria-valuenow="<?php echo $pr_unsatisfied; ?>" 
																aria-valuemin="0" 
																aria-valuemax="100" 
																style="width: 
																	<?php echo $pr_unsatisfied;
																	?>%">
															</div>
														</div>
													</div>
												</td>
											</tr>
										</tbody>	
									</table>
						</div>

					</div>
				</div>
				<?php	
		        	}
				?>
			</div>
			
		</div>
	<?php }elseif (isset($_GET['affectation'])){ ?>
		<?php 
			$id_sondage =$_GET['id'];
			$id_affectation = $_GET['affectation'];
			$sql_sondage = "SELECT * FROM `tbl_sondage` WHERE `id`= $id_sondage";
	        $res_sondage=@mysql_query($sql_sondage) or die ('erreur de selection des sessions');
	        $row_sondage=mysql_fetch_assoc($res_sondage);
	        $sondage_title = $row_sondage['titre_fr'];
	        $id_session = $row_sondage['id_session'];
	        $sqlsession="select idSession, session, annee_academique from $tbl_session WHERE `idSession`= $id_session";
	        $res=@mysql_query($sqlsession) or die ('erreur de selection des sessions');
	        $row=mysql_fetch_assoc($res);
	        $idSession=$row['idSession'];
	        $session=$row['session'];
	        $annee=$row['annee_academique'];
			$sql_affectation= "SELECT * FROM `tbl_sondage_affectation` WHERE   `session` = \"$id_session\" 
			AND `id` = \"$id_affectation\" ";
	    	$req_affectation = @mysql_query($sql_affectation);
	    	$row_affectation = mysql_fetch_assoc($req_affectation);
	    	$code_prof = $row_affectation['code_prof'];
	    	$groupe = $row_affectation['groupe'];
	    	$code_cour = $row_affectation['code_cours'];
	    	$type = $row_affectation['type'];
	    	$sql_prof = "SELECT * FROM `tbl_professeur` WHERE `code_prof` = \"$code_prof\"";
	    	$req_prof = @mysql_query($sql_prof);
	    	$row_prof = mysql_fetch_assoc($req_prof);
	    	$nom_prof = $row_prof['nom_prenom'];
	    	$sql_cour = "SELECT * FROM `tbl_cours` WHERE `code_cours` = \"$code_cour\"";
			$req_cour = @mysql_query($sql_cour);
			$row_cour = mysql_fetch_assoc($req_cour);
			$cour = $row_cour['titre'];
			$cour_eng = $row_cour['titre_eng'];
			//nombre d'etudiant 
			if ($type == 0) {
				$type_cours_id = 1;
			}
			if ($type == 1) {
				$type_cours_id = 6;
			}
			// $sql_etudiant_inscrit = "SELECT count(*) FROM `tbl_inscription_cours` WHERE `code_cours` = \"$code_cour\" 
			// AND `idSession` = $id_session AND `type_cours_id` = $type_cours_id";
		 	// $req_etudiant_inscrit = @mysql_query($sql_etudiant_inscrit);
		 	// $row_etudiant_inscrit = mysql_fetch_array($req_etudiant_inscrit);
		 	// $nb_etudiant_inscrit = $row_etudiant_inscrit['0'];
		 	$sql_etudiant_inscrit = "SELECT count(distinct r.`code_etudiant`) FROM `tbl_resultat_sondage` as r , `tbl_etudiant_deac` as e WHERE `id_affectation` = $id_affectation and r.`code_etudiant` = e.`code_inscription`";
		 	
		 	$req_etudiant_inscrit = @mysql_query($sql_etudiant_inscrit);
		 	$row_etudiant_inscrit = mysql_fetch_array($req_etudiant_inscrit);
		 	$nb_etudiant_inscrit = $row_etudiant_inscrit['0'];
		?>
		
		<div class="tile-progress tile-green">
			<div class="tile-header">
				<h3><?php echo $nom_prof; ?></h3>
				<h3>
						<?php echo $cour_eng; ?>
				</h3>
				<span> Session <?php  echo $session.' '.$annee; ?></span>
				
			</div>
		</div>
		<?php 
			$sql_question= "SELECT * FROM `tbl_questions`";
			$req_question = @mysql_query($sql_question);
			while ($row_question = mysql_fetch_array($req_question)) {
				$id_question = $row_question['id'];
				$sql_question_existe= "SELECT count(*) FROM `tbl_resultat_sondage` as r , `tbl_etudiant_deac` as e  WHERE r.`id_affectation` = $id_affectation AND r.`id_sondage` = $id_sondage AND
				r.`id_question` = $id_question and r.`code_etudiant` = e.`code_inscription`";

		        $req_question_existe = @mysql_query($sql_question_existe);
		        $row_question_existe = mysql_fetch_array($req_question_existe);
		        $nb_question = $row_question_existe['0'];
		        if ($nb_question != 0) { ?>
		        	<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="panel-title" style="text-align: center;width: 100%;">
								<h4 class="text-success">
										<?php echo $row_question['question_en']; ?>
								</h4>
							</div>
							
						</div>
						<div class="panel-body with-table">
								<table class="table table-bordered table-responsive">
									<thead>
										<tr class="col-md-12">
											<th class="col-md-3" style="text-align: center;">reponse</th>
											<th class="col-md-7" style="text-align: center;"></th>
										</tr>
									</thead>
									<tbody>
										<?php 
											$sql_reponse= "SELECT * FROM `tbl_reponse` WHERE `question_id` =$id_question";
											$req_reponse = @mysql_query($sql_reponse);
											while ($row_reponse = mysql_fetch_array($req_reponse)) {  ?>
												<tr>
													<td>
															<?php echo $row_reponse['reponse_en']; ?>
													</td>
													<?php 
														$id_reponse = $row_reponse['id'];
														$sql_nb_etudiants = "SELECT count(distinct(r.`code_etudiant`)) FROM `tbl_resultat_sondage` as r , `tbl_etudiant_deac` as e   WHERE `id_affectation` = $id_affectation AND `id_sondage` = $id_sondage AND
														`id_question` = $id_question AND `id_reponse` = $id_reponse and r.`code_etudiant` = e.`code_inscription`";
												        $req_nb_etudiants = @mysql_query($sql_nb_etudiants);
												        $row_nb_etudiants = mysql_fetch_array($req_nb_etudiants);
												        $nb_etudiant = $row_nb_etudiants['0'];
													?>
													
													<td>
														<?php 
															$porcentage = ($nb_etudiant/$nb_etudiant_inscrit)*100;
															$porcentage = round($porcentage,1);
														 ?>
														<div class="col-md-2"><?php echo $porcentage." %"; ?></div>
														<div class="col-md-10">
															<div class="progress progress-striped active">
																<div class="progress-bar 
																	<?php 
																		if($porcentage<=20){
																			echo "progress-bar-danger";
																		}elseif($porcentage>20 && $porcentage<50){
																			echo "progress-bar-warning";
																		}else{
																			echo "progress-bar-success";
																		} 
																	?>"
																	role="progressbar" 
																	aria-valuenow="<?php echo $porcentage; ?>" 
																	aria-valuemin="0" 
																	aria-valuemax="100" 
																	style="width: 
																		<?php echo $porcentage;
																		?>%">
																</div>
															</div>
														</div>
													</td>
												</tr>
										<?php
											}
										 ?>
									</tbody>	
								</table>
						</div>
				</div>
		    	<?php
		        }
			}
		?>
	<?php }else{ ?>
		<?php 
			$id_sondage =$_GET['id'];
			$niveau = $_GET['niveau'];
			$sql_sondage = "SELECT * FROM `tbl_sondage` WHERE `id`= $id_sondage and `niveau`= \"$niveau\"";
			//var_dump($sql_sondage);
	        $res_sondage=@mysql_query($sql_sondage) or die ('erreur de selection des sessions');
	        $row_sondage=mysql_fetch_assoc($res_sondage);
	        $sondage_title = $row_sondage['titre_fr'];
	        $id_session = $row_sondage['id_session'];
	        $sqlsession="select idSession, session, annee_academique from $tbl_session WHERE `idSession`= $id_session";
	        $res=@mysql_query($sqlsession) or die ('erreur de selection des sessions');
	        $row=mysql_fetch_assoc($res);
	        $idSession=$row['idSession'];
	        $session=$row['session'];
	        $annee=$row['annee_academique'];
			$sql_prof_affectation= "SELECT distinct a.`code_prof` FROM `tbl_sondage_affectation` as a ,  
			`tbl_professeur` as p WHERE a.`groupe` = 3 AND   a.`session` = \"$id_session\" 
			and a.`code_prof` = p.`code_prof` and p.`archive`= 0  and a.`archive` = 0 
			and a.`campus` = 'e-learning'";

			//var_dump($sql_prof_affectation);
        	$req_prof_affectation = @mysql_query($sql_prof_affectation);
        	// les etudiants

        	$sql_nb_etudiant_r = "SELECT count(distinct `code_etudiant`) FROM `tbl_resultat_sondage` as r ,`tbl_sondage_affectation` as a ,  `tbl_professeur` as p , `tbl_etudiant_deac` as e  WHERE `id_sondage` = $id_sondage and a.`code_prof` = p.`code_prof` and p.`archive`= 0  and a.`archive` = 0 and r.`id_affectation` = a.`id` and a.`campus` = 'e-learning' and r.`code_etudiant` = e.`code_inscription`";
        	//var_dump($sql_nb_etudiant_r);
        	$req_nb_etudiant_r = @mysql_query($sql_nb_etudiant_r);
            $row_nb_etudiant_r = mysql_fetch_array($req_nb_etudiant_r);
        	$sql_nb_etudiant_tt = "SELECT count(distinct n.`code_inscription`) FROM `tbl_note_piimt` as n , `tbl_sondage_affectation` as a , `tbl_professeur` as p ,`tbl_etudiant_deac` as e   WHERE `idSession` = $id_session and n.`archive` = 0 and n.`code_cours` = a.`code_cours` and a.`code_prof` = p.`code_prof` and p.`archive`= 0 and a.`archive` = 0 and a.`campus` = 'e-learning' and  n.`code_inscription` = e.`code_inscription`";
        	$req_nb_etudiant_tt = @mysql_query($sql_nb_etudiant_tt);
            $row_nb_etudiant_tt = mysql_fetch_array($req_nb_etudiant_tt);
            $nb_etudiant_r = $row_nb_etudiant_r['0'];
            $nb_etudiant_tt = $row_nb_etudiant_tt['0'];
		?>
		<table>
			<tr>
				<th>Session <?php  echo $session.' '.$annee; ?></th>
			</tr>
			<tr>
				<th>the number of students who responded to the survey <?php echo $nb_etudiant_r." / ".$nb_etudiant_tt; ?></th>
			</tr>
		</table>
		<?php 
				$ttl_very_sat_result = 0;
				$ttl_sat_result = 0;
				$ttl_slightly_sat_result = 0;
				$ttl_unsatisfied_result = 0;
				$ttl_etudiant_result = 0;
	        	while ($row_prof_affectation = mysql_fetch_array($req_prof_affectation)){
	        		$code_prof = $row_prof_affectation['code_prof'];
	        		
	        		$sql_prof = "SELECT * FROM `tbl_professeur` WHERE `code_prof` = \"$code_prof\" and archive=0";
	        		$req_prof = @mysql_query($sql_prof);
	        		$row_prof = mysql_fetch_assoc($req_prof);
	        		$nom_prof = $row_prof['nom_prenom'];

	        		$sql_nb_cour = "SELECT COUNT(*) FROM `tbl_sondage_affectation` WHERE `groupe` = 3 AND   `session` = \"$id_session\" AND 
	        			`archive` = 0 AND 
	        			`code_prof` = \"$code_prof\" and 
	        			`campus` = 'e-learning'";
					$req_nb_cour = @mysql_query($sql_nb_cour);
					$row_nb_cour = mysql_fetch_array($req_nb_cour);
					$nb_cours = $row_nb_cour['0'];
					//////://///////
					$sql_cour_affectation= "SELECT * FROM `tbl_sondage_affectation` WHERE `groupe` = 3 AND   `session` = \"$id_session\" 
					AND `code_prof` = \"$code_prof\" and `campus` = 'e-learning'";
	        		$req_cour_affectation = @mysql_query($sql_cour_affectation);
	        		$ttl_etudiant = 0;
	        		$ttl_very_sat = 0;
					$ttl_sat = 0;
					$ttl_slightly_sat = 0;
					$ttl_unsatisfied = 0;
	        		while ($row_cour_affectation = mysql_fetch_array($req_cour_affectation)){
		        		$code_cour = $row_cour_affectation['code_cours'];
		        		$type = $row_cour_affectation['type'];
		        		$campus = $row_cour_affectation['campus'];
		        		$groupe = $row_cour_affectation['groupe'];
		        		$sql_cour = "SELECT * FROM `tbl_cours` WHERE `code_cours` = \"$code_cour\"";
		        		$req_cour = @mysql_query($sql_cour);
		        		$row_cour = mysql_fetch_assoc($req_cour);
		        		$cour = $row_cour['titre'];
		        		$cour_eng = $row_cour['titre_eng'];
		        		$id_affectation = $row_cour_affectation['id'];
		        		$sql_nb_etudiant = "SELECT  COUNT( Distinct r.`code_etudiant`) FROM `tbl_resultat_sondage` as r , `tbl_resultat_sondage` as e WHERE   `id_affectation` = \"$id_affectation\" and `id_sondage` = \"$id_sondage\" and r.`code_etudiant` = e.`code_inscription`";
						$req_nb_etudiant = @mysql_query($sql_nb_etudiant);
						$row_nb_etudiant = mysql_fetch_array($req_nb_etudiant);
						$nb_etudiants = $row_nb_etudiant['0'];
						$t = 0;
						if ($type == 0) {
							$t = 1;
						}
						if ($type == 1) {
							$t = 6;
						}
						$sql_nb_etudiant_cour = "SELECT count(*) FROM `tbl_note_piimt`as n , `tbl_etudiant_deac`as e , `tbl_inscription_cours_piimt` as i WHERE 
								n.`code_inscription` = e.`code_inscription` and
								n.`code_cours` = i.`code_cours` and 
								n.`code_inscription` = i.`code_inscription` and 
								n.`idSession` = i.`idSession` and
								i.`archive` != 1 and
								i.`idSession` = \"$id_session\" and
								n.`code_cours` = \"$code_cour\" and 
								n.`letter_grade` != \"T\" and 
								n.`archive` != 1 and ";
							if ($campus != "e-learning") {
								$sql_nb_etudiant_cour .= "e.`ville` = \"$campus\" and ";
							}
						$sql_nb_etudiant_cour .= "e.`groupe` = $groupe and i.`type_cours_id` = $t";
						$req_nb_etudiant_cour = @mysql_query($sql_nb_etudiant_cour);
						$row_nb_etudiant_cour = mysql_fetch_array($req_nb_etudiant_cour);
						$nb_etudiants_cour = $row_nb_etudiant_cour['0'];
						//////////////
						$nb_q_ver = 0;
						$sql_resultat = "SELECT Distinct `code_etudiant` FROM `tbl_resultat_sondage` where  `id_affectation` = $id_affectation  and `id_sondage` = $id_sondage";
						$req_resultat = @mysql_query($sql_resultat);
						
						$sql_new = "SELECT r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage,count(r.`id_reponse`) as nb_porcentage FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_etudiant_deac` as e, `tbl_reponse` as rep WHERE  a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and r.`code_etudiant` = e.`code_inscription` group by rep.`porcentage`";
						//var_dump($sql_new);
						$req_new = @mysql_query($sql_new);
						$very_sat = 0;
						$sat = 0;
						$slightly_sat = 0;
						$unsatisfied = 0;
						$ttl_reponse_aff = 0;
						
						while ($row_new = mysql_fetch_array($req_new)) {
							if ($row_new['porcentage'] == 100) {
								
								$very_sat = $row_new['nb_porcentage'];
								
								$ttl_reponse_aff = $ttl_reponse_aff + $very_sat;
							}
							if ($row_new['porcentage'] == 90) {
								
								$sat = $row_new['nb_porcentage'];
								
								$ttl_reponse_aff = $ttl_reponse_aff + $sat;
							}
							if ($row_new['porcentage'] == 80) {
								$slightly_sat = $row_new['nb_porcentage'];
								
								$ttl_reponse_aff = $ttl_reponse_aff + $slightly_sat;
							}
							if ($row_new['porcentage'] == 70) {
								$unsatisfied = $row_new['nb_porcentage'];
								
								$ttl_reponse_aff = $ttl_reponse_aff + $unsatisfied;
							}

						}
						$ttl_very_sat = $ttl_very_sat+$very_sat;
						$ttl_sat = $ttl_sat+$sat;
						$ttl_slightly_sat = $ttl_slightly_sat+$slightly_sat;
						$ttl_unsatisfied = $ttl_unsatisfied+$unsatisfied;
					 	$ttl_etudiant = $ttl_etudiant+$ttl_reponse_aff;
						
					}
					
	        	?>
	        	
				<?php
					$ttl_very_sat_result = $ttl_very_sat_result+$ttl_very_sat;
						$ttl_sat_result = $ttl_sat_result+$ttl_sat;
						$ttl_slightly_sat_result = $ttl_slightly_sat_result+$ttl_slightly_sat;
						$ttl_unsatisfied_result = $ttl_unsatisfied_result+$ttl_unsatisfied;
						$ttl_etudiant_result = $ttl_etudiant_result+$ttl_etudiant;	
		        	}
				?>

		<div style="text-align:left;" class="panel-group" id="accordion-test">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title text-info">
								Overall Student Satisfaction Rate
							</h4>
						</div>
						<div class="panel-body with-table">
									<table class="table table-bordered table-responsive">
										<thead>
											<tr class="col-md-12">
												<th class="col-md-4" style="text-align: center;background-color: #a6a7aa;">Total percentage of satisfaction</th>
												
											</tr>
										</thead>
										<tbody>		
											<tr>
												<td style="text-align: left;"> Very Satisfied ( <?php echo $ttl_very_sat_result." / ".$ttl_etudiant_result; ?> ) Surveys </td>
												<td>
												<?php $pr_very_result = ($ttl_very_sat_result/$ttl_etudiant_result)*100; ?>
													<div class="col-md-3"><?php echo round($pr_very_result,2)." %"; ?></div>
													<div class="col-md-9">
														<div class="progress progress-striped active">
															<div class="progress-bar 
																<?php 
																	if($pr_very_result<=20){
																		echo "progress-bar-danger";
																	}elseif($pr_very_result>20 && $pr_very_result<50){
																		echo "progress-bar-warning";
																	}else{
																		echo "progress-bar-success";
																	} 
																?>"
																role="progressbar" 
																aria-valuenow="<?php echo $pr_very_result; ?>" 
																aria-valuemin="0" 
																aria-valuemax="100" 
																style="width: 
																	<?php echo $pr_very_result;
																	?>%">
															</div>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td style="text-align: left;"> Satisfied ( <?php echo $ttl_sat_result." / ".$ttl_etudiant_result; ?> ) Surveys</td>
												<td>
												<?php $pr_sat_result = ($ttl_sat_result/$ttl_etudiant_result)*100; ?>
													<div class="col-md-3"><?php echo round($pr_sat_result,2)." %"; ?></div>
													<div class="col-md-9">
														<div class="progress progress-striped active">
															<div class="progress-bar 
																<?php 
																	if($pr_sat_result<=20){
																		echo "progress-bar-danger";
																	}elseif($pr_sat_result>20 && $pr_sat_result<50){
																		echo "progress-bar-warning";
																	}else{
																		echo "progress-bar-success";
																	} 
																?>"
																role="progressbar" 
																aria-valuenow="<?php echo $pr_sat_result; ?>" 
																aria-valuemin="0" 
																aria-valuemax="100" 
																style="width: 
																	<?php echo $pr_sat_result;
																	?>%">
															</div>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td style="text-align: left;"> Slightly Satisfied ( <?php echo $ttl_slightly_sat_result." / ".$ttl_etudiant_result; ?> ) Surveys </td>
												<td>
												<?php $pr_slightly_result = ($ttl_slightly_sat_result/$ttl_etudiant_result)*100; ?>
													<div class="col-md-3"><?php echo round($pr_slightly_result,2)." %"; ?></div>
													<div class="col-md-9">
														<div class="progress progress-striped active">
															<div class="progress-bar 
																<?php 
																	if($pr_slightly_result<=20){
																		echo "progress-bar-danger";
																	}elseif($pr_slightly_result>20 && $pr_slightly_result<50){
																		echo "progress-bar-warning";
																	}else{
																		echo "progress-bar-success";
																	} 
																?>"
																role="progressbar" 
																aria-valuenow="<?php echo $pr_slightly_result; ?>" 
																aria-valuemin="0" 
																aria-valuemax="100" 
																style="width: 
																	<?php echo $pr_slightly_result;
																	?>%">
															</div>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td style="text-align: left;"> Unsatisfied ( <?php echo $ttl_unsatisfied_result." / ".$ttl_etudiant_result; ?> ) Surveys </td>
												<td>
												<?php $pr_unsatisfied_result = ($ttl_unsatisfied_result/$ttl_etudiant_result)*100; ?>
													<div class="col-md-3"><?php echo round($pr_unsatisfied_result,2)." %"; ?></div>
													<div class="col-md-9">
														<div class="progress progress-striped active">
															<div class="progress-bar 
																<?php 
																	if($pr_unsatisfied_result<=20){
																		echo "progress-bar-danger";
																	}elseif($pr_unsatisfied_result>20 && $pr_unsatisfied_result<50){
																		echo "progress-bar-warning";
																	}else{
																		echo "progress-bar-success";
																	} 
																?>"
																role="progressbar" 
																aria-valuenow="<?php echo $pr_unsatisfied_result; ?>" 
																aria-valuemin="0" 
																aria-valuemax="100" 
																style="width: 
																	<?php echo $pr_unsatisfied_result;
																	?>%">
															</div>
														</div>
													</div>
												</td>
											</tr>
										</tbody>	
									</table>
						</div>
						
						<?php 
							// $s0 = round($pr_very_result,2);
							// $s1 = round($pr_sat_result,2);
							// $s2 = round($pr_slightly_result,2);
							// $s3 = round($pr_unsatisfied_result,2);

							// $list = array(
							// 	"Overall Student Satisfaction Rate,Session $session $annee,,",
							// 	"Very Satisfied,Satisfied,Slightly Satisfied,Unsatisfied",
							// 	"$s0,$s1,$s2,$s3"
							// );
							// $filename = "toy_csv.csv";
							// $fp = fopen('php://output', 'w');
							// header('Content-type: application/csv');
							// header('Content-Disposition: attachment; filename='.$filename);

							// while($row = $list) {
							// 	fputcsv($fp, $row);
							// }
							// exit;
							// fclose($fp);
							 

						?>


					</div>
		</div>
	<?php } ?>
	
<?php endif ?>


<?php 
 	$_SESSION['message_error'] = "";
 	$_SESSION['message'] = "";
  $_SESSION['message_success'] = "";
?>

<?php 
  $_SESSION['programme'] = '';
  $_SESSION['session'] = '';
  $_SESSION['annee'] = '';
  $_SESSION['titre'] = '';
  $_SESSION['code_inscription'] = '';
  $_SESSION['message_file1'] = '';
  $_SESSION['message_file2'] = '';
  $_SESSION['message_file3'] = '';
  $_SESSION['message_file'] = '';
  $_SESSION['message_programme'] = '';
  $_SESSION['message_titre'] = '';
  $_SESSION['message_session'] = '';
  $_SESSION['message_annee'] = '';
  $_SESSION['message_success'] = '';
  $_SESSION['message_etudiant'] = '';
  $_SESSION['specialite'] = "";
?>
