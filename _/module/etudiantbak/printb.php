<head>
<style>
  body {
  background-image:url('transcript.jpg') ; 
  background-repeat:no-repeat ;
  background-size: 91% ;
  background-position:50% 0%;
  
  }
</style>

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
	 if (isset($_GET['printb'])){
	 $code_inscription= addslashes($_GET['printb']);
	 // select student information
	 $sql="SELECT nom, prenom, date_inscription, date_naissance, niveau ,adresse
	 FROM tbl_etudiant  WHERE code_inscription= '$code_inscription'";
	 $res= @mysql_query($sql) or die('Erreur :: Student information');
	 $row = @mysql_fetch_assoc($res);
	 $date=$row['date_naissance'];
	 $nom=$row['nom'];
	 $prenom=$row['prenom'];
	 $adresse=$row['adresse'];
	 $lieu_naissance=$row['lieu_naissance'];
	 $code_bac=$row['code_bac'];
	 
	 ?>
	 
	 <html>
 <br /> <br /> <br /> <br /> <br /><br />  <br /> <br /> 
<!--
<body bgcolor="#F8F8F8" lang=FR style='tab-interval:36.0pt'>
-->

<body >

<div class=WordSection1>
<table align="center" border="1" cellpadding="0" cellspacing="0" width="87%">
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
      <td colspan="20" align="left" valign="middle" height="30" >&nbsp; Full Name:<?php echo $prenom.$nom;?> 
      </td>
      <td colspan="20" align="center" valign="middle" height="30" class="gras" >&nbsp;
        LAST NAME:<?php echo ;?> </td>
      <td colspan="20" align="left" valign="middle" height="30" class="gras">&nbsp; 
        Document NO:<?php echo $code_inscription;?> </td>
      <td width="105" colspan="15" rowspan="3" align="center" valign="middle" class="gras">&nbsp;</td>
    </tr>
   
    <tr>
      <td colspan="20" align="left" valign="middle" height="30" class="gras">&nbsp; 
        Date of Birth: 
        <?php  
		$date=$row['date_naissance'];
		$tab=split('[/.-]',$date); 
		echo $tab[1].'-'.$tab[2].'-'.$tab[0]; /*echo $row['date_naissance'];*/
		
		?>
      </td>
		
      <td colspan="20" align="center" valign="middle" rowspan="2"><img src="usdla.png" width="80" height="40" border="0"/></td>
	  <td colspan="20" align="left" valign="middle" class="gras">&nbsp; Previous 
        School Name: 
        <?php ?>
      </td>
    </tr>
    
	<tr>
      <td colspan="20" align="left" valign="middle" height="30" class="gras">&nbsp; 
        Student Address: <?php echo $adresse;?></td>
      <td colspan="20" align="left" valign="middle" height="30" class="gras">&nbsp; 
        Previous School Address: 
        <?php ?>
      </td>
    
	</tr>
  </tbody>
</table>



<table width="87%" cellspacing="0" border="1" align="center" class="buletin_data">
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
             $sql="SELECT n.code_cours, c.titre, c.nbr_credit , n.letter_grade, n.gpa, c.type, n.IdSession
             FROM tbl_note AS n, tbl_cours AS c 
             WHERE c.code_cours = n.code_cours 
             AND code_inscription = '$code_inscription' 
			 AND n.archive = 0";
			 $res= @mysql_query($sql) or die('Erreur :: Select notes');
             
			 while($row = mysql_fetch_assoc($res)){
             
			 $ss=$row['IdSession'];
			 
			 $sql2="SELECT session, annee_academique from tbl_session where IdSession= '$ss'";
			 $res2= @mysql_query($sql2) or die('Erreur :: Select session');
			 $ligne=mysql_fetch_assoc($res2);		
			 $d=$ligne['session'].' '. $ligne['annee_academique'];
 
			 if(($row['letter_grade']!= 'T' && $row['letter_grade']!= 'I') && ($row['letter_grade']!='') && $row['letter_grade']!= 'W'&& $row['letter_grade']!= 'X'){
             $j++;
             }
             $GPA += $row['gpa'];
             
			 if($row['letter_grade']!= 'T' && $row['letter_grade']!= 'I' && $row['letter_grade']!='' && $row['letter_grade']!= 'W'&& $row['letter_grade']!= 'X'){ $credit+=$row['nbr_credit'];}
             if($row['letter_grade']== 'T' /*or $row['letter_grade']== 'I' or $row['letter_grade']== 'X'or $row['letter_grade']== 'W'*/)  $transfer+=1 ;
              
            ?>
            <td width="50%" valign="top" style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: 0px solid #000; border-bottom: 0px solid #000;"   >
            <table width="100%" cellpadding="0" cellspacing="0" style="font-size:11px">   
			<tr>
                <td width="75" align="left"  class="code"><?php echo stripslashes($row['code_cours']);?></td>
                <td width="225" align="left"><?php echo stripslashes($row['titre']);?></td>
                <td width="50" align="center"><?php echo $row['letter_grade'];?></td>
				<td width="50" align="center"><?php echo $row['nbr_credit'];?></td>
				<td width="50" align="center"><?php echo $d; ?></td>
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
</table>
		 
     </td>
	</tr>
</table>
  
  
  <table width="87%" border="1" cellspacing="0" align="center" style="border: 1px solid #000; font-size:11px; font-weight:bold; margin-top:0px">
  <tr> 
    <td width="475" height="50">SPECIAL RECOMMENDATIONS: </td> 
    <td width="199" height="50">GRADUATION DATE: </td>
    <td width="270" height="50">SCHOOL OFFICAL SIGNATURE: </td>
  </tr> 
</table>
 <?php
 }
?>
