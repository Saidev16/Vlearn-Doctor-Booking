<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table" height="81" >
  <tr>
    <td>&nbsp;<img src="images/icone/notes.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;GESTION DU SONDAGE ['resultat des sendages']
	 &nbsp;&nbsp;<span class="task"></span>
 	</td>
	<td width="22%">&nbsp;</td> 
  </tr>
</table>
<div class="row">
	<div class="col-md-12" style="float:right;padding: 16px;">
	  <a href="gestion_sondage.php?list_sondage" style="color: #fff;text-decoration: none;" class="btn btn-success btn-xs">les sondages</a>
	  <a href="gestion_sondage.php?list_affectation" style="color: #fff;text-decoration: none;" class="btn btn-success btn-xs"> Les affectations</a>
	  <a href="gestion_sondage.php?list_question" style="color: #fff;text-decoration: none;" class="btn btn-success btn-xs">Les quéstions</a>
	  <a href="gestion_sondage.php?response_list" style="color: #fff;text-decoration: none;" class="btn btn-success btn-xs">Les réponses</a>
	  <a href="gestion_sondage.php?resultat_etudiant&id=<?php echo $_GET['id']; ?>" style="color: #fff;text-decoration: none;" class="btn btn-success btn-xs">Les étudiants</a>
	</div>
</div>
<?php if (isset($_GET['resultat_etudiant']) && isset($_GET['id'])): ?>
	
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
			$sql_prof_affectation= "SELECT DISTINCT `code_prof` FROM `tbl_sondage_affectation` WHERE   `session` = \"$id_session\" 
			AND `archive` = 0 and `campus`= 'e-learning'";
        	$req_prof_affectation = @mysql_query($sql_prof_affectation);
        	$sql_etudiant_sondage = "SELECT distinct(r.`code_etudiant`),e.`nom`,e.`prenom`,e.`ville`,e.`groupe` FROM `tbl_resultat_sondage` as r,
        	`tbl_etudiant_deac`as e WHERE r.`id_sondage` = $id_sondage and e.`code_inscription` = r.`code_etudiant`";
        	$req_etudiant_sondage = @mysql_query($sql_etudiant_sondage);
        	//le nbr des etudiants
        	$sql_nb_etudiant_r = "SELECT count(distinct `code_etudiant`) FROM `tbl_resultat_sondage` WHERE `id_sondage` = $id_sondage";
        	$req_nb_etudiant_r = @mysql_query($sql_nb_etudiant_r);
            $row_nb_etudiant_r = mysql_fetch_array($req_nb_etudiant_r);
        	$sql_nb_etudiant_tt = "SELECT count(distinct `code_inscription`) FROM `tbl_note` WHERE `idSession` = $id_session and `archive` = 0";
        	$req_nb_etudiant_tt = @mysql_query($sql_nb_etudiant_tt);
            $row_nb_etudiant_tt = mysql_fetch_array($req_nb_etudiant_tt);
            $nb_etudiant_r = $row_nb_etudiant_r['0'];
            $nb_etudiant_tt = $row_nb_etudiant_tt['0'];
            $sql_etudiant_tt = "SELECT distinct n.`code_inscription` , e.`groupe` FROM `tbl_note` as n , `tbl_etudiant_deac` as e  WHERE n.`idSession` = $id_session and n.`archive` = 0 and n.`code_inscription` = e.`code_inscription`";
            //var_dump($sql_etudiant_tt);
        	$req_etudiant_tt = @mysql_query($sql_etudiant_tt);
        	$all_etudiant_eng = array();
        	$all_etudiant_fr = array();
        	$e = 0;
        	while ($row_etudiant_tt = mysql_fetch_array($req_etudiant_tt)) {
        		if ($row_etudiant_tt['groupe'] == "2") {
        			$all_etudiant_fr["$e"] = $row_etudiant_tt['code_inscription'];

        		}
        		if ($row_etudiant_tt['groupe'] == "3") {
        			$all_etudiant_eng["$e"] = $row_etudiant_tt['code_inscription'];
        		}
        		$e++;
        	}

		?>
		<h1 class="text-info"><?php echo $sondage_title; ?></h1>
		<h2 class="text-info">Session <?php  echo $session.' '.$annee; ?></h2>
		<div class="row">
			<div class=" col-sm-offset-2 col-md-8">
				<div class="panel panel-primary" id="charts_env">
					<table class="table table-bordered table-responsive">
		
						<thead>
							<tr>
								<th width="100%" class="col-padding-1">
									<div class="pull-left">
										<div class="h4 no-margin">le nombre des étudiants qui ont repondu au sondage</div>
										<small style="color:#00a651;font-size: 14px;"><?php echo $nb_etudiant_r; ?>  /  <?php echo $nb_etudiant_tt; ?></small>
									</div>
								</th>
							</tr>
						</thead>
		
					</table>
					<div class="panel-heading">
						<div class="panel-title"></div>
		
						<div class="panel-options">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#et_f" data-toggle="tab">les étudiants qui ont repondu au sondage</a></li>
								<li class=""><a href="#et_r" data-toggle="tab">les autres étudiants</a></li>
							</ul>
						</div>
					</div>
		
					<div class="panel-body">
		
						<div class="tab-content">
							<div class="tab-pane active" id="et_f" style="">
								<?php 
									$etudiant_complet_eng = array();
									$etudiant_complet_fr = array();
									$i = 0;
							        $incomplet_code_etudiant = "0";
						        	while ($row_etudiant = mysql_fetch_array($req_etudiant_sondage)){
						        		$groupe = $row_etudiant['groupe'];
						        		//var_dump($groupe);
						        		$code_etudiant = $row_etudiant['code_etudiant'];
						        		$sql_nb_resultat = "SELECT count(Distinct `id_affectation`) FROM `tbl_resultat_sondage` WHERE `code_etudiant`= '$code_etudiant' AND  `id_sondage` = $id_sondage";
						        		//var_dump($sql_nb_resultat);
							        	$req_nb_resultat = @mysql_query($sql_nb_resultat);
							            $row_nb_resultat = mysql_fetch_array($req_nb_resultat);
							            $nb_resultat = $row_nb_resultat['0'];
							            $code_etudiant = $row_etudiant['code_etudiant'];
						        		$sql_nb_cours = "SELECT count(Distinct `code_cours`) FROM `tbl_note` WHERE `code_inscription`= '$code_etudiant' AND `letter_grade` != 'T' AND `idSession`=$idSession";

						        		//var_dump($sql_nb_cours);
							        	$req_nb_cours = @mysql_query($sql_nb_cours);
							            $row_nb_cours = mysql_fetch_array($req_nb_cours);
							            $nb_cours = $row_nb_cours['0'];
							            $complete = '';
							            //var_dump($nb_resultat);
							            //var_dump($nb_cours);
							            if ($nb_resultat == $nb_cours) {
							            	$complete = "Complet";
							            	if ($groupe == 2) {
							            		$etudiant_complet_fr["$i"] = $code_etudiant;
							            	}
							            	if ($groupe == 3) {
							            		$etudiant_complet_eng["$i"] = $code_etudiant;
							            	}
							            	$i++;
							            	
							            }elseif($nb_resultat > $nb_cours){
							            	$complete = "Error";
							            }else{
							            	// if ($groupe == 2) {
							            	// 	$incomplet_code_etudiant_fr .= ",".$code_etudiant;
							            	// }
							            	// if ($groupe == 3) {
							            	// 	$incomplet_code_etudiant_eng .= ",".$code_etudiant;
							            	// }

							            	$i++;
							            	$complete = "Incomplet";
							            }

						        	?>
						        	<?php if (!isset($_GET['send'])): ?>
						        		
						        		<div style="text-align:left;" class="panel-group" id="accordion-test">
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title text-info">
														<a class="collapsed" href="?resultat_sondage&id=<?php echo $id_sondage; ?>&
														code_etu=<?php echo $code_etudiant; ?>">
															<?php echo $row_etudiant['nom']." ".$row_etudiant['prenom']." - ".$row_etudiant['ville']; ?> 
															<span class="badge badge-success" style="float: right;"><?php echo $complete; ?></span> 
														</a>
													</h4>
												</div>
											</div>
										</div>

						        	<?php endif ?>
									 
									<?php
							        	}

							        	if (isset($_GET['send'])) {
							        		foreach ($all_etudiant_fr as $k => $v) {
								        		foreach ($etudiant_complet_fr as $k_e => $v_e) {
								        			if (trim($v) == trim($v_e)) {
								        				unset($all_etudiant_fr[$k]);
								        			}
								        		}
								        	}
								        	$all_etudiant_fr_req = "\"\"";
								        	foreach ($all_etudiant_fr as $k => $v) {
								        		$all_etudiant_fr_req .= ","."\"$v\"";
								        	}

								        	foreach ($all_etudiant_eng as $k => $v) {
								        		foreach ($etudiant_complet_eng as $k_e => $v_e) {
								        			if (trim($v) == trim($v_e)) {
								        				unset($all_etudiant_eng[$k]);
								        			}
								        		}
								        	}
								        	$all_etudiant_eng_req = "\"\"";
								        	foreach ($all_etudiant_eng as $k => $v) {
								        		$all_etudiant_eng_req .= ","."\"$v\"";
								        	}
								        	//eng
							        		$sql_email_eng = "SELECT `email` FROM `tbl_etudiant_deac` WHERE `code_inscription` in ($all_etudiant_eng_req)";
							        		//var_dump($sql_email_eng);
									        $res_email_eng = @mysql_query($sql_email_eng) or die ('erreur de selection des emails incomplet');
									        $to_email_eng= "mehdi@aulm.us,rabea@aulm.us";
									        while ($row_email_eng = mysql_fetch_array($res_email_eng)) {
									        	$to_email_eng .= ",".$row_email_eng['email'];
									        }
									        //fr
									        $sql_email_fr = "SELECT `email` FROM `tbl_etudiant_deac` WHERE `code_inscription` in ($all_etudiant_fr_req)";
									        $res_email_fr = @mysql_query($sql_email_fr) or die ('erreur de selection des emails incomplet');
									        $to_email_fr= "mehdi@aulm.us,rabea@aulm.us";
									        while ($row_email_fr = mysql_fetch_array($res_email_fr)) {
									        	$to_email_fr .= ",".$row_email_fr['email'];
									        }
									        //var_dump($to_email_eng);
									        //var_dump($to_email_fr);
									        //english version
									        $to1 = "mehdi@aulm.us";
									        $subject1='IMPORTANT: survey reminder ';
											$message ="<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
												<html xmlns='http://www.w3.org/1999/xhtml'>
													<head>
														<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
														<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
														<title>[SUBJECT]</title>
														<style type='text/css'>

													@media screen and (max-width: 600px) {
													    table[class='container'] {
													        width: 95% !important;
													    }
													}

														#outlook a {padding:0;}
															body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
															.ExternalClass {width:100%;}
															.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}
															#backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
															img {outline:none; text-decoration:none; -ms-interpolation-mode: bicubic;}
															a img {border:none;}
															.image_fix {display:block;}
															p {margin: 1em 0;}
															h1, h2, h3, h4, h5, h6 {color: black !important;}

															h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {color: blue !important;}

															h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {
																color: red !important; 
															 }

															h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {
																color: purple !important; 
															}

															table td {border-collapse: collapse;}

															table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }

															a {color: #000;}

															@media only screen and (max-device-width: 480px) {

																a[href^='tel'], a[href^='sms'] {
																			text-decoration: none;
																			color: black; /* or whatever your want */
																			pointer-events: none;
																			cursor: default;
																		}

																.mobile_link a[href^='tel'], .mobile_link a[href^='sms'] {
																			text-decoration: default;
																			color: orange !important; /* or whatever your want */
																			pointer-events: auto;
																			cursor: default;
																		}
															}


															@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
																a[href^='tel'], a[href^='sms'] {
																			text-decoration: none;
																			color: blue; /* or whatever your want */
																			pointer-events: none;
																			cursor: default;
																		}

																.mobile_link a[href^='tel'], .mobile_link a[href^='sms'] {
																			text-decoration: default;
																			color: orange !important;
																			pointer-events: auto;
																			cursor: default;
																		}
															}

															@media only screen and (-webkit-min-device-pixel-ratio: 2) {
																/* Put your iPhone 4g styles in here */
															}

															@media only screen and (-webkit-device-pixel-ratio:.75){
																/* Put CSS for low density (ldpi) Android layouts in here */
															}
															@media only screen and (-webkit-device-pixel-ratio:1){
																/* Put CSS for medium density (mdpi) Android layouts in here */
															}
															@media only screen and (-webkit-device-pixel-ratio:1.5){
																/* Put CSS for high density (hdpi) Android layouts in here */
															}
															/* end Android targeting */
															h2{
																color:#181818;
																font-family:Helvetica, Arial, sans-serif;
																font-size:22px;
																line-height: 22px;
																font-weight: normal;
															}
															a.link1{

															}
															a.link2{
																color:#fff;
																text-decoration:none;
																font-family:Helvetica, Arial, sans-serif;
																font-size:16px;
																color:#fff;border-radius:4px;
															}
															p{
																color:#555;
																font-family:Helvetica, Arial, sans-serif;
																font-size:16px;
																line-height:160%;
															}
														</style>

													<script type='colorScheme' class='swatch active'>
													  {
													    'name':'Default',
													    'bgBody':'ffffff',
													    'link':'fff',
													    'color':'555555',
													    'bgItem':'ffffff',
													    'title':'181818'
													  }
													</script>

													</head>
													<body>
														<!-- Wrapper/Container Table: Use a wrapper table to control the width and the background color consistently of your email. Use this approach instead of setting attributes on the body tag. -->
														<table cellpadding='0' width='100%' cellspacing='0' border='0' id='backgroundTable' class='bgBody'>
															<tbody>
																<tr>
																	<td>
																		<table cellpadding='0' width='620' class='container' align='center' cellspacing='0' border='0'>
																			<tbody>
																				<tr>
																					<td>
																						<!-- Tables are the most common way to format your email consistently. Set your table widths inside cells and in most cases reset cellpadding, cellspacing, and border to zero. Use nested tables as a way to space effectively in your message. -->
																						

																						<table cellpadding='0' cellspacing='0' border='0' align='center' width='600' class='container' style='border: 1px solid #F1F1F1;'>
																							<tbody>
																								<tr>
																									<td class='movableContentContainer bgItem'>

																										<div class='movableContent'>
																											<table cellpadding='0' cellspacing='0' border='0' align='center' width='600' class='container' style='background-color: #f1f1f1;'>
																												<tbody>
																												<tr>
																													
																													<td width='200' valign='top' align='center'>
																														<div class='movableContent'>
																											<table cellpadding='0' cellspacing='0' border='0' align='center' width='600' class='container'>
																												<tbody>
																												<tr>
																													<td width='50' valign='top'>&nbsp;</td>
																													<td width='100%' valign='top' align='center'>
																														<div class='contentEditableContainer contentImageEditable'>
																										                	<div class='contentEditable' align='center'>
																										                  		<img src='http://edu.piimt.us/images/logopiimtsondage.png' width='450' height=' alt='Logo' data-default='placeholder'>
																										                	</div>
																										              	</div>
																													</td>
																													<td width='50' valign='top'>&nbsp;</td>
																												</tr>
																												
																											</tbody></table>
																										</div>
																													</td>
																													
																												</tr>
																												
																											</tbody></table>
																										</div>

																										<div class='movableContent'>
																											<table cellpadding='0' cellspacing='0' border='0' align='center' width='600' class='container'>
																												<tbody><tr>
																													<td width='100%' colspan='3' align='center' style='padding-bottom:10px;padding-top:25px;'>
																														<div class='contentEditableContainer contentTextEditable'>
																										                	<div class='contentEditable' align='left' style='margin-left: 50px;'>
																										                  		<h2 style='font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;'>Hello,</h2>
																										                	</div>
																										              	</div>
																													</td>
																												</tr>
																												<tr>
																													<td width='50'>&nbsp;</td>
																													<td width='500' align='center' style='font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;font-size: 14px;line-height: 1.3em;font-weight: 200;letter-spacing: 0.015em;'>
																														<div class='contentEditableContainer contentTextEditable' style='text-align: center;'>
																										                	<div class='contentEditable' align='left'>
																										                  		<p style='/* text-align: center; */'>This is to let you know that you haven’t completed your <span style='font-size: 16px;font-weight: bold;color: #106aab;'>surveys for the ".$session." ".$annee." session </span>, we'd really appreciate your participation.</p>
																																<p>Please click the link below to start or continue the survey. Thank you for your time.</p>
																																<p><a href='http://psi.piimt.us/piimt/student.php?task=sondage' target='_blank' style='color: #106aab;font-weight: bold;'>http://psi.piimt.us/piimt/student.php?task=sondage</a></p>
																										                	</div>
																										              	</div>
																													</td>
																													<td width='50'>&nbsp;</td>
																												</tr>
																											</tbody></table>
																											
																										</div>


																										<div class='movableContent'>
																											<table cellpadding='0' cellspacing='0' border='0' align='center' width='600' class='container'>
																												<tbody>
																													<tr>
																														<td width='100%' colspan='2' style='padding-top: 4px;'>
																															<hr style='height:1px;border:none;color:#333;background-color:#ddd;'>
																														</td>
																													</tr>
																													<tr style='text-align: center;'>
																						  
																														<td width='500px' height='20' align='center' valign='top' style='padding-bottom: 0px;'>
																															<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>
																																<tbody>
																																	<tr>
																																										
																																		<td width='20'></td>
																															  
																																		<td width='20'></td><td width='20'></td>

																																		<td valign='top' width='10'>
																																			<div class='contentEditableContainer contentFacebookEditable' style='display:inline;'>
																														                        <div class='contentEditable'>
																														                            <a href='https://www.facebook.com/AULM.US/' target='_blanck'><img src='http://edu.piimt.us/images/facebook.png' data-default='placeholder' data-max-width='30' data-customicon='true' width='30' height='30' alt='facebook' style='margin-right:40x;'></a>
																														                        </div>
																														                    </div>
																																		</td>
																																		<td valign='top' width='10'>
																																			<div class='contentEditableContainer contentTwitterEditable' style='display:inline;'>
																														                      <div class='contentEditable'>
																														                        <a href='https://twitter.com/AUL_ORLANDO' target='_blanck'><img src='http://edu.piimt.us/images/twitter.png' data-default='placeholder' data-max-width='30' data-customicon='true' width='30' height='30' alt='twitter' style='margin-right:40x;'></a>
																														                      </div>
																														                    </div>
																																		</td>
																																		<td valign='top' width='10'>
																																			<div class='contentEditableContainer contentImageEditable' style='display:inline;'>
																														                      <div class='contentEditable'>
																														                        <a target='_blank' href='#' data-default='placeholder' style='text-decoration:none;'>
																																					</a><a href='https://www.youtube.com/channel/UCUhxTZ9pShQeTMTkujiFkYg/about' target='_blanck'> <img src='http://edu.piimt.us/images/youtube.png' data-default='placeholder' data-max-width='30' data-customicon='true' width='30' height='30' alt='facebook' style='margin-right:40x;'></a>
																																				
																														                      </div>
																														                    </div>
																																		</td>
																																		<td valign='top' width='10'>
																																			<div class='contentEditableContainer contentImageEditable' style='display:inline;'>
																														                      <div class='contentEditable'>
																														                        <a target='_blank' href='#' data-default='placeholder' style='text-decoration:none;'>
																																					</a><a href='https://www.linkedin.com/company/american-university-of-leadership' target='_blanck'> <img src='http://edu.piimt.us/images/linkedin.png' data-default='placeholder' data-max-width='30' data-customicon='true' width='30' height='30' alt='facebook' style='margin-right:40x;'></a>
																																				
																														                      </div>
																														                    </div>
																																		</td>
																																		<td valign='top' width='10'>
																																			<div class='contentEditableContainer contentImageEditable' style='display:inline;'>
																														                      <div class='contentEditable'>
																														                        <a target='_blank' href='#' data-default='placeholder' style='text-decoration:none;'>
																																					</a><a href='https://plus.google.com/112140129249305802090/about' target='_blanck'> <img src='http://edu.piimt.us/images/google.png' data-default='placeholder' data-max-width='30' data-customicon='true' width='30' height='30' alt='facebook' style='margin-right:40x;'></a>
																																				
																														                      </div>
																														                    </div>
																																		</td>
																																		<td valign='top' width='10'>
																																			<div class='contentEditableContainer contentImageEditable' style='display:inline;'>
																														                      <div class='contentEditable'>
																														                        <a target='_blank' href='#' data-default='placeholder' style='text-decoration:none;'>
																																					</a><a href='http://www.instagram.com/americanuniversityofleadership' target='_blanck'> <img src='http://edu.piimt.us/images/instagram.png' data-default='placeholder' data-max-width='30' data-customicon='true' width='30' height='30' alt='facebook' style='margin-right:40x;'></a>
																																				
																														                      </div>
																														                    </div>
																																		</td>
																																		<td width='20'></td>
																																		<td width='20'></td>
																																	</tr>
																																</tbody>
																															</table>
																														</td>
																													</tr>
																													<tr>
																														<td width='100%' height='70' valign='middle' style='padding-bottom: 0px;'>
																															<div class='contentEditableContainer contentTextEditable'>
																											                	<div class='contentEditable' align='center'>
																											                  		<span style='font-size:13px;color:#000;font-family:Helvetica, Arial, sans-serif;line-height:200%;'>© 2016 | <a href='http://edu2.aulm.us/' target='_blanck' style='color: #106aab;font-size: 14px;font-style: normal;text-decoration: none;'>Private International Institute of Management and Technology</a>. All rights reserved.</span>
																																
																											                	</div>
																											              	</div>
																														</td>
																													</tr>
																												</tbody>
																											</table>
																										</div>
																									</td>
																								</tr>
																							</tbody>
																						</table>

																					
																					

																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
															</tbody>
														</table>
														<!-- End of wrapper table -->




													</body>
												</html>";
											$From1  = "From:psi@piimt.us\n";
											$From1 .= "Cc:\n";
											$From1 .= "Bcc:".$to_email_eng."\n";
											$From1 .= "MIME-version: 1.0\n";
											$From1 .= "Content-type: text/html; charset= utf-8 \n";	
											mail($to1,$subject1,$message,$From1);
											//frinsh version 
											$to2 = "";
									        $subject2='IMPORTANT: Rappel Sondage ';
									        $message2 ="<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
												<html xmlns='http://www.w3.org/1999/xhtml'>
													<head>
														<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
														<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
														<title>[SUBJECT]</title>
														<style type='text/css'>

													@media screen and (max-width: 600px) {
													    table[class='container'] {
													        width: 95% !important;
													    }
													}

														#outlook a {padding:0;}
															body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
															.ExternalClass {width:100%;}
															.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}
															#backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
															img {outline:none; text-decoration:none; -ms-interpolation-mode: bicubic;}
															a img {border:none;}
															.image_fix {display:block;}
															p {margin: 1em 0;}
															h1, h2, h3, h4, h5, h6 {color: black !important;}

															h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {color: blue !important;}

															h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {
																color: red !important; 
															 }

															h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {
																color: purple !important; 
															}

															table td {border-collapse: collapse;}

															table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }

															a {color: #000;}

															@media only screen and (max-device-width: 480px) {

																a[href^='tel'], a[href^='sms'] {
																			text-decoration: none;
																			color: black; /* or whatever your want */
																			pointer-events: none;
																			cursor: default;
																		}

																.mobile_link a[href^='tel'], .mobile_link a[href^='sms'] {
																			text-decoration: default;
																			color: orange !important; /* or whatever your want */
																			pointer-events: auto;
																			cursor: default;
																		}
															}


															@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
																a[href^='tel'], a[href^='sms'] {
																			text-decoration: none;
																			color: blue; /* or whatever your want */
																			pointer-events: none;
																			cursor: default;
																		}

																.mobile_link a[href^='tel'], .mobile_link a[href^='sms'] {
																			text-decoration: default;
																			color: orange !important;
																			pointer-events: auto;
																			cursor: default;
																		}
															}

															@media only screen and (-webkit-min-device-pixel-ratio: 2) {
																/* Put your iPhone 4g styles in here */
															}

															@media only screen and (-webkit-device-pixel-ratio:.75){
																/* Put CSS for low density (ldpi) Android layouts in here */
															}
															@media only screen and (-webkit-device-pixel-ratio:1){
																/* Put CSS for medium density (mdpi) Android layouts in here */
															}
															@media only screen and (-webkit-device-pixel-ratio:1.5){
																/* Put CSS for high density (hdpi) Android layouts in here */
															}
															/* end Android targeting */
															h2{
																color:#181818;
																font-family:Helvetica, Arial, sans-serif;
																font-size:22px;
																line-height: 22px;
																font-weight: normal;
															}
															a.link1{

															}
															a.link2{
																color:#fff;
																text-decoration:none;
																font-family:Helvetica, Arial, sans-serif;
																font-size:16px;
																color:#fff;border-radius:4px;
															}
															p{
																color:#555;
																font-family:Helvetica, Arial, sans-serif;
																font-size:16px;
																line-height:160%;
															}
														</style>

													<script type='colorScheme' class='swatch active'>
													  {
													    'name':'Default',
													    'bgBody':'ffffff',
													    'link':'fff',
													    'color':'555555',
													    'bgItem':'ffffff',
													    'title':'181818'
													  }
													</script>

													</head>
													<body>
														<!-- Wrapper/Container Table: Use a wrapper table to control the width and the background color consistently of your email. Use this approach instead of setting attributes on the body tag. -->
														<table cellpadding='0' width='100%' cellspacing='0' border='0' id='backgroundTable' class='bgBody'>
															<tbody>
																<tr>
																	<td>
																		<table cellpadding='0' width='620' class='container' align='center' cellspacing='0' border='0'>
																			<tbody>
																				<tr>
																					<td>
																						<!-- Tables are the most common way to format your email consistently. Set your table widths inside cells and in most cases reset cellpadding, cellspacing, and border to zero. Use nested tables as a way to space effectively in your message. -->
																						

																						<table cellpadding='0' cellspacing='0' border='0' align='center' width='600' class='container' style='border: 1px solid #F1F1F1;'>
																							<tbody>
																								<tr>
																									<td class='movableContentContainer bgItem'>

																										<div class='movableContent'>
																											<table cellpadding='0' cellspacing='0' border='0' align='center' width='600' class='container' style='background-color: #f1f1f1;'>
																												<tbody>
																												<tr>
																													
																													<td width='200' valign='top' align='center'>
																														<div class='movableContent'>
																											<table cellpadding='0' cellspacing='0' border='0' align='center' width='600' class='container'>
																												<tbody>
																												<tr>
																													<td width='50' valign='top'>&nbsp;</td>
																													<td width='100%' valign='top' align='center'>
																														<div class='contentEditableContainer contentImageEditable'>
																										                	<div class='contentEditable' align='center'>
																										                  		<img src='http://edu.piimt.us/images/logopiimtsondage.png' width='450' height=' alt='Logo' data-default='placeholder'>
																										                	</div>
																										              	</div>
																													</td>
																													<td width='50' valign='top'>&nbsp;</td>
																												</tr>
																												
																											</tbody></table>
																										</div>
																													</td>
																													
																												</tr>
																												
																											</tbody></table>
																										</div>

																										<div class='movableContent'>
																											<table cellpadding='0' cellspacing='0' border='0' align='center' width='600' class='container'>
																												<tbody><tr>
																													<td width='100%' colspan='3' align='center' style='padding-bottom:10px;padding-top:25px;'>
																														<div class='contentEditableContainer contentTextEditable'>
																										                	<div class='contentEditable' align='left' style='margin-left: 50px;'>
																										                  		<h2 style='font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;'>Bonjour,</h2>
																										                	</div>
																										              	</div>
																													</td>
																												</tr>
																												<tr>
																													<td width='50'>&nbsp;</td>
																													<td width='500' align='center' style='font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;font-size: 14px;line-height: 1.3em;font-weight: 200;letter-spacing: 0.015em;'>
																														<div class='contentEditableContainer contentTextEditable' style='text-align: center;'>
																										                	<div class='contentEditable' align='left'>
																										                  		<p style='/* text-align: center; */'>Je vous rappelle que vous n'avez pas terminé vos <span style='font-size: 16px;font-weight: bold;color: #106aab;'>sondages de la session ".$session." ".$annee." </span>, nous serions très reconnaissants de votre participation.</p>
																																<p>Veuillez cliquer sur le lien ci-dessous pour commencer ou poursuivre le sondage. Merci pour votre temps.</p>
																																<p><a href='http://psi.piimt.us/piimt/student.php?task=sondage' target='_blank' style='color: #106aab;font-weight: bold;'>http://psi.piimt.us/piimt/student.php?task=sondage</a></p>
																										                	</div>
																										              	</div>
																													</td>
																													<td width='50'>&nbsp;</td>
																												</tr>
																											</tbody></table>
																											
																										</div>


																										<div class='movableContent'>
																											<table cellpadding='0' cellspacing='0' border='0' align='center' width='600' class='container'>
																												<tbody>
																													<tr>
																														<td width='100%' colspan='2' style='padding-top: 4px;'>
																															<hr style='height:1px;border:none;color:#333;background-color:#ddd;'>
																														</td>
																													</tr>
																													<tr style='text-align: center;'>
																						  
																														<td width='500px' height='20' align='center' valign='top' style='padding-bottom: 0px;'>
																															<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>
																																<tbody>
																																	<tr>
																																										
																																		<td width='20'></td>
																															  
																																		<td width='20'></td><td width='20'></td>

																																		<td valign='top' width='10'>
																																			<div class='contentEditableContainer contentFacebookEditable' style='display:inline;'>
																														                        <div class='contentEditable'>
																														                            <a href='https://www.facebook.com/AULM.US/' target='_blanck'><img src='http://edu.piimt.us/images/facebook.png' data-default='placeholder' data-max-width='30' data-customicon='true' width='30' height='30' alt='facebook' style='margin-right:40x;'></a>
																														                        </div>
																														                    </div>
																																		</td>
																																		<td valign='top' width='10'>
																																			<div class='contentEditableContainer contentTwitterEditable' style='display:inline;'>
																														                      <div class='contentEditable'>
																														                        <a href='https://twitter.com/AUL_ORLANDO' target='_blanck'><img src='http://edu.piimt.us/images/twitter.png' data-default='placeholder' data-max-width='30' data-customicon='true' width='30' height='30' alt='twitter' style='margin-right:40x;'></a>
																														                      </div>
																														                    </div>
																																		</td>
																																		<td valign='top' width='10'>
																																			<div class='contentEditableContainer contentImageEditable' style='display:inline;'>
																														                      <div class='contentEditable'>
																														                        <a target='_blank' href='#' data-default='placeholder' style='text-decoration:none;'>
																																					</a><a href='https://www.youtube.com/channel/UCUhxTZ9pShQeTMTkujiFkYg/about' target='_blanck'> <img src='http://edu.piimt.us/images/youtube.png' data-default='placeholder' data-max-width='30' data-customicon='true' width='30' height='30' alt='facebook' style='margin-right:40x;'></a>
																																				
																														                      </div>
																														                    </div>
																																		</td>
																																		<td valign='top' width='10'>
																																			<div class='contentEditableContainer contentImageEditable' style='display:inline;'>
																														                      <div class='contentEditable'>
																														                        <a target='_blank' href='#' data-default='placeholder' style='text-decoration:none;'>
																																					</a><a href='https://www.linkedin.com/company/american-university-of-leadership' target='_blanck'> <img src='http://edu.piimt.us/images/linkedin.png' data-default='placeholder' data-max-width='30' data-customicon='true' width='30' height='30' alt='facebook' style='margin-right:40x;'></a>
																																				
																														                      </div>
																														                    </div>
																																		</td>
																																		<td valign='top' width='10'>
																																			<div class='contentEditableContainer contentImageEditable' style='display:inline;'>
																														                      <div class='contentEditable'>
																														                        <a target='_blank' href='#' data-default='placeholder' style='text-decoration:none;'>
																																					</a><a href='https://plus.google.com/112140129249305802090/about' target='_blanck'> <img src='http://edu.piimt.us/images/google.png' data-default='placeholder' data-max-width='30' data-customicon='true' width='30' height='30' alt='facebook' style='margin-right:40x;'></a>
																																				
																														                      </div>
																														                    </div>
																																		</td>
																																		<td valign='top' width='10'>
																																			<div class='contentEditableContainer contentImageEditable' style='display:inline;'>
																														                      <div class='contentEditable'>
																														                        <a target='_blank' href='#' data-default='placeholder' style='text-decoration:none;'>
																																					</a><a href='http://www.instagram.com/americanuniversityofleadership' target='_blanck'> <img src='http://edu.piimt.us/images/instagram.png' data-default='placeholder' data-max-width='30' data-customicon='true' width='30' height='30' alt='facebook' style='margin-right:40x;'></a>
																																				
																														                      </div>
																														                    </div>
																																		</td>
																																		<td width='20'></td>
																																		<td width='20'></td>
																																	</tr>
																																</tbody>
																															</table>
																														</td>
																													</tr>
																													<tr>
																														<td width='100%' height='70' valign='middle' style='padding-bottom: 0px;'>
																															<div class='contentEditableContainer contentTextEditable'>
																											                	<div class='contentEditable' align='center'>
																											                  		<span style='font-size:13px;color:#000;font-family:Helvetica, Arial, sans-serif;line-height:200%;'>© 2016 | <a href='http://edu2.aulm.us/' target='_blanck' style='color: #106aab;font-size: 14px;font-style: normal;text-decoration: none;'>Private International Institute of Management and Technology</a>. All rights reserved.</span>
																																
																											                	</div>
																											              	</div>
																														</td>
																													</tr>
																												</tbody>
																											</table>
																										</div>
																									</td>
																								</tr>
																							</tbody>
																						</table>

																					
																					

																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
															</tbody>
														</table>
														<!-- End of wrapper table -->




													</body>
												</html>";
											
											$From2  = "From:psi@piimt.us\n";
											$From2 .= "Cc:\n";
											$From2 .= "Bcc:".$to_email_fr."\n";
											$From2 .= "MIME-version: 1.0\n";
											$From2 .= "Content-type: text/html; charset= utf-8 \n";	
											mail($to2,$subject2,$message2,$From2);
											?>
											<div class="alert  btn-success alert-dismissible fade in" role="alert">
									              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
									              <h4>tout les mails sont envoyé avec succès.</h4> 
									        </div>
											<script type="text/javascript" language="JavaScript1.2">			
												window.location.replace('gestion_sondage.php?list_sondage');
											</script>
											<?php
							        	}


									?>

							</div>
							<div class="tab-pane" id="et_r" style="">
							</div>
							
							
		
							
		
						</div>
		
					</div>
		
					
		
				</div>
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
