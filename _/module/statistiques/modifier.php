<script language="javascript1.2">
function valid_form(){
document.f_ajout.submit();
}
</script>
<?php
if(isset($_POST['mid_term'])){
$mid_term=$_POST['mid_term'];
$project=$_POST['project'];
$participation=$_POST['participation'];
$final_exam=$_POST['final_exam'];
$code_cours=$_POST['code_cours']; 
$code_inscription=$_POST['code_inscription'];
$idSession=$_POST['idSession'];
$id=$_POST['id'];
$some_coef=0;
// initialise
			
			$letter_grade=$final_grade='';
			$some_coef=$i=$j=0;
 		 	$valide_notes=array();
		 	// put notes in an array
			$notes=array($mid_term, $project, $participation, $final_exam);
			// boucle on notes arrays 
			foreach ( $notes as $note) :
				if (!empty($note) && is_numeric($note) && $note>-1 && $note<101 ) :
				$valide_notes [$i] = $note;
				$i++;
				endif;
		    endforeach;
				 
			//set factory
			if (count($valide_notes)>4){
			// initialise array with 4 val
			$all_coef=array(30, 20, 50);
										}
			else{
			// initialise array with 4 val
			$all_coef=array(30, 20, 30, 20);
			    }
				 
			foreach ($valide_notes as $valide_note):
 			$some_coef += $all_coef[$j];
			$final_grade += $valide_note * $all_coef[$j];
			//echo $valide_note .'*'. $all_coef[$j].'<br>';
			$j++;
			endforeach;
				 					 
			//calculate final grade				
		    $some_coef != 0 ? $final_grade /= $some_coef : $final_grade=$final_grade;
			  //die('final grade '. $final_grade);	
				
				 if ($final_grade <= 59){
				 $letter_grade= 'F';
				 $GPA=0;
				 }
				 
				 if ( $final_grade <= 69  &&  $final_grade >= 60  ){
				 $letter_grade= 'D';
				 $GPA=1;
				 }
				 
				 if ( $final_grade <= 79  &&  $final_grade >= 70  ){
				 $letter_grade= 'C';
				 $GPA=2;
				 }
				 
				 if (  $final_grade <= 89  &&  $final_grade >= 80  ){
				 $letter_grade= 'B';
				 $GPA=3;
				 }
				 
				 if ( $final_grade <= 100  &&  $final_grade >= 90  ){
				 $letter_grade= 'A';
				 $GPA=4;
				 }
				 
 			    if($mid_term=='' and $project=='' and $participation=='' and $final_exam=='') {
				$letter_grade= '';
				$GPA='';
				 }
				 
				if($_POST['transfer']==1){
				 $mid_term = $project = $participation = $final_exam = '';
					 $final_grade='';
					 $letter_grade= 'T';
					 $GPA= 0; 
					 }
   
  // fin du calcule de la note finale	
	 
 
			$sql1="UPDATE $tbl_note SET 
			`mid_term` = '$mid_term',
			`project` = '$project',
			`participation` = '$participation',
			`final_exam` = '$final_exam',
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
			  $id=$_GET['modifier'];
			  $sql4="select n.*, c.titre, s.session, s.annee_academique
			  from $tbl_note as n, $tbl_cours as c, $tbl_session as s 
			  where n.code_note='$id'
			  and c.code_cours=n.code_cours 
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
    <td width="78%" class="titre">&nbsp;GESTION DES NOTES <span class="task">[modifier]</span> </td>
	<td width="22%">
	  <table border="0" align="right" width="0%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
 		  <td valign="top" align="center">
 		   <a href="#" onclick="javascript:valid_form();" ><div class="save"></div>Valider</a> 
 		  </td>
 		  <td valign="top" align="center">
		   <a href="gestion_notes.php?code_inscription=<?=$code_inscription?>">
		  <div class="cancel"></div>Annuler</a></td>
		  
		</tr>
	  </table>	
	  </td> 
  </tr>
</table>
 <form method="post"  action="gestion_notes.php?modifier=oui" name="f_ajout">
    <input type="hidden" name="id" value="<?=$id?>" />
    <input type="hidden" name="code_cours" value="<?=$row['code_cours']?>" />
    <input type="hidden" name="code_inscription" value="<?=$row['code_inscription']?>" />
    <input type="hidden" name="idSession" value="<?=$row['idSession']?>" />
 	   <table border="0" cellpadding="0" cellspacing="2" width="100%" style="margin-left:10px" class="cellule_table">
		  <tr>
		  	<td colspan="4" align="center" class="gras">Titre du cours : <?=$row['titre']?></td>
		 </tr>
 		<tr>
		  	<td colspan="4" align="center" class="gras">Session : <?=$row['session'].' '.$row['annee_academique']?></td>
		 </tr>
		<tr>
			<td height="5" colspan="4"></td>
		</tr>
         <tr>
		  <td width="25%" class="gras">Transfer </td>
		  <td width="25%">
		  <label for="oui">oui</label> <input type="radio" name="transfer" id="oui" value="1" <?=$row['letter_grade']=='T' ? 'checked="checked"' : ''?> />
          <label for="non">non</label> <input type="radio" name="transfer" id="non" value="0" <?=$row['letter_grade']!='T' ? 'checked="checked"' : ''?> />
		  </td>
		  <td width="25%"> </td>
		  <td width="25%"></td>
		  </tr>
		  <tr><td colspan="4" height="3px"></td></tr>
		  <tr>
		  <td width="25%" class="gras"><label for="mid_term">Mid-term</label></td>
		  <td width="25%">
		  <input type="text" name="mid_term" id="mid_term" value="<?=$row['mid_term']?>" class="input" size="7" />
		  </td>
		  <td width="25%"> </td>
		  <td width="25%"></td>
		  </tr>
		  <tr><td colspan="4" height="3px"></td></tr>
		   <tr>
		  <td class="gras"><label for="project">Project :</label> </td>
		  <td><input type="text" name="project" id="project" value="<?=$row['project']?>" size="7" class="input" /></td>
		   <td>&nbsp;</td>
		   <td>&nbsp;</td>
		   </tr>
		  <tr><td colspan="4" height="3px"></td>
		  </tr>
 		   <tr>
		  <td class="gras"><label for="participation">Participation :</label> </td>
		  <td><input type="text" name="participation" id="participation" value="<?=$row['participation']?>" size="7" class="input" /></td>
		   <td>&nbsp;</td>
		   <td>&nbsp;</td>
		   </tr>
		  <tr><td colspan="4" height="3px"></td>
		  </tr>
		   <tr>
		  <td class="gras"><label for="final_exam">Final exam</label> </td>
		  <td><input type="text" name="final_exam" id="final_exam" value="<?=$row['final_exam']?>" class="input" size="7"  />
		 </td>
		   <td>&nbsp;</td>
		   <td>&nbsp;</td>
		   </tr>
		 
	  </table>
</form>
<?php
}
}
?>