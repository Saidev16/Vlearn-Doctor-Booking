<?php if (isset($_GET['result_employer'])): ?>
	<?php


	$annee = "";
	$where = "";

	if ((isset($_POST['annee'])) && $_POST['annee'] != 0) {
		$annee2 = $_SESSION['annee'] = $_POST['annee'];
		$annee3=$annee2+1;
		$where = " (e.date  BETWEEN '$annee2-09-01' AND '$annee3-09-30' or e.datemba  BETWEEN '$annee2-09-01' AND '$annee3-09-30' or e.datedba  BETWEEN '$annee2-09-01' AND '$annee3-09-30')  ";
	}else if($_SESSION['annee'] != "") {
		$annee2 = $_SESSION['date'];
		$annee3=$annee2+1;
		$where = " (e.date  BETWEEN '$annee2-09-01' AND '$annee3-09-30' or e.datemba  BETWEEN '$annee2-09-01' AND '$annee3-09-30' or e.datedba  BETWEEN '$annee2-09-01' AND '$annee3-09-30') ";
	}


	$sql_etu_insc = "SELECT `code_inscription` FROM
	`tbl_etudiant` as e WHERE $where
	UNION
	SELECT `code_inscription` FROM
	`tbl_etudiant_eng` as e
	WHERE $where";
	//$where_relation = "and e.code_inscription = r.code_inscription and r.id = em.result_id";
	$where_relation = " r.code_inscription in ($sql_etu_insc) and r.id = em.result_id";
	$where_result = "and em.result_id = rm.employer_id";




	$sql_etu="SELECT distinct(em.result_id),em.result_id,em.email FROM  resultat_alumni as r , Employer as em, result_employer as rm  WHERE $where_relation $where_result";
	//var_dump($sql_etu);
	$req_etu = @mysql_query($sql_etu);


	$employer_id = "(0,";
	while ($row = mysql_fetch_assoc($req_etu)) {
		$result_id = $row['result_id'];
		//var_dump($result_id);
		$employer_id .= "$result_id,";
	}
	$employer_id .= "0)";

	//var_dump($employer_id);
	?>
	<style media="print">
    @media print {
       .tr_pr {
         display: none !important;
       }
    }
</style>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th colspan="3" style="font-size: 16px;font-weight: 500;color: #000;text-align:center">
					EMPLOYER SURVEY RESULTS
				</th>
			</tr>
		</thead>
		<thead>
			<tr>
				<form action="?result_employer" method="POST">
				<th colspan="2">
					<select class="form-control année" name="annee">
						<option value="0">Year</option>
						<option value="2016" <?php if ($annee == 2016){ echo "selected";} ?> >2016-2017</option>
						<option value="2017" <?php if ($annee == 2017){ echo "selected";} ?> >2017-2018</option>
						<option value="2018" <?php if ($annee == 2018){ echo "selected";} ?> >2018-2019</option>
						<option value="2019" <?php if ($annee == 2019){ echo "selected";} ?> >2019-2020</option>
						<option value="2019" <?php if ($annee == 2020){ echo "selected";} ?> >2020-2021</option>
					</select>
				</th>
				<th colspan="1">
					<button class="btn btn-success">Search</button>
					</form>
				</th>
			</tr>
		</thead>
		<thead>
			<tr>
				<?php

					$sql_count_employer = "SELECT count(DISTINCT(em.result_id)) as nb from  resultat_alumni as r , Employer as em, result_employer as rm where $where_relation";
					//var_dump($sql_count_employer);
					$req_count_employer = @mysql_query($sql_count_employer);
					$row_count_employer = @mysql_fetch_assoc($req_count_employer);
					$ttl_employer = $row_count_employer['nb'];

					$sql_count_employer = "SELECT count(DISTINCT(em.result_id)) as nb from  resultat_alumni as r , Employer as em, result_employer as rm where $where_relation $where_result";
					$req_count_employer = @mysql_query($sql_count_employer);
					$row_count_employer = @mysql_fetch_assoc($req_count_employer);
					$nb_employer = $row_count_employer['nb'];



				?>
				<th colspan="3">Employer Response : <?php echo $nb_employer ?> out of <?php echo $ttl_employer; ?> | <?php echo round(($nb_employer/$ttl_employer)*100,2); ?>% response rate</th>
			</tr>
		</thead>
		<thead>
			<th colspan="3">
				<table class="table table-bordered table-responsive">

					<thead>
						<tr class="col-md-12">
							<th class="col-md-4" style="text-align: center;">Total percentage of satisfaction By Question</th>

						</tr>
					</thead>
					<tbody>
						<?php
						$employers_overal_satisfaction = 0;
						$question_array = array(28,29,30);
						$sql_question = "SELECT * FROM `questions_alumni` WHERE `type` = 'employer' and id_question = 0";

						$req_question = @mysql_query($sql_question);
						while ($row_question = mysql_fetch_assoc($req_question)) {
							$question  = $row_question['question'];
							$parent_question_id = $row_question['id'];

						 ?>

						<?php
								// If the question has a child question
								$sql_question_kid = "SELECT * FROM `questions_alumni` WHERE `type` = 'employer' and id_question = $parent_question_id";
								$req_question_kid = @mysql_query($sql_question_kid);
								$child_count = mysql_num_rows($req_question_kid); ?>
								<tr>
									<th style="text-align: left;width: 500px;height: 50px;"><?php echo $question; ?>
									</th>
								<?php
								if ($child_count == 0) {
											//$($where) and
											$sql_new = "SELECT count(distinct(re.`employer_id`)) as nb ,re.`question_id`, re.`reponse_id` , rep.`porcentage` as porcentage , rep.type
											FROM
											result_employer as re,
											`tbl_reponse_alumni` as rep
											WHERE
											re.employer_id in $employer_id and
											re.`reponse_id` = rep.`id`and
											re.`question_id` in ($parent_question_id)
											group by rep.`porcentage`,re.`employer_id`,re.`question_id`";

											$req_new = @mysql_query($sql_new);
											$satisfaction = 0;
											$nbQ = 0;
											$type = "";
											while ($row_new = mysql_fetch_array($req_new)) {
													$type = $row_new['type'];
													if ($type == "choix") {
														$satisfaction = $satisfaction + $row_new['porcentage'];
														$nbQ++;
													}
											}
											$ttl_satisfaction = $ttl_satisfaction+(round($satisfaction/$nbQ));
											$porcentage = round($satisfaction/$nbQ);
											if ($type == "text" or $type == "textaerea") {
												// number of result
												$sql_count_employer = "SELECT count(employer_id) as nb FROM `result_employer` WHERE `question_id` = $parent_question_id";
												$req_count_employer = @mysql_query($sql_count_employer);
												$row_count_employer = @mysql_fetch_assoc($req_count_employer);
												$nb_result = $row_count_employer['nb'];
												//var_dump($nb_result);
												// number of employer
												$sql_count_employer = "SELECT count(DISTINCT(employer_id)) as nb FROM `result_employer`";
												$req_count_employer = @mysql_query($sql_count_employer);
												$row_count_employer = @mysql_fetch_assoc($req_count_employer);
												$nb_employer = $row_count_employer['nb'];
												//var_dump($nb_employer);
												// ttl response in result
												$sql_count_employer = "SELECT COUNT(`id`) as nb FROM `tbl_reponse_alumni` WHERE `question_id` = $parent_question_id";
												$req_count_employer = @mysql_query($sql_count_employer);
												$row_count_employer = @mysql_fetch_assoc($req_count_employer);
												$nb_answers = $row_count_employer['nb'];
												//var_dump($nb_answers);
												$porcentage = ($nb_result/($nb_answers*$nb_employer))*100;
											}

								 ?>

											 <td>
												 <div class="col-md-3"><?php echo round($porcentage,2)." %"; ?></div>
												 <div class="col-md-9">
													 <div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
															if($porcentage<=20){
																echo "progress-bar-danger.png";
															}elseif($porcentage>20 && $porcentage<50){
																echo "progress-bar-warning.png";
															}else{
																echo "progress-bar-success.png";
															}
														?>" style=" position: absolute;
																	width: <?php if ($porcentage == 0) {
																		echo "0%";
																	}else{
																		echo $porcentage."%";
																		}
																		?>;
																	height: 17px;
															">
														<img src="./../../css/stu-prof/sous-bar.png" style="">
													</div>
													 <!-- <div class="progress progress-striped active">
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
													 </div> -->
												 </div>
											 </td>
											 <td class="tr_pr" style="width:10%">
												 <?php if ($child_count == 0): ?>
	 												<a href="?detail_question=<?php echo $parent_question_id; ?>" target="_blank" style="color: #fff;text-align: center;margin-left: auto;margin-right: auto;display: block;" class="btn btn-success" >Detail</a>
	 											<?php endif; ?>
											 </td>
								<?php
									if (in_array($parent_question_id,$question_array)) {
										$employers_overal_satisfaction += $porcentage;
									}
							}else{
									while ($row_question_kid = mysql_fetch_assoc($req_question_kid)) {
											$question  = $row_question_kid['question'];
											$question_kid_id = $row_question_kid['id'];
											// $sql_new = "SELECT count(distinct(r.`code_inscription`)) as nb ,re.`question_id`, re.`reponse_id` , rep.`porcentage` as porcentage , rep.type FROM `resultat_alumni` as r ,result_employer as re, `tbl_reponse_alumni` as rep , `tbl_etudiant` as et WHERE
											// -- ($where) and
											// r.id = re.employer_id and
											// re.`reponse_id` = rep.`id`and
											// re.`question_id` in ($question_kid_id) and
											// r.`code_inscription` = et.`code_inscription`
											// group by rep.`porcentage`,et.`code_inscription`,re.`question_id`";
											$sql_new = "SELECT count(distinct(re.`employer_id`)) as nb ,re.`question_id`, re.`reponse_id` , rep.`porcentage` as porcentage , rep.type
											FROM
											result_employer as re,
											`tbl_reponse_alumni` as rep
											WHERE
											re.employer_id in $employer_id and
											re.`reponse_id` = rep.`id`and
											re.`question_id` in ($question_kid_id)
											group by rep.`porcentage`,re.`employer_id`,re.`question_id`";
											//var_dump($sql_new);
											$req_new = @mysql_query($sql_new);
											$satisfaction = 0;
											$nbQ = 0;
											$type = "";
											while ($row_new = mysql_fetch_array($req_new)) {
													$type = $row_new['type'];
													$satisfaction = $satisfaction + $row_new['porcentage'];
													$nbQ++;
											}
											$ttl_satisfaction = $ttl_satisfaction+(round($satisfaction/$nbQ));
											$porcentage = round($satisfaction/$nbQ);

								 ?>
								 <?php if ($type == "choix" && $porcentage != 0){ ?>
										 <tr>
											 <td style="text-align: left;width: 500px;height: 50px;">
												 <?php echo $question ?>
											 </td>
											 <td>
												 <div class="col-md-3"><?php echo round($porcentage,2)." %"; ?></div>
												 <div class="col-md-9">
													 <div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
															if($porcentage<=20){
																echo "progress-bar-danger.png";
															}elseif($porcentage>20 && $porcentage<50){
																echo "progress-bar-warning.png";
															}else{
																echo "progress-bar-success.png";
															}
														?>" style=" position: absolute;
																	width: <?php if ($porcentage == 0) {
																		echo "0%";
																	}else{
																		echo $porcentage."%";
																		}
																		?>;
																	height: 17px;
															">
														<img src="./../../css/stu-prof/sous-bar.png" style="">
													</div>
													 <!-- <div class="progress progress-striped active">
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
													 </div> -->
												 </div>
											 </td>
											 <td class="tr_pr" style="width:10%">
												 <a href="?detail_question=<?php echo $question_kid_id; ?>" target="_blank" style="color: #fff;text-align: center;margin-left: auto;margin-right: auto;display: block;" class="btn btn-success" >Detail</a>
											 </td>
								 <?php
										 if (in_array($question_kid_id,$question_array)) {
											 $employers_overal_satisfaction += $porcentage;
										 }
									}
								}
							}
							echo "</tr>";
						}
						$porcentage = $employers_overal_satisfaction/3;
						?>
						<tr>
							<td style="text-align: left;width: 500px;height: 50px;">
								Employer Overall Satisfaction
							</td>
							<td>
								<div class="col-md-3"><?php echo round($porcentage,2)." %"; ?></div>
								<div class="col-md-9">
									<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
										 if($porcentage<=20){
											 echo "progress-bar-danger.png";
										 }elseif($porcentage>20 && $porcentage<50){
											 echo "progress-bar-warning.png";
										 }else{
											 echo "progress-bar-success.png";
										 }
									 ?>" style=" position: absolute;
												 width: <?php if ($porcentage == 0) {
													 echo "0%";
												 }else{
													 echo $porcentage."%";
													 }
													 ?>;
												 height: 17px;
										 ">
									 <img src="./../../css/stu-prof/sous-bar.png" style="">
								 </div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</th>
		</thead>
</table>
<?php endif ?>
