<?php if (isset($_GET['admin_alumni_result'])){
	//calcule
	$annee = "";
	$session = "";
	$if = 0;
	$where = "";
	if (isset($_POST['annee']) && $_POST['annee'] != 0) {
		$annee = $_POST['annee'];
		$if = 1;
		$where ="e.`date` like \"%$annee%\" or e.`datemba` like \"%$annee%\"";
	}else{
		$where = "e.`date` != \"0000-00-00\" or e.`datemba` != \"0000-00-00\" ";
	}

	$sql_etu="SELECT `code_inscription`,`nom`,`prenom`,`email`,`ville`,`date_inscription`, `niveau`, `laureatbba`, `laureatmba`, `date_inscription_mba`,date,datemba,datedba FROM `tbl_etudiant_deac` as e WHERE $where";


	$req_etu = @mysql_query($sql_etu);
	$completed = 0;
	$incompleted = 0;
	$lu = 0;
	$send = 0;
	$i= 0;


?>

<div class="row">
	<div class="col-12">
		<div class="card-header" style="background-color: #fff !important;">
			<div class="row show-grid">
				<div class="col-md-8 col-xs-12 mt-2">
					<a href="#" data-toggle="modal" data-target="#modal_search" class="btn btn-outline-warning btn-sm btn-rounded"> <i class="fa fa-search text-warning mr-10" data-toggle="tooltip" data-original-title="Detail"></i> Advanced Search </a>
				</div>
				<div class="col-md-4 col-xs-12">
					<div class="social-info col-md-12">
						<div class="row">
							<div class="col-sm-4 text-center">
								<span class="counts block head-font">
									<span class="counter-anim counter-count bba_num"><?php echo $bba ?></span>
								</span>
								<span class="counts-text block label label-success">BBA Students</span>
							</div>
							<div class="col-sm-4 text-center">
								<span class="counts block head-font">
									<span class="counter-anim counter-count mba_num"><?php echo $mba ?></span>
								</span>
								<span class="counts-text block label label-success">MBA Students</span>
							</div>
							<div class="col-sm-4 text-center">
								<span class="counts block head-font">
									<span class="counter-anim counter-count dba_num"><?php echo $dba; ?></span>
								</span>
								<span class="counts-text block label label-success">DBA Students</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

    <div class="card">
          <div class="card-body">
              <h4 class="card-title">Alumni Students</h4>
              <h6 class="card-subtitle">Result of Alumni Survey</h6>
              <div class="table-responsive">
                  <table class="table color-table primary-table">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Name </th>
                              <th class="text-center">Alumni Level</th>
                              <th class="text-center">Alumni date</th>
															<th class="text-center">Survey Completed</th>
                          </tr>
                      </thead>
											<tbody>
										<?php
											while ($row_etu = mysql_fetch_assoc($req_etu)) {
												$code_inscription = $row_etu['code_inscription'];
												$sql_resultat_alumni = "SELECT Distinct(code_inscription) FROM `resultat_alumni` WHERE `code_inscription` = '$code_inscription'";
												$req_resultat_alumni = @mysql_query($sql_resultat_alumni);
												$row_resultat_alumni = mysql_fetch_assoc($req_resultat_alumni);

												// echo $row_etu['nom']." ".$row_etu['prenom']."</br>";
												// echo $row_etu['date']."</br>";
												// echo $row_etu['datemba']."</br>";
												// echo $row_etu['datedba']."</br>";
												// if ($row_resultat_alumni['code_inscription'] != null) {
												// 	echo "Survey : Yes";
												// }else{
												// 	echo "Survey : No";
												// }
												// echo "</br></br></br>";
												?>
	                          <tr>
	                              <td></td>
	                              <td><?php echo $row_etu['nom']." ".$row_etu['prenom']; ?></td>
	                              <td class="text-center"><?php echo $row_etu['niveau']; ?></td>
																<td class="text-center">
																	<?php if ($row_etu['niveau'] == "BBA"): ?>
																		 <?php echo $row_etu['date']; ?>
																	<?php endif; ?>
																	<?php if ($row_etu['niveau'] == "MBA"): ?>
																		 <?php echo $row_etu['datemba']; ?>
																	<?php endif; ?>
																	<?php if ($row_etu['niveau'] == "DBA"): ?>
																		 <?php echo $row_etu['datedba']; ?>
																	<?php endif; ?>
																</td>
	                              <td class="text-center">
																	<?php
																		if ($row_resultat_alumni['code_inscription'] != null) {
																			echo "Yes";
																		}else{
																			echo "No";
																		}
																	 ?>
																</td>
	                          </tr>


											<?php
											}
											?>
											</tbody>
										</table>
									</div>
								</div>
							</div>

<?php } ?>
