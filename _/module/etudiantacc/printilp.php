<head>
<!--<style>
  body {
  background-image:url('transcript.jpg') ; 
  background-repeat:no-repeat ;
  background-size: 100% ;
  background-position:50% 0%;
  
  }
</style>
<style>
//td { border: 1px solid #000 }

</style>-->
</head>

<?php

$bd="hisadm_hisdb"; 

$login="hisadm_hisusr";

$mdp="hispass11"; 

$serveur='127.0.0.1';

function connecter($serveur,$login,$mdp,$bd)
{

$connect = @mysql_connect($serveur,$login,$mdp);

if ( ! $connect ) 

die ('Failed to connect server vnc'); 

@mysql_select_db($bd, $connect) or die ('Database Select Failed');

}

connecter($serveur,$login,$mdp,$bd);

 	 
	 
	 $CGPA=$count=$credit=0;
	 if (isset($_GET['printilp'])){
	 $code_inscription= addslashes($_GET['printilp']);
	 // select student information
	 $sql="SELECT e.*
	 FROM tbl_etudiant_all as e WHERE code_inscription= '$code_inscription'";
	 $res= @mysql_query($sql) or die('Erreur :: Student information');
	 $row = @mysql_fetch_assoc($res);
	 $date=$row['date_naissance'];
	 $nom=$row['nom'];
	 $prenom=$row['prenom'];
	 $adresse=$row['adresse'];
	 $lieu_naissance=$row['lieu_naissance'];
	 $code_bac=$row['code_bac'];
	  $prefixe=$row['prefixe'];
	  $graduation_date=$row['graduation_date'];
	 
	 ?>
	 
	 <html>
 <br /> <br /> <br /> <br /> <br /><br />  <br /> <br /> <br /><br />




   <table width="1000"  border="0"  align="center" cellspacing="3" class="cellule_table">

   
      
      <tr>
	 
     <td colspan="20" align="left" valign="middle" height="30" class="gras" >
       <b> <u>&nbsp;PERSONAL DATA:</u></b><br /><br />
       

       </td>
	   
  </tr>
       <tr>
   <td ><span class="gras">STUDENT ID # </span> :&nbsp;<?=$row['prefixe'].$row['cin']?></td>
      
  </tr>
  <tr>
   <td ><span class="gras">FIRST NAME </span> :&nbsp;<?=$row['prenom']?></td>
       <td><span class="gras">LAST NAME</span> :&nbsp;<?=$row['nom']?></td>
       
  </tr>
  <tr>
   <td ><span class="gras">SOC. SEC. #</span> :&nbsp;<?=$row['cin']?></td>
       <td><span class="gras">BIRTH PLACE </span> :&nbsp;<?=$row['nationalite']?></td>
       
  </tr>
  <tr>
   <td ><span class="gras">HOME ADDRESS</span> :&nbsp;<?=$row['adresse']?></td>
       <td><span class="gras">HOME PHONE</span> :&nbsp;<?=$row['tel']?></td>
       
  </tr>

   <tr>
	 
     <td colspan="20" align="left" valign="middle" height="30" class="gras" >
       <br /><b> <u>&nbsp;CLASS SCHEDULE:</u></b><br /><br />
       

       </td>
	   
  </tr>
</table>



 <table width="1000" cellspacing="0" border="1" align="center" class="buletin_data">
  	<tr>
    	<th width="46%">
        	<table width="100%" cellspacing="0" class="gras">
            	<tr>
				  <td width="85" height="44" style="border-right: 1px  solid;">
                    Course Code</td>
                    <td width="260" style="border-right: 1px solid;">Course Title</td>
					<!--<td width="50" style="border-right: 1px solid;">Grade</td>
					<td width="50" >Credit</td>-->
					                
                </tr>
            </table>
      </th>
        
		<th width="38%">
        	<table width="100%" cellspacing="0" class="gras">
            	<tr>
                   <td width="85" height="44" style="border-right: 1px solid;">Course Code</td>
                    <td width="260" style="border-right: 1px solid;">Course Title</td>
					<!--<td width="50" style="border-right: 1px solid;">Grade</td>
					<td width="50" >Credit</td>-->
					
                </tr>
            </table>
      </th>
    </tr>
    
	
	<tr style="	border-right: 1px solid #000; border-left: 1px solid #000; border-top: 0px solid #000; border-bottom: 0px solid #000;"  >
    <?php
    $transfer=0;
	
	?>
    	
			<?php
             
			 $GPA = $j = 0; 
			 $k=0; //indice          
             $sql="SELECT c.code_cours, c.titre, c.nbr_credit , n.letter_grade, n.gpa, c.type, n.IdSession
             FROM tbl_note_all AS n, tbl_cours AS c 
             WHERE c.code_cours_testing = n.code_cours_testing 
             AND code_inscription = '$code_inscription' 
             AND n.letter_grade!= 'F'			
			 AND n.archive = 0";
			 $res= @mysql_query($sql) or die('Erreur :: Select notes');
             
			 while($row = mysql_fetch_assoc($res)){
             
			 $ss=$row['IdSession'];
			 
			 $sql2="SELECT session, annee_academique,academic_year from tbl_session where IdSession= '$ss'";
			 $res2= @mysql_query($sql2) or die('Erreur :: Select session');
			 $ligne=mysql_fetch_assoc($res2);		
			 $d=$ligne['session'].' '. $ligne['annee_academique'];
 
			 if(($row['letter_grade']!= 'T' && $row['letter_grade']!= 'I') && ($row['letter_grade']!='') && $row['letter_grade']!= 'W'&& $row['letter_grade']!= 'X'){
             $j++;
             }
             $GPA += $row['gpa'];
             
			 if($row['letter_grade']!= 'T' && $row['letter_grade']!= 'I' && $row['letter_grade']!='' && $row['letter_grade']!= 'W'&& $row['letter_grade']!= 'X'){ $credit+=$row['nbr_credit'];}
             if($row['letter_grade']== 'T')  $transfer+=1 ;
              
            ?>
            <td width="46%" valign="top" style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: 0px solid #000; border-bottom: 0px solid #000;"   >
            <table width="100%" cellpadding="0" cellspacing="0" style="font-size:13px"> 
		 
			<tr>
			
                <td width="118" align="left"  valign="middle" ><?php echo stripslashes($row['code_cours']);?></td>
                <td width="280" align="left" ><?php echo stripslashes($row['titre']);?></td>
               <!-- <td colspan="4" width="66" align="left" ><?php echo $row['letter_grade'];?></td>
				<td width="69" align="center" ><?php echo $row['nbr_credit'];?></td>-->
				
            </tr> 
		
			</table>
	  </td> 
            <?php 
			// end fetch notes 
			 $k++;
			 if($k%2==0)
			 { 
			 ?>
  </tr>
		   		<tr style="	border-right: 0px solid #000; border-left: 1px solid #000; border-top: 0px solid #000; border-bottom: 0px solid #000;" >
		     <?php
		    } // fin if 
		   } // fin while
		   
		   if($k%2==1)
			 { 
		   ?>
		  <td width="46%" valign="top" style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: 0px solid #000; border-bottom: 0px solid #000;"  >		   </td>
		 <?php
		    }
		?>
		   </tr>
		   <?php

			             $CGPA+=$GPA;
                         $count+=$j;
 			?>
			
			
</table>
		 
     </td>
	</tr>
</table>
 
 <?php
 }
?>
