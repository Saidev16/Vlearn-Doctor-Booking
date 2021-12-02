<?php
		/***** 
		function to convert from number to letter
		return string val 
		******/ 
		function noteConvertor($note){
			switch ($note) {
					case '20' :
					$note_lettre='A+';
					break;
					
					case '19' :
					$note_lettre='A+';
					break;
					
					case 18:
					$note_lettre='A';
					break;
					
					case 17:
				   $note_lettre='A-';
					break;
					
					case 16:
					$note_lettre='B+';
					break;
					 case 15:
					$note_lettre='B';
					break;
					
					case 14:
					$note_lettre='B-';
					break;
					case 13:
					$note_lettre='C+';
					break;
					
					case 12:
					$note_lettre='C';
					break;
					
					case '11':
					$note_lettre='C-';
					break;
			
					case 10:
					$note_lettre='C-';
					break;
					
					case 9:
					$note_lettre='D';
					break;
					case 8:
					$note_lettre='D';
					break;
					
					case '7' :
					$note_lettre='F';
					break;
					
					case  '6':
					$note_lettre='F';
					break;
					
					case '5' :
					$note_lettre='F';
					break;
					
					case '4' :
					$note_lettre='F';
					break;
					
					case '3' :
					$note_lettre='F';
					break;
					
					case '2' :
					$note_lettre='F';
					break;
					
					case '1' :
					$note_lettre='F';
					break;
					
					case '0' :
					$note_lettre='F';
					break;
				}
				return $note_lettre;
		}

		 
		   /*
		   function to calculate factory
		   params: 
		   		notes : array
				percent: array
 		   */
		function factory($notes, $percent ){
			
 			//calcule de la somme des coeficients

			$somme_coeficient=array_sum($percent); 
			 
			//initialisation 
			
			$moyen=$coeficients=$noteNumber=$coeficientCounter=0;
			
			//boucle sur le tableau des notes
			
			foreach ($notes as $note) :
			
 			$note=str_replace(',', '.', $note); 
			
			//si la note n'est pas numerique
			
			if(!is_numeric($note)){
			
			//incrementer le compteur des coeficients
			
			$coeficientCounter++;  
							   	   }
			//si la note est numerique
			
			else if(is_numeric($note) ){

				if($somme_coeficient == 100) { 
					
						$moyen=bcadd($moyen, bcmul($note , $percent[$coeficientCounter], 6), 6);
						$coeficients=bcadd($coeficients, $percent[$coeficientCounter], 6);
 						$coeficientCounter++;
											
											}
							  
					else{
					
  					$moyen=bcadd($note, $moyen, 6);
 					$coeficientCounter++;
					$noteNumber++;
  						
						}
					
					 
							 		  }
										
		      
 					endforeach;
					
					if($noteNumber!=0){
					$moyen/=$noteNumber;
					}
					else if($coeficients!=0){
					$moyen/=$coeficients;
					}
 					//echo 'moyenne fin '.$moyen.'<br>*******************<br><br>';
  					return $moyen;
		
		 
}


	function verifyAbsence($moyen, $absence, $n_comptabilise){
		//declaration d'un tableau
		$notes =array();
		// si la moyen n'est pas null
		if($moyen!=0){
					//cas de trois absences :: soustraire un quart de la note 
			     if ($absence==3){
 					 $notes['nfo']=substr($moyen * 0.75, 0, 5);  
					 $notes['nco']=round($notes['nfo']); 
							   }
					//cas plus que trois absences :: la note est null 
						else if ($absence>3){
							$notes['nfo']=0;
							$notes['nco']=0;
						                    }
								else{
									$notes['nfo']=substr($moyen, 0, 5);
									$notes['nco']=round($notes['nfo']);
								    }
					 //rendu pour etudiant avec prise en charger des absences non comptabilise
					  //cas de trois absences :: soustraire un quart de la note 
					if ($n_comptabilise==3){
						$notes['note_final']=substr($moyen * 0.75, 0, 5);
						$notes['note_chiffre']=round($notes['note_final']);
										   }
							//cas plus que trois absences :: la note est null 
						else if ($n_comptabilise>3){
							$notes['note_final']=$notes['note_chiffre']=0;
 												   }
							else{
								$notes['note_final']=substr($moyen, 0, 5);
								$notes['note_chiffre']=round($notes['note_final']);
							    }
							}	
							//retourne un tableau de note 
							return $notes;	
								}
 ?>
 