<?php if (isset($_GET['admin_alumni_student'])): ?>
	<?php 
		// envoi_student_alumni
		
		//calcule 
		$annee = "";
		$session = "";
		$if = 0;
		$where = "";
		if(isset($_POST['annee']) && $_POST['annee'] != 0 && isset($_POST['session']) && $_POST['session'] != 0){
			$annee = $_POST['annee'];
			$session = $_POST['session'];
			$where ="`bba_grad_date` like \"%$annee-$session-20%\" or `mba_grad_date` like \"%$annee-$session-20%\"";
		}elseif (isset($_POST['annee']) && $_POST['annee'] != 0) {
			$annee = $_POST['annee'];
			$where ="`bba_grad_date` like \"%$annee%\" or `mba_grad_date` like \"%$annee%\"";
		}elseif (isset($_POST['session']) && $_POST['session'] != 0) {
			$session = $_POST['session'];
			$where ="`bba_grad_date` like \"%$session-20%\" or `mba_grad_date` like \"%$session-20%\"";
		}else{
			$where = "`bba_grad_date` != \"0000-00-00\" or `mba_grad_date` != \"0000-00-00\" ";
		}
		$send_mail= 0;
		if (isset($_POST['send']) && $_POST['send'] == 1) {

			$sql_etu="SELECT `code_inscription`,`email`,`niveau`,`bbagrad`,`mbagrad` FROM  `tbl_etudiant_deac` WHERE `survey_alumni` = 0 and $where";
			var_dump($sql_etu);
			$req_etu = @mysql_query($sql_etu);
			$completed = 0;
			$incompleted = 0;
			
			while ($row_etu = mysql_fetch_assoc($req_etu)) {
				$code_inscription = $row_etu['code_inscription'];
				$sql_question = "SELECT distinct q.`id` FROM `questions_alumni` as q , `tbl_reponse_alumni` as r WHERE q.`active` = 0 and q.`id` = r.`question_id`";
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
				$row_res = mysql_fetch_array($req_res);
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
				$count_res = $row_count_res['0'];
				if ($count_res == $q) {
					$sql_complet = "UPDATE `tbl_etudiant_deac` SET `survey_alumni` = 1 where `code_inscription` = \"$code_inscription\"";
					@mysql_query($sql_complet);
					$completed++;
					$finnish = "true";
				}else{
					$bbagrad = $row_etu['bbagrad'];
					$mbagrad = $row_etu['mbagrad'];
					if ($bbagrad == 1) {
						$sql_nb_credit	= "SELECT SUM(c.`nbr_credit`) as nb
										FROM tbl_note AS n, tbl_cours AS c
										where 
										n.code_inscription = \"$code_inscription\"
										AND c.code_cours = n.code_cours
										AND c.type = 'bachelor'
										AND n.archive = 0
										AND n.`letter_grade` not in ('X','F*','F','I')
										group by n.`code_inscription`";
					}
					if ($mbagrad == 1) {
						$sql_nb_credit	= "SELECT SUM(c.`nbr_credit`) as nb
										FROM tbl_note AS n, tbl_cours AS c
										where 
										n.code_inscription = \"$code_inscription\"
										AND c.code_cours = n.code_cours
										AND c.type = 'master'
										AND n.archive = 0
										AND n.`letter_grade` not in ('X','F*','F','I')
										group by n.`code_inscription`";
					}

					$req_nb_credit = @mysql_query($sql_nb_credit);
					$row_nb_credit = mysql_fetch_assoc($req_nb_credit);
					$nb_credit = $row_nb_credit['nb'];
					//echo $code_inscription." = ".$nb_credit." /   ";
					if ($nb_credit == 126 or $nb_credit == 60) {
						$sql_complet = "UPDATE `tbl_etudiant_deac` SET `survey_alumni` = 0 where `code_inscription` = \"$code_inscription\"";
						//@mysql_query($sql_complet);
						$sql_send = "UPDATE `tbl_etudiant_deac` SET `survey_alumni_send` = 1 where `code_inscription` = \"$code_inscription\"";
						@mysql_query($sql_send);
						$incompleted++;
						$finnish = "false";

							//email envoyer
							$headers  = "From:survey@aulm.us\n";
					  		$headers .= "Reply-To: survey@aulm.us\n"; 
							$headers .='Content-Type: text/html; charset="UTF8"'."\n";
							$headers .='Content-Transfer-Encoding: 8bit'; 

							$message ="	<html>
			 					<head>
			 						<title></title>
			 					</head>
			 					<body style='border:hidden !important; bgcolor=' #ffffff'=' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0' >
									<!-- Header-->
									<table border='0' cellpadding='0' cellspacing='0' align='center' width='100%' style='font-family: Arial,Helvetica,sans-serif; max-width: 700px;'>
								       <tbody><tr bgcolor='#bc6162'>
								           <td colspan='5' height='40'>&nbsp;</td>
								       </tr>
								       <tr bgcolor='#bc6162'>
								           <td width='20'>&nbsp;</td>
								           <td width='20'>&nbsp;</td>
								           <td align='center' style='font-size: 29px; color:#FFF; font-weight: normal; letter-spacing: 1px; line-height: 1;
								                           text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.2); font-family: Arial,Helvetica,sans-serif;'>
								              American University of Leadership Alumni Survey
								           </td>
								           <td width='20'>&nbsp;</td>
								           <td width='20'>&nbsp;</td>
								       </tr>
								       <tr bgcolor='#bc6162'>
								           <td colspan='5' height='40'>&nbsp;</td>
								       </tr>
								       <tr>
								           <td height='10' colspan='5'>&nbsp;</td>
								       </tr>
								       <tr>
								           <td>&nbsp;</td>
								           <td colspan='3' align='left' valign='top' style='color:#666666; font-size: 13px;'>
								              
								                <p>We are conducting a survey and your input would be appreciated. Click the button below to start the survey. Thank you for your participation!</p>
								              
								           </td>
								           <td>&nbsp;</td>
								       </tr>

								       
								           <tr>
								               <td colspan='5' height='30'>&nbsp;</td>
								           </tr>
								           <tr>
								               <td>&nbsp;</td>
								               <td colspan='3'>
								                   <table border='0' cellpadding='0' cellspacing='0' align='center' style='background:#bc6162; border-radius: 4px; border: 1px solid #BBBBBB; color:#FFFFFF; font-size:14px; letter-spacing: 1px; text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.8); padding: 10px 18px;'>
								                       <tbody><tr>
								                           <td align='center' valign='center'>
								                               <a href='http://psi.piimt.us/piimt/index.php?survey_alumni=".$code_inscription."&s=6' target='_blank' style='color:#FFFFFF; text-decoration:none;'>Begin Survey</a>
								                           </td>
								                       </tr>
								                   </tbody></table>
								               </td>
								               <td>&nbsp;</td>
								           </tr>
								           <tr>
								               <td colspan='5' height='30'>&nbsp;</td>
								           </tr>
								       
								       <tr valign='top' style='color: #666666;font-size: 10px;'>
								           <td>&nbsp;</td>
								           <td valign='top' align='center' colspan='3'>
								               <p>Please do not forward this email as its survey link is unique to you.</p>
								           </td>
								           <td>&nbsp;</td>
								       </tr>
								       <tr>
								           <td height='20' colspan='5'>&nbsp;</td>
								       </tr>

								       <tr style='color: #999999;font-size: 10px;'>
								           <td align='center' colspan='5'><table width='100%' cellpadding='2'>
								    <tbody>
								        
								    </tbody>
								</table>
								</td>
						       </tr>
						       <tr>
						           <td height='20' colspan='5'>&nbsp;</td>
						       </tr>
								<tr>
										<td>&nbsp;</td>
								        <td valign='top' align='center' colspan='3'>
								            <span style='font-size:13px;color:#181818;font-family:Helvetica, Arial, sans-serif;line-height:200%;' >© 2016 | <a rel='nofollow' target='_blank' href='http://edu.aulm.us/' style='color:#891818;font-size:14px;font-style:normal;text-decoration:none;'>American University of Leadership </a>. All rights reserved.</span>
								        </td>
								        <td>&nbsp;</td>
								</tr>
								   </tbody>
								</table>
								</body>
			 				</html>";
		 					$email = $row_etu['email'];
		 					//echo $message;

		 					mail("$email",'We want your opinion',"$message",$headers);

						$send_mail++;
					}
				}
				
			}

		}
		//echo $send_mail;
		$sql_etu="SELECT `code_inscription`,`nom`,`prenom`,`email`,`ville`,`date_inscription`, `niveau`, `bbagrad`, `mbagrad`, `date_inscription_mba`,`survey_alumni`, `survey_alumni_read`, `survey_alumni_send` FROM `tbl_etudiant_deac` WHERE $where";
		//var_dump($sql_etu);

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
			if ($degree == 'false' && $degree1 == 'false') {
				$q = $q-$t;
			}elseif($degree == 'true'){
				$q = $q-3;
			}elseif ($degree1 == 'true') {
				$q = $q-6;
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
				$sql_complet = "UPDATE `tbl_etudiant_deac` SET `survey_alumni` = 1 where `code_inscription` = \"$code_inscription\"";
				@mysql_query($sql_complet);
				$completed++;
				$finnish = "true";
			}else{
				$sql_complet = "UPDATE `tbl_etudiant_deac` SET `survey_alumni` = 0 where `code_inscription` = \"$code_inscription\"";
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

		//$sql="SELECT `code_inscription`,`nom`,`prenom`,`email`,`ville`,`date_inscription`, `niveau`, `bbagrad`, `mbagrad`, `date_inscription_mba`,`survey_alumni`, `survey_alumni_read`, `survey_alumni_send` FROM `tbl_etudiant_deac` WHERE `bbagrad` = 1 or `mbagrad` = 1";
		$sql="SELECT `code_inscription`,`nom`,`prenom`,`email`,`ville`,`date_inscription`, `niveau`, `bbagrad`, `mbagrad`, `date_inscription_mba`,`survey_alumni`, `survey_alumni_read`, `survey_alumni_send` FROM `tbl_etudiant_deac` WHERE $where";
		//var_dump($sql);
		$req = @mysql_query($sql);

		unset($_POST);

	?>
	
	  <div style="<?php if ($send_mail == 0){ ?>display:none;<?php }?> margin-bottom: 0px;" class="alert alert-success" role="alert"> 
	  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class='fermer' aria-hidden="true">×</span></button>
	  	<strong>l'email du sondage est envoyé a <span class="nb_etu"><?php echo $send_mail; ?></span></strong>   
	  </div>
	    
	<table class="table table-bordered"> 
		<thead> 
			<tr> 
				<form action="gestion_sondage.php?admin_alumni_student" method="POST">
				<th colspan="2">
					<select class="form-control" name="annee">
						<option value="0">Année</option>
						<option value="2016">2016</option>
						<option value="2017">2017</option>
					</select>
				</th>
				<th colspan="1">
					<select name="session" class="form-control">
						<option value="0">Session</option>
						<option value="06">Juin</option>
						<option value="01">Janvier</option>
					</select>
				</th>
				<th>
			        <label style="margin-bottom: 8px;">
			          <input type="checkbox" name="send" value="1"> envoyer le sondage aux etudiants
			        </label>
				</th>
				
				
				 
				<th colspan="5"> <button class="btn btn-success">rechereche</button> </form></th>

			</tr> 
		</thead>
		<thead> 
			<tr> 
				<th colspan="2">Nombre d'etudiant : <?php echo $i; ?></th> 
				<th colspan="2">sondage lu : <?php echo $lu; ?></th>
				<th colspan="2">sondage envoyer : <?php echo $send; ?></th> 
				<th colspan="3">sondage completer : <?php echo $completed; ?></th>
			</tr> 
		</thead>
		<thead> 
			<tr> 
				<th>Code d'inscription</th>
				<th>Nom</th> 
				<th>Prenom</th> 
				<th>Email</th>
				<th>Ville</th>
				<th>Niveau</th>
				<th>Envoyer</th>
				<th>Lue</th>
				<th>statut</th>
			</tr> 
		</thead> 
		<tbody>
	<?php
		while ($row = mysql_fetch_assoc($req)){
	?>
		<tr> 
			<td style="text-align: left;" ><?php echo $row['code_inscription']; ?></td> 
			<td style="text-align: left;" ><?php echo $row['nom']; ?></td> 
			<td style="text-align: left;" ><?php echo $row['prenom']; ?></td> 
			<td style="text-align: left;" ><?php echo $row['email']; ?></td>
			<td style="text-align: left;" ><?php echo $row['ville']; ?></td>
			<td style="text-align: left;" ><?php echo $row['niveau']; ?></td>
			<td>
				<?php if ($row['survey_alumni_send'] == 0): ?>
					<?php echo "non"; ?>
				<?php endif ?>
				<?php if ($row['survey_alumni_send'] == 1): ?>
					<?php echo "oui"; ?>
				<?php endif ?>
			</td>
			<td>
				<?php if ($row['survey_alumni_read'] == 0): ?>
					<?php echo "non"; ?>
				<?php endif ?>
				<?php if ($row['survey_alumni_read'] == 1): ?>
					<?php echo "oui"; ?>
				<?php endif ?>
			</td>
			<td>
				<?php if ($row['survey_alumni'] == 0): ?>
					<?php echo "non"; ?>
				<?php endif ?>
				<?php if ($row['survey_alumni'] == 1): ?>
					<?php echo "oui"; ?>
				<?php endif ?>
			</td>
		</tr>	
	<?php
		}
	 ?>
	 </tbody> 
		</table>
		
	<script type="text/javascript">
		// jQuery(".send_all").click(function(){
		// 	jQuery(".alert-success").slideDown();
		// 	$.ajax({
	 //            type :'POST',
	 //            url : 'gestion_sondage.php?admin_alumni_send',
	 //            dataType:'json',
	 //            data: {
	                
	 //             },
	 //            success : function(data){
	 //            	jQuery('.nb_etu').html(data.nombre);
	 //            }
	 //        });
		// });
		// jQuery('.fermer').click(function(){
		// 	jQuery(".alert-success").hide();
		// });

</script>
<?php endif ?>

