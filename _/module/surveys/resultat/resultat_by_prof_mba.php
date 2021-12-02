<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table" height="81" >
  <tr>
    <td>&nbsp;<img src="images/icone/notes.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DU SONDAGE ['resultat des sondages']
	 &nbsp;&nbsp;<span class="task"></span>
 	</td>
	<td width="22%">&nbsp;</td> 
  </tr>
</table>
<div class="row">
	<!-- <div class="col-md-12" style="float:right;padding: 16px;">
	  <a href="Surveys.php?list_sondage" style="color: #fff;text-decoration: none;" class="btn btn-success btn-xs">les sondages</a>
	  <a href="Surveys.php?list_affectation" style="color: #fff;text-decoration: none;" class="btn btn-success btn-xs"> Les affectations</a>
	  <a href="Surveys.php?list_question" style="color: #fff;text-decoration: none;" class="btn btn-success btn-xs">Les quéstions</a>
	  <a href="Surveys.php?response_list" style="color: #fff;text-decoration: none;" class="btn btn-success btn-xs">Les réponses</a>
	  <a href="Surveys.php?resultat_etudiant&id=<?php echo $_GET['id']; ?>" style="color: #fff;text-decoration: none;" class="btn btn-success btn-xs">Les étudiants</a>
	</div> -->
</div>
<div class="row">
<?php if (isset($_GET['resultat_by_prof_mba']) && isset($_GET['id'])): ?>

	<?php if (isset($_GET['annee']) && isset($_GET['periode'])) { ?>
		<?php 
			$periode = $_GET['periode'];
			$annee = $_GET['annee'];
			$sql_prof_affectation= "SELECT DISTINCT a.`code_prof` FROM `tbl_sondage_affectation` as a ,`tbl_professeur` as p , `tbl_aff_etudiant` as e , `tbl_etudiant_deac` as et   WHERE a.`groupe` = 3 and a.`niveau` = \"mba\" and a.`annee` = $annee and `periode` = \"$periode\" AND a.`archive` = 0 and a.code_prof = p.code_prof and p.archive = 0 and a.`id` = e.`id_affectation` and a.`type` = 1 and e.`code_inscription` = et.`code_inscription`";
			//var_dump($sql_prof_affectation);
        	$req_prof_affectation = @mysql_query($sql_prof_affectation);
        	// les etudiants

        	$sql_nb_etudiant_r = "SELECT count(distinct r.`code_etudiant`) FROM `tbl_sondage_affectation` as a ,`tbl_resultat_sondage` as r  ,`tbl_professeur` as p , `tbl_aff_etudiant` as e , `tbl_etudiant_deac` as et  WHERE a.`annee` = \"$annee\" and a.`periode` = \"$periode\" and a.`id` = r.`id_affectation` and a.`groupe` = 3 and a.code_prof = p.code_prof and p.archive = 0 and a.`id` = e.`id_affectation` and a.`type` = 1 and e.`code_inscription` = et.`code_inscription`";
        	//var_dump($sql_nb_etudiant_r);
        	$req_nb_etudiant_r = @mysql_query($sql_nb_etudiant_r);
            $row_nb_etudiant_r = mysql_fetch_array($req_nb_etudiant_r);
        	$sql_nb_etudiant_tt = "SELECT count(*) FROM `tbl_sondage_affectation` as a , `tbl_professeur` as p , `tbl_aff_etudiant` as e , `tbl_etudiant_deac` as et  WHERE a.`niveau` = \"mba\" and a.`annee` = $annee and a.`periode` = \"$periode\"  and a.`id` = e.`id_affectation` and a.`groupe` = 3 and a.code_prof = p.code_prof and p.archive = 0 and a.`id` = e.`id_affectation` and a.`type` = 1 and e.`code_inscription` = et.`code_inscription`";
        	//var_dump($sql_nb_etudiant_tt);
        	$req_nb_etudiant_tt = @mysql_query($sql_nb_etudiant_tt);
            $row_nb_etudiant_tt = mysql_fetch_array($req_nb_etudiant_tt);
            $nb_etudiant_r = $row_nb_etudiant_r['0'];
            $nb_etudiant_tt = $row_nb_etudiant_tt['0'];
		?>
		<h2 class="text-info">Session <?php  echo $periode.' '.$annee; ?></h2>				
		<!-- <h3 class="text-info">the number of students who responded to the survey <?php echo $nb_etudiant_r." / ".$nb_etudiant_tt; ?> </h3> -->

		<div class="row">
			<a href="http://sis.aulm.us/administrator/Surveys.php?resultat_excel_mba&annee=<?php echo $annee; ?>&periode=<?php echo $periode; ?>&id=2&name=<?php echo "Overall_Satisfaction_of_Students_for_session_".$periode."_".$annee; ?>" class="btn btn-success" >Export Overall Satisfaction of Students</a>
			<div class=" col-sm-offset-2 col-md-8">	
				
				<br>
				<?php 
				$ttl_very_sat_result = 0;
				$ttl_sat_result = 0;
				$ttl_slightly_sat_result = 0;
				$ttl_unsatisfied_result = 0;
				$ttl_etudiant_result = 0;
	        	while ($row_prof_affectation = mysql_fetch_array($req_prof_affectation)){
	        		$code_prof = $row_prof_affectation['code_prof'];
	        		$sql_prof = "SELECT * FROM `tbl_professeur` WHERE `code_prof` = \"$code_prof\"";
	        		$req_prof = @mysql_query($sql_prof);
	        		$row_prof = mysql_fetch_assoc($req_prof);
	        		$nom_prof = $row_prof['nom_prenom'];
	        		$sql_nb_cour = "SELECT COUNT(distinct r.`id_affectation`) FROM `tbl_sondage_affectation` as a , `tbl_professeur` as p , `tbl_resultat_sondage` as r , `tbl_aff_etudiant` as e , `tbl_etudiant_deac` as et  WHERE   a.`niveau` = \"mba\" and a.`annee` = $annee and a.`periode` = \"$periode\" AND a.`archive` = 0 AND  a.`code_prof` = \"$code_prof\" and a.`code_prof` = p.`code_prof` and p.`archive`= 0 and a.groupe = 3 and a.`id` = r.`id_affectation` and a.`id` = e.`id_affectation` and e.`code_inscription` = et.`code_inscription`";
	        		//var_dump($sql_nb_cour);
					$req_nb_cour = @mysql_query($sql_nb_cour);
					$row_nb_cour = mysql_fetch_array($req_nb_cour);
					$nb_cours = $row_nb_cour['0'];
					//////://///////
					$sql_new = "SELECT r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage,count(r.`id_reponse`) as nb_porcentage FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_reponse` as rep , `tbl_aff_etudiant` as e , `tbl_etudiant_deac` as et WHERE `groupe` = 3 and   `niveau` = \"mba\" and `annee` = $annee and `periode` = \"$periode\" AND `code_prof` = \"$code_prof\" and a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id`  group by rep.`porcentage` and a.`id` = e.`id_affectation` and e.`code_inscription` = et.`code_inscription`";
					//var_dump($sql_new);
					$req_new = @mysql_query($sql_new);
					$sql_cour_affectation= "SELECT distinct r.`id_affectation` , a.* FROM `tbl_sondage_affectation` as a , `tbl_professeur` as p , `tbl_resultat_sondage` as r , `tbl_aff_etudiant` as e , `tbl_etudiant_deac` as et WHERE a.`groupe` = 3 and   a.`niveau` = \"mba\" and a.`annee` = $annee and a.`periode` = \"$periode\" and  a.`code_prof` = \"$code_prof\" and a.`code_prof` = p.`code_prof` and p.`archive`= 0 and a.groupe = 3 and a.`id` = r.`id_affectation` and a.`id` = e.`id_affectation` and a.`type` = 1 and e.`code_inscription` = et.`code_inscription`";
	        		//var_dump($sql_cour_affectation);
			        $req_cour_affectation = @mysql_query($sql_cour_affectation);
					// $sql_cour_affectation= "SELECT * FROM `tbl_sondage_affectation` WHERE `groupe` = 3 and   `niveau` = \"mba\" and `annee` = $annee and `periode` = \"$periode\" AND `code_prof` = \"$code_prof\" ";
	    			//  $req_cour_affectation = @mysql_query($sql_cour_affectation);
	        		$ttl_etudiant = 0;
	        		$ttl_very_sat = 0;
					$ttl_sat = 0;
					$ttl_slightly_sat = 0;
					$ttl_unsatisfied = 0;


					while ($row_new = mysql_fetch_array($req_new)) {
						if ($row_new['porcentage'] == 100) {
							$ttl_very_sat = $row_new['nb_porcentage'];
							$ttl_etudiant = $ttl_etudiant + $ttl_very_sat;
						}
						if ($row_new['porcentage'] == 90) {
							$ttl_sat = $row_new['nb_porcentage'];
							$ttl_etudiant = $ttl_etudiant + $ttl_sat;
						}
						if ($row_new['porcentage'] == 80) {
							$ttl_slightly_sat = $row_new['nb_porcentage'];
							$ttl_etudiant = $ttl_etudiant + $ttl_slightly_sat;
						}
						if ($row_new['porcentage'] == 70) {
							$ttl_unsatisfied = $row_new['nb_porcentage'];
							$ttl_etudiant = $ttl_etudiant + $ttl_unsatisfied;
						}

					}
					
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
												$l = "en";

											?>
												
												urlList[i] = "http://sis.aulm.us/administrator/Surveys.php?resultat_excel_mba&id=<?php echo $id_sondage; ?>&affectation=<?php echo $row_cour_affectation['id']; ?>&prof_name=<?php echo $nom_prof; ?>&cours=<?php echo $row_cour_affectation['code_cours']; ?>&l=<?php echo $l; ?>&campus=<?php echo $row_cour_affectation['campus']; ?>&name=<?php echo "result of survey -".$nom_prof."-".$row_cour_affectation['code_cours']."-".$row_cour_affectation['campus']."-".$l ?>"
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
				
				<?php
					$ttl_very_sat_result = $ttl_very_sat_result+$ttl_very_sat;
						$ttl_sat_result = $ttl_sat_result+$ttl_sat;
						$ttl_slightly_sat_result = $ttl_slightly_sat_result+$ttl_slightly_sat;
						$ttl_unsatisfied_result = $ttl_unsatisfied_result+$ttl_unsatisfied;
						$ttl_etudiant_result = $ttl_etudiant_result+$ttl_etudiant;	
		        	}
				?>
			</div>
		</div>
	<?php } ?>
	
<?php endif ?>

</div>

