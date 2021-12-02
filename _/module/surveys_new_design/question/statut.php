<?php 
	// activer une question 
	$_SESSION['message_error'] 	=	"";
	$_SESSION['message_deja'] 	=  	"";
	$_SESSION['message_success'] =  "";

	if (isset($_GET['activer_question'])) {
		if ($_GET['id'] != "") {
			// verifier si il'est désactiver 
			$id = $_GET['id'];

			$select_question = "SELECT  `statut` FROM `tbl_questions` WHERE `id` = $id";
			$update_question = "UPDATE `tbl_questions` SET`statut`=0 WHERE `id` = $id ";
			$query_select = mysql_query($select_question);
			if (mysql_num_rows($query_select) == 1) {
				$row=mysql_fetch_assoc($query_select);
				$statut = $row['statut'];
					
				if ($statut == 1) {
					@mysql_query($update_question) or die ("erreur lors de l'activation de la reponse");
					$_SESSION['message_success'] =  "la question a été activer avec succès ";
					?>
					<script type="text/javascript" language="JavaScript1.2">			
						window.location.replace('gestion_sondage.php?list_question');
					</script>

					<?php
				}else{
					$_SESSION['message_deja'] 	=  	"la question et deja activer";
					?>
					<script type="text/javascript" language="JavaScript1.2">			
						window.location.replace('gestion_sondage.php?list_question');
					</script>

					<?php
				}
			}else{
				$_SESSION['message_error'] 	=	"la question que vous tentez l'activer n'existe pas !";
				?>
				<script type="text/javascript" language="JavaScript1.2">			
					window.location.replace('gestion_sondage.php?list_question');
				</script>

				<?php
			}
		}else{
			$_SESSION['message_error'] 	=	"le systéme a détecté une erreur pendant l'activation de la question merci de ressayer une autre fois";
			?>
			<script type="text/javascript" language="JavaScript1.2">			
				window.location.replace('gestion_sondage.php?list_question');
			</script>

			<?php
		}
	}elseif (isset($_GET['desactiver_question'])) {
		if ($_GET['id'] != "") {
			// verifier si il'est désactiver 
			$id = $_GET['id'];
			$select_question = "SELECT  `statut` FROM `tbl_questions` WHERE `id` = $id";
			$update_question = "UPDATE `tbl_questions` SET`statut`=1 WHERE `id` = $id ";
			$query_select = mysql_query($select_question);
			if (mysql_num_rows($query_select) == 1) {
				$row=mysql_fetch_assoc($query_select);
				$statut = $row['statut'];
				if ($statut == 0) {
					@mysql_query($update_question) or die ("erreur lors de l'activation de la reponse");
					$_SESSION['message_success'] =  "la question a été désactiver avec succès ";
					?>
					<script type="text/javascript" language="JavaScript1.2">			
						window.location.replace('gestion_sondage.php?list_question');
					</script>

					<?php
				}else{
					$_SESSION['message_deja'] 	=  	"la question est déja désactiver";
					?>
					<script type="text/javascript" language="JavaScript1.2">			
						window.location.replace('gestion_sondage.php?list_question');
					</script>

					<?php
				}
			}else{
				$_SESSION['message_error'] 	=	"la question que vous tentez de la désactiver n'existe pas !";
				?>
				<script type="text/javascript" language="JavaScript1.2">			
					window.location.replace('gestion_sondage.php?list_question');
				</script>

				<?php
			}
		}else{
			$_SESSION['message_error'] 	=	"le systéme a détecté une erreur pendant la désactivation du question merci de ressayer une autre fois";
			?>
			<script type="text/javascript" language="JavaScript1.2">			
				window.location.replace('gestion_sondage.php?list_question');
			</script>

			<?php
		}
	}else{
		?>
			<script type="text/javascript" language="JavaScript1.2">			
				window.location.replace('gestion_sondage.php?list_question');
			</script>

		<?php
	}



 ?>
