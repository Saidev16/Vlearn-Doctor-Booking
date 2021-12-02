<?php
if (isset($_GET['edit_response']) && $_GET['edit_response'] == 'edit') {

	$message_reponse_en = "";
	$message_unique_reponse_en = "";
	$message_statut = "";
	$message_porcentage = "";

	$_SESSION['message_reponse_en'] = "";
	$_SESSION['message_unique_reponse_en'] = "";
	$_SESSION['message_statut'] = "";
	$_SESSION['reponse_fr'] = "";
	$_SESSION['reponse_en'] = "";
	$_SESSION['statut'] = "";
	$_SESSION['porcentage'] = "";
	//les champ oblegatoire



	if (isset($_POST['id']) && $_POST['id'] != "" && $_GET['id'] != "" && $_GET['id'] == $_POST['id'] ) {

		$id = $_POST['id'];
		$req = "SELECT * FROM `tbl_reponses` WHERE `id` = $id";
		@mysql_query($req) or die("error select answer");
		$query = mysql_query($req);
		if (mysql_num_rows($query) == 1) {
			$row=mysql_fetch_assoc($query);
		}else{
			$_SESSION['message_error'] = "Answer doesn't exist.";
			?>
			<script type="text/javascript" language="JavaScript1.2">
			window.location.replace('Surveys.php?response_list');
			</script>
			<?php
		}
		$db_id = $row['id'];
		$bd_rep_fr = $row['rep_en'];
		$bd_rep_en = $row['rep_en'];
		$bd_statut = $row['statut'];
		$db_porcentage = $row['porcentage'];
		$reponse_fr = $_POST['reponse_en'];
		$reponse_en = $_POST['reponse_en'];
		$porcentage = $_POST['porcentage'];
		$statut = $_POST['statut'];
		if (empty($_POST['reponse_en']) || $_POST['reponse_en'] == "") {
			$message_reponse_en = "1";
		}else{
			if ($bd_rep_en != $reponse_en) {
				$reponse_en = $_POST['reponse_en'];
				$query_reponse = mysql_query("SELECT `rep_en` FROM `tbl_reponses` WHERE `rep_en` = \"$reponse_en\"");

				if(mysql_num_rows($query_reponse) == 1){
					$message_unique_reponse_en = "1";
				}
			}

		}
		if ($_POST['statut'] <= 0 && $_POST['statut'] >= 1) {
			$message_statut = "1";
		}
		if ($_POST['porcentage'] == "1") {
			$message_porcentage = "1";
		}

		if ($db_id == $id && $bd_rep_en == $_POST['reponse_en'] && $bd_statut == $_POST['statut'] && $db_porcentage == $porcentage) {
			?>
			<script type="text/javascript" language="JavaScript1.2">
			window.location.replace('Surveys.php?response_list');
			</script>
			<?php
		}else{

			if ($message_porcentage == "1" || $message_reponse_en == "1" ||  $message_unique_reponse_en == "1" ||  $message_statut == "1" ) {
				$_SESSION['message_reponse_en'] = $message_reponse_en;
				$_SESSION['message_unique_reponse_en'] = $message_unique_reponse_en;
				$_SESSION['message_statut'] = $message_statut;
				$_SESSION['message_porcentage']= $message_porcentage;
				$_SESSION['reponse_fr'] = $_POST['reponse_en'];
				$_SESSION['reponse_en'] = $_POST['reponse_en'];
				$_SESSION['statut'] = $_POST['statut'];
				$_SESSION['porcentage'] = $_POST['porcentage'];
				?>

				<script type="text/javascript" language="JavaScript1.2">
				window.location.replace('Surveys.php?edit_response&id=<?php echo $id; ?>');
				</script>
				<?php
			}else{

				$sql_update = "	UPDATE `tbl_reponses` SET `rep_fr`=\"$reponse_fr\",`rep_en`=\"$reponse_en\",`porcentage`= $porcentage WHERE `id`=$id";

				@mysql_query($sql_update) or die ("erreur lors de la modifcation d'une reponse");
				unset($_SESSION['message_reponse_en']);
				unset($_SESSION['message_unique_reponse_en']);
				unset($_SESSION['message_statut']);
				unset($_SESSION['reponse_en']);
				unset($_SESSION['session']);
				unset($_SESSION['statut']);
				unset($_SESSION['porcentage']);
				unset($_SESSION['message_porcentage']);
				?>
				<script type="text/javascript" language="JavaScript1.2">
				window.location.replace('Surveys.php?response_list');
				</script>

				<?php

			}
		}

	}else{

		$_SESSION['message_error'] = "error pendant la modification merci de ressayer";
		?>
		<script type="text/javascript" language="JavaScript1.2">
		window.location.replace('Surveys.php?response_list');
		</script>

		<?php
	}


}else{
	?>
	<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
		<tr>
			<td><img src="images/icone/classes.gif" border="0"/></td>
			<td width="78%" class="reponse">&nbsp;SURVEY MANAGEMENT <span class="task">[Edit Answer]</span> </td>
			<td width="22%">
				<table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
					<tr>

						<td valign="top" align="center">
							<a href="Surveys.php?response_list" ><div class="cancel"></div>Cancel</a>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<?php
	$id = $_GET['id'];
	if ($id != "") {
		$req = "SELECT * FROM `tbl_reponses` WHERE `id` = $id";
		@mysql_query($req) or die("erreur de la selection des reponses ");
		$query = mysql_query($req);
		if (mysql_num_rows($query) == 1) {
			$row=mysql_fetch_assoc($query);
		}else{
			$_SESSION['message_error'] = "Cette reponse n'existe pas";
			?>
			<script type="text/javascript" language="JavaScript1.2">
			window.location.replace('Surveys.php?response_list');
			</script>
			<?php
		}

	}else{
		$_SESSION['message_error'] = "Answer dosen't exist";
		?>
		<script type="text/javascript" language="JavaScript1.2">
		window.location.replace('Surveys.php?response_list');
		</script>

		<?php
	}

	?>
	<form action="Surveys.php?edit_response=edit&id=<?php echo $id; ?>" method="POST" style="text-align: left;margin-top: 30px;" >

		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="form-group <?php if (isset($_SESSION['message_reponse_en']) && $_SESSION['message_reponse_en'] !=  ""  || (isset($_SESSION['message_unique_reponse_en']) && $_SESSION['message_unique_reponse_en'] !=  "")) {echo 'has-error';} ?>">
			<label for="exampleInputEmail1">Answer *</label>
			<input id='input_reponse' type="text" value="<?php  if (isset($_SESSION['reponse_en']) && $_SESSION['reponse_en'] !=  "") {echo $_SESSION['reponse_en'];}else{echo $row['rep_en'];}  ?>" name="reponse_en" class="form-control" id="exampleInputEmail1">
			<?php if (isset($_SESSION['message_reponse_en']) && $_SESSION['message_reponse_en'] !=  "") {
				echo "<label id='error_reponse' class='control-label' style='width: 100%;padding-top: 6px;' for='inputError1'>Required field</label>";
			} ?>
			<?php if (isset($_SESSION['message_unique_reponse_en']) && $_SESSION['message_unique_reponse_en'] !=  "") {
				echo "<label id='error_reponse' class='control-label' style='width: 100%;padding-top: 6px;' for='inputError1'>Already exist</label>";
			} ?>
		</div>
		<div class="form-group <?php if (isset($_SESSION['message_porcentage']) && $_SESSION['message_porcentage'] !=  "") {echo 'has-error';} ?>">
			<label for="exampleInputEmail1">Porcentage</label>
			<select id='porcentage'  name="porcentage" class="form-control" style="width: 218px;">
				<option value="1" >Choose the porcentage</option>
				<option value="100" <?php if(isset($_SESSION['porcentage']) && $_SESSION['porcentage']== 100){echo "selected";}elseif($row['porcentage'] == 100 ){echo "selected";} ?>>100 %</option>
				<option value="90" <?php if(isset($_SESSION['porcentage']) && $_SESSION['porcentage']== 90){echo "selected";}elseif($row['porcentage'] == 90 ){echo "selected";} ?>>90 %</option>
				<option value="70" <?php if(isset($_SESSION['porcentage']) && $_SESSION['porcentage']== 70){echo "selected";}elseif($row['porcentage'] == 70 ){echo "selected";} ?>>70 %</option>
				<option value="80" <?php if(isset($_SESSION['porcentage']) && $_SESSION['porcentage']== 80){echo "selected";}elseif($row['porcentage'] == 80 ){echo "selected";} ?>>80 %</option>
				<option value="0" <?php if(isset($_SESSION['porcentage']) && $_SESSION['porcentage']== 0){echo "selected";}elseif($row['porcentage'] == 0 ){echo "selected";} ?>>0 %</option>
				?>
			</select>
			<?php if (isset($_SESSION['message_porcentage']) && $_SESSION['message_porcentage'] !=  "") {
				echo "<label id='error_reponse' class='control-label' style='width: 100%;padding-top: 6px;' for='inputError1'>Required field</label>";
			} ?>
		</div>
		<div class="span12" class="col-sm-12" style="height: 43px;padding: 0px;">
			<div style="margin-top: 25px;margin-right: 165px;" class="form-group <?php if (isset($_SESSION['message_statut']) && $_SESSION['message_statut'] !=  "") { echo 'has-error';} ?>">
				<label for="exampleInputFile" style="float: left;margin-right: 19px;">Statut *</label>
				<div class="radio" style="float: left;margin: 0px;margin-left: 20px;margin-right: 110px;">
					<label class="radio-inline">
						<input class='input_programme' id="mba" name="statut"  type="radio" style="font-size: 12px;" <?php if (isset($_SESSION['statut']) && $_SESSION['statut'] == "0"){echo "checked=checked";} ?> <?php if (isset($_SESSION['statut']) && $_SESSION['statut'] == "" && $row['statut'] == ""){echo "checked";} if ($row['statut'] == "0") {echo "checked";} ?> value="0" > Activate
					</label>
				</div>
				<div class="radio" style="margin: 0;">
					<label class="radio-inline">
						<input  class='input_programme' id="bba" name="statut" type="radio" style="font-size: 12px;" <?php if (isset($_SESSION['statut']) && $_SESSION['statut'] == "1"){echo "checked=checked";} if ($row['statut'] == "1") {echo "checked";} ?> value="1"> Deactivate
					</label>
				</div>
				<?php if (isset($_SESSION['message_statut']) && $_SESSION['message_statut'] !=  "") {
					echo "<label id='error_programme' class='control-label' style='width: 100%;padding-top: 6px;' for='inputError1'>Required field</label>";
				} ?>
			</div>
		</div>
		<div class="col-sm-12" style="padding:0;">
			<input type="submit" style="color: #fff;" class="btn btn-success btn-xs"  value="Submit">
		</div>

	</form>
	<?php
	$_SESSION['message_reponse_en'] = "";
	$_SESSION['message_unique_reponse_en'] = "";
	$_SESSION['message_statut'] = "";
	$_SESSION['reponse_en'] = "";
	$_SESSION['statut'] = "";
	$_SESSION['porcentage'] = "";
	$_SESSION['message_porcentage'] = "";
}

?>
