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
mysql_query("SET NAMES 'utf8'", $connect);

if ( ! $connect ) 

die ('Failed to connect server vnc'); 

@mysql_select_db($bd, $connect) or die ('Database Select Failed');

}

connecter($serveur,$login,$mdp,$bd);

 	 
	 
	 $CGPA=$count=$credit=0;
	 if (isset($_GET['printO'])){
	 $code_inscription= addslashes($_GET['printO']);
	 // select student information
	 $sql="SELECT e.*
	 FROM tbl_etudiant_burkina as e WHERE code_inscription= '$code_inscription'";
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




   <table width="1000"  cellpadding="0" cellspacing="0" border="0" align="center" class="buletin_data" >

   
      
      <tr>
	 
     <td colspan="20" align="left" valign="middle" height="30" class="gras" style="border: 1px  solid;">
       <b> &nbsp;First Name:</b><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst($nom);?>  </td>
	    <td colspan="20" align="left" valign="middle" height="30" class="gras" style="border: 1px solid;">
       <b> &nbsp;Date of Birth:</b><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php 
$date=$row['date_naissance'];
$tab=split('[/.-]',$date); 
echo $tab[1].'-'.$tab[2].'-'.$tab[0]; /*echo $row['date_naissance'];*/

?> </td>
       
      <td height="21" colspan="15" align="left" valign="center" class="gras" style="border: 1px solid;">
       <b> &nbsp;&nbsp;&nbsp;&nbsp;Previous School Name:</b><br />
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['lieu_naissance'];  ?> </td>
		 <!-- <td width="19%" colspan="35" rowspan="10" align="center" valign="middle" style="border: 1px solid;"><span style="color:#A4A4A4">OFFICIAL </span></td>-->
		    
	   
     
    </tr>
   
    <tr>
      <td colspan="40" align="left" valign="middle" height="30" style="border: 1px solid;">&nbsp;<b>Last Name:</b><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst($prenom);?> 
	    <td colspan="15" align="left" valign="middle" height="30" style="border-right: 1px solid;"><b> &nbsp;&nbsp;<br />&nbsp;&nbsp;&nbsp;&nbsp;Previous School Address:</b><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row['code_bac'];?>   </td>		
	    <td colspan="15" align="center" valign="middle" height="30">  </td>
     
    </tr>
    
	<tr>
       
    <td height="30" colspan="40" align="center" valign="middle" style="border: 1px solid;" ><b>Student Address: </b> <br /><?php echo $adresse;?></td>
	<td colspan="5" align="left" valign="middle" height="23" style="border-right: 1px solid;">     </td>
    
        
    
   
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
                    <td width="50"  style="border-right: 1px solid;" >Credit</td>
					<td width="50">Grade</td>
					
					                
                </tr>
            </table>
      </th>
        
		<th width="38%">
        	<table width="100%" cellspacing="0" class="gras">
            	<tr>
                   <td width="85" height="44" style="border-right: 1px solid;">Course Code</td>
                    <td width="260" style="border-right: 1px solid;">Course Title</td>
                    <td width="50"  style="border-right: 1px solid;">Credit</td>
					<td width="50" ">Grade</td>
			
					
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
             FROM tbl_note_burkina AS n, tbl_cours AS c 
             WHERE c.code_cours = n.code_cours 
             AND code_inscription = '$code_inscription' 
			
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
                <td width="69" align="center" ><?php echo $row['nbr_credit'];?></td>
                <td colspan="4" width="66" align="left" ><?php echo $row['letter_grade'];?></td>
				
				
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
			
			 <table width="1000"  cellpadding="0" cellspacing="0" border="0" style="border:1px solid black;" align="center" class="buletin_data" >
          <tr>
               <td colspan="0" align="center" class="gras" style="border: 1px  solid;"> <p><u><b>C.G.P.A.</b></u></p>
			     <?php
			     if($j>0 )
         { $zineb= round($GPA/$j, 2) ;
           echo  number_format($zineb, 1, '.', ' ');
         }
           else { echo '' ; }


			      //echo $j>0 ? round($GPA/$j, 2) : '' ; ?>
            </td>
			<td colspan="0" align="center" class="gras" style="border: 1px  solid;"> <p><u><b>Legend</b></u></p>
			     <?php echo 'T=Transferred'; ?><br />
				  <?php echo 'A thru F = ASL Course'; ?>
            </td>
			<td colspan="0"  align="center"class="gras" style="border: 1px  solid;"> <p><u><b>Graduation Date:</b></u></p>
			     <?php 
		$tab=split('[/.-]',$graduation_date); 
		 if($tab[1]=='1')
		 {$tab[1]='January';}
		 else  if($tab[1]=='2')
		 {$tab[2]='February';}
		  else  if($tab[1]=='3')
		 {$tab[1]='March';}
		  else  if($tab[1]=='4')
		 {$tab[1]='April';}
		  else  if($tab[1]=='5')
		 {$tab[1]='May';}
		  else  if($tab[1]=='6')
		 {$tab[1]='June';}
		  else  if($tab[1]=='7')
		 {$tab[1]='July';}
		  else  if($tab[1]=='8')
		 {$tab[1]='August';}
		  else  if($tab[1]=='9')
		 {$tab[1]='September';}
		  else  if($tab[1]=='10')
		 {$tab[1]='October';}
		  else  if($tab[1]=='11')
		 {$tab[1]='November';}
		  else  if($tab[1]=='12')
		 {$tab[1]='December';}
		 
		echo $tab[1].' '.$tab[0]; //echo 'January 2015' ; ?>
            </td>
				<td colspan="0"  align="center"class="gras" style="border: 1px  solid;"> <p><u><b> Total Credits Earned:</b></u></p>
		</p>
			 <?php 
			
 $sql14="SELECT sum(nbr_credit)
             FROM tbl_note_burkina AS n, tbl_cours AS c 
             WHERE c.code_cours = n.code_cours
             AND code_inscription = '$code_inscription'
			  and letter_grade ='T'
			 AND n.archive = 0
			 ";
			 
		$result14 = mysql_query($sql14) or die (mysql_error());

$resultat14=mysql_fetch_row($result14);
$transfer14=$resultat14[0]; 	  ?>
 <?php echo  $transfer14 + $credit.Cr;//'24Cr';?>
             
   </tr>
	</table> 
</table>
		 
     </td>
	</tr>
</table>
 
 <?php
 }
?>
