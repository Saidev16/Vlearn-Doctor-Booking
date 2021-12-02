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
					$_SESSION['message_success'] =  "la réponse a été activer avec succès ";
					?>
					<script type="text/javascript" language="JavaScript1.2">			
						window.location.replace('gestion_sondage.php?response_list');
					</script>

					<?php
				}else{
					$_SESSION['message_deja'] 	=  	"la réponse et deja activer";
					?>
					<script type="text/javascript" language="JavaScript1.2">			
						window.location.replace('gestion_sondage.php?response_list');
					</script>

					<?php
				}
			}else{
				$_SESSION['message_error'] 	=	"la réponse que vous tentez l'activer n'existe pas !";
				?>
				<script type="text/javascript" language="JavaScript1.2">			
					window.location.replace('gestion_sondage.php?response_list');
				</script>

				<?php
			}
		}else{
			$_SESSION['message_error'] 	=	"le systéme a détecté une erreur pendant l'activation de la réponse merci de ressayer une autre fois";
			?>
			<script type="text/javascript" language="JavaScript1.2">			
				window.location.replace('gestion_sondage.php?response_list');
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
					@mysql_query($update_reponse) or die ("erreur lors de l'activation de la reponse");
					$_SESSION['message_success'] =  "la réponse a été désactiver avec succès ";
					?>
					<script type="text/javascript" language="JavaScript1.2">			
						window.location.replace('gestion_sondage.php?response_list');
					</script>

					<?php
				}else{
					$_SESSION['message_deja'] 	=  	"la réponse est déja désactiver";
					?>
					<script type="text/javascript" language="JavaScript1.2">			
						window.location.replace('gestion_sondage.php?response_list');
					</script>

					<?php
				}
			}else{
				$_SESSION['message_error'] 	=	"la réponse que vous tentez de la désactiver n'existe pas !";
				?>
				<script type="text/javascript" language="JavaScript1.2">			
					window.location.replace('gestion_sondage.php?response_list');
				</script>

				<?php
			}
		}else{
			$_SESSION['message_error'] 	=	"le systéme a détecté une erreur pendant la désactivation du réponse merci de ressayer une autre fois";
			?>
			<script type="text/javascript" language="JavaScript1.2">			
				window.location.replace('gestion_sondage.php?response_list');
			</script>

			<?php
		}
	}else{
		?>
			<script type="text/javascript" language="JavaScript1.2">			
				window.location.replace('gestion_sondage.php?response_list');
			</script>

		<?php
	}



 ?>
