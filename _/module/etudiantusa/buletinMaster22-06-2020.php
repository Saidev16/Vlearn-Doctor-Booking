
 <?php
 	 $CGPA=$count=$credit=0;
	 if (isset($_GET['buletinMaster'])){
	 $code_inscription= addslashes($_GET['buletinMaster']);
	 // select student information
	 $sql="SELECT e.*
	 FROM tbl_etudiant_usa AS e WHERE code_inscription= '$code_inscription'";
	 $res= @mysql_query($sql) or die('Erreur :: Student information');
	 $row = @mysql_fetch_assoc($res);
	 $date=$row['date_naissance'];
	
	$nom=$row['nom'];
	$prenom=$row['prenom'];
	$adresse=$row['adresse'];
	$lieu_naissance=$row['lieu_naissance'];
	$code_bac=$row['code_bac'];
	$prefixe=$row['prefixe'];
	?>

  <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/etudiants.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;Bulletin </span></td>
	<td width="90">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		<td valign="top" align="center" >
		  <a href="http://his.americanhigh.us/module/etudiantusa/printb.php?printb=<?=$code_inscription?>" target="_blank"  title="Imprimer"> 
		  <div class="imprimer"></div>Print</a>
		  </td><!---
		 <td valign="top" align="center" >
		  <a href="http://piimt.us/piimt/html2pdf_v3.20/html2pdf_v3.20/exemples/exempleB00.php?buletin=<?php echo $code_inscription?>" target="_blank"  title="Imprimer"> 
		  <div class="imprimer"></div>Imprimer</a>
		  </td>-->
		   <td align="right">
		 <a href="gestion_des_etudiants_usa.php"><div class="retour"></div>Back</a>
		 </td>
		</tr>
	  </table>
	</td> 
  </tr>
  </table>
 
<style>
</style>
</head>

<body bgcolor="#F8F8F8" lang=FR
style='tab-interval:36.0pt'>

<div class=WordSection1>
<table align="center" border="1" cellpadding="0" cellspacing="0" width="1000">
  <tbody>
    <tr>
      <td colspan="75" align="center" valign="middle" height="40" class="gras">
	  <span class="style4" ><font size=5 color="#960018">American School of Leadership</font></span>
	  <br>
	  <span class="style2"><font color="#960018">Academic Record – Transcript</font> </span></td>
      <!-- First line -->
      </tr>
      <!-- second line -->
      <tr>
      <td colspan="20" align="left" valign="middle" height="30" class="gras">Full 
        NAME:<?php echo $prenom.' '.$nom;?> </td>
   <!-- <td colspan="20" align="center" valign="middle" rowspan="3"><img src="images/icone/usdla.png" width="80" height="40" border="0"/></td>-->
      <td colspan="20" align="left" valign="middle" height="30" class="gras">DOCUMENT 
      NO:<?php echo $prefixe.$code_inscription;?> </td> 
    </tr>
   
    <tr>
      <td colspan="20" align="left" valign="middle" height="30" class="gras">DATE 
        OF BIRTH:
        <?php  
		$date=$row['date_naissance'];
		$tab=split('[/.-]',$date); 
		echo $tab[1].'-'.$tab[2].'-'.$tab[0]; /*echo $row['date_naissance'];*/
		
		?>
      </td>
		
    
	  <td colspan="20" align="left" valign="middle" class="gras">PREVIOUS SCHOOL 
        NAME: <?php echo $row['lieu_naissance'];  ?> </td>
    </tr>
    
	<tr>
      <td colspan="20" align="left" valign="middle" height="30" class="gras">STUDENT 
        ADDRESS: <?php echo $adresse;?></td>
      <td colspan="20" align="left" valign="middle" height="30" class="gras">PREVIOUS 
        SCHOOL ADDRESS: <?php echo $row['code_bac'];?> </td>
    
	</tr>
  </tbody>
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
					<td width="50">Date</td>                    
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
					<td width="50">Date</td>   
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
             FROM tbl_note_usa AS n, tbl_cours AS c 
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
                <td width="75" align="left"  class="code"><?php echo stripslashes($row['code_cours']);?></td>
                <td width="225" align="left"><?php echo stripslashes($row['titre']);?></td>
                <td width="50" align="center"><?php echo $row['letter_grade'];?></td>
				<td width="50" align="center"><?php echo $row['nbr_credit'];?></td>
				<td width="50" align="center"><?php echo $ligne['academic_year']; ?></td>
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
           <tr>
               <td colspan="3" class="gras">Grade Point Average(GPA):</td>
               <td align="center" class="gras"><?php echo $j>0 ? round($GPA/$j, 2) : '' ; ?></td>
           </tr>
		    <tr>
               <td colspan="3" class="gras">Cumulative Credits:</td>
               <td align="center" class="gras"><?php echo $credit;?></td>
           </tr>
         </table>
		 
     </td>
	</tr>
</table>
  
  
  <table width="1000" border="1" cellspacing="0" align="center" style="border: 1px solid #000; font-size:11px; font-weight:bold; margin-top:0px">
  <tr> 
    <td width="444" height="50"><p>SPECIAL RECOMMENDATIONS: </p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td> 
    <td width="259" height="50"><p>GRADUATION DATE:
        <?php echo 'August 20th 2014';//$ligne['academic_year'];?>
      </p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="283" height="50"><p>SCHOOL OFFICAL SIGNATURE: </p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
  </tr> 
</table>
 <?php
 }
?>
