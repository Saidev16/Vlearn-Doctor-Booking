<?php
	if (isset($_GET['activer_affectation']) && $_GET['activer_affectation'] == "oui"){

		$message_session = 0;

		if ($_POST['session'] == "null") {
			$message_session = 1;
		}

		if ($message_session == 1) {
			$_SESSION['message_session'] = $message_session;
			$_SESSION['session'] = $_POST['session'];
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--
					window.location.replace('Surveys.php?activer_affectation');
			//-->
			</script>
			<?php
		}else{


			$session = $_POST['session'];


			$sql_insert = "UPDATE `tbl_sondage_affectation` SET `archive`= 1 WHERE `session` = \"$session\"";
			mysql_query($sql_insert)or die ("erreur lors du l'archivation des s'affectations");

			?>

			<script type="text/javascript" language="JavaScript1.2">
			<!--
					window.location.replace('Surveys.php?list_affectation');
			//-->
			</script>
			<?php
		}
	}elseif (isset($_GET['desactiver_affectation']) && $_GET['desactiver_affectation'] == "oui"){

		$message_session = 0;

		if ($_POST['session'] == "null") {
			$message_session = 1;
		}

		if ($message_session == 1) {
			$_SESSION['message_session'] = $message_session;
			$_SESSION['session'] = $_POST['session'];
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--
					window.location.replace('Surveys.php?desactiver_affectation');
			//-->
			</script>
			<?php
		}else{


			$session = $_POST['session'];


			$sql_insert = "UPDATE `tbl_sondage_affectation` SET `archive`= 0 WHERE `session` = \"$session\"";
			mysql_query($sql_insert)or die ("erreur lors du l'archivation des s'affectations");

			?>

			<script type="text/javascript" language="JavaScript1.2">
			<!--
					window.location.replace('Surveys.php?list_affectation');
			//-->
			</script>
			<?php
		}






		?>

              <?php
			  }
			  else{
			  ?>

		<table border="0" width="100%" align="center" class="haut_table">
		  <tr>
		    	<td>
					<img src="images/icone/etudiants.gif" border="0"/>
				</td>
		    	<td width="78%" class="titre" style="text-align:left;">
					&nbsp;Surveys<span class="task">
					<?php $action=""; ?>
					<?php if (isset($_GET['activer_affectation'])): ?>
						<?php $action = "activer_affectation"; ?>
						[Archive a session]
					<?php endif ?>
					<?php if (isset($_GET['desactiver_affectation'])): ?>
						<?php $action = "desactiver_affectation"; ?>
						[Unarchive a session]
					<?php endif ?>
					</span>
			    </td>



	 	<form method="post" action="Surveys.php?<?php echo $action; ?>=oui" >

	 		<td width="22%">
			 <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
			    <tr>
				  <td style="padding: 22px;" valign="top" align="center">
				   <div class="save"></div> <input type="submit" value="Submit"/>
				  </td>
				  <td style="padding: 22px;" valign="top" align="center">
				   <a href="Surveys.php?list_affectation"><div class="cancel"></div>Cancel</a>
				  </td>
				</tr>
			  </table>
				</td>
		  </tr>
		 </table>
		  <table style="margin:20px" border="0" width="100%" cellpadding="0" cellspacing="0" align="center" >
		   <tr>
		     <td height="5"></td>
		   </tr>
	       <tr>
	         <td valign="top" width="100%">
		        <table border="0" cellpadding="0" cellspacing="2" width="100%" class="cellule_table">

				  	<tr><td colspan="3" height="3px"></td></tr>
		        	<tr>
						<td>Session * : </td>
						<td style="text-align:left;">
							<select name="session" class=" input input_size"  style="width:280px">
								<option value="null">Choose the session</option>
								<?php
						 			$sql_sess = "SELECT * FROM `tbl_session` order by annee_academique";
						 			$req_sess = mysql_query($sql_sess)or die ("erreur lors de la sélection des sondage");

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
							<?php if ($_SESSION['message_session'] == "1"): ?>
								<?php echo "Ce champ est obligatoire"; ?>
							<?php endif ?>
						</td>
						  <td>&nbsp;</td>
				  	</tr>
				  	<tr><td colspan="3" height="3px"></td></tr>


				  	<?php
						$_SESSION['message_session'] = "0";
						$_SESSION['session'] = "";
				  	 ?>


				</table>
		     </td>

			</tr>

		  </table>

	    </form>

<?php

}

?>
