	
<?php 
	
		if (isset($_GET['admin_alumni_result_rep']) && !empty($_GET['admin_alumni_result_rep'])) {
				$sondage_id = 6;
				$code_inscription = $_GET['admin_alumni_result_rep'];
				$sql_lu = "UPDATE `tbl_etudiant_gen` SET `survey_alumni_read` = 1 where `code_inscription` = \"$code_inscription\"";
				@mysql_query($sql_lu);
				$sql_sondage= "SELECT *  FROM `tbl_sondage` WHERE `id`=$sondage_id";
	        	
	        	$req_sondage = @mysql_query($sql_sondage);

	        	$row_sondage = mysql_fetch_assoc($req_sondage);

	        			//verification
				$sql_question = "SELECT distinct q.`id` FROM `questions_alumni` as q , `tbl_reponse_alumni` as r WHERE q.`active` = 0 and q.`id` = r.`question_id`";
				$req_question = @mysql_query($sql_question);
				$sql_res = "SELECT `id_reponse` FROM `resultat_alumni` WHERE `id_question` = 12 and `code_inscription` = \"$code_inscription\" and `id_sondage` = $sondage_id";
				$req_res = @mysql_query($sql_res);
				$row_res = mysql_fetch_array($req_res);
				$id_reponse_res = $row_res['id_reponse'];
				if ($id_reponse_res != null) {
					$sql = "SELECT `porcentage` FROM `tbl_reponse_alumni` WHERE `id` = $id_reponse_res";
					$req = @mysql_query($sql);
					$row = mysql_fetch_array($req);
					$porcentage = $row['porcentage'];
					if ($porcentage >= 90) {
						$degree = "true";
						$degree1 = "false";
					}elseif ($porcentage == 80) {
						$degree = "false";
						$degree1 = "true";
					}else{
						$degree = "false";
						$degree1 = "false";
					}
				}else{
					$degree = "false";
					$degree1 = "false";
				}

				$sql_res = "SELECT `id_reponse` FROM `resultat_alumni` WHERE `id_question` = 11 and `code_inscription` = \"$code_inscription\"";
				$req_res = @mysql_query($sql_res);
				$row_res = mysql_fetch_assoc($req_res);
				$id_reponse_res = $row_res['id_reponse'];
				if ($id_reponse_res != null) {
					$obl = "true";
				}else{
					$obl = "false";
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
					}else{
						$q++;
					}
					
				}
				if ($degree == 'false' && $degree1 == 'false') {
					
					$q = $q-$t;
				}elseif($degree == 'true'){
					$q = $q-3;
				}elseif ($degree1 == 'true') {
					$q = $q-6;
				}
				
				if ($obl == 'false') {
					$q = $q-1;
				}

				


	        	$sql_count_res = "SELECT count(`id_question`) FROM `resultat_alumni` WHERE `code_inscription` = \"$code_inscription\"";
				$req_count_res = @mysql_query($sql_count_res);
				$row_count_res = mysql_fetch_array($req_count_res);
				$count_res = $row_count_res['0'];				if ($count_res == $q) {
					$sql_complet = "UPDATE `tbl_etudiant_gen` SET `survey_alumni` = 1 where `code_inscription` = \"$code_inscription\"";
					@mysql_query($sql_complet);
					$finnish = "true";
				}else{
					$finnish = "false";
				}
	        	?>
	        	<?php if (isset($_SESSION['error']) && $_SESSION['error'] == 1): ?>
			        <div class="col-md-12">
						<div class="alert alert-danger">
								Thank you to fix all errors and click finish !
						</div>
					</div>
	        	<?php endif ?>
	        	
	        	<div class="section-finnish">
	        	<?php 

	        			
			        	if ($row_sondage != false) {
			        		
			        		//echo "<h2 style='text-align: center;' class='text-info'>".$row_sondage['titre_en']."</h2>"; 

			        		echo "<h2 style='text-align: left;' class='text-info'>Alumni Survey</h2>"; 

			        		echo "<blockquote> <p style='text-align:left'>".$_SESSION['name']."</p> </blockquote>";


			        		echo "<div style='font-size: 16px;' class='alert alert-warning' role='alert'> We're committed to monitoring the quality of our academic programs and curriculum, as part of an ongoing improvement process, we would appreciate your feedback on your overall satisfaction and any recommendations you might suggest. </div>";
								?>
								<!-- <form id="rootwizard" method="post" action="?task=sondage_request" class="form-horizontal form-wizard"> -->
									<?php 
										$sql_question_parent = "SELECT * FROM `questions_alumni` WHERE `id_question` = 0 and `active` = 0";
										$req_question_parent = @mysql_query($sql_question_parent);
										$i=0;
			        					while ($row_question_parent = mysql_fetch_assoc($req_question_parent)) {
			        						$i++;
			        						$id_parent = $row_question_parent['id'];
			        						$question_parent = $row_question_parent['question'];
			        						$count_question= "SELECT COUNT(*) FROM `questions_alumni` WHERE `active` = 0 and `id_question` = $id_parent";
			        						
								        	$req_count_question = @mysql_query($count_question);
								        	$row_count = mysql_fetch_array($req_count_question);
								        	$count = $row_count['0'];
								        	if ($id_parent == 12) {
												$sql_res = "SELECT `id_reponse` FROM `resultat_alumni` WHERE `id_question` = $id_parent and `code_inscription` = \"$code_inscription\" and `id_sondage` = $sondage_id";
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
											}
									 ?>
									<div class="row <?php echo "question_relation_".$id_parent; ?>" style="
										<?php if ($id_parent == 13): ?>
												<?php if ($degree == "false"): ?>
													display: none;
												<?php endif ?>
										<?php endif ?>
										<?php if ($id_parent == 14): ?>
												<?php if ($degree1 == "false"): ?>
													display: none;
												<?php endif ?>
										<?php endif ?>
										">
										<div class="col-sm-12 col-md-12 col-lg-12">
											<div class="panel panel-danger <?php echo "panel_".$id_parent; ?>" style="border-color: #8c2733;border-radius: 3px 3px 0px 0px;"> 
											 	<div class="panel-heading" style="color: #ac1818;background-color: #8c2733;border-color: #8c2733;"> 
											 		<h3 class="panel-title" style="color: #fff;"><?php echo $i." ) ".$question_parent; ?></h3> 
											 		<input type="hidden" name="id_parent_<?php echo $id_parent ?>" class="id_parent_<?php echo $id_parent ?>" value ="<?php echo $id_parent;?>">
											 	</div> 

											 	<?php if ($count == 0){ 
											 		$code_inscription = $_GET['admin_alumni_result_rep'];
											 		$sql_resultat = "SELECT COUNT(*) FROM `resultat_alumni` WHERE `id_question`= $id_parent and `id_sondage` = $sondage_id and `code_inscription` = \"$code_inscription\"";
											 		$req_resultat = @mysql_query($sql_resultat);
								        			$row_count_resultat = mysql_fetch_array($req_resultat);
								        			$count_resultat = $row_count_resultat['0'];
											 		$sql_reponse = "SELECT * FROM `tbl_reponse_alumni` WHERE `statut` = 0 and `question_id` = $id_parent";
											 		$req_reponse = @mysql_query($sql_reponse);
											 		$r = 0;
											 		$r_t = 0;
											 		$choix = 0;
											 			while ($row_reponse = mysql_fetch_assoc($req_reponse)) {
							        						$r++;
												 			$id_reponse = $row_reponse['id'];
												 			$reponse = $row_reponse['reponse_en'];
												 			$type = $row_reponse['type'];
												 			$sql_resultat_rep = "SELECT rep.`reponse_en`, rep.`type` , res.`text` FROM `resultat_alumni` as res , `tbl_reponse_alumni` as rep WHERE res.`id_question`= $id_parent and res.`id_sondage` = $sondage_id and res.`code_inscription` = \"$code_inscription\" and res.`id_reponse` = rep.`id` and res.`id_reponse` = $id_reponse";
													 		$req_resultat_rep = @mysql_query($sql_resultat_rep);
										        			$row_resultat_rep = mysql_fetch_array($req_resultat_rep);
												 		?>	

													 		<?php if ($type == "choix"): ?>

													 			<?php if ($row_resultat_rep == false ){ ?>
													 				<?php if ($count_resultat == 0): ?>
														 				<li  style="border: 1px solid #eee;border-left-width: 13px;border-left-color: #aa6708;color: #000;border-bottom: 0px;" class="list-group-item">
																 			<div class="radio"> 
																 				<label class = "<?php echo "r_".$id_parent; ?>"> 
																 					<input  type="radio" name="<?php echo "r_".$id_parent; ?>" id="optionsRadios1" value="<?php echo $id_reponse; ?>"> <?php echo $reponse; ?>
																 				</label> 
																 			</div>
																 		</li>
													 				<?php endif ?>
														 		<?php }else{ ?>
														 			<?php $choix++; ?>
													 				<div class="alert alert-success" role="alert" style="text-align: center;color: #fff;background-color: #045702;margin-bottom: 0px;border-color: #045702;border-radius: 0px 0px 4px 4px;"> 	
														 				<strong>
														 					<span class="entypo-check" aria-hidden="tbl_reponse_alumni" style="font-size: 14px;"></span> 
														 					Done - 
														 						<span>
															 						<?php 
															 							if ($row_resultat_rep['type'] == "choix") {
															        						echo $row_resultat_rep['reponse_en'];
															        					}else{
															        						echo $row_resultat_rep['reponse_en']." : ".$row_resultat_rep['text'];
															        					} 
															        				?>
														        				</span>
														 				</strong>
														 			</div>

													 			<?php } ?>

													 		<?php endif ?>
													 		<?php if ($type == "text"): $r_t++; ?>
													 			<?php if ($row_resultat_rep == false){ ?>
													 				<?php if ($choix == 0): ?>
														 				<li class="list-group-item">
																	    	<div class="containner">
																	    		<div class="col-sm-12 col-md-12 col-lg-12">
																	    			<?php 
																	    				$oblegatoire = $row_reponse['oblegatoire'];
																	    				$type_content = $row_reponse['type_content'];
																	    			 ?>
																	    			<div class="form-group"> 
																			    		<label for="exampleInputEmail1"><?php echo $reponse;  ?></label>
																			    		<input class="<?php echo "q_".$id_parent."_".$id_reponse."_text_id"; ?>" type="hidden" value="<?php echo $id_reponse; ?>">
																			    		
																			    			<input <?php if ($type_content == "phone"): ?> data-parsley-pattern="^\d{10}$" <?php endif ?> <?php if ($type_content == "email"){ ?>
																			    				data-parsley-trigger="change" type="email"
																			    			<?php }else{ ?> type="text" <?php } ?> name="<?php echo "q_".$id_parent."_".$id_reponse."_text"; ?>" class="form-control <?php echo "q_".$id_parent."_".$id_reponse."_text"; ?>"
																			    			<?php if ($oblegatoire == 0): ?>
																			    				required
																			    			<?php endif ?>
																			    			 >
																			    		
																			    	</div>
																	    		</div>
																	    	</div>
																	    	

																	    	<script type="text/javascript">
																			    jQuery(".<?php echo "q_".$id_parent."_".$id_reponse."_text"; ?>").keyup(function(){
																 					var text = jQuery(".<?php echo "q_".$id_parent."_".$id_reponse."_text"; ?>").val();
																 					if (text != "") {
																 						jQuery(".<?php echo "q_".$id_parent."_".$id_reponse."_text_confirm"; ?>").slideDown();
																 					}else{
																 						jQuery(".<?php echo "q_".$id_parent."_".$id_reponse."_text_confirm"; ?>").slideUp();
																 					}

																 				});
																 				$(function () {
																				  $('#<?php echo "q_".$id_parent."_".$id_reponse."_text_f"; ?>').parsley().on('field:validated', function() {
																				    var ok = $('.parsley-error').length === 0;
																				    $('.bs-callout-info').toggleClass('hidden', !ok);
																				    $('.bs-callout-warning').toggleClass('hidden', ok);
																				  })
																				  
																				});
																 				
																	    	</script>	
																	    </li>
																	    <div class="alert alert-success <?php echo "alert_".$id_parent."_".$id_reponse."_text"; ?>" role="alert" style="display:none;text-align: center;color: #fff;background-color: #045702;border-color: #045702;margin-top: 0px;border-radius: 0px 0px 4px 4px;"> 	
																 				<strong>
																 					<span class="entypo-check" aria-hidden="tbl_reponse_alumni" style="font-size: 14px;"></span> 
																 					Done - <?php echo $reponse; ?> <span class="<?php echo "q_".$id_parent."_".$id_reponse."_text_text"; ?>"></span>
																 				</strong>
																 		</div>
													 				<?php endif ?>
													 			<?php }else{ ?>
													 				<div class="alert alert-success" role="alert" style="text-align: center;color: #fff;background-color: #045702;border-color: #045702;border-radius: 0px 0px 4px 4px;"> 	
														 				<strong>
														 					<span class="entypo-check" aria-hidden="tbl_reponse_alumni" style="font-size: 14px;"></span> 
														 					Done - 
														 						<span>
															 						<?php 
															 							if ($row_resultat_rep['type'] == "choix") {
															        						echo $row_resultat_rep['reponse_en'];
															        					}else{
															        						echo $row_resultat_rep['reponse_en']." : ".$row_resultat_rep['text'];
															        					} 
															        				?>
														        				</span>
														 				</strong>
														 			</div>

													 			<?php } ?>
													 			
													 		<?php endif ?>
													 		<?php if ($type == "textaerea"): ?>
													 			<?php if ($row_resultat_rep == false ){ ?>
													 				<?php if ($count_resultat == 0): ?>
															 			<li class="list-group-item">
																	    	<div class="containner">
																	    		<div class="col-sm-12 col-md-12 col-lg-12">
																	    			<div class="form-group"> 
																			    		<label for="exampleInputEmail1"><?php echo $reponse; ?></label>
																			    		<input class="<?php echo "q_".$id_parent."_".$id_reponse."_textarea_id"; ?>" type="hidden" value="<?php echo $id_reponse; ?>">
																			    		<textarea type="textarea" name="<?php echo "q_".$id_parent."_".$id_reponse."_textarea"; ?>" class="form-control <?php echo "q_".$id_parent."_".$id_reponse."_textarea"; ?>" ></textarea>
																			    	</div>
																	    		</div>
																	    	</div>	
																	    </li>
													 				<?php endif ?>
													 			<?php }else{ ?>
													 				<div class="alert alert-success" role="alert" style="text-align: center;color: #fff;background-color: #045702;border-color: #045702;margin-bottom: 0px;border-radius: 0px 0px 4px 4px;"> 	
														 				<strong>
														 					<span class="entypo-check" aria-hidden="tbl_reponse_alumni" style="font-size: 14px;"></span> 
														 					Done - 
														 						<span>
															 						<?php 
															 							if ($row_resultat_rep['type'] == "choix") {
															        						echo $row_resultat_rep['reponse_en'];
															        					}else{
															        						echo $row_resultat_rep['reponse_en']." : ".$row_resultat_rep['text'];
															        					} 
															        				?>
														        				</span>
														 				</strong>
														 			</div>

													 			<?php } ?>
												 			<?php endif ?>
												 		<?php } ?>
												 			
												 			</div>
												 			<div class="alert alert-success <?php echo "alert_".$id_parent; ?>" role="alert" style="display:none;text-align: center;color: #fff;background-color: #045702;border-color: #045702;margin-top: -17px;border-radius: 0px 0px 4px 4px;"> 	
												 				<strong>
												 					<span class="entypo-check" aria-hidden="tbl_reponse_alumni" style="font-size: 14px;"></span> 
												 					Done - <span class="<?php echo "rep_".$id_parent; ?>"></span>
												 				</strong>
												 			</div>
												 			<?php

											 	 }else{ ?>
											 		<?php 
											 			$question_parent = $row_question_parent['question'];
						        						$sql_question_fils= "SELECT * FROM `questions_alumni` WHERE `active` = 0 and `id_question` = $id_parent";
						        						
											        	$req_question_fils = @mysql_query($sql_question_fils);
											        	$code_inscription = $_GET['admin_alumni_result_rep'];
							        					while ($row_question_fils = mysql_fetch_assoc($req_question_fils)) {
							        						$question_fils = $row_question_fils['question'];
							        						$question_fils_id = $row_question_fils['id'];
							        						$sql_resultat = "SELECT COUNT(*) FROM `resultat_alumni` WHERE `id_question`= $question_fils_id and `id_sondage` = $sondage_id and `code_inscription` = \"$code_inscription\"";
							        						//var_dump($sql_resultat);
													 		$req_resultat = @mysql_query($sql_resultat);
										        			$row_count_resultat = mysql_fetch_array($req_resultat);
										        			$count_resultat = $row_count_resultat['0'];
										        			//var_dump($count_resultat);
											 		 ?>
													 	<div class="panel-body" style="border: 1px solid #eee;border-left-width: 13px;border-left-color: #aa6708;color: #000;border-bottom: 0px;background-color: #eee;"> <?php echo $question_fils; ?> </div> 
														<?php
															$id_question_fils = $row_question_fils['id']; 	
															?>
															<input class="id_question_fils_<?php echo $id_question_fils; ?>" type="hidden" value="<?php echo $id_question_fils; ?>">
															<?php
															$sql_reponse = "SELECT * FROM `tbl_reponse_alumni` WHERE `statut` = 0 and `question_id` = $id_question_fils";
													 		$req_reponse = @mysql_query($sql_reponse);
								        					while ($row_reponse = mysql_fetch_assoc($req_reponse)) {
													 			$id_reponse = $row_reponse['id'];
													 			$reponse = $row_reponse['reponse_en'];
													 			$type = $row_reponse['type'];
													 			$sql_resultat_rep = "SELECT rep.`reponse_en`, rep.`type` , res.`text` FROM `resultat_alumni` as res , `tbl_reponse_alumni` as rep WHERE res.`id_question`= $id_question_fils and res.`id_sondage` = $sondage_id and res.`code_inscription` = \"$code_inscription\" and res.`id_reponse` = rep.`id` and res.`id_reponse` = $id_reponse";
													 			$req_resultat_rep = @mysql_query($sql_resultat_rep);
										        				$row_resultat_rep = mysql_fetch_array($req_resultat_rep);
													 			?>	
														 		<?php if ($type == "choix"): ?>
														 			<?php if ($row_resultat_rep == false ){ ?>
													 					<?php if ($count_resultat == 0): ?>
																 			<li  style="border: 1px solid #eee;border-left-width: 13px;border-left-color: #aa6708;color: #000;border-bottom: 0px;" class="list-group-item <?php echo "li_".$id_question_fils; ?>">
																	 			<div class="radio"> 
																	 				<label class = "<?php echo "r_".$id_question_fils; ?>"> 
																	 					<input type="radio" name="<?php echo "r_".$id_question_fils; ?>" id="optionsRadios1" value="<?php echo $id_reponse; ?>"> <?php echo $reponse; ?>
																	 				</label> 
																	 			</div>
																	 		</li>
														 				<?php endif ?>
															 		<?php }else{ ?>
														 				<div class="alert alert-success" role="alert" style="text-align: center;color: #fff;background-color: #045702;margin-bottom: 0px;border-color: #045702;border-radius: 0px 0px 4px 4px;"> 	
															 				<strong>
															 					<span class="entypo-check" aria-hidden="tbl_reponse_alumni" style="font-size: 14px;"></span> 
															 					Done - 
															 						<span>
																 						<?php 
																 							if ($row_resultat_rep['type'] == "choix") {
																        						echo $row_resultat_rep['reponse_en'];
																        					}else{
																        						echo $row_resultat_rep['reponse_en']." : ".$row_resultat_rep['text'];
																        					} 
																        				?>
															        				</span>
															 				</strong>
															 			</div>

														 			<?php } ?>

														 		<?php endif ?>
														 		<?php if ($type == "text"): ?>
														 			<li class="list-group-item ">
																    	<div class="containner">
																    		<div class="col-sm-12 col-md-12 col-lg-12">
																    			<div class="form-group"> 
																		    		<label for="exampleInputEmail1"><?php echo $reponse; ?></label>
																		    		<input type="text" name="<?php echo "q_".$id_question_fils."_".$id_reponse."_text"; ?>" class="form-control <?php echo "q_".$id_question_fils."_".$id_reponse."_text"; ?>" >
																		    	</div>
																    		</div>
																    	</div>	
																    </li>
														 		<?php endif ?>
														 		<?php if ($type == "textaerea"): ?>
														 			<li class="list-group-item">
																    	<div class="containner">
																    		<div class="col-sm-12 col-md-12 col-lg-12">
																    			<div class="form-group"> 
																		    		<label for="exampleInputEmail1"><?php echo $reponse; ?></label>
																		    		<textarea type="textarea" name="<?php echo "q_".$id_question_fils."_".$id_reponse."_textarea"; ?>" class="form-control <?php echo "q_".$id_question_fils."_".$id_reponse."_textarea"; ?>" ></textarea>
																		    	</div>
																		    	
																    		</div>
																    	</div>	
																    </li>
														 		<?php endif ?>
													 			
												 			<?php } ?>
												 			<li class="list-group-item alert alert-success <?php echo "alert_".$id_question_fils; ?>" role="alert" style="display:none;text-align: center;color: #fff;background-color: #045702;border-color: #045702;margin-top: 0px;border-radius: 0px 0px 4px 4px;"> 	
												 				<strong>
												 					<span class="entypo-check" aria-hidden="tbl_reponse_alumni" style="font-size: 14px;"></span> 
												 					Done - <span class="<?php echo "rep_".$id_question_fils; ?>"></span>
												 				</strong>
												 			</li>
													<?php } ?>

													</div>
											 	<?php } ?>
											
										</div>
									</div>
									 <?php 	
			        					}
			        				?>
								
								<?php
						}else{
							?>
								<div class="page-error-404">
									<div class="error-symbol">
										<i class="entypo-attention"></i>
									</div>
											<h2>This survey was disabled or does not exist</h2>
											<a href="?sondage" class="btn btn-green btn-icon icon-left">
												<i class="entypo-info"></i> return to surveys list
											</a>
										
									</div>
								</div>
							<?php
						}
					
			?>
			</div>
			<?php
	    }else{
	    	
	    }
	


 ?>

