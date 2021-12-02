 <?php
 	 $CGPA=$count=$credit=0;
	 if (isset($_GET['buletin'])){
	 $code_inscription= addslashes($_GET['buletin']);
	 // select student information
	 $sql="SELECT concat(nom, ' ', prenom) AS name, date_inscription, date_naissance, nom_filiere, niveau 
	 FROM $tbl_etudiant as e, $tbl_filiere as f WHERE code_inscription= '$code_inscription' and e.filiere=f.id_filiere LIMIT 1";
	 $res= @mysql_query($sql) or die('Erreur :: Student information');
	 $row = @mysql_fetch_assoc($res);
	 ?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" class="haut_table">
  <tr>
    <td><img src="images/icone/etudiants.gif" border="0"/></td>
    <td width="78%" class="titre">&nbsp;Bulletin</span></td>
	<td width="90">
	  <table border="0" align="right" width="100%" cellpadding="10" cellspacing="4" id="link" >
	    <tr>
		 <td valign="top" align="center" >
		  <a href="http://piimt.us/piimt/html2pdf_v3.20/html2pdf_v3.20/exemples/exemple00.php?buletin=<?php echo $code_inscription?>" target="_blank"  title="Imprimer"> 
		  <div class="imprimer"></div>Imprimer</a>
		  </td>
		   <td align="right">
		 <a href="gestion_des_etudiants.php"><div class="retour"></div>retour</a>
		 </td>
		</tr>
	  </table>
	</td> 
  </tr>
</table>
  <table class="buletin_header" cellspacing="5" width="1000" align="center">
  	<tr>
    	<td><span class="gras">Name: </span><?php echo ucfirst($row['name']);?></td>
        <td><span class="gras">I.D Number: </span> <?php echo $code_inscription;?></td>
    </tr>
    <tr>
    	<td><span class="gras">Birth date: </span> <?php echo $row['date_naissance'];?></td>
        <td><span class="gras">Degree pursued: </span> <?php echo $row['niveau'];?></td>
    </tr>
    <tr>
    	<td><span class="gras">First registration: </span><?php echo $row['date_inscription'];?> </td>
        <td><span class="gras">Major:  </span><?php echo $row['nom_filiere'];?> </td>
    </tr>
  </table>
  <table width="1000" cellspacing="0" border="1" align="center" class="buletin_data">
  	<tr>
    	<th width="50%">
        	<table width="100%" cellspacing="0" class="gras">
            	<tr>
                    <td width="75">Course</td>
                    <td>Description</td>
                    <td width="50">Credit</td>
                    <td width="50">Grade</td>
                </tr>
            </table>
        </th>
        <th width="50%">
		
        	<table width="100%" cellspacing="0" class="gras">
            	<tr>
                    <td width="75">Course</td>
                    <td>Description</td>
                    <td width="50">Credit</td>
                    <td width="50">Grade</td>
                </tr>
            </table>
			
        </th>
    </tr>
    <tr>
    <?php
    $transfer=0;
	$query="SELECT DISTINCT n.idSession, s.session, s.annee_academique 
	FROM $tbl_note AS n, $tbl_session AS s
	where n.idSession = s.idSession
	AND n.code_inscription = '$code_inscription'
	AND n.archive = 0
	ORDER BY n.idSession";   
	$ressource=@mysql_query($query) or die('Erreur :: Select sessions');
	$i =0;
	while ($ligne= mysql_fetch_assoc($ressource)){
	$idSession = $ligne['idSession'];
 	$session = $ligne['session'];
 	$i++;  
	if ($i%2) {echo '</tr><tr>'; }
	?>
    	<td width="50%" valign="top">
        	<table width="100%" cellpadding="0" cellspacing="0" style="font-size:11px">
            	<tr>
                	<th colspan="4"><?php echo $ligne['session'].' '. $ligne['annee_academique']?></th>
                </tr>
			<?php
             $GPA = $j = 0;           
             $sql="SELECT n.code_cours, c.titre, c.nbr_credit , n.letter_grade, n.gpa 
             FROM $tbl_note AS n, $tbl_cours AS c 
             WHERE c.code_cours = n.code_cours 
             AND code_inscription = '$code_inscription' 
             AND idSession = '$idSession'
	     	 AND n.archive = 0";
	
             $res= @mysql_query($sql) or die('Erreur :: Select notes');
             while($row = mysql_fetch_assoc($res)){
             if(($row['letter_grade']!= 'T' && $row['letter_grade']!= 'I') && ($row['letter_grade']!='')){
             $j++;
             }
             $GPA += $row['gpa'];
             if($row['letter_grade']!= 'T' && $row['letter_grade']!= 'I' && $row['letter_grade']!=''){ $credit+=$row['nbr_credit'];}
             if($row['letter_grade']== 'T' or $row['letter_grade']== 'I')  $transfer+=1 ;
              
            ?>
             <tr>
                <td width="75" align="left"  class="code"><?php echo stripslashes($row['code_cours']);?></td>
                <td width="225" align="left"><?php echo stripslashes($row['titre']);?></td>
                <td width="50" align="center"><?php echo $row['nbr_credit'];?></td>
                <td width="50" align="center"><?php echo $row['letter_grade'];?></td>
            </tr>
            
            <?php 
			// end fetch notes 
			 }
			             $CGPA+=$GPA;
                          $count+=$j;
 			?>
           <tr>
               <td colspan="3" class="gras">Grade Point Average(GPA):</td>
               <td align="center" class="gras"><?php echo $j>0 ? round($GPA/$j, 2) : '' ; ?></td>
           </tr>
         </table>
     </td>
   <?php
   // end fetch session
  } 
  ?>
  </tr>
  </table>
  
  <table width="1000" cellspacing="0" align="center" style="border: 1px solid #000; font-size:11px; font-weight:bold; margin-top:10px">
  <tr>
    <td>CGPA Credits: <?php echo $credit; ?></td>
  </tr>
  <tr>
    <td>Transfet Credits: <?php echo $transfer; ?></td>
  </tr>
  <tr>
    <td>Cumulate Grade Point Average (CGPA): <?php echo  $count > 0 ? round($CGPA/$count, 2) : '' ; ?></td>
  </tr>
  <tr>
    <td>End of transcript</td>
  </tr>
  </table>
  
  <table width="1000" cellspacing="0" align="center" style="font-size:11px;">
  <tr>
    <td>Valid only when signed and stamped with the seal of the institute.<br />Date printed<br /><?php echo date('Y-m-d');?></td>
  </tr>
  </table>
 <?php
 }
 ?>
