<style type="text/Css">
<!--
table
{
	width:	100%;
	border:	solid 1px #000;
	font-size:9px;
}

th
{
	text-align:	center;
	border:		solid 1px #000;
}

td
{
	text-align:	left;
}
.gras{
font-weight:bold;
}
-->
</style>
 <?php
 require "../../../administrator/config/config.php";

 $CGPA=$count=$credit=0;
	 if (isset($_GET['buletin'])){
	 $code_inscription = addslashes($_GET['buletin']);
	 // select student information
	 $sql="SELECT concat(nom, ' ', prenom) AS name, date_inscription, date_naissance, nom_filiere, niveau 
	 FROM $tbl_etudiant as e, $tbl_filiere as f WHERE code_inscription= '$code_inscription' and e.filiere=f.id_filiere LIMIT 1";
	 $res= @mysql_query($sql) or die('Erreur :: Student information');
	 $row = @mysql_fetch_assoc($res);
	 ?>
	 <br /> <br /> <br /> <br /> <br /><br /> <br /> <br /> <br /> <br />
	 <table style="border:1px solid #fff">
	 <tr>
	 	<td>
		  <table style="width:100%" align="left" cellpadding="0" cellspacing="0">
			<tr>
				<td style="width:50%"><span class="gras">Name: </span><?php echo ucfirst($row['name']);?></td>
				<td style="width:50%"><span class="gras">I.D Number: </span> <?php echo $code_inscription;?></td>
			</tr>
			<tr>
				<td><span class="gras">Birth date: </span> <?php $date=$row['date_naissance'];
		$tab=split('[/.-]',$date);
		echo $tab[2].'-'.$tab[1].'-'.$tab[0]; /*echo $row['date_naissance'];*/
		
		?></td>
				<td><span class="gras">Degree pursued: </span> <?php echo $row['niveau'];?></td>
			</tr>
			<tr>
				<td><span class="gras">First registration: </span><?php $date=$row['date_inscription'];
		$tab=split('[/.-]',$date); 
		echo $tab[2].'-'.$tab[1].'-'.$tab[0];?> </td>
				<td><span class="gras">Major: </span><?php echo $row['nom_filiere'];?> </td>
			</tr>
		  </table>
		  <br />
		  <table style="width:100%" cellspacing="0" border="0" align="left">
			<tr>
			<?php
			$transfer=0;
			$query="SELECT DISTINCT n.idSession, s.session, s.annee_academique 
	FROM $tbl_note AS n, $tbl_session AS s, $tbl_cours AS c
	where n.idSession = s.idSession
	AND n.code_inscription = '$code_inscription'
		AND c.code_cours = n.code_cours
	AND n.archive = 0
	AND c.type = 'master'
		ORDER BY n.idSession"; 
			$ressource=@mysql_query($query) or die('Erreur :: Select sessions');
			$i =0;
			while ($ligne= mysql_fetch_assoc($ressource)){
			$idSession=$ligne['idSession'];
			$session = $ligne['session'];
			$i++;  
			if ($i%2 && $i!=0) {echo '</tr><tr>'; }
			?>
				<td style="width:50%" valign="top">
								<table style="width:100%" cellpadding="0" cellspacing="2" border="1">
						
					<?php
					 $GPA = $j =  $header = 0;           
					  $sql="SELECT n.code_cours, c.titre, c.nbr_credit , n.letter_grade, n.gpa, c.type
             FROM $tbl_note AS n, $tbl_cours AS c 
             WHERE c.code_cours = n.code_cours 
             AND code_inscription = '$code_inscription' 
             AND idSession = '$idSession'
			 AND (ucase(trim(c.type)) = 'MASTER' OR ucase(trim(c.type)) ='MBA')
	     	 AND n.archive = 0";
					 $res= @mysql_query($sql) or die('Erreur :: Select notes');
					 while($row = mysql_fetch_assoc($res)){
					 if(($row['letter_grade']!= 'T' && $row['letter_grade']!= 'I') && ($row['letter_grade']!='') && $row['letter_grade']!= 'W'&& $row['letter_grade']!= 'X'){
             $j++;
             }
					 $GPA += $row['gpa'];
					 if($row['letter_grade']!= 'T' && $row['letter_grade']!= 'I' && $row['letter_grade']!='' && $row['letter_grade']!= 'W'&& $row['letter_grade']!= 'X'){ $credit+=$row['nbr_credit'];}
					 if($row['letter_grade']== 'T' /*or $row['letter_grade']== 'TC'  or $row['letter_grade']== 'X'or $row['letter_grade']== 'W'*/)  $transfer+=1 ;
					  if ($header == 0 ) {
					?>
					
					 <tr class="gras">
							<td style="width:15%">Course</td>
							<td style="width:65%">Description</td>
							<td style="width:10%">Credit</td>
							<td style="width:10%">Grade</td>
					 </tr>
					 <tr>
							<td colspan="4" align="center"><?php echo $ligne['session'].' '. $ligne['annee_academique']?></td>
					 </tr>
					 <? } ?>
					 <? $header = 1; ?>
					 <tr>
						<td style="width:15%" align="left" class="gras"><?php echo stripslashes($row['code_cours']);?></td>
						<td style="width:65%" align="left"><?php echo stripslashes($row['titre']);?></td>
						<td style="width:10%" align="center"><?php echo $row['nbr_credit'];?></td>
						<td style="width:10%" align="center"><?php echo $row['letter_grade'];?></td>
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
				  <br />
                </td>
   <?php
   // end fetch session
  } 
  ?>
  </tr>
  </table>
 
  <br />
  <table style="width:100%" cellspacing="0" border="0" align="left" class="gras" style="padding-right:450px;">
  <tr>
    <td>CGPA Credits: <?php echo $credit; ?></td>
  </tr>
  <tr>
    <td>Transfet Credits: <?php echo $transfer*3; ?></td>
  </tr>
  <tr>
    <td>Cumulate Grade Point Average (CGPA): <?php echo  $count > 0 ? round($CGPA/$count, 2) : '' ; ?></td>
  </tr>
  <tr>
    <td>End of transcript</td>
  </tr>
  </table>
  <br />
  <table style="width:100%" border="0" cellspacing="0" align="left">
  <tr>
    <td>Valid only when signed and stamped with the seal of the institute.<br />Date printed<br /><?php echo date('Y-m-d');?></td>
  </tr>
  </table>
  </td></tr></table>
 <?php
 }
 ?>