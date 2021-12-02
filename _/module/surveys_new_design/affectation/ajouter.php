<?php
if (isset($_GET['new_affectation']) && $_GET['new_affectation'] == "oui"){
		$message_prof = "";
		$message_cour = "";
		$message_session = "";
		$message_groupe = "";
		if ($_POST['code_prof'] == "null") {
			$message_prof = 1;
		}
		if ($_POST['cour'] == "null") {
			$message_cour = 1;
		}
		if ($_POST['session'] == "null") {
			$message_session = 1;
		}
		// if ($_POST['groupe'] == "null") {
		// 	$message_groupe = 1;
		// }


		if ( $message_cour == 1
			|| $message_prof == 1 || $message_session == 1) {
			$_SESSION['message_prof'] = $message_prof;
			$_SESSION['message_cour'] = $message_cour;
			$_SESSION['message_session'] = $message_session;
			// $_SESSION['message_groupe'] = $message_groupe;

			$_SESSION['prof'] = $_POST['code_prof'];
			$_SESSION['cour'] = $_POST['cour'];
			$_SESSION['session'] = $_POST['session'];
			$_SESSION['groupe'] = $_POST['groupe'];

			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--
					window.location.replace("Surveys.php?new_affectation");
			//-->
			</script>
			<?php
		}else{
			$prof = $_POST['code_prof'];
			$cour = $_POST['cour'];
			$session = $_POST['session'];
			$groupe = $_POST['groupe'];


			$sql_exist = "SELECT COUNT(*) FROM `tbl_sondage_affectation` WHERE `session` = \"$session\"  and `type` = \"$type\"
				and `code_cours` = \"$cour\" and `groupe` = $groupe ";
			$req = mysql_query($sql_exist) or die ("erreur lors de l'affectation");
			$nb = mysql_fetch_row($req);

			if ($nb[0] != 0) {
				$_SESSION['exist'] = 1;
				$_SESSION['prof'] = $_POST['code_prof'];
				$_SESSION['cour'] = $_POST['cour'];
				// $_SESSION['groupe'] = $_POST['groupe'];
				$_SESSION['session'] = $_POST['session'];

				?>
				<script type="text/javascript" language="JavaScript1.2">
				<!--
						window.location.replace('Surveys.php?new_affectation');
				//-->
				</script>
				<?php
			}else{
				$sql_insert = "INSERT INTO `tbl_sondage_affectation`(`code_prof`, `code_cours`,`session`, `type`,`archive`,`groupe`,`niveau`,`campus`)
				VALUES (\"$prof\",\"$cour\",\"$session\",\"$type\",1,$groupe,\"bba\",\"e-learning\")";
				mysql_query($sql_insert)or die ("erreur lors de l'affectation");
				$_SESSION['message_prof'] = "";
				$_SESSION['message_cour'] = "";
				$_SESSION['message_session'] = "";
				$_SESSION['message_groupe'] = "";

				$_SESSION['prof'] = "";
				$_SESSION['cour'] = "";
				$_SESSION['session'] = "";
				$_SESSION['groupe'] = "";
				$_SESSION['exist'] = "";

				?>
				<script type="text/javascript" language="JavaScript1.2">
				<!--
						window.location.replace('Surveys.php?list_affectation');
				//-->
				</script>


			<?php
			}
		}
}else{
		  ?>

		<table border="0" width="100%" align="center" class="haut_table">
		  <tr>
		    	<td>
					<img src="images/icone/etudiants.gif" border="0"/>
				</td>
		    	<td width="78%" class="titre">
					&nbsp;Listing Survey <span class="task">[add  affectation]</span>
			    </td>


	 	<form method="post" action="Surveys.php?new_affectation=oui" >
	 		<td width="22%">
			 <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
			    <tr>
				  <td valign="top" align="center">
				   <div class="save"></div> <input type="submit" value="Add"/>
				  </td>
				  <td valign="top" align="center">
				   <a href="Surveys.php?list_affectation"><div class="cancel"></div>Cancel</a>
				  </td>
				</tr>
			  </table>
				</td>
		  </tr>

		 </table>

		  <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center">
		   <tr>
    		<?php if (isset($_SESSION['exist']) && $_SESSION['exist'] == "1"): ?>
    			<td style="padding-left: 26px;color: red;">ATTENTION !!! Ce cour est deja affecter a un proffeseur
    			dans cette session merci de couriger l'erreur ou bien Contacter l'administration </td>
    		<?php endif ?>

    	</tr>
    	<tr>
		     <td height="5"></td>
		   </tr>
	       <tr>
	         <td valign="top" width="100%">
		        <table border="0" cellpadding="0" cellspacing="2" width="100%" class="cellule_table">

					<tr>

						<td style="width: 95px;">Professor * : </td>
						<td style="width: 280px;">
							<select name="code_prof" class=" input input_size"  style="width:280px">
								<option value="null">Choose the professor</option>
							  	<?php
							 		$sql_prof = "SELECT * FROM `tbl_professeur` WHERE 'archive' = 0  order by nom_prenom";
							 		$req_prof = mysql_query($sql_prof)or die ("erreur lors de la sélection des enseignants");

							 		while ($row_prof = mysql_fetch_array($req_prof)) {
							 			$selected = "";
							 			if (isset($_SESSION['prof']) && $row_prof["code_prof"] == $_SESSION['prof']) {
							 				$selected = "selected";
							 			}
						 				echo "<option value='".$row_prof["code_prof"]."'".$selected.">
						 				".$row_prof["nom_prenom"]."</option>";
						 			}

							 	?>
						  	</select>
						</td>
						<td style="padding-left: 26px;color: red;">
							<?php if (isset($_SESSION['message_prof']) && $_SESSION['message_prof'] == "1"): ?>
								<?php echo "Required field"; ?>
							<?php endif ?>
						</td>
						  <td>&nbsp;</td>
				  	</tr>

				  	<tr><td colspan="3" height="3px"></td></tr>
				  	<tr>
						<td>Course * : </td>
						<td>
							<select name="cour" class=" input input_size"  style="width:280px">
								<option value="null">Choose the course</option>
								<?php
							 		$sql_cour = "SELECT * FROM `tbl_cours` WHERE 'archive' = 0 order by code_cours";
							 		$req_cour = mysql_query($sql_cour)or die ("erreur lors de la sélection des enseignants");
							 		while ($row_cour = mysql_fetch_array($req_cour)) {
							 			$selected = "";
							 			if (isset($_SESSION['cour']) && $row_cour["code_cours"] == $_SESSION['cour']) {
							 				$selected = "selected";
							 			}
						 				echo "<option value='".$row_cour["code_cours"]."'".$selected.">".$row_cour["code_cours"]."</option>";
						 			}
							 	?>
						  	</select>
						</td>
						<td style="padding-left: 26px;color: red;">
							<?php if (isset($_SESSION['message_cour']) && $_SESSION['message_cour'] == "1"): ?>
								<?php echo "Required field"; ?>
							<?php endif ?>

						</td>
						  <td>&nbsp;</td>
				  	</tr>
				  	<tr><td colspan="3" height="3px"></td></tr>
		        	<tr>
						<td>Session* : </td>
						<td>
							<select name="session" class=" input input_size"  style="width:280px">
								<option value="null">Choose the session</option>
								<?php
						 			$sql_sess = "SELECT * FROM `tbl_session` order by annee_academique";
						 			$req_sess = mysql_query($sql_sess)or die ("erreur lors de la sélection des enseignants");

						 			while ($row_sess = mysql_fetch_array($req_sess)) {
						 				$selected = "";
							 			if (isset($_SESSION['session']) && $row_sess["idSession"] == $_SESSION['session']) {
							 				$selected = "selected";
							 			}
						 				echo "<option value='".$row_sess["idSession"]."'".$selected.">".$row_sess["session"]." ".$row_sess["annee_academique"]."</option>";
						 			}
						 		?>
						  	</select>
						</td>
						<td style="padding-left: 26px;color: red;">
							<?php if (isset($_SESSION['message_session']) && $_SESSION['message_session'] == "1"): ?>
								<?php echo "Required field"; ?>
							<?php endif ?>
						</td>
						  <td>&nbsp;</td>
				  	</tr>
				  	<tr><td colspan="3" height="3px"></td></tr>
				  	<tr>
						<!-- <td>Program* : </td>
						<td>
							<select name="groupe" class=" input input_size"  style="width:280px">
								<option value="null">Choose the group</option>
							  	<option value="bba" <?php if (isset($_SESSION['groupe']) && $_SESSION['groupe'] == "2"): ?> selected<?php endif ?> >BBA</option>
					          	<option value="dba" <?php if (isset($_SESSION['groupe']) && $_SESSION['groupe'] == "3"): ?> selected<?php endif ?> >DBA</option>
						  	</select>
						</td>
						<td style="padding-left: 26px;color: red;">
							<?php if (isset($_SESSION['message_groupe']) && $_SESSION['message_groupe'] == "1"): ?>
								<?php echo "Required field"; ?>
							<?php endif ?>
						</td> -->
						  <td>&nbsp;</td>
				  	</tr>


				  	<?php
				  		$_SESSION['message_prof'] = "";
						$_SESSION['message_cour'] = "";
						$_SESSION['message_session'] = "";
						$_SESSION['message_type'] = "";
						$_SESSION['message_groupe'] = "";
						$_SESSION['prof'] = "";
						$_SESSION['cour'] = "";
						$_SESSION['session'] = "";
						$_SESSION['groupe'] = "";
						$_SESSION['exist'] = "";
				  	 ?>


				</table>
		     </td>

			</tr>

		  </table>

	    </form>

<?php

}

?>
