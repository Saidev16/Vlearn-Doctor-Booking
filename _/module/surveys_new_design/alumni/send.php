<?php 

	if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
		$sql_etu="SELECT `code_inscription`,`email` FROM `tbl_etudiant_deac` WHERE `code_inscription` = \"test123456\"";
		$req_etu = @mysql_query($sql_etu);
		$completed = 0;
		$incompleted = 0;
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
				$sql_complet = "UPDATE `tbl_etudiant_deac` SET `survey_alumni` = 1 where `code_inscription` = \"$code_inscription\"";
				@mysql_query($sql_complet);
				$completed++;
				$finnish = "true";
			}else{
				$sql_complet = "UPDATE `tbl_etudiant_deac` SET `survey_alumni` = 0 where `code_inscription` = \"$code_inscription\"";
				@mysql_query($sql_complet);
				$sql_send = "UPDATE `tbl_etudiant_deac` SET `survey_alumni_send` = 1 where `code_inscription` = \"$code_inscription\"";
				@mysql_query($sql_send);
				
				$incompleted++;
				$finnish = "false";
				//email envoyer
				$headers  = "From: contact@aulm.us\n";
		  		$headers .= "Reply-To: contact@aulm.us\n"; 
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
 				//$email = "zineb@aulm.us";
 				//mail("$email",'We want your opinion',$message,$headers);

				$i++;
				

			}
			
		}

		echo json_encode(['nombre'=>$i]);
		

	}else{

	}

 ?>