<?php

$code_prof=$session=$code_cours=$code_horaire=$niveau=$where=$type='';

$_SESSION['prof'] = "";
$_SESSION['cour'] = "";
$_SESSION['type'] = "";
$_SESSION['session'] = "";
$_SESSION['groupe'] = "";

if((isset($_POST['tous'])) && (!empty($_POST['tous']))){
	$code_prof=$session=$code_cours=$code_horaire=$niveau=$where=$type='';
	unset($_SESSION['type']);
	unset($_SESSION['niveau_enseigne']);
}else{
	if((isset($_POST['code_prof']))  && $_POST['code_prof'] != "null" ){
		$code_prof = $_SESSION['prof'] = $_POST['code_prof'];
		$where = $where." and a.code_prof='". $code_prof."' ";
	}else if( (isset($_POST['code_prof']))  && $_POST['code_prof'] == "null"){
		unset($_SESSION['prof']);
	}else if( (isset($_SESSION['prof'])) && (!empty($_SESSION['prof'])) ){
		$pre_where=' where 1=1';
		$where = $where." and a.code_prof='". $_SESSION['prof']."' ";
	}

	if((isset($_POST['cour'])) && $_POST['cour'] != "null" ){
		$cour = $_SESSION['cour'] = $_POST['cour'];
		$where = $where." and a.code_cours='". $cour."' ";
	}else if( (isset($_POST['cour'])) && $_POST['cour'] == "null" ){
		unset($_SESSION['cour']);
	}else if( (isset($_SESSION['cour'])) && (!empty($_SESSION['cour'])) ){
		$pre_where=' where 1=1';
		$where = $where." and a.code_cours='". $_SESSION['cour']."' ";
	}

	if((isset($_POST['type'])) && $_POST['type'] != "null" ){
		$type = $_SESSION['type'] = $_POST['type'];
		$where = $where." and a.type='". $type."' ";
	}else if( (isset($_POST['type'])) && $_POST['type'] == "null" ){
		unset($_SESSION['type']);
	}else if( (isset($_SESSION['type'])) && (!empty($_SESSION['type'])) ){
		$pre_where=' where 1=1';
		$where = $where." and a.type='". $_SESSION['type']."' ";
	}

	if((isset($_POST['session'])) && $_POST['session'] != "null" ){
		$session = $_SESSION['session'] = $_POST['session'];
		$sql_sess = "SELECT * FROM `tbl_session` where idSession = $session order by annee_academique";
		$req_sess = mysql_query($sql_sess)or die ("erreur select Sessions");

		while ($row_sess = mysql_fetch_array($req_sess)) {
			$periode = $row_sess["session"];
			$annee = $row_sess["annee_academique"];
		}

		$where = $where." and (a.session='". $session."' or (a.periode = '".$periode."' and a.annee = '".$annee."')) ";
	}else if( (isset($_POST['session'])) && $_POST['session'] == "null" ){
		unset($_SESSION['session']);
	}else if( (isset($_SESSION['session'])) && (!empty($_SESSION['session'])) ){
		$pre_where=' where 1=1';
		$where = $where." and a.session='". $_SESSION['session']."' ";
	}

	if((isset($_POST['groupe'])) && $_POST['groupe'] != "null" ){
		$groupe = $_SESSION['groupe'] = $_POST['groupe'];
		$where = $where." and a.groupe='". $groupe."' ";
	}else if( (isset($_POST['groupe'])) && $_POST['groupe'] == "null" ){
		unset($_SESSION['groupe']);
	}else if( (isset($_SESSION['groupe'])) && (!empty($_SESSION['groupe'])) ){
		$pre_where=' where 1=1';
		$where = $where." and a.groupe='". $_SESSION['groupe']."' ";
	}
	if((isset($_POST['campus'])) && $_POST['campus'] != "null" ){
		$campus = $_SESSION['campus'] = $_POST['campus'];
		$where = $where." and a.campus='". $campus."' ";
	}else if( (isset($_POST['campus'])) && $_POST['campus'] == "null" ){
		unset($_SESSION['campus']);
	}else if( (isset($_SESSION['campus'])) && (!empty($_SESSION['campus'])) ){
		$pre_where=' where 1=1';
		$where = $where." and a.campus='". $_SESSION['campus']."' ";
	}
}



//$sql="SELECT Distinct * FROM `tbl_sondage_affectation` as a  Where 1=1 and a.`archive` = 0  and a.code_cours not in('SEM-555') and session != 0".$where." order by `session`,code_cours ASC";
$sql = "SELECT count(distinct(r.code_etudiant)) as nb_sondage , a.* FROM `tbl_sondage_affectation` as a , `tbl_resultat_sondage` as r Where 1=1 and a.`archive` = 0 and a.code_cours not in('SEM-555') ".$where." and
a.`id` = r.id_affectation group by r.id_affectation
order by a.`session`,a.code_cours ASC";
//echo $sql;

?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
	<tr>
		<td>&nbsp;<img src="images/icone/enseignants.gif" border="0"/></td>
		<td width="78%" class="titre">&nbsp;Surveys</td>
		<td width="22%">
			<table border="0" align="right" width="100%" cellspacing="10"  id="link" >

				<tr>

					<td valign="top" align="center">
						<a href="Surveys.php?new_affectation"><div class="ajouter"></div>New</a>
					</td>

					<td valign="top" align="center" >
						<a href="#"
						onclick="javascript:if(document.adminMenu.boxchecked.value==0){
							alert('Veuillez sélectionner un enseignant dans la liste ??');}
							else
							{
								chemin=document.adminMenu.boxchecked.value;
								chemin='Surveys.php?edit_affictaion='+chemin;
								window.location.replace(chemin);
							}"><div class="modifier"></div>Edit</a>
						</td>
						<td valign="top" align="center">
							<a href="Surveys.php?activer_affectation"><div class="archive"></div>Archive a session</a>
						</td>
						<td valign="top" align="center">
							<a href="Surveys.php?desactiver_affectation"><div class="archive"></div>Unarchive a session</a>

						</td>



					</tr>
				</table>
			</td>
		</tr>
	</table>

	<table width="100%" align="center" cellspacing="1"  class="adminlist">
		<form action="#" method="post" name="adminMenu">
			<input type="hidden" name="boxchecked" value="0" />
			<div class="container_search" style="height: 45px;">
				<select name="code_prof" class="search">
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
				<select name="cour" class="search">
					<option value="null">Choose the course</option>
					<?php
					$sql_cour = "SELECT * FROM `tbl_cours` WHERE 'archive' = 0 order by code_cours";
					$req_cour = mysql_query($sql_cour)or die ("erreur select courses");
					while ($row_cour = mysql_fetch_array($req_cour)) {
						$selected = "";
						if (isset($_SESSION['cour']) && $row_cour["code_cours"] == $_SESSION['cour']) {
							$selected = "selected";
						}
						echo "<option value='".$row_cour["code_cours"]."'".$selected.">".$row_cour["code_cours"]."</option>";
					}
					?>
				</select>
				<select name="session" class="search">
					<option value="null">Choose the session</option>
					<?php
					$sql_sess = "SELECT * FROM `tbl_session` order by annee_academique";
					$req_sess = mysql_query($sql_sess)or die ("erreur select Sessions");

					while ($row_sess = mysql_fetch_array($req_sess)) {
						$selected = "";
						if (isset($_SESSION['session']) && $row_sess["idSession"] == $_SESSION['session']) {
							$selected = "selected";
						}
						echo "<option value='".$row_sess["idSession"]."'".$selected.">".$row_sess["session"]." ".$row_sess["annee_academique"]."</option>";
					}
					?>
				</select>
				<!-- <select name="groupe" class="search">
				<option value="null">Choose the group</option>
				<option value="3" <?php if (isset($_SESSION['groupe']) && $_SESSION['groupe'] == "3"): ?> selected<?php endif ?> >Anglophone</option>
			</select> -->
			<!-- <select name="campus" class="search">
			<option value="null">choisissez la campus</option>
			<option value="rabat" <?php if (isset($_SESSION['campus']) && $_SESSION['campus'] == "rabat"): ?> selected<?php endif ?> >Rabat</option>
			<option value="casablanca" <?php if (isset($_SESSION['campus']) && $_SESSION['campus'] == "casablanca"): ?> selected<?php endif ?>> Casablanca</option>
			<option value="marrakech" <?php if (isset($_SESSION['campus']) && $_SESSION['campus'] == "marrakech"): ?> selected<?php endif ?>> Marrakech</option>
			<option value="e-learning" <?php if (isset($_SESSION['campus']) && $_SESSION['campus'] == "e-learning"): ?> selected<?php endif ?>>E-learning</option>

		</select> -->
		<input type="submit" name="valider" value="submit" class="input" style="margin-top: 3px;" />
		<input type="submit" value="all" name="tous" class="input" style="margin-top: 3px;"  />
	</div>
	<div style="float:right;">
		<a href="Surveys.php?list_sondage" style="color: #fff;text-decoration: none;" class="btn btn-success btn-xs">Surveys</a>
		<a href="Surveys.php?list_question" style="color: #fff;text-decoration: none;" class="btn btn-success btn-xs">Questions</a>
		<a href="Surveys.php?response_list" style="color: #fff;text-decoration: none;" class="btn btn-success btn-xs">Answers</a>
	</div>
	<tr>
		<th width="15"  style="text-align:center;">#</th>
		<th width="15"  style="text-align:center;">&nbsp;</th>
		<th width="15"  style="text-align:center;padding:4px">ID Affectation</th>
		<th width="15"  style="text-align:center;padding:9px">Surveys</th>
		<th width="400" style="text-align:left;padding-left:10px;">Full name</th>
		<th width="400" style="text-align:left;padding-left:10px;">groupe</th>
		<th width="135" style="text-align:center;">Session</th>
		<th width="180" style="text-align:center;">Course</th>
		<th width="400" style="text-align:left;padding-left:10px;">campus</th>
		<th width="180" style="text-align:center;">add professor</th>

	</tr>
	<?php
	$j=0;
	//var_dump($sql);

	$req = mysql_query($sql)or die ("erreur select affectations");
	while ($row = mysql_fetch_array($req)) {
		$j++;
		$cf=$row["id"];
		$session_b = $row['periode']."-".$row['annee'];
		$niveau = $row['niveau'];
		?>

		<tr>
			<td><?php echo $j?></td>
			<td align="center">
				<input type="radio" id="<?php echo $cf?>" name="id" value="<?php echo $cf?>" onClick="document.adminMenu.boxchecked.value=<?php echo $cf?>" />
			</td>
			<td align="center">&nbsp;<?php echo $row["id"]?></td>
			<td align="center">&nbsp;<?php echo $row["nb_sondage"]?></td>

			<td style="text-align:left;padding-left:10px;">
				<?php
			$sql_prof = "SELECT * FROM `tbl_professeur` WHERE `code_prof` = ".$row['code_prof'];
			$req_prof = mysql_query($sql_prof)or die ("erreur select professors");
			$row_prof = mysql_fetch_array($req_prof);
			echo $row_prof["nom_prenom"];?>
		</td>
			<td align="center">
	 	 	<?php
	 	 		if ($row['groupe'] == 2) {
	  				echo "Francophone";
	  			}elseif ($row['groupe']== 3) {
	  				echo "Anglophone";
	  			}
	 	  	?>
	 	 </td>
			<td align="center">
				<?php
				if ($row['session']== 0) {

					echo $niveau." - ".$session_b;
				}else{
					$sql_sess = "SELECT * FROM `tbl_session` WHERE `idSession` = ".$row['session'];
					$req_sess = mysql_query($sql_sess)or die ("erreur select Session");
					$row_sess = mysql_fetch_array($req_sess);
					echo "BBA - ".$row_sess["session"]." ".$row_sess["annee_academique"];
				}
				?>


		</td>
		<td align="center">&nbsp;<?php echo $row["code_cours"]?></td>
		<td align="center">&nbsp;<?php echo $row["campus"]?></td>

		<td align="center">
				<?php if ($row["code_prof_sis"] != 0){
					$sql_prof = "SELECT * FROM `tbl_professeur` WHERE `code_prof` = ".$row['code_prof_sis'];
					$req_prof = mysql_query($sql_prof)or die ("erreur select professors");
					$row_prof = mysql_fetch_array($req_prof);
					echo $row_prof["nom_prenom"]." - ";
				}
				?>

				<a href="Surveys.php?add_prof=<?php echo $cf; ?>" target="_blank" >edit</a>
		</td>





</tr>
<?php
}
?>
</form>
</table>
