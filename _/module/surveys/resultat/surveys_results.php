
<?php include "function.php"; ?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table" height="81" >
  <tr>
    <td>&nbsp;<img src="images/icone/notes.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;BBA SURVEYS ['Result Surveys']
	 &nbsp;&nbsp;<span class="task"></span>
 	</td>
	<td width="22%">&nbsp;</td>
  </tr>
</table>
<div class="row">
	<div class="col-md-12" style="float:right;padding: 16px;">
		<h1>BBA Survey</h1>
	</div>
</div>
<style type="text/css">
@media print {
    a {
	    display: none !important;
	}
	.p {
		display: block !important;
	}
}
</style>
<?php if (isset($_GET['surveys_results']) && isset($_GET['id'])): ?>

	<?php if (isset($_GET['code_prof'])){ ?>
		<?php
				$id_sondage =$_GET['id'];
				$code_prof = $_GET['code_prof'];
				$sql_sondage = "SELECT * FROM `tbl_sondage` WHERE `id`= $id_sondage";
		        $res_sondage=@mysql_query($sql_sondage) or die ('erreur de selection des sessions');
		        $row_sondage=mysql_fetch_assoc($res_sondage);
		        $sondage_title = $row_sondage['titre_en'];
		        $id_session = $row_sondage['id_session'];
		        $sqlsession="select idSession, session, annee_academique from $tbl_session WHERE `idSession`= $id_session";
		        $res=@mysql_query($sqlsession) or die ('erreur de selection des sessions');
		        $row=mysql_fetch_assoc($res);
		        $idSession=$row['idSession'];
		        $session=$row['session'];
		        $annee=$row['annee_academique'];
				    $sql_cour_affectation= "SELECT distinct r.id_affectation, a.* FROM `tbl_sondage_affectation` as a ,  `tbl_professeur` as p,`tbl_resultat_sondage` as r WHERE
    				a.`groupe` = 3 AND
    				a.`session` = \"$id_session\" AND
    				a.`code_prof` = \"$code_prof\" and
    				a.`code_prof` = p.`code_prof` and
    				p.`archive`= 0 and
    				`campus` = 'e-learning' and a.`archive` = 0 AND a.`id` = r.`id_affectation`";
				    //var_dump($sql_cour_affectation);
	        	$req_cour_affectation = @mysql_query($sql_cour_affectation);
	        	$sql_prof = "SELECT * FROM `tbl_professeur` WHERE `code_prof` = \"$code_prof\" and archive=0";
	        	$req_prof = @mysql_query($sql_prof);
	        	$row_prof = mysql_fetch_assoc($req_prof);
	        	$nom_prof = $row_prof['nom_prenom'];
	        	// les etudiants

	        	$sql_nb_etudiant_r = "SELECT count(distinct r.`code_etudiant`) FROM
	        		`tbl_resultat_sondage` as r , `tbl_etudiant` as e WHERE
	        		r.`id_sondage` in ($id_sondage,2,7) and
	        		r.`code_etudiant` = e.`code_inscription`";
	        	$req_nb_etudiant_r = @mysql_query($sql_nb_etudiant_r);
	            $row_nb_etudiant_r = mysql_fetch_array($req_nb_etudiant_r);
	        	$sql_nb_etudiant_tt = "SELECT count(distinct n.`code_inscription`) FROM `tbl_note_piimt` as n , `tbl_etudiant` as e WHERE `idSession` = $id_session and `archive` = 0 and r.`code_etudiant` = e.`code_inscription`";
	        	$req_nb_etudiant_tt = @mysql_query($sql_nb_etudiant_tt);
	            $row_nb_etudiant_tt = mysql_fetch_array($req_nb_etudiant_tt);
	            $nb_etudiant_r = $row_nb_etudiant_r['0'];
	            $nb_etudiant_tt = $row_nb_etudiant_tt['0'];
		?>
		<h1 class="text-info"><?php echo $sondage_title; ?></h1>
		<!--<h2 class="text-info">Session <?php  echo $session.' '.$annee; ?></h2>-->
		<h3 class="text-info"><?php echo ucwords($nom_prof); ?></h3>
		<!-- <h4 class="text-info">the number of students who responded to the survey <?php echo $nb_etudiant_r." / ".$nb_etudiant_tt; ?> </h4> -->
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
	        		$sql_nb_etudiant = "SELECT  COUNT( Distinct r.`code_etudiant`) FROM `tbl_resultat_sondage` as r , `tbl_etudiant` as e  WHERE   `id_affectation` = \"$id_affectation\"
					AND `id_sondage` in (\"$id_sondage\",2,7) and r.`code_etudiant` = e.`code_inscription`";
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
					$sql_nb_etudiant_cour = "SELECT count(*) FROM `tbl_note_piimt`as n , `tbl_etudiant`as e , `tbl_inscription_cours_piimt` as i WHERE
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
								<a style=" font-size: 12px;" class="collapsed" href="?surveys_results&id=<?php echo $id_sondage; ?>&affectation=<?php echo $id_affectation; ?>">
									<?php echo $code_cour." : "; ?>
									<?php
									if ($groupe == 3) {echo $cour_eng;}?>
									<?php
										// if ($type == 0) {echo " - Présentiel";}else{echo " - E-learning";}
									?>
									<span class="badge badge-success" style="float: right;">
									<?php
										// if ($nb_etudiants == 0)
										// {echo "aucun etudiant";}
										// elseif ($nb_etudiants == 1)
										// { echo $nb_etudiants."/".$nb_etudiants_cour." un etudiant";}
										// else{echo $nb_etudiants."/".$nb_etudiants_cour." etudiants";}

 									?>



									<i class="entypo-plus-circled"></i></span>
								</a>
								<p class="p" style="display: none;"> <?php echo $code_cour." : "; ?>
									<?php
									if ($groupe == 3) {echo $cour_eng;}?></p>
							</h4>
						</div>
						<?php
							//Q9
							$sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_reponse` as rep , `tbl_etudiant` as e WHERE  a.`archive` = 0 AND a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and r.`id_sondage` in ($id_sondage,2,7)  and a.`campus`= 'e-learning' and r.`code_etudiant` = e.`code_inscription`  and id_question in (9,22,21,19,18,17,13) group by rep.`porcentage`,`code_etudiant`,`id_question`";
							$req_new = @mysql_query($sql_new);
							$porcentage1 = 0;
							$satisfaction = 0;
							$nbQ = 0;
							while ($row_new = mysql_fetch_array($req_new)) {
								$satisfaction = $satisfaction + $row_new['porcentage'];
								$nbQ++;
							}
							$porcentage1 = $porcentage1 + ($satisfaction/$nbQ);
              if ($porcentage1 == 0) {
                //var_dump($sql_new);
                $question_list = array(9,22,21,19,18,17,13);
                add_default_result($id_affectation,$question_list,$id_sondage);
              }
							// Q1-->Q8
							$sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_reponse` as rep , `tbl_etudiant` as e WHERE  a.`archive` = 0 AND a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and r.`id_sondage` in ($id_sondage,2,7)  and a.`campus`= 'e-learning' and r.`code_etudiant` = e.`code_inscription`  and id_question in (1,2,3,4,5,6,7,8,15,16,23,24,25,26,27,31) group by rep.`porcentage`,`code_etudiant`,`id_question`";
							$req_new = @mysql_query($sql_new);
							$porcentage2 = 0;
							$satisfaction = 0;
							$nbQ = 0;
							while ($row_new = mysql_fetch_array($req_new)) {
								$satisfaction = $satisfaction + $row_new['porcentage'];
								$nbQ++;
							}
							$porcentage2 = $porcentage2 + ($satisfaction/$nbQ);
              if ($porcentage2 == 0) {
                //var_dump($sql_new);
                $question_list = array(1,2,3,4,5,6,7,8,15,16,23,24,25,26,27,31);
                add_default_result($id_affectation,$question_list,$id_sondage);
              }
							//Q10
							$sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_reponse` as rep , `tbl_etudiant` as e WHERE  a.`archive` = 0 AND a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and r.`id_sondage` in ($id_sondage,2,7)  and a.`campus`= 'e-learning' and r.`code_etudiant` = e.`code_inscription`  and id_question in (10,29,28) group by rep.`porcentage`,`code_etudiant`,`id_question`";

							$req_new = @mysql_query($sql_new);
							$porcentage3 = 0;
							$satisfaction = 0;
							$nbQ = 0;
							while ($row_new = mysql_fetch_array($req_new)) {
								$satisfaction = $satisfaction + $row_new['porcentage'];
								$nbQ++;
							}
							$porcentage3 = $porcentage3 + ($satisfaction/$nbQ);
              if ($porcentage3 == 0) {
                //var_dump($sql_new);
                $question_list = array(10,29,28);
                add_default_result($id_affectation,$question_list,$id_sondage);
              }
							//Q12
							$sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_reponse` as rep , `tbl_etudiant` as e WHERE  a.`archive` = 0 AND a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and r.`id_sondage` in ($id_sondage,2,7)  and a.`campus`= 'e-learning' and r.`code_etudiant` = e.`code_inscription`  and id_question in (12,14,10) group by rep.`porcentage`,`code_etudiant`,`id_question`";
							$req_new = @mysql_query($sql_new);
							$porcentage4 = 0;
							$satisfaction = 0;
							$nbQ = 0;
							while ($row_new = mysql_fetch_array($req_new)) {
								$satisfaction = $satisfaction + $row_new['porcentage'];
								$nbQ++;
							}
							$porcentage4 = $porcentage4 + ($satisfaction/$nbQ);
              if ($porcentage4 == 0) {
                //var_dump($sql_new);
                $question_list = array(12,14,10);
                add_default_result($id_affectation,$question_list,$id_sondage);
              }
							//Q11
							$sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_reponse` as rep , `tbl_etudiant` as e WHERE  a.`archive` = 0 AND a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and r.`id_sondage` in ($id_sondage,2,7)  and a.`campus`= 'e-learning' and r.`code_etudiant` = e.`code_inscription`  and id_question in (11,32,30) group by rep.`porcentage`,`code_etudiant`,`id_question`";
							$req_new = @mysql_query($sql_new);
							$porcentage5 = 0;
							$satisfaction = 0;
							$nbQ = 0;
							while ($row_new = mysql_fetch_array($req_new)) {
								$satisfaction = $satisfaction + $row_new['porcentage'];
								$nbQ++;
							}
							$porcentage5 = $porcentage5 + ($satisfaction/$nbQ);
              if ($porcentage5 == 0) {
                //var_dump($sql_new);
                $question_list = array(11,32,30);
                add_default_result($id_affectation,$question_list,$id_sondage);
              }

              $div = 0;

              if ($porcentage1 != 0) {
                $div++;
                $nb_pr1++;
              }
              if ($porcentage2 != 0) {
                $div++;
                $nb_pr2++;
              }
              if ($porcentage3 != 0) {
                $div++;
                $nb_pr3++;
              }
              if ($porcentage4 != 0) {
                $div++;
                $nb_pr4++;
              }
              if ($porcentage5 != 0) {
                $div++;
                $nb_pr5++;
              }

    					$overall = ($porcentage1+$porcentage2+$porcentage3+$porcentage4+$porcentage5)/$div;


						?>
						<div class="panel-body with-table">
									<table class="table table-bordered table-responsive">
										<thead>
											<tr class="col-md-12">
												<th class="col-md-3" style="text-align: center;">Satisfaction Rate</th>

											</tr>
										</thead>
										<tbody>
											<tr>
												<td style="text-align: left;">Satisfaction Curriculm </td>
												<td>
													<div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($porcentage1)." %"; ?></div>
													<div class="col-md-10" style="width:300px; float:left;">
														<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
																if($porcentage1<=20){
																	echo "progress-bar-danger.png";
																}elseif($porcentage1>20 && $porcentage1<50){
																	echo "progress-bar-warning.png";
																}else{
																	echo "progress-bar-success.png";
																}
															?>" style=" position: absolute;
													    			width: <?php if ($porcentage1 == 0) {
													    				echo "0%";
													    			}else{
													    				echo $porcentage1."%";
													    				}
													    				?>;
													    			height: 17px;
																">
															<img src="./../../css/stu-prof/sous-bar.png" style="">
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td style="text-align: left;"> Faculty </td>
												<td>
													<div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($porcentage2)." %"; ?></div>
													<div class="col-md-10" style="width:300px; float:left;">
														<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
																if($porcentage2<=20){
																	echo "progress-bar-danger.png";
																}elseif($porcentage2>20 && $porcentage2<50){
																	echo "progress-bar-warning.png";
																}else{
																	echo "progress-bar-success.png";
																}
															?>" style=" position: absolute;
													    			width: <?php if ($porcentage2 == 0) {
													    				echo "0%";
													    			}else{
													    				echo $porcentage2."%";
													    			} ?>;
													    			height: 17px;
																">
															<img src="./../../css/stu-prof/sous-bar.png" style="">
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td style="text-align: left;"> Administration </td>
												<td>
													<div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($porcentage3)." %"; ?></div>
													<div class="col-md-10" style="width:300px; float:left;">
														<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
																if($porcentage3<=20){
																	echo "progress-bar-danger.png";
																}elseif($porcentage3>20 && $porcentage3<50){
																	echo "progress-bar-warning.png";
																}else{
																	echo "progress-bar-success.png";
																}
															?>" style=" position: absolute;
													    			width: <?php if ($porcentage3 == 0) {
													    				echo "0%";
													    			}else{
													    				echo $porcentage3."%";
													    			} ?>;
													    			height: 17px;
																">
															<img src="./../../css/stu-prof/sous-bar.png" style="">
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td style="text-align: left;"> Library </td>
												<td>
													<div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($porcentage4)." %"; ?></div>
													<div class="col-md-10" style="width:300px; float:left;">
														<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
																if($porcentage4<=20){
																	echo "progress-bar-danger.png";
																}elseif($porcentage4>20 && $porcentage4<50){
																	echo "progress-bar-warning.png";
																}else{
																	echo "progress-bar-success.png";
																}
															?>" style=" position: absolute;
													    			width: <?php if ($porcentage4 == 0) {
													    				echo "0%";
													    			}else{
													    				echo $porcentage4."%";
													    			} ?>;
													    			height: 17px;
																">
															<img src="./../../css/stu-prof/sous-bar.png" style="">
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td style="text-align: left;"> Campus Tools </td>
												<td>
													<div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($porcentage5)." %"; ?></div>
													<div class="col-md-10" style="width:300px; float:left;">
														<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
																if($porcentage5<=20){
																	echo "progress-bar-danger.png";
																}elseif($porcentage5>20 && $porcentage5<50){
																	echo "progress-bar-warning.png";
																}else{
																	echo "progress-bar-success.png";
																}
															?>" style=" position: absolute;
													    			width: <?php if ($porcentage5 == 0) {
													    				echo "0%";
													    			}else{
													    				echo $porcentage5."%";
													    			} ?>;
													    			height: 17px;
																">
															<img src="./../../css/stu-prof/sous-bar.png" style="">
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td style="text-align: left;"> Overall </td>
												<td>
													<div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($overall)." %"; ?></div>
													<div class="col-md-10" style="width:300px; float:left;">
														<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
																if($overall<=20){
																	echo "progress-bar-danger.png";
																}elseif($overall>20 && $overall<50){
																	echo "progress-bar-warning.png";
																}else{
																	echo "progress-bar-success.png";
																}
															?>" style=" position: absolute;
													    			width: <?php if ($overall == 0) {
													    				echo "0%";
													    			}else{
													    				echo $overall."%";
													    			} ?>;
													    			height: 17px;
																">
															<img src="./../../css/stu-prof/sous-bar.png" style="">
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
      $sondage_title = $row_sondage['titre_en'];
      $id_session = $row_sondage['id_session'];
      $sqlsession="select idSession, session, annee_academique from $tbl_session WHERE `idSession`= $id_session";
      $res=@mysql_query($sqlsession) or die ('erreur de selection des sessions');
      $row=mysql_fetch_assoc($res);
      $idSession=$row['idSession'];
      $session=$row['session'];
      $annee=$row['annee_academique'];
       $sql_affectation= "SELECT * FROM `tbl_sondage_affectation` WHERE `groupe` = 3 AND   `session` = \"$id_session\" AND `id` = \"$id_affectation\" ";
	    	$req_affectation = @mysql_query($sql_affectation);
	    	$row_affectation = mysql_fetch_assoc($req_affectation);
	    	$code_prof = $row_affectation['code_prof'];
	    	$groupe = $row_affectation['groupe'];
	    	$code_cour = $row_affectation['code_cours'];
	    	$type = $row_affectation['type'];
	    	$sql_prof = "SELECT * FROM `tbl_professeur` WHERE `code_prof` = \"$code_prof\" and archive=0";
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
			// $sql_etudiant_inscrit = "SELECT count(*) FROM `tbl_inscription_cours_piimt` WHERE `code_cours` = \"$code_cour\"
			// AND `idSession` = $id_session AND `type_cours_id` = $type_cours_id";
		 	// $req_etudiant_inscrit = @mysql_query($sql_etudiant_inscrit);
		 	// $row_etudiant_inscrit = mysql_fetch_array($req_etudiant_inscrit);
		 	// $nb_etudiant_inscrit = $row_etudiant_inscrit['0'];
		 	$sql_etudiant_inscrit = "SELECT count(distinct r.`code_etudiant`) FROM `tbl_resultat_sondage` as r , `tbl_etudiant` as e WHERE `id_affectation` = $id_affectation and r.`code_etudiant` = e.`code_inscription`";
		 	$req_etudiant_inscrit = @mysql_query($sql_etudiant_inscrit);
		 	$row_etudiant_inscrit = mysql_fetch_array($req_etudiant_inscrit);
		 	$nb_etudiant_inscrit = $row_etudiant_inscrit['0'];
		?>

		<div class="tile-progress tile-green">
			<div class="tile-header">
				<h3><?php echo ucwords($nom_prof); ?></h3>
				<h3>
						<?php echo $cour_eng; ?>
				</h3>
				<span><?php echo $sondage_title; ?> </span>

			</div>
		</div>
		<?php
			$sql_question= "SELECT * FROM `tbl_questions`";
			$req_question = @mysql_query($sql_question);
			while ($row_question = mysql_fetch_array($req_question)) {
				$id_question = $row_question['id'];
				$sql_question_existe= "SELECT count(*) FROM `tbl_resultat_sondage` as r , `tbl_etudiant` as e  WHERE r.`id_affectation` = $id_affectation AND r.`id_sondage` in ($id_sondage,2,7) AND
				r.`id_question` = $id_question and r.`code_etudiant` = e.`code_inscription`";
		        $req_question_existe = @mysql_query($sql_question_existe);
		        $row_question_existe = mysql_fetch_array($req_question_existe);
		        $nb_question = $row_question_existe['0'];
		        if ($nb_question != 0) { ?>
		       <div class="panel panel-primary">
						<div class="panel-heading">
							<div class="panel-title" style="text-align: center;width: 100%;">
								<h4 class="text-success">
									<?php if ($groupe == 2): ?>
										<?php echo $row_question['question_en']; ?>
									<?php endif ?>
									<?php if ($groupe == 3): ?>
										<?php echo $row_question['question_en']; ?>
									<?php endif ?>
								</h4>
							</div>

						</div>
						<div class="panel-body with-table">
								<table class="table table-bordered table-responsive">
									<thead>
										<tr class="col-md-12">
											<th class="col-md-3" style="text-align: center;">Answer</th>

											<th class="col-md-7" style="text-align: center;" colspan="2"></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$sql_reponse= "SELECT * FROM `tbl_reponse` WHERE `question_id` =$id_question";
                      //var_dump($sql_reponse);
											$req_reponse = @mysql_query($sql_reponse);
											while ($row_reponse = mysql_fetch_array($req_reponse)) {  ?>
												<tr>
													<td>
														<?php if ($groupe == 2): ?>
															<?php echo $row_reponse['reponse_en']; ?>
														<?php endif ?>
														<?php if ($groupe == 3): ?>
															<?php echo $row_reponse['reponse_en']; ?>
														<?php endif ?>
													</td>
													<?php
														$id_reponse = $row_reponse['id'];
														$sql_nb_etudiants = "SELECT count(distinct(r.`code_etudiant`)) FROM `tbl_resultat_sondage` as r , `tbl_etudiant` as e   WHERE `id_affectation` = $id_affectation AND `id_sondage` = $id_sondage AND
														`id_question` = $id_question AND `id_reponse` = $id_reponse and r.`code_etudiant` = e.`code_inscription`";
												        $req_nb_etudiants = @mysql_query($sql_nb_etudiants);
												        $row_nb_etudiants = mysql_fetch_array($req_nb_etudiants);
												        $nb_etudiant = $row_nb_etudiants['0'];
                                //var_dump($nb_etudiant);
                                $porcentage = ($nb_etudiant/$nb_etudiant_inscrit)*100;
  															$porcentage = round($porcentage,1);
													?>
                         <!-- <td class="col-md-1" ><?php echo $porcentage; ?>%</td>  -->
													<td>
														<div class="col-md-10">
															<div class="progress progress-striped active"
																style="width: 270px;position: absolute;">

																		<img src="../../../css/stu-prof/<?php
																			if($porcentage<=20){
																				echo "progress-bar-danger.png";
																			}elseif($porcentage>20 && $porcentage<50){
																				echo "progress-bar-warning.png";
																			}else{
																				echo "progress-bar-success.png";
																			}
																		?>" style=" position: absolute;
																    			width: <?php echo $porcentage; ?>%;
																    			height: 17px;
																			">

																		<img src="./../../css/stu-prof/sous-bar.png" style="">
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
	        $res_sondage=@mysql_query($sql_sondage) or die ('erreur de selection des sessions');
	        $row_sondage=mysql_fetch_assoc($res_sondage);
	        $sondage_title = $row_sondage['titre_en'];
	        $id_session = $row_sondage['id_session'];
	        $sqlsession="select idSession, session, annee_academique from $tbl_session WHERE `idSession`= $id_session";
	        $res=@mysql_query($sqlsession) or die ('erreur de selection des sessions');
	        $row=mysql_fetch_assoc($res);
	        $idSession=$row['idSession'];
	        $session=$row['session'];
	        $annee=$row['annee_academique'];
            //var_dump($sql_sondage);

	        // les profs
			$sql_prof_affectation= "SELECT distinct a.`code_prof`
				FROM
				`tbl_sondage_affectation` as a ,
				`tbl_professeur` as p
				WHERE
				a.`groupe` = 3 AND
				a.`session` = \"$id_session\" AND
				a.`code_prof` = p.`code_prof` AND
				a.`archive` = 0 AND
				a.`campus` = 'e-learning'
			";

			//var_dump($sql_prof_affectation);
        	$req_prof_affectation = @mysql_query($sql_prof_affectation);

		?>
		<h1 class="text-info"><?php echo $sondage_title; ?></h1>
		<!--<h2 class="text-info">Session <?php  echo $session.' '.$annee; ?></h2>
		<h3 class="text-info">The number of students who responded to the survey 40/79 --> <?php //echo $nb_etudiant_r." / ".$nb_etudiant_tt; ?> </h3>

		<div class="row">
			<div class=" col-sm-offset-2 col-md-8">
				<?php
				$ttl_pr1 = 0;
        $nb_pr1 = 0;
				$ttl_pr2 = 0;
        $nb_pr2 = 0;
				$ttl_pr3 = 0;
        $nb_pr3 = 0;
				$ttl_pr4 = 0;
        $nb_pr4 = 0;
				$ttl_pr5 = 0;
        $nb_pr5 = 0;
				$nb_prof = 0;

	        	while ($row_prof_affectation = mysql_fetch_array($req_prof_affectation)){

	        		$code_prof = $row_prof_affectation['code_prof'];
	        		$sql_prof = "SELECT * FROM `tbl_professeur` WHERE `code_prof` = \"$code_prof\" and archive=0";
	        		$req_prof = @mysql_query($sql_prof);
	        		$row_prof = mysql_fetch_assoc($req_prof);
	        		$nom_prof = $row_prof['nom_prenom'];

	        		$sql_nb_cour = "SELECT COUNT(distinct(a.id)) FROM `tbl_sondage_affectation` as a , tbl_resultat_sondage as r
	        			WHERE
	        			a.`groupe` = 3 AND
	        			a.`session` = \"$id_session\" AND
	        			a.`archive` = 0 AND
	        			a.id = r.id_affectation AND
	        			a.`code_prof` = \"$code_prof\" AND
	        			a.`campus` = 'e-learning'";
              //var_dump($sql_nb_cour);
    					$req_nb_cour = @mysql_query($sql_nb_cour);
    					$row_nb_cour = mysql_fetch_array($req_nb_cour);
    					$nb_cours = $row_nb_cour['0'];
    					//var_dump($nb_cours);
    					//
    					$sql_cour_affectation= "SELECT distinct(r.id_affectation), a.* FROM `tbl_sondage_affectation` as a, tbl_resultat_sondage as r WHERE
    					a.`groupe` = 3 AND
              a.`archive` = 0 AND
    					a.`session` = \"$id_session\" AND
    					a.`code_prof` = \"$code_prof\" AND
    					a.`campus` = 'e-learning' AND a.id = r.id_affectation";
              //var_dump($sql_cour_affectation);
    					$porcentage1 = 0;
    					$porcentage2 = 0;
    					$porcentage3 = 0;
    					$porcentage4 = 0;
    					$porcentage5 = 0;
	        		$req_cour_affectation = @mysql_query($sql_cour_affectation);
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
		        		$sql_nb_etudiant = "SELECT  COUNT( Distinct r.`code_etudiant`) FROM `tbl_resultat_sondage` as r , `tbl_etudiant` as e WHERE   `id_affectation` = \"$id_affectation\" and `id_sondage` in (\"$id_sondage\",2,7) and r.`code_etudiant` = e.`code_inscription`";
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
						$sql_nb_etudiant_cour = "SELECT count(*) FROM `tbl_note_piimt`as n , `tbl_etudiant`as e , `tbl_inscription_cours_piimt` as i WHERE
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
						//Q9
						$sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_etudiant` as e, `tbl_reponse` as rep WHERE  a.`archive` = 0 AND a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and r.`code_etudiant` = e.`code_inscription` and r.id_question in (9,22,21,19,18,17,13) group by rep.`porcentage`,`code_etudiant`,`id_question`";
            //var_dump($sql_new);
						$req_new = @mysql_query($sql_new);
						$satisfaction = 0;
						$nbQ = 0;
						while ($row_new = mysql_fetch_array($req_new)) {
							$satisfaction = $satisfaction + $row_new['porcentage'];
							$nbQ++;
						}
            //var_dump($nbQ);

						$porcentage1 = $porcentage1 + ($satisfaction/$nbQ);
            //var_dump($porcentage1);
						//Q1-->Q8
						$sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_etudiant` as e, `tbl_reponse` as rep WHERE  a.`archive` = 0 AND a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and r.`code_etudiant` = e.`code_inscription` and r.id_question in (1,2,3,4,5,6,7,8,15,16,23,24,25,26,27,31) group by rep.`porcentage`,`code_etudiant`,`id_question`";
						$req_new = @mysql_query($sql_new);
						//var_dump($sql_new);
						$satisfaction = 0;
						$nbQ = 0;
						while ($row_new = mysql_fetch_array($req_new)) {
							$satisfaction = $satisfaction + $row_new['porcentage'];
							$nbQ++;
						}
						$porcentage2 = $porcentage2 + ($satisfaction/$nbQ);
						//Q10
						$sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_etudiant` as e, `tbl_reponse` as rep WHERE  a.`archive` = 0 AND a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and r.`code_etudiant` = e.`code_inscription` and r.id_question in (10,29,28) group by rep.`porcentage`,`code_etudiant`,`id_question`";

						$req_new = @mysql_query($sql_new);
						$satisfaction = 0;
						$nbQ = 0;
						while ($row_new = mysql_fetch_array($req_new)) {
							$satisfaction = $satisfaction + $row_new['porcentage'];
							$nbQ++;
						}
						$porcentage3 = $porcentage3 + ($satisfaction/$nbQ);
						//Q12
						$sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_etudiant` as e, `tbl_reponse` as rep WHERE  a.`archive` = 0 AND a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and r.`code_etudiant` = e.`code_inscription` and id_question in (12,14,10) group by rep.`porcentage`,`code_etudiant`,`id_question`";

						$req_new = @mysql_query($sql_new);
						$satisfaction = 0;
						$nbQ = 0;
						while ($row_new = mysql_fetch_array($req_new)) {
							$satisfaction = $satisfaction + $row_new['porcentage'];
							$nbQ++;
						}
						$porcentage4 = $porcentage4 + ($satisfaction/$nbQ);
						//Q11
						$sql_new = "SELECT count(distinct(r.code_etudiant)) as nb ,`id_question`,r.code_etudiant, r.`id_affectation` , r.`id_reponse` , rep.`porcentage` as porcentage FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r , `tbl_etudiant` as e, `tbl_reponse` as rep WHERE  a.`archive` = 0 AND a.`id` = r.`id_affectation` and r.`id_reponse` = rep.`id` and a.`id` = $id_affectation and r.`code_etudiant` = e.`code_inscription` and r.id_question in (11,32,30) group by rep.`porcentage`,`code_etudiant`,`id_question`";
						//var_dump($sql_new);
						$req_new = @mysql_query($sql_new);
						$satisfaction = 0;
						$nbQ = 0;
						while ($row_new = mysql_fetch_array($req_new)) {
							$satisfaction = $satisfaction + $row_new['porcentage'];
							$nbQ++;
						}
						//echo "$porcentage5 + ($satisfaction/$nbQ)</br>";
						$porcentage5 = $porcentage5 + ($satisfaction/$nbQ);

					}
					$porcentage1 = $porcentage1/$nb_cours;
					$porcentage2 = $porcentage2/$nb_cours;
					$porcentage3 = $porcentage3/$nb_cours;
					$porcentage4 = $porcentage4/$nb_cours;
					$porcentage5 = $porcentage5/$nb_cours;

					$ttl_pr1 = $ttl_pr1 + $porcentage1;
					$ttl_pr2 = $ttl_pr2 + $porcentage2;
					$ttl_pr3 = $ttl_pr3 + $porcentage3;
					$ttl_pr4 = $ttl_pr4 + $porcentage4;
					$ttl_pr5 = $ttl_pr5 + $porcentage5;

          $div = 0;

          // if ($porcentage1 > 100) {
          //   $porcentage1 = 100;
          // }
          //
          // if ($porcentage2 > 100) {
          //   $porcentage2 = 100;
          // }
          //
          // if ($porcentage3 > 100) {
          //   $porcentage3 = 100;
          // }
          //
          // if ($porcentage4 > 100) {
          //   $porcentage4 = 100;
          // }
          //
          // if ($porcentage5 > 100) {
          //   $porcentage5 = 100;
          // }



          if ($porcentage1 != 0) {
            $div++;
            $nb_pr1++;
          }
          if ($porcentage2 != 0) {
            $div++;
            $nb_pr2++;
          }
          if ($porcentage3 != 0) {
            $div++;
            $nb_pr3++;
          }
          if ($porcentage4 != 0) {
            $div++;
            $nb_pr4++;
          }
          if ($porcentage5 != 0) {
            $div++;
            $nb_pr5++;
          }

					$overall = ($porcentage1+$porcentage2+$porcentage3+$porcentage4+$porcentage5)/$div;


	        	?>

	        	<?php if ($nb_cours != 0):
	        		$nb_prof = $nb_prof+1;
	        	?>
	        		<div style="text-align:left;" class="panel-group" id="accordion-test">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title text-info">
									<a class="collapsed" href="?surveys_results&id=<?php echo $id_sondage; ?>&
									code_prof=<?php echo $code_prof; ?>">
										<?php echo ucwords($nom_prof); ?> <span class="badge badge-success" style="float: right;"><?php echo $nb_cours; if ($nb_cours == 1) {echo "  Course";}else{echo "  Courses";} ?> <i class="entypo-plus-circled"></i></span>
									</a>
									<p class="p" style="display: none;"><?php echo ucwords($nom_prof); ?> <span class="badge badge-success" style="float: right;"><?php echo $nb_cours; if ($nb_cours == 1) {echo "  Course";}else{echo "  Courses";} ?> </span></p>
								</h4>
							</div>
						</div>
					</div>
					<div class="panel-body with-table">
						<table class="table table-bordered table-responsive">
							<thead>
								<tr class="col-md-12">
									<th class="col-md-4" style="text-align: center;">Satisfaction Rate</th>

								</tr>
							</thead>
							<tbody>
								<tr>
									<td style="text-align: left;">Satisfaction Curriculm </td>
									<td>
										<div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($porcentage1)." %"; ?></div>
										<div class="col-md-10" style="width:300px; float:left;">
											<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
													if($porcentage1<=20){
														echo "progress-bar-danger.png";
													}elseif($porcentage1>20 && $porcentage1<50){
														echo "progress-bar-warning.png";
													}else{
														echo "progress-bar-success.png";
													}
												?>" style=" position: absolute;
										    			width: <?php if ($porcentage1 == 0) {
										    				echo "0%";
										    			}else{
										    				echo $porcentage1."%";
										    				}
										    				?>;
										    			height: 17px;
													">
												<img src="./../../css/stu-prof/sous-bar.png" style="">
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td style="text-align: left;"> Faculty </td>
									<td>
										<div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($porcentage2)." %"; ?></div>
										<div class="col-md-10" style="width:300px; float:left;">
											<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
													if($porcentage2<=20){
														echo "progress-bar-danger.png";
													}elseif($porcentage2>20 && $porcentage2<50){
														echo "progress-bar-warning.png";
													}else{
														echo "progress-bar-success.png";
													}
												?>" style=" position: absolute;
										    			width: <?php if ($porcentage2 == 0) {
										    				echo "0%";
										    			}else{
										    				echo $porcentage2."%";
										    			} ?>;
										    			height: 17px;
													">
												<img src="./../../css/stu-prof/sous-bar.png" style="">
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td style="text-align: left;"> Administration </td>
									<td>
										<div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($porcentage3)." %"; ?></div>
										<div class="col-md-10" style="width:300px; float:left;">
											<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
													if($porcentage3<=20){
														echo "progress-bar-danger.png";
													}elseif($porcentage3>20 && $porcentage3<50){
														echo "progress-bar-warning.png";
													}else{
														echo "progress-bar-success.png";
													}
												?>" style=" position: absolute;
										    			width: <?php if ($porcentage3 == 0) {
										    				echo "0%";
										    			}else{
										    				echo $porcentage3."%";
										    			} ?>;
										    			height: 17px;
													">
												<img src="./../../css/stu-prof/sous-bar.png" style="">
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td style="text-align: left;"> Library </td>
									<td>
										<div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($porcentage4)." %"; ?></div>
										<div class="col-md-10" style="width:300px; float:left;">
											<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
													if($porcentage4<=20){
														echo "progress-bar-danger.png";
													}elseif($porcentage4>20 && $porcentage4<50){
														echo "progress-bar-warning.png";
													}else{
														echo "progress-bar-success.png";
													}
												?>" style=" position: absolute;
										    			width: <?php if ($porcentage4 == 0) {
										    				echo "0%";
										    			}else{
										    				echo $porcentage4."%";
										    			} ?>;
										    			height: 17px;
													">
												<img src="./../../css/stu-prof/sous-bar.png" style="">
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td style="text-align: left;"> Campus Tools </td>
									<td>
										<div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($porcentage5)." %"; ?></div>
										<div class="col-md-10" style="width:300px; float:left;">
											<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
													if($porcentage5<=20){
														echo "progress-bar-danger.png";
													}elseif($porcentage5>20 && $porcentage5<50){
														echo "progress-bar-warning.png";
													}else{
														echo "progress-bar-success.png";
													}
												?>" style=" position: absolute;
										    			width: <?php if ($porcentage5 == 0) {
										    				echo "0%";
										    			}else{
										    				echo $porcentage5."%";
										    			} ?>;
										    			height: 17px;
													">
												<img src="./../../css/stu-prof/sous-bar.png" style="">
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td style="text-align: left;"> Overall </td>
									<td>
										<div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($overall)." %"; ?></div>
										<div class="col-md-10" style="width:300px; float:left;">
											<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
													if($overall<=20){
														echo "progress-bar-danger.png";
													}elseif($overall>20 && $overall<50){
														echo "progress-bar-warning.png";
													}else{
														echo "progress-bar-success.png";
													}
												?>" style=" position: absolute;
										    			width: <?php if ($overall == 0) {
										    				echo "0%";
										    			}else{
										    				echo $overall."%";
										    			} ?>;
										    			height: 17px;
													">
												<img src="./../../css/stu-prof/sous-bar.png" style="">
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
	        	<?php endif ?>
				<?php
		        	}
		      $ttl_pr1 = $ttl_pr1/$nb_pr1;
					$ttl_pr2 = $ttl_pr2/$nb_pr2;
					$ttl_pr3 = $ttl_pr3/$nb_pr3;
					$ttl_pr4 = $ttl_pr4/$nb_pr4;
					$ttl_pr5 = $ttl_pr5/$nb_pr5;
          // if ($ttl_pr1 > 100) {
          //   $ttl_pr1 = 100;
          // }
          // if ($ttl_pr2 > 100) {
          //   $ttl_pr2 = 100;
          // }
          // if ($ttl_pr3 > 100) {
          //   $ttl_pr3 = 100;
          // }
          // if ($ttl_pr4 > 100) {
          //   $ttl_pr4 = 100;
          // }
          // if ($ttl_pr5 > 100) {
          //   $ttl_pr5 = 100;
          // }
          $div = 0;
          if ($ttl_pr1 != 0) {
            $div++;
          }
          if ($ttl_pr2 != 0) {
            $div++;
          }
          if ($ttl_pr3 != 0) {
            $div++;
          }
          if ($ttl_pr4 != 0) {
            $div++;
          }
          if ($ttl_pr5 != 0) {
            $div++;
          }

				?>
			</div>
		</div>

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
												<th class="col-md-4" style="text-align: center;">Satisfaction Rate</th>

											</tr>
										</thead>
										<tbody>
											<tr>
												<td style="text-align: left;">Satisfaction Curriculm </td>
												<td>
													<div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($ttl_pr1)." %"; ?></div>
													<div class="col-md-10" style="width:300px; float:left;">
														<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
																if($ttl_pr1<=20){
																	echo "progress-bar-danger.png";
																}elseif($ttl_pr1>20 && $ttl_pr1<50){
																	echo "progress-bar-warning.png";
																}else{
																	echo "progress-bar-success.png";
																}
															?>" style=" position: absolute;
													    			width: <?php if ($ttl_pr1 == 0) {
													    				echo "0%";
													    			}else{
													    				echo $ttl_pr1."%";
													    				}
													    				?>;
													    			height: 17px;
																">
															<img src="./../../css/stu-prof/sous-bar.png" style="">
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td style="text-align: left;"> Faculty </td>
												<td>
													<div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($ttl_pr2)." %"; ?></div>
													<div class="col-md-10" style="width:300px; float:left;">
														<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
																if($ttl_pr2<=20){
																	echo "progress-bar-danger.png";
																}elseif($ttl_pr2>20 && $ttl_pr2<50){
																	echo "progress-bar-warning.png";
																}else{
																	echo "progress-bar-success.png";
																}
															?>" style=" position: absolute;
													    			width: <?php if ($ttl_pr2 == 0) {
													    				echo "0%";
													    			}else{
													    				echo $ttl_pr2."%";
													    			} ?>;
													    			height: 17px;
																">
															<img src="./../../css/stu-prof/sous-bar.png" style="">
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td style="text-align: left;"> Administration </td>
												<td>
													<div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($ttl_pr3)." %"; ?></div>
													<div class="col-md-10" style="width:300px; float:left;">
														<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
																if($ttl_pr3<=20){
																	echo "progress-bar-danger.png";
																}elseif($ttl_pr3>20 && $ttl_pr3<50){
																	echo "progress-bar-warning.png";
																}else{
																	echo "progress-bar-success.png";
																}
															?>" style=" position: absolute;
													    			width: <?php if ($ttl_pr3 == 0) {
													    				echo "0%";
													    			}else{
													    				echo $ttl_pr3."%";
													    			} ?>;
													    			height: 17px;
																">
															<img src="./../../css/stu-prof/sous-bar.png" style="">
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td style="text-align: left;"> Library </td>
												<td>
													<div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($ttl_pr4)." %"; ?></div>
													<div class="col-md-10" style="width:300px; float:left;">
														<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
																if($ttl_pr4<=20){
																	echo "progress-bar-danger.png";
																}elseif($ttl_pr4>20 && $ttl_pr4<50){
																	echo "progress-bar-warning.png";
																}else{
																	echo "progress-bar-success.png";
																}
															?>" style=" position: absolute;
													    			width: <?php if ($ttl_pr4 == 0) {
													    				echo "0%";
													    			}else{
													    				echo $ttl_pr4."%";
													    			} ?>;
													    			height: 17px;
																">
															<img src="./../../css/stu-prof/sous-bar.png" style="">
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td style="text-align: left;"> Campus Tools </td>
												<td>
													<div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($ttl_pr5)." %"; ?></div>
													<div class="col-md-10" style="width:300px; float:left;">
														<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
																if($ttl_pr5<=20){
																	echo "progress-bar-danger.png";
																}elseif($ttl_pr5>20 && $ttl_pr5<50){
																	echo "progress-bar-warning.png";
																}else{
																	echo "progress-bar-success.png";
																}
															?>" style=" position: absolute;
													    			width: <?php if ($ttl_pr5 == 0) {
													    				echo "0%";
													    			}else{
													    				echo $ttl_pr5."%";
													    			} ?>;
													    			height: 17px;
																">
															<img src="./../../css/stu-prof/sous-bar.png" style="">
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<?php $ttl_ovrall = ($ttl_pr1+$ttl_pr2+$ttl_pr3+$ttl_pr4+$ttl_pr5)/$div; ?>
												<td style="text-align: left;"> Overall </td>
												<td>
													<div class="col-md-2" style="width:89px; float: left;text-align: right;"><?php echo round($ttl_ovrall)." %"; ?></div>
													<div class="col-md-10" style="width:300px; float:left;">
														<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
																if($ttl_ovrall<=20){
																	echo "progress-bar-danger.png";
																}elseif($ttl_ovrall>20 && $ttl_ovrall<50){
																	echo "progress-bar-warning.png";
																}else{
																	echo "progress-bar-success.png";
																}
															?>" style=" position: absolute;
													    			width: <?php if ($ttl_ovrall == 0) {
													    				echo "0%";
													    			}else{
													    				echo $ttl_ovrall."%";
													    			} ?>;
													    			height: 17px;
																">
															<img src="./../../css/stu-prof/sous-bar.png" style="">
														</div>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
						</div>

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
