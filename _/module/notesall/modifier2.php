<script language="javascript1.2">
function valid_form(){
document.f_ajout.submit();
}
</script>
<?php
//$fStart=$_GET['foupasf'];

 if(isset($_POST['mid_term']))
{
$mid_term=$_POST['mid_term'];
$project=$_POST['project'];
$participation=$_POST['participation'];
$code_cours=$_POST['code_cours']; 
$code_inscription=$_POST['code_inscription'];
$idSession=$_POST['idSession'];
$id=$_POST['id'];
$some_coef=0;
  if(isset($_POST['transfer']) and $_POST['transfer']==1){
 	 $letter_grade= 'T';
   						  }
						    if(isset($_POST['withdrawal']) and $_POST['withdrawal']==1){
 	 $letter_grade= 'W';
   						  }
 	else {
        // if there are four marks
		if ( (!empty($mid_term)) &&  (!empty($project))  &&   (!empty($participation)) )
		{
		// declare coeficient if 4 marks
		$coef_mid_term=1;
		$coef_project=1;
		$coef_participation=1;
		// calcule final grade 
		$final_grade=(($mid_term*$coef_mid_term) +  ($project*$coef_project) + ($participation*$coef_participation) )/ 3;
		 }
			else{
			//declare coeficient if three marks
			$coef_mid_term=1;
			$coef_project=1;
			$coef_participation =1;
			
			$final_grade = 0;
			if (!empty($mid_term)){
			$final_grade += $mid_term * $coef_mid_term  ;
			$some_coef += $coef_mid_term;
			  }
						if (!empty($project)){
				$final_grade += $project * $coef_project  ;
				$some_coef += $coef_project;
									}
					if (!empty($participation)){
					$final_grade += $participation * $coef_participation  ;
					$some_coef += $coef_project;
												}
												
						
												
							$final_grade/=$some_coef;
							 }
				}
				
 if (round($final_grade) <= 59 && $final_grade!=''){
 $letter_grade= 'F';
 $GPA=0;
 }
 
  if ( round($final_grade) <= 63  &&  round($final_grade) >= 60  ){
 $letter_grade= 'D-';
 $GPA=0.67;
 }
 
 if ( round($final_grade) <= 66  &&  round($final_grade) >= 64 ){
 $letter_grade= 'D';
 $GPA=1;
 }
 
 if ( round($final_grade) <= 69  &&  round($final_grade) >= 67 ){
 $letter_grade= 'D+';
 $GPA=1.33;
 }
 
  if ( round($final_grade) <= 73  &&  round($final_grade) >= 70  ){
 $letter_grade= 'C-';
 $GPA=1.67;
 }
 
 if ( round($final_grade) <= 76  &&  round($final_grade) >= 74  ){
 $letter_grade= 'C';
 $GPA=2;
 }
 
 if ( round($final_grade) <= 79  &&  round($final_grade) >= 77  ){
 $letter_grade= 'C+';
 $GPA=2.33;
 }
 
 if (  round($final_grade) <= 83  &&  round($final_grade) >= 80  ){
 $letter_grade= 'B-';
 $GPA=2.67;
 }
 
 if (  round($final_grade) <= 86  &&  round($final_grade) >= 84  ){
 $letter_grade= 'B';
 $GPA=3;
 }
 
 if (  round($final_grade) <= 89  &&  round($final_grade) >= 87  ){
 $letter_grade= 'B+';
 $GPA=3.33;
 }
 
 if ( round($final_grade) <= 93  &&  round($final_grade) >= 90  ){
 $letter_grade= 'A-';
 $GPA=3.67;
 }
 
 if ( round($final_grade) <= 100  &&  round($final_grade) >= 94  ){
 $letter_grade= 'A';
 $GPA=4;
 }
 
 
 
 if(isset($_POST['transfer']) and $_POST['transfer']=='transfer'){
 	 $mid_term = $project = $participation =  $final_grade = '';
	 $letter_grade= 'T';
	 $GPA= 0; 
	 }
	 if(isset($_POST['withdrawal']) and $_POST['withdrawal']=='withdrawal'){
 	 $mid_term = $project = $participation =  $final_grade = '';
	 $letter_grade= 'W';
	 $GPA= 0; 
	 }
	 
 if(isset($_POST['incomplete']) and$_POST['incomplete']=='incomplete'){
 	 $mid_term = $project = $participation =  '';
	 $letter_grade= 'I';
	 $GPA= 0; 
	 }
   
  // fin du calcule de la note finale	
	 
 
			$sql1="UPDATE tbl_note_piimt SET 
			`mid_term` = '$mid_term',
			`project` = '$project',
			`participation` = '$participation',
			`final_grade` = '$final_grade',
			`letter_grade` = '$letter_grade',
			`gpa` = '$GPA' 
			 WHERE `code_note` = '$id' ";  
 
 			$req1=mysql_query($sql1) or die("erreur lors de l'insertion des notes");
			?>
			<script type="text/javascript" language="JavaScript1.2">
			<!--	
				window.location.replace("gestion_notes.php?code_inscription=<?=$code_inscription?>");
			//-->
			</script>
              <?php
			  }
			  else{
			  $id=$_GET['modifier2'];
			  $sql4="select n.*, c.titre, s.session, s.annee_academique
			  from tbl_note_piimt as n, $tbl_cours as c, $tbl_session as s 
			  where n.code_note='$id'
			  and c.code_cours_psi=n.code_cours 
			  and s.idSession=n.idSession ";
			  
			  $req=@mysql_query($sql4) or die ("erreur lors de la selection des notes ");
			  while ($row=mysql_fetch_assoc($req)){
			  $code_cours=$row['code_cours'];
			  $idSession=$row['idSession'];
			  $code_inscription=$row['code_inscription'];
			  	?>
				

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/notes.gif"  border="0"/></td>
    <td width="78%" class="titre">&nbsp;Listing Grades  <span class="task">[Edit]</span> </td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
 		  <td valign="top" align="center">
 		   <a href="#" onclick="javascript:valid_form();" ><div class="save"></div>Submit</a> 
 		  </td>
 		  <td valign="top" align="center">
		   <a href="gestion_notes.php?code_inscription=<?=$code_inscription?>">
		  <div class="cancel"></div>Cancel</a></td>
		  
		</tr>
	  </table>	
	  </td> 
  </tr>
</table>
 <form method="post"  action="gestion_notes.php?modifier2=oui" name="f_ajout">
    <input type="hidden" name="id" value="<?=$id?>" />
    <input type="hidden" name="code_cours" value="<?=$row['code_cours']?>" />
    <input type="hidden" name="code_inscription" value="<?=$row['code_inscription']?>" />
    <input type="hidden" name="idSession" value="<?=$row['idSession']?>" />
	
 	   <table border="0" cellpadding="0" cellspacing="2" width="100%" style="margin-left:10px" class="cellule_table">
		  <tr>
		  	<td colspan="4" align="center" class="gras">Title Course: <?=$row['titre']?></td>
		 </tr>
 		<tr>
		  	<td colspan="4" align="center" class="gras">Session : <?=$row['session'].' '.$row['annee_academique']?></td>
		 </tr>
		<tr>
			<td height="5" colspan="4"></td>
		</tr>
		
         <tr>
		  <td colspan="4"class="gras">
          <label for="transfer">Transfer</label>: <input type="checkbox" id="transfer" name="transfer" value="transfer" <?=$row['letter_grade']=='T' ? $checked : ''?> /></td>
		  </tr>
		   <tr>
		  <td colspan="4"class="gras">
          <label for="withdrawal">Withdrawal</label>: <input type="checkbox" id="withdrawal" name="withdrawal" value="withdrawal" <?=$row['letter_grade']=='W' ? $checked : ''?> /></td>
		  </tr>
          <tr><td colspan="4" height="3px"></td></tr>
		<tr>
		  <td colspan="4"class="gras">
          <label for="incomplete">Incomplete course </label>: <input type="checkbox" id="incomplete" name="incomplete" value="incomplete" <?=$row['letter_grade']=='I' ? $checked : ''?> />
          </td>
		  </tr>
		  <tr><td colspan="4" height="3px"></td></tr>
		  <tr>
		  <td width="25%" class="gras"><label for="mid_term">Project 1:</label></td>
		  <td width="25%">
		  <input type="text" name="mid_term" id="mid_term" value="<?=$row['mid_term']?>" class="input" size="7" />
		  </td>
		  <td width="25%"> </td>
		  <td width="25%"></td>
		  </tr>
		  <tr><td colspan="4" height="3px"></td></tr>
		   <tr>
		  <td class="gras"><label for="project">Project 2 :</label> </td>
		  <td><input type="text" name="project" id="project" value="<?=$row['project']?>" size="7" class="input" /></td>
		   <td>&nbsp;</td>
		   <td>&nbsp;</td>
		   </tr>
		  <tr><td colspan="4" height="3px"></td>
		  </tr>
 		   <tr>
		  <td class="gras"><label for="participation">Project 3 :</label> </td>
		  <td><input type="text" name="participation" id="participation" value="<?=$row['participation']?>" size="7" class="input" /></td>
		   <td>&nbsp;</td>
		   <td>&nbsp;</td>
		   </tr>
		  <tr><td colspan="4" height="3px"></td>
		  </tr>
		  
		   <tr><td colspan="4" height="3px"></td>
		  </tr>
		   <tr>
		<!-- <td class="gras"><label for="fStart">State:</label> </td>
		  <td><input type="text" name="fStart" id="fStart" value="<?php echo $fStart;?>" class="input" size="7"  />
		 </td>-->
		   <td>&nbsp;</td>
		   <td>&nbsp;</td>
		   </tr>
		 </table>



	  
	 
</form>
<?php
}

}
?>
