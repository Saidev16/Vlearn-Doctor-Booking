<?php if (isset($_GET['resultat_by_prof']) && isset($_GET['id'])): ?>

		<?php 
			$id_sondage =$_GET['id'];
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
			$sql_prof_affectation= "SELECT DISTINCT a.`code_prof` FROM `tbl_sondage_affectation` as a ,`tbl_professeur` as p WHERE   a.`session` = \"$id_session\" 
			AND a.`archive` = 0  and a.code_prof = p.code_prof and p.archive = 0 and a.campus = 'e-learning' ";
			//var_dump($sql_prof_affectation);
        	$req_prof_affectation = @mysql_query($sql_prof_affectation);
        	// les etudiants

        	$sql_nb_etudiant_r = "SELECT count(distinct r.`code_etudiant`) FROM `tbl_resultat_sondage` as r , `tbl_etudiant_deac` as e WHERE `id_sondage` = $id_sondage and r.`code_etudiant` = e.`code_inscription`";
        	$req_nb_etudiant_r = @mysql_query($sql_nb_etudiant_r);
            $row_nb_etudiant_r = mysql_fetch_array($req_nb_etudiant_r);
        	$sql_nb_etudiant_tt = "SELECT count(distinct `code_inscription`) FROM `tbl_note` as n , 
        		`tbl_etudiant_deac` as e WHERE `idSession` = $id_session and `archive` = 0 and r.`code_etudiant` = e.`code_inscription`";
        	$req_nb_etudiant_tt = @mysql_query($sql_nb_etudiant_tt);
            $row_nb_etudiant_tt = mysql_fetch_array($req_nb_etudiant_tt);
            $nb_etudiant_r = $row_nb_etudiant_r['0'];
            $nb_etudiant_tt = $row_nb_etudiant_tt['0'];
		?>
		<h2 class="text-info">Session <?php  echo $session.' '.$annee; ?></h2>				
		<!-- <h3 class="text-info">the number of students who responded to the survey <?php echo $nb_etudiant_r." / ".$nb_etudiant_tt; ?> </h3> -->
		<div class="row">
			<div class="col-sm-offset-2 col-md-8">	
				<a href="http://sis.aulm.us/administrator/Surveys.php?resultat_excel&id=<?php echo $id_sondage; ?>&niveau=BBA&name=<?php echo "Overall_Satisfaction_of_Students_for_session_".$session."_".$annee; ?>" class="btn btn-success" >Export Overall Satisfaction of Students</a>

				<br/>
				<br/>
				<?php 
				$ttl_very_sat_result = 0;
				$ttl_sat_result = 0;
				$ttl_slightly_sat_result = 0;
				$ttl_unsatisfied_result = 0;
				$ttl_etudiant_result = 0;
	        	while ($row_prof_affectation = mysql_fetch_array($req_prof_affectation)){
	        		$code_prof = $row_prof_affectation['code_prof'];
	        		$sql_cour_affectation= "SELECT distinct r.`id_affectation` , a.* FROM `tbl_sondage_affectation` as a , `tbl_professeur` as p , `tbl_resultat_sondage` as r  
	        			WHERE   a.`session` = \"$id_session\" AND  a.`code_prof` = \"$code_prof\" and a.`code_prof` = p.`code_prof` and p.`archive`= 0 and a.groupe = 3 and a.`id` = r.`id_affectation` and a.campus = 'e-learning'";
	        			//var_dump($sql_cour_affectation);
			        	$req_cour_affectation = @mysql_query($sql_cour_affectation);

	        		$sql_prof = "SELECT * FROM `tbl_professeur` WHERE `code_prof` = \"$code_prof\" and archive=0";
	        		$req_prof = @mysql_query($sql_prof);
	        		$row_prof = mysql_fetch_assoc($req_prof);
	        		$nom_prof = $row_prof['nom_prenom'];
	        		$sql_nb_cour = "SELECT COUNT(distinct r.`id_affectation`) FROM `tbl_sondage_affectation` as a , `tbl_professeur` as p , `tbl_resultat_sondage` as r WHERE   
	        			a.`session` = \"$id_session\" AND 
	        			a.`archive` = 0 AND  
						a.`code_prof` = \"$code_prof\" and 
						a.`code_prof` = p.`code_prof` and 
						p.`archive`= 0 and 
						a.groupe = 3 and 
						a.`id` = r.`id_affectation` and 
						a.campus = 'e-learning'";
					//var_dump($sql_nb_cour);
					$req_nb_cour = @mysql_query($sql_nb_cour);
					$row_nb_cour = mysql_fetch_array($req_nb_cour);
					$nb_cours = $row_nb_cour['0'];
	        		?>
	        		<div style="text-align:left;" class="panel-group" id="accordion-test">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title text-info">
									<?php echo $nom_prof ?> <span class="badge badge-success" style="float: right;"><?php echo $nb_cours; if ($nb_cours == 1) {echo "  cour";}else{echo "  cours";} ?></span>  <span class="prof-<?php echo $code_prof; ?> badge badge-success" style="float: right;cursor: pointer;" > Export all courses by Prof</span>
							<script type="text/javascript">
								$(".prof-<?php echo $code_prof; ?>").click(function() {
									var urlList = [];
									var i = 0;
									<?php  
										$l = "";
										while ($row_cour_affectation = mysql_fetch_array($req_cour_affectation)){ 
											if ($row_cour_affectation['groupe']== 2) {
												$l = "fr";
											}else{
												$l = "en";
											}

										?>
											
											urlList[i] = "http://sis.aulm.us/administrator/Surveys.php?resultat_excel&id=<?php echo $id_sondage; ?>&affectation=<?php echo $row_cour_affectation['id']; ?>&prof_name=<?php echo $nom_prof; ?>&cours=<?php echo $row_cour_affectation['code_cours']; ?>&l=<?php echo $l; ?>&campus=<?php echo $row_cour_affectation['campus']; ?>&name=<?php echo "result of survey -".$nom_prof."-".$row_cour_affectation['code_cours']."-".$row_cour_affectation['campus']."-".$l ?>"
										i= i+1;
									<?php } ?>

									for( var i in urlList ){
										window.open( urlList[i], '_blank' );
									}
								});
							</script> 
							</h4>
						</div>

					</div>
				</div>
	        		<div class="row">
						<div class=" ">	
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
				        		$sql_nb_etudiant = "SELECT  COUNT( Distinct `code_etudiant`) FROM `tbl_resultat_sondage` WHERE   `id_affectation` = \"$id_affectation\" 
								AND `id_sondage` = \"$id_sondage\"";
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
								$sql_nb_etudiant_cour = "SELECT count(*) FROM `tbl_note`as n , `tbl_etudiant_deac`as e , `tbl_inscription_cours` as i WHERE n.`code_inscription` = e.`code_inscription` and
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
				        	?>
								<div style="text-align:left;" class="panel-group" id="accordion-test">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title text-info">
												<?php echo $code_cour." : "; ?>
												<?php if ($groupe == 3) {echo $cour_eng." - ".$campus." - Anglophone";}?><?php if ($groupe == 2) {echo $cour." - ".$campus." - Francophone";} if ($type == 0) {echo " - Présentiel";} ?> 
											</h4>
										</div>
									<?php 
										
									?>
									

								</div>
							</div>
							<?php	
					        	}
							?>
						</div>
						
					</div>	        	
				<?php
					
		        	}
				?>
			</div>
		</div>
	
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
