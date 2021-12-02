<?php
	// activer une réponse
	$_SESSION['message_error'] 	=	"";
	$_SESSION['message_deja'] 	=  	"";
	$_SESSION['message_success'] =  "";

	if (isset($_GET['activer_response'])) {
		if ($_GET['id'] != "") {
			// verifier si il'est désactiver
			$id = $_GET['id'];

			$select_reponse = "SELECT  `statut` FROM `tbl_reponses` WHERE `id` = $id";
			$update_reponse = "UPDATE `tbl_reponses` SET`statut`=0 WHERE `id` = $id ";
			$query_select = mysql_query($select_reponse);
			if (mysql_num_rows($query_select) == 1) {
				$row=mysql_fetch_assoc($query_select);
				$statut = $row['statut'];

				if ($statut == 1) {
					@mysql_query($update_reponse) or die ("erreur lors de l'activation de la reponse");
					$_SESSION['message_success'] =  "The answer has been successfully activated";
					?>
					<script type="text/javascript" language="JavaScript1.2">
						window.location.replace('Surveys.php?response_list');
					</script>

					<?php
				}else{
					$_SESSION['message_deja'] 	=  	"The answer is already activate";
					?>
					<script type="text/javascript" language="JavaScript1.2">
						window.location.replace('Surveys.php?response_list');
					</script>

					<?php
				}
			}else{
				$_SESSION['message_error'] 	=	"The answer you try to activate it does not exist!";
				?>
				<script type="text/javascript" language="JavaScript1.2">
					window.location.replace('Surveys.php?response_list');
				</script>

				<?php
			}
		}else{
			$_SESSION['message_error'] 	=	"The system has detected an error try again";
			?>
			<script type="text/javascript" language="JavaScript1.2">
				window.location.replace('Surveys.php?response_list');
			</script>

			<?php
		}
	}elseif (isset($_GET['desactiver_response'])) {
		if ($_GET['id'] != "") {
			// verifier si il'est désactiver
			$id = $_GET['id'];
			$select_reponse = "SELECT  `statut` FROM `tbl_reponses` WHERE `id` = $id";
			$update_reponse = "UPDATE `tbl_reponses` SET`statut`=1 WHERE `id` = $id ";
			$query_select = mysql_query($select_reponse);
			if (mysql_num_rows($query_select) == 1) {
				$row=mysql_fetch_assoc($query_select);
				$statut = $row['statut'];
				if ($statut == 0) {
					@mysql_query($update_reponse) or die ("error update answer");
					$_SESSION['message_success'] =  "The answer has been successfully disabled";
					?>
					<script type="text/javascript" language="JavaScript1.2">
						window.location.replace('Surveys.php?response_list');
					</script>

					<?php
				}else{
					$_SESSION['message_deja'] 	=  	"The answer is already deactivate";
					?>
					<script type="text/javascript" language="JavaScript1.2">
						window.location.replace('Surveys.php?response_list');
					</script>

					<?php
				}
			}else{
				$_SESSION['message_error'] 	=	"The answer you try to disable it does not exist!";
				?>
				<script type="text/javascript" language="JavaScript1.2">
					window.location.replace('Surveys.php?response_list');
				</script>

				<?php
			}
		}else{
			$_SESSION['message_error'] 	=	"The system has detected an error try again";
			?>
			<script type="text/javascript" language="JavaScript1.2">
				window.location.replace('Surveys.php?response_list');
			</script>

			<?php
		}
	}else{
		?>
			<script type="text/javascript" language="JavaScript1.2">
				window.location.replace('Surveys.php?response_list');
			</script>

		<?php
	}



 ?>
