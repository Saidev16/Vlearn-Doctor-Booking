<?php if (isset($_GET['admin_alumni_result'])): ?>
	<?php
		// student alumni

		//calcule
		$annee = "";
		$session = "";
		$if = 0;
		$where = "";
//		if (isset($_POST['annee']) && $_POST['annee'] != 0) {
//			$annee = $_POST['annee'];
//			$if = 1;
//			$where ="e.`date` like \"%$annee%\" or e.`datemba` like \"%$annee%\" or e.`datedba` like \"%$annee%\"";
//		}else{
//			$where = "e.`date` != \"0000-00-00\" or e.`datemba` != \"0000-00-00\" or e.`datedba` like \"0000-00-00\"";
//		}

    if ((isset($_POST['annee'])) && $_POST['annee'] != 0) {
      $annee2 = $_SESSION['annee'] = $_POST['annee'];
      $annee3=$annee2+1;
      $where = " (e.date  BETWEEN '$annee2-09-01' AND '$annee3-09-30' or e.datemba  BETWEEN '$annee2-09-01' AND '$annee3-09-30' or e.datedba  BETWEEN '$annee2-09-01' AND '$annee3-09-30') ";
    }else if($_SESSION['annee'] != "") {
      $annee2 = $_SESSION['date'];
      $annee3=$annee2+1;
      $where = " (e.date  BETWEEN '$annee2-09-01' AND '$annee3-09-30' or e.datemba  BETWEEN '$annee2-09-01' AND '$annee3-09-30' or e.datedba  BETWEEN '$annee2-09-01' AND '$annee3-09-30') ";
    }

		$sql_etu="SELECT `code_inscription`,`nom`,`prenom`,`email`,`ville`,`date_inscription`, `niveau`, `laureatbba`, `laureatmba`, `date_inscription_mba` FROM
		`tbl_etudiant` as e
		WHERE $where";
		$sql_etu = "
		SELECT `code_inscription` FROM
		`tbl_etudiant` as e WHERE $where
		UNION
		SELECT `code_inscription` FROM
		`tbl_etudiant_eng` as e
		WHERE $where";

		$req_etu = @mysql_query($sql_etu);
		$completed = 0;
		$incompleted = 0;
		$lu = 0;
		$send = 0;
		$i= 0;
		while ($row_etu = mysql_fetch_assoc($req_etu)) {
			$code_inscription = $row_etu['code_inscription'];
			$sql_question = "SELECT `id` FROM `questions_alumni` WHERE `active` = 0";
			$req_question = @mysql_query($sql_question);
			$sql_res = "SELECT `id_reponse` FROM `resultat_alumni` WHERE `id_question` = 12 and `code_inscription` = \"$code_inscription\"";
			$req_res = @mysql_query($sql_res);
			$row_res = mysql_fetch_array($req_res);
			$id_reponse_res = $row_res['id_reponse'];
			if ($id_reponse_res != null) {
				$sql = "SELECT `porcentage` FROM `tbl_reponse_alumni` WHERE `id` = $id_reponse_res";
				$req = @mysql_query($sql);
				$row = mysql_fetch_array($req);
				$porcentage = $row['porcentage'];
				if ($porcentage >= 90  ) {
					$degree = "true";
				}else{
					$degree = "false";
				}
			}else{
				$degree = "false";
			}
			$q = 0;
			$t = 0;
			while ($row_question = mysql_fetch_assoc($req_question)){
				$row_id = $row_question['id'];
				$sql_reponse="SELECT count(`id`) FROM `tbl_reponse_alumni` WHERE `statut` = 0 and `question_id` = $row_id and (`type` = 'text' or `type` = 'textaerea') ";
				//echo $sql_reponse;
				$req_reponse = @mysql_query($sql_reponse);
				$row_count_reponse = mysql_fetch_array($req_reponse);
				$count_reponse = $row_count_reponse['0'];
				//echo $count_reponse;
				if($count_reponse >= 2){
					$q = $q + $count_reponse;
					$t = $t + $count_reponse;
				}elseif($count_reponse = 1){
					$q++;
				}

			}
			//echo $t;
			if ($degree == 'false') {
				$q = $q-$t;
			}
			$sql_question = "SELECT count(distinct `id_question`) FROM `questions_alumni` WHERE `id_question` != 0 and `active` = 0";
			//echo $sql_question;
			$req_question = @mysql_query($sql_question);
			$row_question = mysql_fetch_array($req_question);
			$count_question = $row_question['0'];
			//echo $count_question;
			$q = $q - $count_question;


      $sql_count_res = "SELECT count(`id_question`) FROM `resultat_alumni` WHERE `code_inscription` = \"$code_inscription\"";
			$req_count_res = @mysql_query($sql_count_res);
			$row_count_res = mysql_fetch_array($req_count_res);
			$count_res = $row_count_res['0'];
			if ($count_res == $q) {
				$sql_complet = "UPDATE `tbl_etudiant` SET `survey_alumni` = 1 where `code_inscription` = \"$code_inscription\"";
				@mysql_query($sql_complet);
				$completed++;
				$finnish = "true";
			}else{
				$sql_complet = "UPDATE `tbl_etudiant` SET `survey_alumni` = 0 where `code_inscription` = \"$code_inscription\"";
				@mysql_query($sql_complet);
				$incompleted++;
				$finnish = "false";

			}
			if ($row_etu['survey_alumni_read'] == 1) {
				$lu++;
			}
			if ($row_etu['survey_alumni_send'] == 1) {
				$send++;
			}
			$i++;
		}

		$id_sondage =6;
		$id_question = array(7,5,6,10);
		$porcentage = array();
		$total = array();
		//foreach ($years as $k => $v) {
		  // Alumni students by year
		  // Quality of Education
			 if ((isset($_POST['annee'])) && $_POST['annee'] != 0) {
            $annee2 = $_SESSION['annee'] = $_POST['annee'];
            $annee3=$annee2+1;
            $where = " et.date  BETWEEN '$annee2-09-01' AND '$annee3-09-30' or et.datemba  BETWEEN '$annee2-09-01' AND '$annee3-09-30' or et.datedba  BETWEEN '$annee2-09-01' AND '$annee3-09-30' ";

        }else if($_SESSION['annee'] != "") {
            $annee2 = $_SESSION['date'];
            $annee3=$annee2+1;
            $where = " et.date  BETWEEN '$annee2-09-01' AND '$annee3-09-30' or et.datemba  BETWEEN '$annee2-09-01' AND '$annee3-09-30' or et.datedba  BETWEEN '$annee2-09-01' AND '$annee3-09-30' ";
        }
		  $ttl_satisfaction = 0;
			$porcentage = array();
			$v = 0;
		  foreach ($id_question as $id) {
		    if ($id != 6) {
		      $sql_new = "SELECT count(distinct(r.`code_inscription`)) as nb ,`id_question`, r.`id_reponse` , rep.`porcentage` as porcentage FROM `resultat_alumni` as r , `tbl_reponse_alumni` as rep
					WHERE
		      r.`id_reponse` = rep.`id`and
		      r.`id_question` = $id and
		      r.`code_inscription` in ($sql_etu)
		      group by rep.`porcentage`,r.`code_inscription`,`id_question`";
		      //var_dump($sql_new);
		      $req_new = @mysql_query($sql_new);
		      $satisfaction = 0;
		      $nbQ = 0;
		      while ($row_new = mysql_fetch_array($req_new)) {
		          $satisfaction = $satisfaction + $row_new['porcentage'];
		          $nbQ++;
		      }
		      $ttl_satisfaction = $ttl_satisfaction+(round($satisfaction/$nbQ));
		      $porcentage[$v] = round($satisfaction/$nbQ);
					$v++;
		    }else{
		      $sql_new = "SELECT count(distinct(r.`code_inscription`)) as nb ,`id_question`, r.`id_reponse` , rep.`porcentage` as porcentage FROM `resultat_alumni` as r , `tbl_reponse_alumni` as rep WHERE
		      r.`id_reponse` = rep.`id`and
		      r.`id_question` in (6,2,3) and
		      r.`code_inscription` in ($sql_etu)
		      group by rep.`porcentage`,r.`code_inscription`,`id_question`";
		      //var_dump($sql_new);
		      $req_new = @mysql_query($sql_new);
		      $satisfaction = 0;
		      $nbQ = 0;
		      while ($row_new = mysql_fetch_array($req_new)) {
		          $satisfaction = $satisfaction + $row_new['porcentage'];
		          $nbQ++;
		      }
		      $ttl_satisfaction = $ttl_satisfaction+(round($satisfaction/$nbQ));
		      $porcentage[$v] = round($satisfaction/$nbQ);
					$v++;
		    }

		  }
		  //Overall satisfactions
		  $total[] = $ttl_satisfaction/4;
		//}
		// Placement rate
		$placement_rate = array();
		    // nb of employer + continuing education
		    $sql_new = "SELECT count(distinct(r.`code_inscription`)) as nb FROM `resultat_alumni` as r WHERE
		        r.`id_question` = 12 and
		        r.`id_reponse` in (47,48,49,50) and
		        r.`code_inscription` in ($sql_etu)";
		        //var_dump($sql_new);
		    $req_new = @mysql_query($sql_new);
		    $row_new = mysql_fetch_array($req_new);
		    $nb_e_c = $row_new['nb'];
				//var_dump($nb_e_c);
		    $placement_rate[] = round(($nb_e_c/$i)*100);


	?>
	<style media="print">
    @media print {
       .tr_pr {
         display: none !important;
       }
    }
</style>

	  <div style="display:none;margin-bottom: 0px;" class="alert alert-success" role="alert">
	  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class='fermer' aria-hidden="true">×</span></button>
	  	<strong>l'email du sondage est envoyé a <span class="nb_etu"></span></strong>
	  </div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th colspan="3" style="font-size: 16px;font-weight: 500;color: #000;text-align:center">
					ALUMNI SURVEY RESULTS
				</th>
			</tr>
		</thead>
		<thead>
			<tr>
				<form action="?admin_alumni_result" method="POST">
				<th colspan="2">
					<select class="form-control année" name="annee">
						<option value="0">Year</option>
						<option value="2016" <?php if ($annee == 2016){ echo "selected";} ?> >2016-2017</option>
						<option value="2017" <?php if ($annee == 2017){ echo "selected";} ?> >2017-2018</option>
						<option value="2018" <?php if ($annee == 2018){ echo "selected";} ?> >2018-2019</option>
						<option value="2019" <?php if ($annee == 2019){ echo "selected";} ?> >2019-2020</option>
						<option value="2020" <?php if ($annee == 2020){ echo "selected";} ?> >2020-2021</option>
					</select>
				</th>
				<th colspan="1">
					<button class="btn btn-success">Search</button>
					</form>
				</th>
			</tr>
		</thead>
		<thead>
			<th colspan="3">
				<table class="table table-bordered table-responsive">

					<thead>
						<tr class="col-md-12">
							<th class="col-md-4" style="text-align: center;">Total percentage of satisfaction</th>

						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="text-align: center;width: 400px;"> Quality of Education </td>
							<td>
								<div class="col-md-3"><?php echo round($porcentage[0],2)." %"; ?></div>
								<div class="col-md-9">
									<!-- <div class="progress progress-striped active">
										<div class="progress-bar
											<?php
												if($porcentage[0]<=20){
													echo "progress-bar-danger";
												}elseif($porcentage[0]>20 && $porcentage[0]<50){
													echo "progress-bar-warning";
												}else{
													echo "progress-bar-success";
												}
											?>"
											role="progressbar"
											aria-valuenow="<?php echo $porcentage[0]; ?>"
											aria-valuemin="0"
											aria-valuemax="100"
											style="width:
												<?php echo $porcentage[0];
												?>%">
										</div>
									</div> -->
									<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
										 if($porcentage[0]<=20){
											 echo "progress-bar-danger.png";
										 }elseif($porcentage[0]>20 && $porcentage[0]<50){
											 echo "progress-bar-warning.png";
										 }else{
											 echo "progress-bar-success.png";
										 }
									 ?>" style=" position: absolute;
												 width: <?php if ($porcentage[0] == 0) {
													 echo "0%";
												 }else{
													 echo $porcentage[0]."%";
													 }
													 ?>;
												 height: 17px;
										 ">
									 <img src="./../../css/stu-prof/sous-bar.png" style="">
								 </div>
								</div>
							</td>
						</tr>
						<!-- <tr>
							<td style="text-align: left;"> Satisfied ( <?php echo $ttl_sat_result." / ".$ttl_etudiant_result; ?> ) Surveys</td>
							<td>
							<?php $pr_sat_result = ($ttl_sat_result/$ttl_result_sat)*100; ?>
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
						</tr> -->
						<tr>
							<td style="text-align: left;"> Value Education/Tuition </td>
							<td>
								<div class="col-md-3"><?php echo round($porcentage[1],2)." %"; ?></div>
								<div class="col-md-9">
									<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
										 if($porcentage[1]<=20){
											 echo "progress-bar-danger.png";
										 }elseif($porcentage[1]>20 && $porcentage[1]<50){
											 echo "progress-bar-warning.png";
										 }else{
											 echo "progress-bar-success.png";
										 }
									 ?>" style=" position: absolute;
												 width: <?php if ($porcentage[1] == 0) {
													 echo "0%";
												 }else{
													 echo $porcentage[1]."%";
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
							<td style="text-align: left;"> Performance Improvement </td>
							<td>
								<div class="col-md-3"><?php echo round($porcentage[2],2)." %"; ?></div>
								<div class="col-md-9">
									<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
										 if($porcentage[2]<=20){
											 echo "progress-bar-danger.png";
										 }elseif($porcentage[2]>20 && $porcentage[2]<50){
											 echo "progress-bar-warning.png";
										 }else{
											 echo "progress-bar-success.png";
										 }
									 ?>" style=" position: absolute;
												 width: <?php if ($porcentage[2] == 0) {
													 echo "0%";
												 }else{
													 echo $porcentage[2]."%";
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
							<td style="text-align: left;"> Referral rate </td>
							<td>
								<div class="col-md-3"><?php echo round($porcentage[3],2)." %"; ?></div>
								<div class="col-md-9">
									<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
										 if($porcentage[3]<=20){
											 echo "progress-bar-danger.png";
										 }elseif($porcentage[3]>20 && $porcentage[3]<50){
											 echo "progress-bar-warning.png";
										 }else{
											 echo "progress-bar-success.png";
										 }
									 ?>" style=" position: absolute;
												 width: <?php if ($porcentage[3] == 0) {
													 echo "0%";
												 }else{
													 echo $porcentage[3]."%";
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
							<td style="text-align: left;"> Academic Satisfaction </td>
							<td>
								<div class="col-md-3"><?php echo round($porcentage[3],2)." %"; ?></div>
								<div class="col-md-9">
									<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
										 if($porcentage[3]<=20){
											 echo "progress-bar-danger.png";
										 }elseif($porcentage[3]>20 && $porcentage[3]<50){
											 echo "progress-bar-warning.png";
										 }else{
											 echo "progress-bar-success.png";
										 }
									 ?>" style=" position: absolute;
												 width: <?php if ($porcentage[3] == 0) {
													 echo "0%";
												 }else{
													 echo $porcentage[3]."%";
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
							<td style="text-align: left;"> Overall Satisfaction </td>
							<td>
								<div class="col-md-3"><?php echo round($total[0],2)." %"; ?></div>
								<div class="col-md-9">
									<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
										 if($total[0]<=20){
											 echo "progress-bar-danger.png";
										 }elseif($total[0]>20 && $total[0]<50){
											 echo "progress-bar-warning.png";
										 }else{
											 echo "progress-bar-success.png";
										 }
									 ?>" style=" position: absolute;
												 width: <?php if ($total[0] == 0) {
													 echo "0%";
												 }else{
													 echo $total[0]."%";
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
							<td style="text-align: left;"> Placement Rate </td>
							<td>
								<div class="col-md-3"><?php echo round($placement_rate[0],2)." %"; ?></div>
								<div class="col-md-9">
									<!-- <div class="progress progress-striped active">
										<div class="progress-bar
											<?php
												if($placement_rate[0]<=20){
													echo "progress-bar-danger";
												}elseif($placement_rate[0]>20 && $placement_rate[0]<50){
													echo "progress-bar-warning";
												}else{
													echo "progress-bar-success";
												}
											?>"
											role="progressbar"
											aria-valuenow="<?php echo $placement_rate[0]; ?>"
											aria-valuemin="0"
											aria-valuemax="100"
											style="width:
												<?php echo $placement_rate[0];
												?>%">
										</div>
									</div> -->
									<div class="progress progress-striped active"	style="width: 270px;position: absolute;">	<img src="../../../css/stu-prof/<?php
										 if($placement_rate[0]<=20){
											 echo "progress-bar-danger.png";
										 }elseif($placement_rate[0]>20 && $placement_rate[0]<50){
											 echo "progress-bar-warning.png";
										 }else{
											 echo "progress-bar-success.png";
										 }
									 ?>" style=" position: absolute;
												 width: <?php if ($placement_rate[0] == 0) {
													 echo "0%";
												 }else{
													 echo $placement_rate[0]."%";
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
		<thead>
			<?php

				$sql="SELECT count(distinct(r.`code_inscription`)) as nb FROM `tbl_etudiant` as et ,`resultat_alumni` as r WHERE ($where) and r.`code_inscription` = et.`code_inscription`
				UNION
				SELECT count(distinct(r.`code_inscription`)) as nb FROM `tbl_etudiant_eng` as et ,`resultat_alumni` as r WHERE ($where) and r.`code_inscription` = et.`code_inscription`
				";
			//	var_dump($sql);
				$req = @mysql_query($sql);
				$nb_student = 0;
				while ($row = mysql_fetch_assoc($req)) {
						$nb_student += $row['nb'];
				}

				//var_dump($nb_student);


				if ($annee == 2018) {
					$nb_student = 41;
				}
			 ?>
			<tr>
				<th colspan="3">Alumni Response : <?php echo $nb_student ?> out of <?php echo $i; ?> | <?php echo round($nb_student/$i*100,2); ?>% response rate</th>
			</tr>
		</thead>
		<thead>
			<tr>
				<th>Student</th>
				<th>Major</th>
				<!-- <th>Envoyer</th> -->
				<!-- <th>Lue</th> -->
				<th class="tr_pr">Responses</th>
			</tr>
		</thead>
		<tbody>
	<?php
		$sql="SELECT distinct(r.`code_inscription`),et.`nom`,et.`prenom`,et.`email`,et.`ville`,et.`date_inscription`, et.`niveau`, et.`laureatbba`, et.`laureatmba`, et.`date_inscription_mba` FROM `tbl_etudiant` as et ,`resultat_alumni` as r WHERE ($where) and r.`code_inscription` = et.`code_inscription`";
		//var_dump($sql);
		$req = @mysql_query($sql);
		$r = 0;

		while ($row = mysql_fetch_assoc($req)){
			$r++;
	?>
		<tr>
			<td style="text-align: left;" ><?php echo "Anonymous ".$r; echo "/  ".$row['code_inscription'];?></td>
			<td style="text-align: left;" ><?php echo $row['niveau']; ?></td>
			<!-- <td>
				<?php if ($row['survey_alumni_send'] == 0): ?>
					<?php echo "non"; ?>
				<?php endif ?>
				<?php if ($row['survey_alumni_send'] == 1): ?>
					<?php echo "oui"; ?>
				<?php endif ?>
			</td> -->
			<!-- <td>
				<?php if ($row['survey_alumni_read'] == 0): ?>
					<?php echo "non"; ?>
				<?php endif ?>
				<?php if ($row['survey_alumni_read'] == 1): ?>
					<?php echo "oui"; ?>
				<?php endif ?>
			</td> -->
			<td >
				<a class="tr_pr" href="gestion_sondage.php?admin_alumni_result_rep=<?php echo $row['code_inscription']; ?>">Click here</a>
			</td>
		</tr>
	<?php
				$last_code = $row['code_inscription'];
		}


	 ?>
	 </tbody>
</table>
<?php endif ?>
