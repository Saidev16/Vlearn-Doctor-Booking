<?php 
	// activer une sondage 
	$_SESSION['message_error'] 	=	"";
	$_SESSION['message_deja'] 	=  	"";
	$_SESSION['message_success'] =  "";

	if (isset($_GET['activer_sondage'])) {
		if ($_GET['id'] != "") {
			// verifier si il'est désactiver 
			$id = $_GET['id'];

			$select_sondage = "SELECT  `statut` FROM `tbl_sondage` WHERE `id` = $id";
			$update_sondage = "UPDATE `tbl_sondage` SET`statut`=0 WHERE `id` = $id ";
			$query_select = mysql_query($select_sondage);
			if (mysql_num_rows($query_select) == 1) {
				$row=mysql_fetch_assoc($query_select);
				$statut = $row['statut'];
					
				if ($statut == 1) {
					@mysql_query($update_sondage) or die ("erreur lors de l'activation du sondage");
					$_SESSION['message_success'] =  "le sondage a été activer avec succès ";
					?>
					<script type="text/javascript" language="JavaScript1.2">			
						window.location.replace('gestion_sondage.php');
					</script>

					<?php
				}else{
					$_SESSION['message_deja'] 	=  	"le sondage et deja activer";
					?>
					<script type="text/javascript" language="JavaScript1.2">			
						window.location.replace('gestion_sondage.php');
					</script>

					<?php
				}
			}else{
				$_SESSION['message_error'] 	=	"le sondage que vous tentez d'activer n'existe pas !";
				?>
				<script type="text/javascript" language="JavaScript1.2">			
					window.location.replace('gestion_sondage.php');
				</script>

				<?php
			}
		}else{
			$_SESSION['message_error'] 	=	"le systéme a détecté une erreur pendant l'activation du sondage merci de ressayer une autre fois";
			?>
			<script type="text/javascript" language="JavaScript1.2">			
				window.location.replace('gestion_sondage.php');
			</script>

			<?php
		}
	}elseif (isset($_GET['desactiver_sondage'])) {
		if ($_GET['id'] != "") {
			// verifier si il'est désactiver 
			$id = $_GET['id'];
			$select_sondage = "SELECT  `statut` FROM `tbl_sondage` WHERE `id` = $id";
			$update_sondage = "UPDATE `tbl_sondage` SET`statut`=1 WHERE `id` = $id ";
			$query_select = mysql_query($select_sondage);
			if (mysql_num_rows($query_select) == 1) {
				$row=mysql_fetch_assoc($query_select);
				$statut = $row['statut'];
				if ($statut == 0) {
					@mysql_query($update_sondage) or die ("erreur lors de l'activation du sondage");
					$_SESSION['message_success'] =  "le sondage a été désactiver avec succès ";
					?>
					<script type="text/javascript" language="JavaScript1.2">			
						window.location.replace('gestion_sondage.php');
					</script>

					<?php
				}else{
					$_SESSION['message_deja'] 	=  	"le sondage est déja désactiver";
					?>
					<script type="text/javascript" language="JavaScript1.2">			
						window.location.replace('gestion_sondage.php');
					</script>

					<?php
				}
			}else{
				$_SESSION['message_error'] 	=	"le sondage que vous tentez de le désactiver n'existe pas !";
				?>
				<script type="text/javascript" language="JavaScript1.2">			
					window.location.replace('gestion_sondage.php');
				</script>

				<?php
			}
		}else{
			$_SESSION['message_error'] 	=	"le systéme a détecté une erreur pendant la désactivation du sondage merci de ressayer une autre fois";
			?>
			<script type="text/javascript" language="JavaScript1.2">			
				window.location.replace('gestion_sondage.php');
			</script>

			<?php
		}
	}else{
		?>
			<script type="text/javascript" language="JavaScript1.2">			
				window.location.replace('gestion_sondage.php');
			</script>

		<?php
	}



 ?>
