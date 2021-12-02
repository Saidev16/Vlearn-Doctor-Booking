		<?php
		if(isset($_POST['boxchecked'])){
		 
		    //récupération de la saisie utisateur  
			$id =$_POST['id'];
			$code_note=(int)$_POST['boxchecked'];
			$code_cours=addslashes($_POST['code_cours']);
 			$mid_term=addslashes($_POST['mid_term']);
			$project=addslashes($_POST['project']);
			$participation=addslashes($_POST['participation']);
			$final_exam=addslashes($_POST['final_exam']);
			
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
				
 if (round($final_grade) <= 59){
 $letter_grade= 'F';
 $GPA=0;
 }
 
  if ( round($final_grade) <= 63  &&  round($final_grade) >= 60  ){
 $letter_grade= 'D-';
 $GPA=1;
 }
 
 if ( round($final_grade) <= 66  &&  round($final_grade) >= 64 ){
 $letter_grade= 'D';
 $GPA=1;
 }
 
 if ( round($final_grade) <= 69  &&  round($final_grade) >= 67 ){
 $letter_grade= 'D+';
 $GPA=1;
 }
 
  if ( round($final_grade) <= 73  &&  round($final_grade) >= 70  ){
 $letter_grade= 'C-';
 $GPA=2;
 }
 
 if ( round($final_grade) <= 76  &&  round($final_grade) >= 74  ){
 $letter_grade= 'C';
 $GPA=2;
 }
 
 if ( round($final_grade) <= 79  &&  round($final_grade) >= 77  ){
 $letter_grade= 'C+';
 $GPA=2;
 }
 
 if (  round($final_grade) <= 83  &&  round($final_grade) >= 80  ){
 $letter_grade= 'B-';
 $GPA=3;
 }
 
 if (  round($final_grade) <= 86  &&  round($final_grade) >= 84  ){
 $letter_grade= 'B';
 $GPA=3;
 }
 
 if (  round($final_grade) <= 89  &&  round($final_grade) >= 87  ){
 $letter_grade= 'B+';
 $GPA=3;
 }
 
 if ( round($final_grade) <= 93  &&  round($final_grade) >= 90  ){
 $letter_grade= 'A-';
 $GPA=4;
 }
 
 if ( round($final_grade) <= 100  &&  round($final_grade) >= 94  ){
 $letter_grade= 'A';
 $GPA=4;
 }
				 
 			    if($mid_term=='' and $project=='' and $participation=='' and $final_exam=='') {
				$letter_grade= '';
				$GPA='';
				 }
			 //mise à jour de la note
		
		$sql="UPDATE $tbl_note SET 
			`mid_term` = '$mid_term',
			`project` = '$project',
			`participation` = '$participation',
			`final_exam` = '$final_exam',
			`final_grade` = '$final_grade',
			`letter_grade` = '$letter_grade',
			`gpa` = '$GPA'  
 			 WHERE `code_note` = '$id' "; 
		 
 		
		@mysql_query($sql) or die("erreur lors de la mise à jour de la note");
		?>
		<form name="retour" method="post">
		<input type="hidden" name="task" value="note" />
		<input type="hidden" name="boxchecked" value="<?=$code_cours?>" />
		<input type="hidden" name="token" value="<?=$_SESSION['token']?>" />
		</form>
		<script language="javascript1.2">
		document.retour.submit();
		</script>
		<?php
		}
		?>
