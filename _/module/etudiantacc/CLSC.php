
 <?php
 	 $CGPA=$count=$credit=0;
	 if (isset($_GET['CLSC'])){
	 $code_inscription= addslashes($_GET['CLSC']);
	 // select student information
	 $sql="SELECT e.*
	 FROM tbl_etudiant_all AS e WHERE code_inscription= '$code_inscription'";
	 $res= @mysql_query($sql) or die('Erreur :: Student information');
	 $row = @mysql_fetch_assoc($res);
	 $date=$row['date_naissance'];
	$nom=$row['nom'];
	$prenom=$row['prenom'];
	$adresse=$row['adresse'];
	$lieu_naissance=$row['lieu_naissance'];
	$code_bac=$row['code_bac'];
	$prefixe=$row['prefixe'];
	$cin=$row['cin'];
	$graduation_date=$row['graduation_date'];
	?>

  <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/etudiants.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;Class Schedule </span></td>
	<td width="90">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		<!---<td valign="top" align="center" >
		  <a href="http://his.americanhigh.us/module/etudiantall/printb.php?printb=<?=$code_inscription?>" target="_blank"  title="Imprimer"> 
		  <div class="imprimer"></div>Print</a>
		  </td>
		 <td valign="top" align="center" >
		  <a href="http://piimt.us/piimt/html2pdf_v3.20/html2pdf_v3.20/exemples/exempleB00.php?buletin=<?php echo $code_inscription?>" target="_blank"  title="Imprimer"> 
		  <div class="imprimer"></div>Imprimer</a>
		  </td>-->
		   <td align="right">
		 <a href="gestion_des_etudiants_all.php"><div class="retour"></div>Back</a>
		 </td>
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
	 
     <td colspan="20" align="center" valign="middle" height="30" class="gras" style="border: 1px  solid;">
      <b> &nbsp; </b><br />
       <b> &nbsp;Student Name:<?php echo $nom.$prenom;?> </b><br /><br />
       <b> &nbsp;Registration Code:<?php echo $prefixe.$cin; ?></b><br /><br />

       </td>
	   
  </tr>
      
   
</table>

<table width="1000" cellspacing="0" border="1" align="center" class="buletin_data">
  	<tr>
    	<th width="50%">
        	<table width="100%" cellspacing="0" class="gras">
            	<tr>
                    <td width="75">Course Code</td>
                    <td>Course Title</td>
					<!--<td width="50">Grade</td>
					<td width="50">Credit</td>-->
					                 
                </tr>
            </table>
        </th>
        
		<th width="50%">
        	<table width="100%" cellspacing="0" class="gras">
            	<tr>
                   <td width="75">Course Code</td>
                    <td>Course Title</td>
					<!--<td width="50">Grade</td>
					<td width="50">Credit</td>-->
					   
                </tr>
            </table>
        </th>
    </tr>
    
	
    <?php
	

	
    $transfer=0;
	$query="SELECT DISTINCT n.idSession, s.session, s.annee_academique,s.ordering
	FROM tbl_note_all AS n, $tbl_session AS s, $tbl_cours AS c
	where n.idSession = s.idSession
	AND n.code_inscription = '$code_inscription'
	 
	AND c.code_cours_testing = n.code_cours_testing
	
	AND n.archive = 0
	order by s.ordering
	";
	 
	 	$ressource=@mysql_query($query) or die('Erreur :: Select sessions');
	 $i =0;
	while ($ligne= mysql_fetch_assoc($ressource)){
	$idSession = $ligne['idSession'];
 	$session = $ligne['session'];
	//$ac_year = $ligne['academic_year'];
 	$i++;  
	if ($i%2) {echo '</tr><tr>'; }
	//echo '</tr><tr>'; 
	?>
    	<td width="50%" valign="top">
        	<table width="100%" cellpadding="0" cellspacing="0" style="font-size:11px">
            	<tr>
                	<th colspan="4"><?php //if($ligne['annee_academique'] >='2010')
					
					echo $ligne['session'].' '. $ligne['annee_academique']?></th>
                </tr>
			<?php
             $GPA = $j = 0;           
            $sql="SELECT c.code_cours, c.titre, c.nbr_credit , n.letter_grade, n.gpa, c.type
             FROM tbl_note_all AS n, $tbl_cours AS c 
             WHERE c.code_cours_testing = n.code_cours_testing 
			 AND code_inscription = '$code_inscription' 
             AND idSession = '$idSession'
			
	AND n.archive = 0
			 ";
	
            
	
            
             $res= @mysql_query($sql) or die('Erreur :: Select notes');
             while($row = mysql_fetch_assoc($res)){
             if(($row['letter_grade']!= 'T' && $row['letter_grade']!= 'I' && $row['letter_grade']!= 'W'&& $row['letter_grade']!= 'X') && ($row['letter_grade']!='')){
             $j++;
             }
             $GPA += $row['gpa'];
             if($row['letter_grade']!= 'T' && $row['letter_grade']!= 'I' && $row['letter_grade']!='' && $row['letter_grade']!= 'W'&& $row['letter_grade']!= 'X' && $row['letter_grade']!= 'F')
			 
			 { $credit+=$row['nbr_credit'];}
			 
             if($row['letter_grade']== 'T' /*or $row['letter_grade']== 'I' or $row['letter_grade']== 'X'or $row['letter_grade']== 'W'*/)  
			 $transfer+=1 ;
              
            ?>
            <tr>
                <td width="75" align="left"  class="code"><?php echo stripslashes($row['code_cours']);?></td>
                <td width="225" align="left"><?php echo trim(stripslashes($row["titre"]));/*echo stripslashes($row['titre']);*/?> </td>
                <td width="50" align="center"><?php echo $row['nbr_credit'];?></td>
               <!--  <td width="50" align="center"><?php /*if(($mid_term=='' or $final_exam=='') and  ($letter_grade!='T' and $letter_grade!='F*' and $letter_grade!='X') and $row['code_cours']!='MEM555')
				{ echo 'I';	}
				else {*/echo $row['letter_grade'];//}?></td>-->
            </tr>
            
            <?php 
			// end fetch notes 
			 }
			             $CGPA+=$GPA;
                          $count+=$j;
 			?>
           <!-- <tr>
               <td colspan="3" class="gras">Grade Point Average(GPA):</td>
               <td align="center" class="gras"><?php echo $j>0 ? round($GPA/$j, 2) : '' ; ?></td>
           </tr>-->
         </table>
     </td>
   <?php
   // end fetch session
  } 
  ?>
  </tr>
  </table>

 
 <?php
 } 
 ?>
