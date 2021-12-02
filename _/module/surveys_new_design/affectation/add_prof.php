<?php
if (isset($_GET['add_prof'])){
    if ($_POST['id'] != 0 && $_POST['code_prof_sis'] != "") {
      $id = $_POST['id'];
      $code_prof_sis = $_POST['code_prof_sis'];
      $sql_insert = "UPDATE `tbl_sondage_affectation` SET `code_prof_sis`=\"$code_prof_sis\" WHERE `id` = \"$id\"";

      mysql_query($sql_insert)or die ("error update affection");
      ?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--
					window.location.replace('Surveys.php?list_affectation');
			//-->
			</script>
			<?php


			}else{
			  ?>

		<table border="0" width="100%" align="center" class="haut_table">
		  <tr>
		    	<td>
					<img src="images/icone/etudiants.gif" border="0"/>
				</td>
		    	<td width="78%" class="titre" style="text-align:left">
					&nbsp;SURVEY MANAGEMENT<span class="task">[Edit]</span>
			    </td>
			    <?php
			    	$id=$_GET["add_prof"];

			    	$sql_select = "SELECT * FROM `tbl_sondage_affectation` WHERE `archive` = 0 and `id` = ".$id;

			    	$req_select = mysql_query($sql_select)or die ("selection d'une affectation");
			    	$row_select=mysql_fetch_assoc($req_select);
			    	$prof = $row_select['code_prof'];
					$cour = $row_select['code_cours'];
					$type = $row_select['type'];
					$session = $row_select['session'];
					$groupe = $row_select['groupe'];
					$campus = $row_select['campus'];
          $session_b = $row_select['periode']."-".$row_select['annee'];
					$prof_sis = $row_affectation['code_prof_sis'];

			     ?>


	 	<form method="post" action="Surveys.php?add_prof=oui" >
	 	<input type="hidden" name="id" value="<?php echo $id;?>" />
	 		<td width="22%">
			 <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
			    <tr>
				  <td valign="top" align="center" style="padding:20px">
				   <div class="save"></div> <input type="submit" value="Submit"/>
				  </td>
				  <td valign="top" align="center" style="padding:20px">
				   <a href="Surveys.php?list_affectation"><div class="cancel"></div>Cancel</a>
				  </td>
				</tr>
			  </table>
				</td>
		  </tr>
		 </table>
		  <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" style="margin: 24px;">
        <td style="width: 95px;">Professor* : </td>
        <td style="width: 280px;">
          <?php
          $sql_prof = "SELECT * FROM `tbl_professeur` WHERE 'archive' = 0 and code_prof= $prof order by nom_prenom";

          $req_prof = mysql_query($sql_prof)or die ("erreur lors de la sélection des sondage");

          while ($row_prof = mysql_fetch_array($req_prof)) {
            echo $row_prof["nom_prenom"];
          }

        ?>
        </td>
          <td>&nbsp;</td>
        </tr>

        <tr><td colspan="3" height="3px"></td></tr>
        <tr>
        <td>Course* : </td>
        <td>
            <?php

                echo $cour;
            ?>
        </td>
          <td>&nbsp;</td>
        </tr>
        <tr><td colspan="3" height="3px"></td></tr>
          <tr>
        <td>Session* : </td>
        <td>
            <?php
            if ($session == 0) {
              echo $session_b;
            }else{
              $sql_sess = "SELECT * FROM `tbl_session` where idSession = $session order by annee_academique";
              $req_sess = mysql_query($sql_sess)or die ("erreur lors de la sélection des sondage");
              while ($row_sess = mysql_fetch_array($req_sess)) {
                echo $row_sess["session"]." ".$row_sess["annee_academique"];
              }
            }
            ?>
        </td>
          <td>&nbsp;</td>
        </tr>
        <tr><td colspan="3" height="3px"></td></tr>


				  	<tr><td colspan="3" height="3px"></td></tr>

				  	<tr>
            <td>Professor_SIS : </td>
						<td>
              <select name="code_prof_sis" class=" input input_size"  style="width:280px">
								<option value="">Choose the professor</option>
							  	<?php
							 		$sql_prof = "SELECT distinct (nom_prenom),`code_prof` FROM `tbl_professeur` WHERE 'archive' = 0  order by nom_prenom";
							 		$req_prof = mysql_query($sql_prof)or die ("erreur lors de la sélection des sondage");

							 		while ($row_prof = mysql_fetch_array($req_prof)) {
							 			$selected = "";
							 			if ($prof_sis != 0 && $prof_sis == $row_prof["code_prof"]) {
							 				$selected = "selected";
							 			}
						 				echo "<option value='".$row_prof["code_prof"]."'".$selected.">
						 				".$row_prof["nom_prenom"]."</option>";
						 			}

							 	?>
						  </select>
						</td>
					</tr>
				  	<tr><td colspan="3" height="3px"></td></tr>



				</table>
		     </td>

			</tr>

		  </table>

	    </form>

<?php

}
}
?>
