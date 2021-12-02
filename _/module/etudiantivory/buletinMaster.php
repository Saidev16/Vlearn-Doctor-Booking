
 <?php
 	 $CGPA=$count=$credit=0;
	 if (isset($_GET['buletinMaster'])){
	 $code_inscription= addslashes($_GET['buletinMaster']);
	 $gen=$_GET['gen'];
	 // select student information
	 $sql="SELECT e.*
	 FROM tbl_etudiant_ivory AS e WHERE code_inscription= '$code_inscription'";
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

  <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/etudiants.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;Bulletin </span></td>
	<td width="90">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		<td valign="top" align="center" >
		  <a href="http://his.americanhigh.us/module/etudiantivory/printb.php?printb=<?=$code_inscription?>" target="_blank"  title="Imprimer"> 
		  <div class="imprimer"></div>Print</a>
		  </td>
		  <td valign="top" align="center" >
		  <a href="http://his.americanhigh.us/module/etudiantivory/printO.php?printO=<?=$code_inscription?>" target="_blank"  title="Imprimer"> 
		  <div class="imprimer"></div>Print Official</a>
		  </td><!---
		 <td valign="top" align="center" >
		  <a href="http://piimt.us/piimt/html2pdf_v3.20/html2pdf_v3.20/exemples/exempleB00.php?buletin=<?php echo $code_inscription?>" target="_blank"  title="Imprimer"> 
		  <div class="imprimer"></div>Imprimer</a>
		  </td>
		   <td align="right">
		 <a href="gestion_des_etudiants_ivory.php"><div class="retour"></div>Back</a>
		 </td>
-->


		 <?php if($gen == 1) { ?>
<td align="right">
<a href="gestion_des_etudiants_all.php"><div class="retour"></div>Back</a>
</td>
<?php
}
else { ?>

<td align="right">
<a href="gestion_des_etudiants_ivory.php"><div class="retour"></div>Back</a>
</td>

	<?php } ?>
		</tr>
	  </table>
	</td> 
  </tr>
  </table>
 
<style>
</style>
</head>

<table width="1000"  cellpadding="0" cellspacing="0" border="0" style="border:1px solid black;" align="center" class="buletin_data" >

   
      
      <tr>
	 
     <td colspan="20" align="left" valign="middle" height="30" class="gras" style="border: 1px  solid;">
       <b> &nbsp;First Name:</b><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst(strtolower($prenom));
       //$prenom;?>  </td>
	    <td colspan="20" align="left" valign="middle" height="30" class="gras" style="border: 1px solid;">
       <b> &nbsp;Date of Birth:</b><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php 
$date=$row['date_naissance'];
$tab=split('[/.-]',$date); 
echo $tab[1].'-'.$tab[2].'-'.$tab[0]; /*echo $row['date_naissance'];*/

?> </td>
       
      <td height="50" width=50 colspan="15" align="left" valign="middle" style="border: 1px solid;">
       <b> &nbsp;&nbsp;&nbsp;Previous School Name:</b><br />
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['lieu_naissance'];  ?> </td>
	    <td width="70" height="30" colspan="20" align="center" valign="middle" class="gras" style="border-right: 1px solid;">&nbsp; <p>&nbsp;</p>
        <p><font color="#E0EBEB">OFFICE USE ONLY </font> </p></td>
  </tr>
       <tr>
      <td colspan="40" align="left" valign="middle" height="30" style="border: 1px solid;">&nbsp;<b>Last Name:</b><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst(strtolower($nom));//$nom;?> 
      
	   <td colspan="15" align="left" valign="middle" height="30" style="border-right: 1px solid;"><b> &nbsp;&nbsp;&nbsp;<br />
	       &nbsp;&nbsp;&nbsp;Previous School Address:</b><br /> 
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <?php echo $row['code_bac'];?>     </td>
    </tr>
    <tr>
     <td height="30" colspan="40" align="center" valign="middle" style="border: 1px solid;" ><b>Student Address: </b> <br /><?php echo $adresse;?></td>
	   <td colspan="5" align="left" valign="middle" height="23" style="border-right: 1px solid;" >     </td>
	</tr>
</table>

<table width="1000" cellspacing="0" border="1" align="center" class="buletin_data">
  	<tr>
    	<th width="50%">
        	<table width="100%" cellspacing="0" class="gras">
            	<tr>
                    <td width="75">Course Code</td>
                    <td>Course Title</td>
					<td width="50">Grade</td>
					<td width="50">Credit</td>
					                 
                </tr>
            </table>
        </th>
        
		<th width="50%">
        	<table width="100%" cellspacing="0" class="gras">
            	<tr>
                   <td width="75">Course Code</td>
                    <td>Course Title</td>
					<td width="50">Grade</td>
					<td width="50">Credit</td>
					   
                </tr>
            </table>
        </th>
    </tr>
    
	
	<tr style="	border-right: 1px solid #000; border-left: 1px solid #000; border-top: 0px solid #000; border-bottom: 0px solid #000;"  >
    <?php
    $transfer=0;
	/*$query="SELECT DISTINCT n.idSession, s.session, s.annee_academique 
	FROM $tbl_note AS n, $tbl_session AS s, $tbl_cours AS c
	where n.idSession = s.idSession
	AND n.code_inscription = '$code_inscription'
		AND c.code_cours = n.code_cours
	AND n.archive = 0
	
		ORDER BY n.idSession";   
	$ressource=@mysql_query($query) or die('Erreur :: Select sessions');
	$i =0;
	while ($ligne= mysql_fetch_assoc($ressource)){
	$idSession = $ligne['idSession'];
 	$session = $ligne['session'];
 	$i++;  
	/*if ($i%2) {echo '</tr><tr>'; }*/
	?>
    	
			<?php
             
			 $GPA = $j = 0; 
			 $k=0; //indice          
             $sql="SELECT c.code_cours, c.titre, c.nbr_credit , n.letter_grade, n.gpa, c.type, n.IdSession, n.code_cours_testing 
             FROM tbl_note_ivory AS n, tbl_cours AS c 
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
            <td width="50%" valign="top" style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: 0px solid #000; border-bottom: 0px solid #000;"   >
            <table width="100%" cellpadding="0" cellspacing="0" style="font-size:11px">   
			<tr>
		
                <td width="89" align="left"  class="code"><?php echo stripslashes($row['code_cours']);?></td>
                <td width="285" align="left"><?php echo stripslashes($row['titre']);?></td>
                <td width="41" align="center"><?php echo $row['letter_grade'];?></td>
				<td width="61" align="center"><?php echo $row['nbr_credit'];?></td>
				
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
		   		<tr style="	border-right: 1px solid #000; border-left: 1px solid #000; border-top: 0px solid #000; border-bottom: 0px solid #000;" >
		     <?php
		    } // fin if 
		   } // fin while
		   
		   if($k%2==1)
			 { 
		   ?>
		   <td width="50%" valign="top" style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: 0px solid #000; border-bottom: 0px solid #000;"  >
		   </td>
		 <?php
		    }
		?>
		   </tr>
		   <?php

			             $CGPA+=$GPA;
                         $count+=$j;
 			?>
			
   <table width="1000" cellspacing="0" align="center" style="border: 1px solid #000; font-size:11px; font-weight:bold; margin-top:10px">
    <tr>
               <td colspan="0" align="center" class="gras" style="border: 1px  solid;"> <p><u><b>C.G.P.A.</b></u></p>
			     <?php if($j>0 )
         { $zineb= round($GPA/$j, 2) ;
           echo  number_format($zineb, 1, '.', ' ');
         }
           else { echo '' ; }
           ?>
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
             FROM tbl_note_ivory AS n, tbl_cours AS c 
             WHERE c.code_cours = n.code_cours
                          AND code_inscription = '$code_inscription'
			  and letter_grade ='T'
			 AND n.archive = 0
			 ";
			 
		$result14 = mysql_query($sql14) or die (mysql_error());

$resultat14=mysql_fetch_row($result14);
$transfer14=$resultat14[0]; 	  ?>
 <?php echo  $transfer14+ $credit.Cr;//'24Cr';?>
<!-- <p>&nbsp;<u><b> Transfer Credits :</b></u> <?php echo  $transfer14 .Cr;//'24Cr';?>
</p>
			 <p>&nbsp;<u><b>  Total Credits Earned:</b></u>  <?php echo  $transfer14 + $credit.Cr;//'24Cr';?></p> 
			 <p></p>
			 <p></p>
			 <p></p>-->
			  
            </td>
				    
           
			
             
   </tr>
  </table>
 
 <?php
 }
?>
