<?php
	if (isset($_GET['edit_sondage']) && $_GET['edit_sondage'] == 'edit') {
		$message_titre_en = "";
		$message_session = "";
		$message_session_unique = "";
		$message_statut = "";
		$message_type = "";
		$message_type_unique = "";
		$_SESSION['message_titre_en'] = "";
		$_SESSION['message_session'] = "";
		$_SESSION['message_session_unique'] = "";
		$_SESSION['message_statut'] = "";
		$_SESSION['titre_en'] = "";
		$_SESSION['session'] = "";
		$_SESSION['statut'] = "";
		$_SESSION['type'] = "";
		$_SESSION['message_type_unique'] = "";
		// les champ oblegatoire
		//var_dump($_POST);

		if (isset($_POST['id']) && $_POST['id'] != "" && $_GET['id'] != "" && $_GET['id'] == $_POST['id'] ) {
			$id = $_POST["id"];

			if (empty($_POST['titre_en']) || $_POST['titre_en'] == "") {
				$message_titre_en = "1";
			}
			if ($_POST['session'] == "none") {
				$message_session = "1";
			}
			if ($_POST['statut'] <= 0 && $_POST['statut'] >= 1) {
				$message_statut = "1";
			}
			if ($_POST['type'] <= 0 && $_POST['type'] >= 1) {
				$message_statut = "1";
			}
			if ($message_titre_en == "1" || $message_session == "1" || $message_statut == "1"
				|| $message_session_unique == "1") {
				$_SESSION['message_titre_en'] = $message_titre_en;
				$_SESSION['message_session'] = $message_session;
				$_SESSION['message_session_unique'] = $message_session_unique;
				$_SESSION['message_statut'] = $message_statut;
				$_SESSION['message_type'] = $message_type;
				$_SESSION['message_type_unique'] = $message_type_unique;
				$_SESSION['titre_en'] = $_POST['titre_en'];
				$_SESSION['session'] = $_POST['session'];
				$_SESSION['statut'] = $_POST['statut'];
				$_SESSION['type'] = $_POST['type'];
				?>
				<script type="text/javascript" language="JavaScript1.2">
					window.location.replace('Surveys.php?new_sondage');
				</script>

				<?php
			}else{
				$titre_en = $_POST['titre_en'];
				$session = $_POST['session'];
				$statut = $_POST['statut'];
				$type = $_POST['type'];
				$date =date("j/n/Y");
				$type = $_POST['type'];
				$query_session = mysql_query("SELECT `id_session` FROM `tbl_sondage` WHERE `id_session` = \"$session\" AND `type` = $type AND `id` != $id" );

				if(mysql_num_rows($query_session) == 1){
				   $message_session_unique = "1";
				   $message_type_unique = "1";
				}
				if ($message_session_unique == 1) {
					$_SESSION['message_session_unique'] = $message_session_unique;
					$_SESSION['message_type_unique'] = $message_type_unique;
					?>
					<script type="text/javascript" language="JavaScript1.2">
						window.location.replace("Surveys.php?edit_sondage&id=<?php echo $id; ?>");
					</script>

					<?php
				}else{
					$sql_update = "UPDATE `tbl_sondage` SET `titre_fr`=\"$titre_en\",`id_session`=\"$session\",`titre_en`=\"$titre_en\",`statut`=\"$statut\" WHERE `id`=\"$id\"";
					@mysql_query($sql_update) or die ('erreur lors de la creation du sondage');
				}
				unset($_SESSION['message_titre_en']);
				unset($_SESSION['message_session']);
				unset($_SESSION['message_statut']);
				unset($_SESSION['message_type']);
				unset($_SESSION['titre_en']);
				unset($_SESSION['session']);
				unset($_SESSION['statut']);
				?>
				<script type="text/javascript" language="JavaScript1.2">
					window.location.replace('Surveys.php?confirm');
				</script>

				<?php
			}
		}else{

			$_SESSION['message_error'] = "error pendant la modification merci de ressayer";
			?>
			<script type="text/javascript" language="JavaScript1.2">
				window.location.replace('Surveys.php');
			</script>

			<?php
		}

	}else{
?>
	<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
	  <tr>
	    <td><img src="images/icone/classes.gif" border="0"/></td>
	    <td width="78%" class="titre">&nbsp;Listing Survey  <span class="task">[Edit Survey]</span> </td>
		<td width="22%">
		  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
		  <tr>
			  <td valign="top" align="center">
			   <a href="Surveys.php" ><div class="cancel"></div>Back</a>
			  </td>
		  </tr>
		  </table>
		</td>
	  </tr>
	</table>
	<?php
			$id = $_GET['id'];
			if ($id != "") {
				$req = "SELECT * FROM `tbl_sondage` WHERE `id` = $id";
		        @mysql_query($req) or die("erreur de la selection du sondage ");
		        $query = mysql_query($req);
		        if (mysql_num_rows($query) == 1) {
		        	$row=mysql_fetch_assoc($query);
		        }else{
		        	$_SESSION['message_error'] = "This survey already exist.";
		        	?>
						<script type="text/javascript" language="JavaScript1.2">
							window.location.replace('Surveys.php');
						</script>
					<?php
		        }

			}else{
				$_SESSION['message_error'] = "This Survey dosen't exist.";
				?>
				<script type="text/javascript" language="JavaScript1.2">
					window.location.replace('Surveys.php');
				</script>

				<?php
			}
	?>
	<form  action="Surveys.php?edit_sondage=edit&id=<?php echo $row['id']; ?>" method="POST" style="text-align: left;margin-top: 80px;" >
				<input name="id" type="hidden" value="<?php echo $row['id']; ?>">
				<div class="form-group <?php if (isset($_SESSION['message_titre_en']) && $_SESSION['message_titre_en'] !=  "") {echo 'has-error';} ?>">
	        <label for="exampleInputEmail1">Survey title *</label>
	        <input id='input_titre' type="text" value="<?php  if (isset($_SESSION['titre_en']) && $_SESSION['titre_en'] !=  "") {echo $_SESSION['titre_en'];}else{echo $row['titre_en'];}  ?>" name="titre_en" class="form-control" id="exampleInputEmail1">
	        <?php if (isset($_SESSION['message_titre_en']) && $_SESSION['message_titre_en'] !=  "") {
	           echo "<label id='error_titre' class='control-label' style='width: 100%;padding-top: 6px;' for='inputError1'>Required Field</label>";
	        } ?>
      	</div>
		<div style="margin-right: 175px;" class="form-group <?php if ((isset($_SESSION['message_session']) && $_SESSION['message_session'] !=  "") || (isset($_SESSION['message_session_unique']) && $_SESSION['message_session_unique'] !=  "")) { echo 'has-error';} ?>">
	        <label for="exampleInputFile">Session *</label>
	        <select id='input_annee'  name="session" class="form-control" style="width: 184px;">
		        <option value="none">Choose the session</option>
				<?php
					$sql_session="select idSession, session, annee_academique from $tbl_session order by ordering ";
		  			$req_session=@mysql_query($sql_session);
			  		while($row_session=mysql_fetch_assoc($req_session)){
			 			$session = ucfirst($row_session['session']).' '.$row_session['annee_academique'];
			  			$id_session=$row_session['idSession'];
				?>
					<option value="<?php echo $id_session; ?>" <?php if (isset($_SESSION['session']) && $_SESSION['session'] == $id_session){echo "selected";}elseif($row['id_session'] == $id_session){echo "selected";} ?> ><?php echo $session; ?></option>
				<?php
					}
				?>
	        </select>
	        <?php if (isset($_SESSION['message_session']) && $_SESSION['message_session'] !=  "") {
	           echo "<label id='error_annee' class='control-label' style='width: 100%;padding-top: 6px;' for='inputError1'>Required Field</label>";
	        }
	        if (isset($_SESSION['message_session_unique']) && $_SESSION['message_session_unique'] !=  "") {
	           echo "<label id='error_annee' class='control-label' style='width: 100%;padding-top: 6px;' for='inputError1'>There is already a Survey for this session. </label>";
	        }
	        ?>
	    </div>
	    <!-- <div class="span12">
	    	<div style="margin-top: 25px;margin-right: 165px;" class="form-group <?php if (isset($_SESSION['message_statut']) && $_SESSION['message_statut'] !=  "") { echo 'has-error';} ?>">
	        <label for="exampleInputFile" style="float: left;margin-right: 19px;">type *</label>
	        <div class="radio"  style="float: left;padding: 0px;margin-left: 29px;">
	            <label class="radio">
	              <input class='input_programme'  name="type"  type="radio" style="font-size: 12px;" <?php if (isset($_SESSION['message_type']) && $_SESSION['message_type'] == "0"){echo "checked=checked";}elseif ($row['type'] == '0') {echo "checked=checked";} ?> value="0" > Présentiel
	            </label>
	        </div>
	        <div class="radio">
	            <label class="radio" style="float: left;padding: 0px;margin-left: 29px;margin-right: 55px;">
	              <input  class='input_programme'  name="type" type="radio" style="font-size: 12px;" <?php if (isset($_SESSION['message_type']) && $_SESSION['message_type'] == "1"){echo "checked=checked";}elseif ($row['type'] == '1') {echo "checked=checked";} ?> value="1"> E-learning
	            </label>
	        </div>
	          <?php if (isset($_SESSION['message_type']) && $_SESSION['message_type'] !=  "") {
	             echo "<label id='error_programme' class='control-label' style='width: 100%;padding-top: 6px;' for='inputError1'>Required Field</label>";
	          } ?>
	         <?php  if (isset($_SESSION['message_type_unique']) && $_SESSION['message_type_unique'] !=  "") {
	           echo "<label id='error_annee' class='control-label' style='width: 100%;padding-top: 6px;' for='inputError1'>il existe déja un sondage pour ce type  </label>";
	        }
	        ?>
	        </div>
	    </div>	 -->
	    <div class="col-sm-12" style="height: 53px;margin-left: -12px;">
	    	<div style="margin-top: 25px;margin-right: 165px;" class="form-group <?php if (isset($_SESSION['message_statut']) && $_SESSION['message_statut'] !=  "") { echo 'has-error';} ?>">
	        <label for="exampleInputFile" style="float: left;margin-right: 19px;">Status *</label>
	        <div class="radio" style="float: left;margin: 0px;margin-left: 0px;margin-right: 45px;">
	            <label class="radio">
	              <input class='input_programme'  name="statut"  type="radio" style="font-size: 12px;" <?php if (isset($_SESSION['statut']) && $_SESSION['statut'] == "0"){echo "checked=checked";}elseif ($row['statut'] == '0') {echo "checked=checked";} ?> value="0" > Activate
	            </label>
	        </div>
	        <div class="radio" style="padding: 0px;margin-left: 44px;margin-right: 55px;margin-top: 0px;">
	        	<label class="radio" >
	              <input  class='input_programme'  name="statut" type="radio" style="font-size: 12px;" <?php if (isset($_SESSION['statut']) && $_SESSION['statut'] == "1"){echo "checked=checked";}elseif ($row['statut'] == '1') {echo "checked=checked";} ?> value="1"> deactivate
	            </label>
	        </div>
	          <?php if (isset($_SESSION['message_statut']) && $_SESSION['message_statut'] !=  "") {
	             echo "<label id='error_programme' class='control-label' style='width: 100%;padding-top: 6px;' for='inputError1'>Required Field</label>";
	          } ?>
	        </div>
	    </div>
		<div class="col-sm-12">
			<input type="submit" style="color: #fff;" class="btn btn-success btn-xs" value="Edit">
		</div>
	</form>
<?php
	$_SESSION['message_titre_en'] = "";
	$_SESSION['message_session'] = "";
	$_SESSION['message_session_unique'] = "";
	$_SESSION['message_statut'] = "";
	$_SESSION['message_type'] = "";
	$_SESSION['message_type_unique'] = "";
	$_SESSION['titre_en'] = "";
	$_SESSION['session'] = "";
	$_SESSION['statut'] = "";
	}

?>
